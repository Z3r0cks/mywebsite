<?php
require './includes/auth.php';
require './includes/db_connect.php';


$user_name = $_SESSION['user_name'];

if (isset($_SESSION['is_guest']) && $_SESSION['is_guest'] === true) {
    header('Location: dashboard');
    exit;
}

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
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png" />
    <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
    <div class="nav">
        <a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
        <a href="dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
    </div>
    <div class="container_dashboard">

        <h1>Willkommen bei den Dokumenten, <?= htmlspecialchars($user_name) ?></h1>
        <p class="mb-3">Unten finden Sie nun Bewerbungsunterlagen und Zeugnisse als einzelne Dateien.</p>

        <table class="documents-table mb-2">
            <thead>
                <tr>
                    <th>Datei</th>
                    <th>Größe</th>
                    <th>Beschreibung</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($documents)) : 
                        $count = count($documents);
                        foreach ($documents as $index => $document) :
                        $border = $index === $count - 1 ? 'class="no-border"' : "" ?>

                            <tr <?= $border ?>>
                                <td class="documents-table__name">
                                    <a class="table_desc" href="download.php?file=<?= $document['file_hash'] ?>"><?= htmlspecialchars($document['file_name']) ?></a>
                                </td>
                                <td class="documents-table__size"><?= number_format((float)$document['file_size']) ?> KB</td>
                                <td class="documents-table__desc"><?= htmlspecialchars($document['file_desc']) ?></td>
                                <td class="documents-table__action">
                                    <a class="table_desc" href="download.php?file=<?= $document['file_hash'] ?>" aria-label="Download <?= htmlspecialchars($document['file_name']) ?>">
                                        <img class="documents-table__icon" src="./assets/svg/download-button.svg" alt="Download" />
                                    </a>
                                </td>
                            </tr>
                            
                    <?php endforeach; ?>
                <?php else : ?>
                        <tr>
                            <td colspan="4" class="documents-table__empty">Keine Dokumente vorhanden.</td>
                        </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>