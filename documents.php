<?php
require './includes/auth.php';
require './includes/db_connect.php';


$user_name = $_SESSION['user_name'];

try {
    $sql = "
        SELECT d.file_id, d.file_name, d.file_desc, d.file_url, d.file_hash, d.file_size
        FROM documents d
        JOIN user_documents ud ON d.file_id = ud.document_id
        JOIN user u ON ud.user_id = u.user_id
        WHERE u.user_name = :user_name
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->execute();

    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./js/accordion.js" defer></script>
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

        <h1>Willkommen im bei den Dokumenten, <?= htmlspecialchars($user_name) ?></h1>
        <p class="mb-3">Unten finden Sie nun Bewerbungsunterlagen und Zeugnisse als einzelne Dateien.</p>

        <table class="mb-2" style="width: 100%;">
            <?php foreach ($documents as $document) : ?>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=<?= $document['file_hash'] ?>"><?= $document['file_name'] ?></a></td>
                    <td class="table_desc
                    "><?= $document['file_size'] ?> KB</td>
                    <td class="table_desc
                    table_desc__second"> <?= $document['file_desc'] ?></td>
                    <td><a class="table_desc" href="download.php?file=<?= $document['file_hash'] ?>"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>