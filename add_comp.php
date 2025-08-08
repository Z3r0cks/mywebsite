<?php
// session_start();
require './includes/auth.php';
require './includes/db_connect.php';

function randomHash($lengt)
{
   $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   $pass = array(); //remember to declare $pass as an array
   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   for ($i = 0; $i < $lengt; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
   }
   return implode($pass); //turn the array into a string
}

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
   $company_initial_apply = isset($_POST["company_initial_apply"]) ? 1 : 0;

   // Validierung der Eingaben
   if (empty($company_name) || empty($company_email) || empty($company_password)) {
      die("Benutzername, E-Mail und Passwort dürfen nicht leer sein.");
   }

   if (!filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
      die("Ungültige E-Mail-Adresse.");
   }

   // Passwort-Hashing
   $hashed_password = password_hash($company_password, PASSWORD_DEFAULT);
   $file_hash = randomHash(20);

   try {

      // add user
      $sql = "
           INSERT INTO user (user_name, email, passwort, job_desc, initial_apply, role, file_hash)
           VALUES (:company_name, :company_email, :company_password, :company_job_desc, :company_initial_apply, 'user', :file_hash)
       ";
      $stmt = $pdo->prepare($sql);

      $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
      $stmt->bindParam(':company_email', $company_email, PDO::PARAM_STR);
      $stmt->bindParam(':company_password', $hashed_password, PDO::PARAM_STR);
      $stmt->bindParam(':company_job_desc', $company_job_desc, PDO::PARAM_STR);
      $stmt->bindParam(':company_initial_apply', $company_initial_apply, PDO::PARAM_STR);
      $stmt->bindParam(':file_hash', $file_hash, PDO::PARAM_STR);
      $stmt->execute();

      // add document
      $file_name = $_FILES["file"]["name"];
      $file_size = round($_FILES["file"]["size"] / 1024);
      $target_dir = "downloads/protected/motivation/";
      $target_file = $target_dir . basename($file_name);
      $target_url = "/" . $target_dir . basename($file_name);

      try {
         $sql = "
            INSERT INTO documents (file_name, file_desc, file_url, file_size, file_hash, common_file)
            VALUES (:file_name, 'Motivationsschreiben für die Bewerbung', :target_url, :file_size, :file_hash, 0)
         ";

         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
         $stmt->bindParam(':target_url', $target_url, PDO::PARAM_STR);
         $stmt->bindParam(':file_size', $file_size, PDO::PARAM_INT);
         $stmt->bindParam(':file_hash', $file_hash, PDO::PARAM_STR);
         $stmt->execute();
         move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      } catch (PDOException $e) {
         die("Fehler beim Hinzufügen des Users: " . $e->getMessage());
      }

      // add user_documents
      $user_id_query = $pdo->prepare("SELECT user_id FROM user WHERE user_name = :company_name");
      $user_id_query->execute([':company_name' => $company_name]);
      $user_id = $user_id_query->fetchColumn();

      $file_ids_query = $pdo->prepare("SELECT file_id FROM documents WHERE common_file = 1 OR file_hash = :file_hash");
      $file_ids_query->execute([':file_hash' => $file_hash]);

      $file_ids = $file_ids_query->fetchAll(PDO::FETCH_COLUMN); //

      $insert_stmt = $pdo->prepare("INSERT INTO user_documents (user_id, document_id) VALUES (:user_id, :document_id)");
      foreach ($file_ids as $document_id) {
         $insert_stmt->execute([
            ':user_id' => $user_id,
            ':document_id' => $document_id,
         ]);
      }
   } catch (PDOException $e) {
      die("Fehler beim Hinzufügen des User-Dokuments: " . $e->getMessage());
   }
}

try {
   $stmt = $pdo->prepare("SELECT user_name, user_id FROM user");
   $stmt->execute();
   $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   die("Fehler beim Hinzufügen des Dokuments: " . $e->getMessage());
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
      <form action="add_comp" method="post" enctype="multipart/form-data">
         <!-- CSRF-Token als verstecktes Feld -->
         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

         <label for="company_name">Benutzername:</label>
         <input type="text" id="company_name" name="company_name" required>
         <br>

         <label for="company_email">E-Mail:</label>
         <input type="email" id="company_email" name="company_email" required>
         <br>
         <?php $pw = randomHash(8) ?>
         <label for="company_password">Passwort:</label>
         <input value="<?= htmlspecialchars($pw) ?>" type="text" id="company_password" name="company_password" required>
         <br>

         <label for="company_job_desc">Job-Beschreibung:</label>
         <input type="text" id="company_job_desc" name="company_job_desc">
         <br>

         <label for="company_initial_apply">Initial Apply:</label>
         <input type="checkbox" id="company_initial_apply" name="company_initial_apply">
         <br>

         <label for="file">Motivationsschreiben:</label>
         <input id="file" name="file" type="file" />
         <br>

         <button type="submit">Hinzufügen</button>
      </form>
   </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>