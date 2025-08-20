<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db_connect.php';

// Verify admin role
$sql = "SELECT role FROM user WHERE user_name = :user_name";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || $user['role'] !== 'admin') {
	http_response_code(403);
	die('Forbidden');
}

/**
 * Read lines from a log file, supporting both plain text and gzipped files.
 * Returns a generator yielding lines to minimize memory usage.
 */
function readLogLines(string $filePath): Generator {
	$extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
	if ($extension === 'gz') {
		$handle = @gzopen($filePath, 'rb');
		if (!$handle) {
			throw new RuntimeException('Could not open gz file: ' . basename($filePath));
		}
		try {
			while (!gzeof($handle)) {
				yield gzgets($handle);
			}
		} finally {
			gzclose($handle);
		}
	} else {
		$handle = @fopen($filePath, 'rb');
		if (!$handle) {
			throw new RuntimeException('Could not open file: ' . basename($filePath));
		}
		try {
			while (!feof($handle)) {
				yield fgets($handle);
			}
		} finally {
			fclose($handle);
		}
	}
}

/**
 * Parse a single log line (common/combined format).
 * Returns associative array or null if unparsable.
 */
function parseLogLine(string $line): ?array {
	$line = trim($line);
	if ($line === '') return null;
	$pattern = '/^(?P<ip>\S+)\s+\S+\s+\S+\s+\[(?P<time>[^\]]+)\]\s+"(?P<request>[^"]*)"\s+(?P<status>\d{3})\s+(?P<size>\S+)(?:\s+"(?P<referer>[^"]*)")?(?:\s+"(?P<agent>[^"]*)")?/';
	if (!preg_match($pattern, $line, $matches)) {
		return null;
	}
	$method = $path = $protocol = '';
	if (!empty($matches['request'])) {
		$parts = explode(' ', $matches['request'], 3);
		$method = $parts[0] ?? '';
		$path = $parts[1] ?? '';
		$protocol = $parts[2] ?? '';
	}
	return [
		'ip' => $matches['ip'] ?? '',
		'time' => $matches['time'] ?? '',
		'method' => $method,
		'path' => $path,
		'protocol' => $protocol,
		'status' => isset($matches['status']) ? (int)$matches['status'] : null,
		'size' => $matches['size'] ?? '-',
		'referer' => $matches['referer'] ?? '',
		'agent' => $matches['agent'] ?? '',
	];
}

/**
 * Resolve IP geolocation via ip-api.com and cache results to file.
 */
function geolocateIps(array $ips): array {
	$cacheDir = __DIR__ . '/../cache';
	$cacheFile = $cacheDir . '/ip_geo_cache.json';
	if (!is_dir($cacheDir)) {
		@mkdir($cacheDir, 0777, true);
	}
	$cache = [];
	if (is_file($cacheFile)) {
		$json = file_get_contents($cacheFile);
		$cache = json_decode($json, true) ?: [];
	}
	$now = time();
	$ttl = 60 * 60 * 24 * 14; // 14 days
	$result = [];
	$toLookup = [];
	foreach ($ips as $ip) {
		if (!filter_var($ip, FILTER_VALIDATE_IP)) continue;
		if (isset($cache[$ip]) && isset($cache[$ip]['_ts']) && ($now - (int)$cache[$ip]['_ts'] < $ttl)) {
			$result[$ip] = $cache[$ip];
		} else {
			$toLookup[] = $ip;
		}
	}
	// Limit outbound lookups to avoid rate limits
	$toLookup = array_slice(array_values(array_unique($toLookup)), 0, 100);
	foreach ($toLookup as $ip) {
		$url = 'http://ip-api.com/json/' . urlencode($ip) . '?fields=status,country,regionName,city,lat,lon,query';
		$data = [];
		if (function_exists('curl_init')) {
			$ch = curl_init($url);
			curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CONNECTTIMEOUT => 3,
				CURLOPT_TIMEOUT => 5,
			]);
			$resp = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($resp ?? '', true) ?: [];
		} else {
			$ctx = stream_context_create(['http' => ['timeout' => 5]]);
			$resp = @file_get_contents($url, false, $ctx);
			$data = json_decode($resp ?? '', true) ?: [];
		}
		if (($data['status'] ?? '') === 'success') {
			$entry = [
				'country' => $data['country'] ?? '',
				'region' => $data['regionName'] ?? '',
				'city' => $data['city'] ?? '',
				'lat' => $data['lat'] ?? null,
				'lon' => $data['lon'] ?? null,
				'_ts' => $now,
			];
			$cache[$ip] = $entry;
			$result[$ip] = $entry;
		} else {
			$cache[$ip] = ['country' => '', 'region' => '', 'city' => '', 'lat' => null, 'lon' => null, '_ts' => $now];
			$result[$ip] = $cache[$ip];
		}
		// Be gentle to API
		usleep(90000);
	}
	// Persist cache
	file_put_contents($cacheFile, json_encode($cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
	return $result;
}

// Discover available log files
$logDir = realpath(__DIR__ . '/../logs');
if ($logDir === false) {
	$logFiles = [];
} else {
	$patterns = [
		$logDir . DIRECTORY_SEPARATOR . 'access.log',
		$logDir . DIRECTORY_SEPARATOR . 'access.log.*',
		$logDir . DIRECTORY_SEPARATOR . 'access.log.*.gz',
	];
	$logFiles = [];
	foreach ($patterns as $pattern) {
		foreach (glob($pattern) ?: [] as $path) {
			if (is_file($path)) $logFiles[$path] = basename($path);
		}
	}
	// Sort newest last-modified first
	uksort($logFiles, function ($a, $b) {
		return filemtime($b) <=> filemtime($a);
	});
}

// Selected file
$selectedBase = isset($_GET['file']) ? basename($_GET['file']) : '';
$selectedPath = '';
foreach ($logFiles as $path => $base) {
	if ($base === $selectedBase) {
		$selectedPath = $path;
		break;
	}
}

// Read and parse
$limit = isset($_GET['limit']) ? max(50, min(5000, (int)$_GET['limit'])) : 500;
$rows = [];
$statusCounts = [];
$endpointCounts = [];
$ipCounts = [];
$hourlyCounts = [];
$parseErrorCount = 0;
if ($selectedPath !== '') {
	try {
		$lineNum = 0;
		foreach (readLogLines($selectedPath) as $line) {
			$lineNum++;
			$entry = parseLogLine((string)$line);
			if ($entry === null) {
				$parseErrorCount++;
				continue;
			}
			$rows[] = $entry;
			$status = (string)($entry['status'] ?? '');
			$statusCounts[$status] = ($statusCounts[$status] ?? 0) + 1;
			$endpoint = $entry['method'] . ' ' . $entry['path'];
			$endpointCounts[$endpoint] = ($endpointCounts[$endpoint] ?? 0) + 1;
			$ip = $entry['ip'];
			$ipCounts[$ip] = ($ipCounts[$ip] ?? 0) + 1;
			// Hourly aggregation
			$timeStr = $entry['time'] ?? '';
			if ($timeStr !== '') {
				$dt = DateTime::createFromFormat('d/M/Y:H:i:s O', $timeStr);
				if ($dt instanceof DateTime) {
					$hourKey = $dt->format('Y-m-d H:00');
					$hourlyCounts[$hourKey] = ($hourlyCounts[$hourKey] ?? 0) + 1;
				}
			}
			if (count($rows) >= $limit) {
				break; // limit entries for display
			}
		}
	} catch (Throwable $e) {
		$error = $e->getMessage();
	}
}

// Geolocate IPs present in current page
$geoByIp = [];
if (!empty($rows)) {
	$ips = array_values(array_unique(array_column($rows, 'ip')));
	$geoByIp = geolocateIps($ips);
}

// Derived aggregations for summary
$countryCounts = [];
foreach ($rows as $r) {
	$ip = $r['ip'];
	$geo = $geoByIp[$ip] ?? null;
	$country = trim($geo['country'] ?? '');
	if ($country === '') { $country = 'Unbekannt'; }
	$countryCounts[$country] = ($countryCounts[$country] ?? 0) + 1;
}

$sortedIpCounts = $ipCounts; arsort($sortedIpCounts);
$sortedEndpointCounts = $endpointCounts; arsort($sortedEndpointCounts);
$sortedCountryCounts = $countryCounts; arsort($sortedCountryCounts);
$sortedHourlyCounts = $hourlyCounts; ksort($sortedHourlyCounts);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Access Logs</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="icon" type="image/png" href="../assets/favicons/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/svg+xml" href="../assets/favicons/favicon.svg" />
	<link rel="shortcut icon" href="../assets/favicons/favicon.ico" />
	<link rel="manifest" href="../assets/favicons/site.webmanifest" />
</head>
<body>
	<div class="nav">
		<a href="../dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
		<a href="../logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
	</div>
	<div class="container_dashboard">
		<div class="container__title">
			<h4 class="container__title--text">Access Logs</h4>
			<span>Wählen Sie eine Logdatei aus und sehen Sie deren Inhalt mit Geolokationsdaten.</span>
		</div>
		<div class=" mb-8">
			<div class="">
				<form method="get" class="" style="display:block">
					<label for="file">Datei:</label>
					<select name="file" id="file">
						<option value="">-- Bitte wählen --</option>
						<?php foreach ($logFiles as $path => $base): ?>
							<option value="<?php echo htmlspecialchars($base); ?>" <?php echo $base === $selectedBase ? 'selected' : ''; ?>><?php echo htmlspecialchars($base); ?></option>
						<?php endforeach; ?>
					</select>
					<label for="limit">Max. Zeilen:</label>
					<input type="number" min="50" max="5000" step="50" id="limit" name="limit" value="<?php echo (int)$limit; ?>" />
					<button class="btn btn--main" type="submit">Anzeigen</button>
				</form>
			</div>
		</div>
		<?php if (!empty($error)): ?>
			<div class="">
				<div class="" style="display:block;color:#b00020">Fehler: <?php echo htmlspecialchars($error); ?></div>
			</div>
		<?php endif; ?>
		<?php if ($selectedPath !== ''): ?>
			<div class=" mb-8">
				<div class="">
					<div class="" style="display:block">
						<strong>Datei:</strong> <?php echo htmlspecialchars($selectedBase); ?>
						<span> (Anzeige auf <?php echo count($rows); ?> Zeilen begrenzt)</span>
					</div>
				</div>
				<div class="">
					<div class="" style="display:block">
						<strong>Zusammenfassung</strong>
						<div>Requests: <?php echo array_sum($statusCounts); ?> | IPs: <?php echo count($ipCounts); ?> | Parse-Fehler: <?php echo (int)$parseErrorCount; ?></div>
						<div>Status-Codes:
							<?php foreach ($statusCounts as $code => $cnt) { echo '<span style="margin-right:10px">' . htmlspecialchars((string)$code) . ': ' . (int)$cnt . '</span>'; } ?>
						</div>
					</div>
				</div>
				<div class="">
					<div class="" style="display:block">
						<strong>Top IPs</strong>
						<div>
							<?php $i = 0; foreach ($sortedIpCounts as $ip => $cnt) { if ($i++ >= 10) break; $geo = $geoByIp[$ip] ?? null; $loc = $geo ? implode(', ', array_filter([$geo['city'] ?? '', $geo['region'] ?? '', $geo['country'] ?? ''])) : ''; echo '<div>' . htmlspecialchars($ip) . ' (' . (int)$cnt . ') ' . ($loc !== '' ? '– ' . htmlspecialchars($loc) : '') . '</div>'; } ?>
						</div>
					</div>
					<div class="" style="display:block">
						<strong>Länder</strong>
						<div>
							<?php $i = 0; foreach ($sortedCountryCounts as $country => $cnt) { if ($i++ >= 10) break; echo '<div>' . htmlspecialchars($country) . ': ' . (int)$cnt . '</div>'; } ?>
						</div>
					</div>
					<div class="" style="display:block">
						<strong>Top Endpunkte</strong>
						<div>
							<?php $i = 0; foreach ($sortedEndpointCounts as $ep => $cnt) { if ($i++ >= 10) break; echo '<div title="' . htmlspecialchars($ep) . '">' . htmlspecialchars($ep) . ': ' . (int)$cnt . '</div>'; } ?>
						</div>
					</div>
					<div class="" style="display:block">
						<strong>Requests pro Stunde</strong>
						<div style="display:flex; flex-wrap:wrap; gap:8px">
							<?php foreach ($sortedHourlyCounts as $h => $cnt) { echo '<span style="background:#f2f2f2; padding:4px 6px; border-radius:4px">' . htmlspecialchars($h) . ': ' . (int)$cnt . '</span>'; } ?>
						</div>
					</div>
				</div>
				<div class="" style="overflow:auto; max-height:65vh">
					<table class="table" style="width:100%; border-collapse:collapse">
						<thead>
							<tr>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Zeit</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">IP</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Ort</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Anfrage</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Status</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Bytes</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">Referer</th>
								<th style="text-align:left; padding:6px; border-bottom:1px solid #ddd">UA</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($rows as $r): ?>
							<tr>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0"><?php echo htmlspecialchars($r['time']); ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0"><?php echo htmlspecialchars($r['ip']); ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0">
									<?php
									$geo = $geoByIp[$r['ip']] ?? null;
									if ($geo) {
										$parts = array_filter([$geo['city'] ?? '', $geo['region'] ?? '', $geo['country'] ?? '']);
										$label = implode(', ', $parts);
										if (($geo['lat'] ?? null) !== null && ($geo['lon'] ?? null) !== null) {
											$lat = (float)$geo['lat'];
											$lon = (float)$geo['lon'];
											$url = 'https://www.openstreetmap.org/?mlat=' . rawurlencode((string)$lat) . '&mlon=' . rawurlencode((string)$lon) . '#map=8/' . rawurlencode((string)$lat) . '/' . rawurlencode((string)$lon);
											echo '<a href="' . htmlspecialchars($url) . '" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($label !== '' ? $label : ($geo['country'] ?? '')) . '</a>';
										} else {
											echo htmlspecialchars($label !== '' ? $label : ($geo['country'] ?? ''));
										}
									} else {
										echo '-';
									}
									?>
								</td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0"><?php echo htmlspecialchars($r['method'] . ' ' . $r['path']); ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0"><?php echo (int)$r['status']; ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0"><?php echo htmlspecialchars((string)$r['size']); ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0; max-width:280px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap" title="<?php echo htmlspecialchars($r['referer']); ?>"><?php echo htmlspecialchars($r['referer']); ?></td>
								<td style="padding:6px; border-bottom:1px solid #f0f0f0; max-width:360px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap" title="<?php echo htmlspecialchars($r['agent']); ?>"><?php echo htmlspecialchars($r['agent']); ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
		<?php include __DIR__ . '/../includes/footer.php'; ?>
		<div class="devBtn"></div>
	</div>
</body>
</html>


