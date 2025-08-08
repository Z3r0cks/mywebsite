<?php
/**
 * Enhanced error handling page
 * Handles different types of errors including HTTP errors and application errors
 */

require_once __DIR__ . '/includes/error_handler.php';

// Start session for error logging if needed
session_start();

// Get error type from URL parameters or default to generic error
$error_type = $_GET['type'] ?? $_GET['error'] ?? 'generic';
$error_code = $_GET['code'] ?? null;

/**
 * Get error information based on type
 * @param string $type Error type
 * @return array Error information
 */
function getErrorInfo($type) {
    $errors = [
        // HTTP Errors
        '404' => [
            'title' => 'Seite nicht gefunden',
            'message' => 'Die angeforderte Seite konnte nicht gefunden werden.',
            'description' => 'Die URL die Sie eingegeben haben existiert nicht oder wurde verschoben.',
            'show_login' => false,
            'http_code' => 404
        ],
        '500' => [
            'title' => 'Interner Server Fehler',
            'message' => 'Ein unerwarteter Fehler ist aufgetreten.',
            'description' => 'Bitte versuchen Sie es später erneut oder kontaktieren Sie den Administrator.',
            'show_login' => false,
            'http_code' => 500
        ],
        '403' => [
            'title' => 'Zugriff verweigert',
            'message' => 'Sie haben keine Berechtigung, auf diese Seite zuzugreifen.',
            'description' => 'Möglicherweise müssen Sie sich anmelden oder haben keine ausreichenden Rechte.',
            'show_login' => true,
            'http_code' => 403
        ],
        '400' => [
            'title' => 'Ungültige Anfrage',
            'message' => 'Die Anfrage konnte nicht verarbeitet werden.',
            'description' => 'Bitte überprüfen Sie Ihre Eingaben und versuchen Sie es erneut.',
            'show_login' => false,
            'http_code' => 400
        ],
        // Application Errors
        'invalid_credentials' => [
            'title' => 'Falscher Login',
            'message' => 'Die Login-Daten waren nicht korrekt.',
            'description' => 'Benutzername oder Passwort sind falsch.',
            'show_login' => true,
            'http_code' => 401
        ],
        'invalid_token' => [
            'title' => 'Sicherheitsfehler',
            'message' => 'Ungültiger Sicherheitstoken.',
            'description' => 'Bitte laden Sie die Seite neu und versuchen Sie es erneut.',
            'show_login' => false,
            'http_code' => 403
        ],
        'database_error' => [
            'title' => 'Datenbankfehler',
            'message' => 'Ein Fehler bei der Datenverbindung ist aufgetreten.',
            'description' => 'Bitte versuchen Sie es später erneut.',
            'show_login' => false,
            'http_code' => 500
        ],
        'missing_data' => [
            'title' => 'Fehlende Daten',
            'message' => 'Nicht alle erforderlichen Felder wurden ausgefüllt.',
            'description' => 'Bitte füllen Sie alle Pflichtfelder aus.',
            'show_login' => true,
            'http_code' => 400
        ],
        'guest_not_available' => [
            'title' => 'Gast-Login nicht verfügbar',
            'message' => 'Der Gast-Zugang ist derzeit nicht verfügbar.',
            'description' => 'Bitte verwenden Sie einen regulären Login.',
            'show_login' => true,
            'http_code' => 503
        ],
        'generic' => [
            'title' => 'Ein Fehler ist aufgetreten',
            'message' => 'Da ist etwas schief gelaufen.',
            'description' => 'Bitte versuchen Sie es erneut oder kontaktieren Sie den Support.',
            'show_login' => false,
            'http_code' => 500
        ]
    ];
    
    return $errors[$type] ?? $errors['generic'];
}

$error_info = getErrorInfo($error_type);

// Set appropriate HTTP status code
http_response_code($error_info['http_code']);

// Log HTTP errors using the enhanced error handler
if (is_numeric($error_type)) {
    ErrorHandler::logHttpError(
        (int)$error_type,
        $error_info['message'],
        $_SERVER['REQUEST_URI'] ?? 'Unknown URI'
    );
} else {
    // Log application errors
    ErrorHandler::logCustomError(
        "Application error: {$error_info['message']}",
        $error_info['http_code'] >= 500 ? 'ERROR' : 'WARNING',
        ['error_type' => $error_type, 'url' => $_SERVER['REQUEST_URI'] ?? 'Unknown']
    );
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= htmlspecialchars($error_info['title']) ?></title>
   <link rel="stylesheet" href="./style.css">
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <a href="index.php"><button class="btn btn--main btn--nav">Zurück zur Startseite</button></a>
   <div class="container">
      <h1><?= htmlspecialchars($error_info['title']) ?></h1>
      <p class="mb-3"><?= htmlspecialchars($error_info['message']) ?></p>
      
      <?php if (!empty($error_info['description'])): ?>
         <p class="error-description"><?= htmlspecialchars($error_info['description']) ?></p>
      <?php endif; ?>

      <?php if ($error_info['show_login']): ?>
         <h3>Noch ein Versuch?</h3>
         <form class="display-flex flex-column login" action="check_login.php" method="POST">
            <?php
            // Generate new CSRF token if session is active
            if (session_status() === PHP_SESSION_ACTIVE) {
                if (empty($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
            }
            ?>
            <div class="display-flex flex-justify-between">
               <div class="mr-10-px login--input">
                  <label for="user_name">Benutzername</label>
                  <input type="text" placeholder="Login Name" id="user_name" name="user_name" required>
               </div>
               <div class="ml-10-px login--input">
                  <label for="password">Passwort</label>
                  <input type="password" placeholder="Passwort" id="password" name="password" required>
                  <?php if (isset($_SESSION['csrf_token'])): ?>
                     <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                  <?php endif; ?>
               </div>
            </div>
            <button class="button_form" type="submit">Anmelden</button>
         </form>
         
         <?php if ($error_type !== 'guest_not_available'): ?>
         <div class="guest-login-section">
            <p class="text-center">oder</p>
            <form class="display-flex flex-column login" action="guest_login.php" method="POST">
               <button class="button_form" type="submit">Als Gast anmelden</button>
            </form>
         </div>
         <?php endif; ?>
      <?php endif; ?>

      <?php if (in_array($error_type, ['404', '500', '403', '400'])): ?>
         <div class="error-actions">
            <p>Was können Sie tun?</p>
            <ul class="error-suggestions">
               <?php if ($error_type === '404'): ?>
                  <li>Überprüfen Sie die URL auf Tippfehler</li>
                  <li>Verwenden Sie die Navigation oder gehen Sie zur <a href="index.php">Startseite</a></li>
                  <li>Verwenden Sie den Zurück-Button Ihres Browsers</li>
               <?php elseif ($error_type === '500'): ?>
                  <li>Laden Sie die Seite in einigen Minuten neu</li>
                  <li>Leeren Sie Ihren Browser-Cache</li>
                  <li>Kontaktieren Sie den Administrator, falls das Problem weiterhin besteht</li>
               <?php elseif ($error_type === '403'): ?>
                  <li>Melden Sie sich an, um auf diese Seite zuzugreifen</li>
                  <li>Überprüfen Sie Ihre Berechtigung</li>
               <?php endif; ?>
            </ul>
         </div>
      <?php endif; ?>
   </div>

   <style>
   .error-description {
      margin-bottom: 20px;
      color: #666;
   }
   
   .error-actions {
      margin-top: 30px;
      padding: 20px;
      background-color: #f8f9fa;
      border-radius: 5px;
   }
   
   .error-suggestions {
      margin: 10px 0;
      padding-left: 20px;
   }
   
   .error-suggestions li {
      margin: 5px 0;
   }
   
   .error-suggestions a {
      color: #007bff;
      text-decoration: none;
   }
   
   .error-suggestions a:hover {
      text-decoration: underline;
   }
   </style>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>