<?php
require './includes/auth.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Was ist AI?</title>
	<link rel="stylesheet" href="./style.css">
	<script src="./js/ai_demo.js" defer></script>
	<link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
	<link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
	<link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
	<link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
	<div class="nav">
		<a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
		<a href="dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
	</div>

	<div class="container_dashboard ai-page">
		<h1>Was ist AI?</h1>

		<!-- 1. Einstieg -->
		<section class="ai-section">
			<h2>Was versteht man unter AI?</h2>
			<p class="ai-lead">Künstliche Intelligenz (AI) bezeichnet Systeme oder Maschinen, die Aufgaben ausführen können, für die normalerweise menschliche Intelligenz erforderlich ist – etwa Mustererkennung, Lernen oder Problemlösung.</p>
			<div class="ai-examples">
				<div class="ai-example-card bg-main2">
					<span class="ai-example-title">Sprache</span>
					<span class="ai-example-desc">Siri/Alexa</span>
				</div>
				<div class="ai-example-card bg-second1">
					<span class="ai-example-title">Bilder</span>
					<span class="ai-example-desc">Gesichtserkennung</span>
				</div>
				<div class="ai-example-card bg-second2">
					<span class="ai-example-title">Texte</span>
					<span class="ai-example-desc">Chatbots</span>
				</div>
			</div>
		</section>

		<!-- 2. Neuronale Netze -->
		<section class="ai-section">
			<h2>Neuronale Netze</h2>
			<p>Das Herzstück moderner AI sind neuronale Netze. Sie sind vom menschlichen Gehirn inspiriert – bestehen aber aus mathematischen Funktionen und nicht aus biologischen Zellen.</p>
			<div class="ai-grid">
				<div class="ai-neuron-svg">
					<svg viewBox="0 0 260 160" xmlns="http://www.w3.org/2000/svg" aria-label="Neuron Diagramm">
						<defs>
							<linearGradient id="g1" x1="0" x2="1">
								<stop offset="0%" stop-color="#2e6c48"/>
								<stop offset="100%" stop-color="#50b375"/>
							</linearGradient>
						</defs>
						<!-- Inputs -->
						<circle cx="30" cy="40" r="10" fill="#0f7dbd"/>
						<circle cx="30" cy="80" r="10" fill="#0f7dbd"/>
						<circle cx="30" cy="120" r="10" fill="#0f7dbd"/>
						<!-- Hidden neuron -->
						<circle cx="130" cy="80" r="18" fill="url(#g1)" stroke="#2e6c48" stroke-width="2"/>
						<!-- Output -->
						<circle cx="230" cy="80" r="12" fill="#d9534f"/>
						<!-- Connections -->
						<line x1="40" y1="40" x2="112" y2="72" stroke="#969595" stroke-width="2"/>
						<line x1="40" y1="80" x2="112" y2="80" stroke="#969595" stroke-width="2"/>
						<line x1="40" y1="120" x2="112" y2="88" stroke="#969595" stroke-width="2"/>
						<line x1="148" y1="80" x2="218" y2="80" stroke="#969595" stroke-width="2"/>
						<!-- Labels -->
						<text x="10" y="22" font-size="10" fill="#686868">Eingaben</text>
						<text x="118" y="24" font-size="10" fill="#686868">Gewichte + Bias</text>
						<text x="214" y="24" font-size="10" fill="#686868">Ausgabe</text>
					</svg>
				</div>
				<div class="ai-table-wrapper">
					<table class="ai-table">
						<thead>
							<tr>
								<th>Biologisches Neuron</th>
								<th>Künstliches Neuron</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Dendriten empfangen Signale</td>
								<td>Eingaben (Features)</td>
							</tr>
							<tr>
								<td>Soma verarbeitet Signale</td>
								<td>Gewichtung + Bias</td>
							</tr>
							<tr>
								<td>Axon gibt Signal weiter</td>
								<td>Ausgabe nach Aktivierungsfunktion</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>

		<!-- 3. Wie lernen neuronale Netze? -->
		<section class="ai-section">
			<h2>Wie lernen neuronale Netze?</h2>
			<ul class="ai-list">
				<li>Gewichte bestimmen, wie stark ein Eingang zählt</li>
				<li>Bias verschiebt die Entscheidungsschwelle</li>
				<li>Aktivierungsfunktion entscheidet, ob das Neuron „anspringt“</li>
				<li>Training passt Gewichte & Bias so lange an, bis das Netz Muster erkennt</li>
			</ul>
			<div class="ai-card">
				<h3>Interaktive Mini-Neuron-Demo</h3>
				<div class="demo-neuron" id="demo-neuron">
					<div class="demo-controls">
						<label>Eingabe x
							<input type="number" step="0.1" id="nn-input-x" value="1">
						</label>
						<label>Gewicht w
							<input type="range" min="-5" max="5" step="0.1" id="nn-weight" value="1">
							<span id="nn-weight-val">1.0</span>
						</label>
						<label>Bias b
							<input type="range" min="-5" max="5" step="0.1" id="nn-bias" value="0">
							<span id="nn-bias-val">0.0</span>
						</label>
						<label>Aktivierung
							<select id="nn-activation">
								<option value="linear">Linear</option>
								<option value="relu">ReLU</option>
								<option value="sigmoid">Sigmoid</option>
							</select>
						</label>
					</div>
					<div class="demo-output">
						<div class="demo-row"><span>z = w · x + b</span><span id="nn-z">1.0</span></div>
						<div class="demo-row"><span>y = f(z)</span><span id="nn-y">1.0</span></div>
						<div class="demo-bar" aria-label="Output visualization"><div id="nn-bar-fill"></div></div>
					</div>
				</div>
				<p class="ai-note">Verschiebe die Regler für <em>w</em> und <em>b</em>, um zu sehen, wie sich die Ausgabe verändert.</p>
			</div>
		</section>

		<!-- 4. Von Pixeln zum Gesicht -->
		<section class="ai-section">
			<h2>Von Pixeln zum Gesicht</h2>
			<p>Stell dir vor, du zeigst dem Netz ein Bild von einer Katze. In den ersten Schichten erkennt es nur Kanten und einfache Formen. In mittleren Schichten werden daraus Schnurrhaare, Augen oder Ohren. In tiefen Schichten erkennt das Netz: Das ist eine Katze.</p>
			<div class="ai-steps">
				<div class="ai-step">
					<span class="ai-step-title">Pixelmuster</span>
				</div>
				<div class="ai-step">
					<span class="ai-step-title">Kanten</span>
				</div>
				<div class="ai-step">
					<span class="ai-step-title">Nase/Ohren</span>
				</div>
				<div class="ai-step">
					<span class="ai-step-title">Katze</span>
				</div>
			</div>
		</section>

		<!-- 6. Fazit -->
		<section class="ai-section">
			<h2>Fazit</h2>
			<p>Ich beschäftige mich mit neuronalen Netzen, weil mich fasziniert, wie einfache mathematische Bausteine so komplexe Intelligenz erzeugen können.</p>
		</section>
	</div>

	<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>



