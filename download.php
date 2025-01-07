<?php
require './includes/auth.php';
require './includes/db_connect.php';

$allowedFiles = [
    'ddskjIJJjkfji565awd' => __DIR__ . '/downloads/protected/basic/Lebenslauf_patrick_kaserer.pdf',
    '5wek353kkkj3ak4das5' => __DIR__ . '/download/protected/basic/motivation/test_motivationsschreiben.pdf',
];

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
