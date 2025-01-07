<?php
// session_start();
require './includes/auth.php';
require './includes/db_connect.php';

// CSRF-Schutz vorbereiten
if (!isset($_SESSION['csrf_token'])) {
   $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Verarbeite das Formular, wenn es abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Überprüfe CSRF-Token
   if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die("Ungültiger CSRF-Token.");
   }

   // Eingaben validieren und bereinigen
   $company_name = htmlspecialchars(trim($_POST['company_name']));
   $company_email = filter_var($_POST['company_email'], FILTER_SANITIZE_EMAIL);
   $company_password = $_POST['company_password']; // Wird später gehasht
   $company_job_desc = htmlspecialchars(trim($_POST['company_job_desc']));
   $company_initial_apply = $_POST['company_initial_apply'];

   // Validierung der Eingaben
   if (empty($company_name) || empty($company_email) || empty($company_password)) {
      die("Benutzername, E-Mail und Passwort dürfen nicht leer sein.");
   }

   if (!filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
      die("Ungültige E-Mail-Adresse.");
   }

   // Passwort-Hashing
   $hashed_password = password_hash($company_password, PASSWORD_DEFAULT);

   try {
      // SQL-Abfrage vorbereiten
      $sql = "
           INSERT INTO user (user_name, email, passwort, job_desc, initial_apply)
           VALUES (:company_name, :company_email, :company_password, :company_job_desc, :company_initial_apply)
       ";
      $stmt = $pdo->prepare($sql);

      // Parameter binden
      $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
      $stmt->bindParam(':company_email', $company_email, PDO::PARAM_STR);
      $stmt->bindParam(':company_password', $hashed_password, PDO::PARAM_STR);
      $stmt->bindParam(':company_job_desc', $company_job_desc, PDO::PARAM_STR);
      $stmt->bindParam(':company_initial_apply', $company_initial_apply, PDO::PARAM_STR);

      // Query ausführen
      $stmt->execute();

      // Erfolgsmeldung und Weiterleitung
      header('Location: dashboard.php?success=1');
      exit();
   } catch (PDOException $e) {
      die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Unternehmen Hinzufügen</title>
   <link rel="stylesheet" href="./style.css">
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
   <div class="container_dashboard">
      <h1>Unternehmen Hinzufügen</h1>
      <!-- Formular anzeigen -->
      <form action="add_comp" method="post">
         <!-- CSRF-Token als verstecktes Feld -->
         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

         <label for="company_name">Benutzername:</label>
         <input type="text" id="company_name" name="company_name" required>
         <br>

         <label for="company_email">E-Mail:</label>
         <input type="email" id="company_email" name="company_email" required>
         <br>

         <label for="company_password">Passwort:</label>
         <input type="password" id="company_password" name="company_password" required>
         <br>

         <label for="company_job_desc">Job-Beschreibung:</label>
         <input type="text" id="company_job_desc" name="company_job_desc">
         <br>

         <label for="company_initial_apply">Initial Apply:</label>
         <input type="checkbox" id="company_initial_apply" name="company_initial_apply">
         <br>

         <button type="submit">Hinzufügen</button>
      </form>
   </div>
</body>

</html>