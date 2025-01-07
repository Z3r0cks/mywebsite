<?php
require './includes/auth.php';
require './includes/db_connect.php';

// $allowedFiles = [
//     'ddskjIJJjkfji565awd' => __DIR__ . '/downloads/protected/basic/Lebenslauf_patrick_kaserer.pdf',
// ];

$user_name = $_SESSION['user_name'];

try {
    $sql = "
        SELECT d.file_url, d.file_hash
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

$allowedFiles = [];
foreach ($documents as $document) {
    $allowedFiles[$document['file_hash']] = __DIR__ . $document['file_url'];
};

if (isset($_GET['file']) && array_key_exists($_GET['file'], $allowedFiles)) {
    $filePath = $allowedFiles[$_GET['file']];
    $fileName = basename($filePath);

    if (file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        echo "Datei nicht gefunden.";
        exit();
    }
} else {
    echo "Ungültige Anfrage.";
    exit();
}
