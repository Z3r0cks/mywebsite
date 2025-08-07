<?php
/**
 * Dedicated 404 error page
 * Handles requests for non-existent URLs with better user experience
 */

require_once __DIR__ . '/includes/error_handler.php';

// Log the 404 error
ErrorHandler::logHttpError(404, '404 Not Found - Page does not exist', $_SERVER['REQUEST_URI'] ?? 'Unknown');

// Set proper HTTP status code
http_response_code(404);

// Start session for potential login functionality
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Seite nicht gefunden - 404</title>
   <link rel="stylesheet" href="./style.css">
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
   
   <style>
   .error-404 {
       text-align: center;
       padding: 50px 20px;
   }
   
   .error-404 h1 {
       font-size: 8rem;
       font-weight: bold;
       color: #6c757d;
       margin: 0;
       line-height: 1;
   }
   
   .error-404 h2 {
       font-size: 2rem;
       margin: 20px 0;
       color: #343a40;
   }
   
   .error-404 p {
       font-size: 1.2rem;
       color: #6c757d;
       margin-bottom: 30px;
   }
   
   .error-actions-404 {
       display: flex;
       justify-content: center;
       gap: 20px;
       flex-wrap: wrap;
       margin: 30px 0;
   }
   
   .error-btn {
       padding: 12px 24px;
       border: none;
       border-radius: 5px;
       text-decoration: none;
       font-size: 16px;
       cursor: pointer;
       transition: all 0.3s ease;
   }
   
   .error-btn--primary {
       background-color: #007bff;
       color: white;
   }
   
   .error-btn--primary:hover {
       background-color: #0056b3;
       color: white;
   }
   
   .error-btn--secondary {
       background-color: #6c757d;
       color: white;
   }
   
   .error-btn--secondary:hover {
       background-color: #545b62;
       color: white;
   }
   
   .search-suggestions {
       margin: 40px 0;
       padding: 20px;
       background-color: #f8f9fa;
       border-radius: 8px;
       text-align: left;
   }
   
   .search-suggestions h3 {
       margin-top: 0;
       color: #495057;
   }
   
   .search-suggestions ul {
       margin: 15px 0;
       padding-left: 20px;
   }
   
   .search-suggestions li {
       margin: 8px 0;
       color: #6c757d;
   }
   
   .search-suggestions a {
       color: #007bff;
       text-decoration: none;
   }
   
   .search-suggestions a:hover {
       text-decoration: underline;
   }
   
   @media (max-width: 768px) {
       .error-404 h1 {
           font-size: 6rem;
       }
       
       .error-404 h2 {
           font-size: 1.5rem;
       }
       
       .error-actions-404 {
           flex-direction: column;
           align-items: center;
       }
       
       .error-btn {
           width: 200px;
       }
   }
   </style>
</head>

<body>
   <div class="container">
      <div class="error-404">
         <h1>404</h1>
         <h2>Seite nicht gefunden</h2>
         <p>Die Seite, die Sie suchen, existiert nicht oder wurde verschoben.</p>
         
         <div class="error-actions-404">
            <a href="index.php" class="error-btn error-btn--primary">Zur Startseite</a>
            <button onclick="history.back()" class="error-btn error-btn--secondary">Zurück</button>
         </div>
         
         <div class="search-suggestions">
            <h3>Was können Sie tun?</h3>
            <ul>
               <li>Überprüfen Sie die URL auf Tippfehler</li>
               <li>Verwenden Sie die Navigation oder gehen Sie zur <a href="index.php">Startseite</a></li>
               <li>Nutzen Sie den Zurück-Button Ihres Browsers</li>
               <li>Falls Sie über einen Link hierher gekommen sind, ist dieser möglicherweise veraltet</li>
            </ul>
            
            <h3>Häufig gesuchte Seiten:</h3>
            <ul>
               <li><a href="index.php">Startseite</a></li>
               <li><a href="dashboard.php">Dashboard</a> (Login erforderlich)</li>
               <li><a href="documents.php">Dokumente</a> (Login erforderlich)</li>
            </ul>
         </div>
         
         <!-- Optional: Login form for quick access -->
         <div class="search-suggestions">
            <h3>Schnell anmelden</h3>
            <p>Falls Sie sich anmelden möchten, um auf geschützte Inhalte zuzugreifen:</p>
            
            <form class="display-flex flex-column login" action="check_login.php" method="POST" style="max-width: 400px; margin: 0 auto;">
               <div class="display-flex flex-justify-between">
                  <div class="mr-10-px login--input">
                     <label for="user_name">Benutzername</label>
                     <input type="text" placeholder="Login Name" id="user_name" name="user_name" required>
                  </div>
                  <div class="ml-10-px login--input">
                     <label for="password">Passwort</label>
                     <input type="password" placeholder="Passwort" id="password" name="password" required>
                     <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                  </div>
               </div>
               <button class="button_form" type="submit">Anmelden</button>
            </form>
            
            <div class="guest-login-section">
               <p class="text-center">oder</p>
               <form class="display-flex flex-column login" action="guest_login.php" method="POST" style="max-width: 400px; margin: 0 auto;">
                  <button class="button_form" type="submit">Als Gast anmelden</button>
               </form>
            </div>
         </div>
      </div>
   </div>

   <script>
   // Optional: Track 404 errors for analytics
   if (typeof gtag !== 'undefined') {
       gtag('event', 'page_view', {
           'page_title': '404 Not Found',
           'page_location': window.location.href
       });
   }
   
   // Auto-focus on username field if user scrolls to login form
   const observer = new IntersectionObserver((entries) => {
       entries.forEach(entry => {
           if (entry.isIntersecting) {
               document.getElementById('user_name').focus();
           }
       });
   });
   
   const loginForm = document.querySelector('form[action="check_login.php"]');
   if (loginForm) {
       observer.observe(loginForm);
   }
   </script>
</body>

</html>
