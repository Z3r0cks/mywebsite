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
}

// get all user_name and user_id from user in database:
try {
   $stmt = $pdo->prepare("SELECT user_name, user_id FROM user");
   $stmt->execute();
   $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}


function randomPassword()
{
   $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   $pass = array(); //remember to declare $pass as an array
   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   for ($i = 0; $i < 20; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
   }
   return implode($pass); //turn the array into a string
}

print_r(randomPassword());
// print_r(randomPassword());
// print_r(randomPassword());
// print_r(randomPassword());

// upload file
// try {
//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//       $file = $_FILES['file'];
//       $user = $_POST['user'];

//       if ($file['error'] !== 0) {
//          die("Fehler beim Upload.");
//       }

//       $file_name = $file['name'];
//       $allowed = array('pdf', 'docx', 'doc', 'txt');

//       $sql = "INSERT INTO `documents` (`file_name`, `file_desc`, `file_url`, `file_size`, `file_hash`, `uploaded_at`) VALUES (NULL, 'Fachhochschulreife', 'Zeugnis der Fachhochschulreife', '/downloads/protected/basic/fachhochschulreife.pdf', '1129', 'o9Mj6DD9KIXg3oB', '2025-01-07 17:46:40');"

// } catch (PDOException $e) {
//    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
// }

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
      <label for="motivation">Motivationsschreiben?</label>
      <input type="checkbox" id="motivation" name="motivation">

      <form action="add_file" method="post">
         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

         <label for="file">File</label>
         <input id="file" name="file" type="file" />
         <br>

         <label for="add_company">Unternehmen hinzufügen?</label>
         <select name="user">
            <option value="false">False</option>
            <?php foreach ($users as $user) : ?>
               <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
            <?php endforeach; ?>
         </select> <br>

         <button type="submit">Upload</button>
      </form>
   </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
<script>
   el = '<select name="user"> <option value="false">False</option> <?php foreach ($users as $user) : ?><option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option><?php endforeach; ?> </select> <br>'
</script>

</body>
</html>