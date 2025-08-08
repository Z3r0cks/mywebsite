<?php
/**
 * Admin interface for viewing error logs
 * Requires admin authentication
 */

require_once __DIR__ . '/../includes/error_handler.php';
require_once __DIR__ . '/../includes/auth.php';

// Check if user is logged in and has admin rights
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../error.php?type=403');
    exit();
}

// For now, assume any logged-in user can view logs
// In production, you should check for admin role
// if ($_SESSION['role'] !== 'admin') {
//     header('Location: ../error.php?type=403');
//     exit();
// }

$limit = $_GET['limit'] ?? 50;
$errors = ErrorHandler::getRecentErrors((int)$limit);
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Logs - Admin</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    .admin-header {
        background-color: #343a40;
        color: white;
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .admin-nav {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }
    
    .admin-nav a {
        color: #adb5bd;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 3px;
    }
    
    .admin-nav a:hover,
    .admin-nav a.active {
        background-color: #495057;
        color: white;
    }
    
    .log-controls {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    
    .log-entry {
        background-color: white;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 15px;
        overflow: hidden;
    }
    
    .log-header {
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-bottom: 1px solid #dee2e6;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .log-header:hover {
        background-color: #e9ecef;
    }
    
    .log-content {
        padding: 15px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        white-space: pre-wrap;
        background-color: #f8f9fa;
        display: none;
    }
    
    .log-content.expanded {
        display: block;
    }
    
    .severity-FATAL { border-left: 4px solid #dc3545; }
    .severity-ERROR { border-left: 4px solid #fd7e14; }
    .severity-WARNING { border-left: 4px solid #ffc107; }
    .severity-NOTICE { border-left: 4px solid #17a2b8; }
    .severity-INFO { border-left: 4px solid #28a745; }
    
    .expand-icon {
        transition: transform 0.3s ease;
    }
    
    .expand-icon.rotated {
        transform: rotate(180deg);
    }
    
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        text-align: center;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #495057;
    }
    
    .stat-label {
        color: #6c757d;
        margin-top: 5px;
    }
    </style>
</head>

<body>
    <div class="admin-header">
        <h1>Error Logs Administration</h1>
        <div class="admin-nav">
            <a href="../dashboard.php">Dashboard</a>
            <a href="error_logs.php" class="active">Error Logs</a>
            <a href="../index.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?= count($errors) ?></div>
                <div class="stat-label">Geladene Einträge</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?= count(array_filter($errors, function($error) { 
                        return strpos($error, 'FATAL') !== false || strpos($error, 'ERROR') !== false; 
                    })) ?>
                </div>
                <div class="stat-label">Kritische Fehler</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?= count(array_filter($errors, function($error) { 
                        return strpos($error, 'HTTP_ERROR') !== false; 
                    })) ?>
                </div>
                <div class="stat-label">HTTP Fehler</div>
            </div>
        </div>

        <div class="log-controls">
            <form method="GET" style="display: flex; gap: 10px; align-items: center;">
                <label for="limit">Anzahl Einträge:</label>
                <select name="limit" id="limit" onchange="this.form.submit()">
                    <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                    <option value="200" <?= $limit == 200 ? 'selected' : '' ?>>200</option>
                </select>
                
                <button type="button" onclick="location.reload()" style="margin-left: 20px;">Aktualisieren</button>
                <button type="button" onclick="clearLogs()" style="background-color: #dc3545; color: white;">Logs löschen</button>
            </form>
        </div>

        <?php if (empty($errors)): ?>
            <div class="log-entry">
                <div class="log-content" style="display: block;">
                    Keine Fehler gefunden. Das ist ein gutes Zeichen! 🎉
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($errors as $index => $error): ?>
                <?php
                // Parse error to determine severity
                $severity = 'INFO';
                if (strpos($error, 'FATAL') !== false) $severity = 'FATAL';
                elseif (strpos($error, 'ERROR') !== false) $severity = 'ERROR';
                elseif (strpos($error, 'WARNING') !== false) $severity = 'WARNING';
                elseif (strpos($error, 'NOTICE') !== false) $severity = 'NOTICE';
                
                // Extract first line for header
                $lines = explode("\n", trim($error));
                $header = $lines[0] ?? 'Unknown error';
                ?>
                <div class="log-entry severity-<?= $severity ?>">
                    <div class="log-header" onclick="toggleLog(<?= $index ?>)">
                        <span><?= htmlspecialchars($header) ?></span>
                        <span class="expand-icon" id="icon-<?= $index ?>">▼</span>
                    </div>
                    <div class="log-content" id="content-<?= $index ?>">
<?= htmlspecialchars($error) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
    function toggleLog(index) {
        const content = document.getElementById('content-' + index);
        const icon = document.getElementById('icon-' + index);
        
        content.classList.toggle('expanded');
        icon.classList.toggle('rotated');
    }
    
    function clearLogs() {
        if (confirm('Sind Sie sicher, dass Sie alle Logs löschen möchten? Diese Aktion kann nicht rückgängig gemacht werden.')) {
            // This would require a separate endpoint to handle log clearing
            alert('Log-Clearing-Funktionalität muss noch implementiert werden.');
        }
    }
    
    // Auto-refresh every 30 seconds
    setTimeout(function() {
        location.reload();
    }, 30000);
    </script>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
</body>

</html>
