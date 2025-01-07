<?php
require './includes/db_connect.php';

// Session-Management mit sicheren Cookie-Parametern
session_set_cookie_params([
    'httponly' => true,
    'secure' => true, // Aktivieren, wenn HTTPS verwendet wird
    'samesite' => 'Strict'
]);
session_start();

// Eingaben prüfen und bereinigen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzername und Passwort aus POST abrufen und validieren
    $user_name = trim($_POST['user_name']);
    $password = $_POST['password'];

    // Überprüfen, ob die Eingaben nicht leer sind
    if (empty($user_name) || empty($password)) {
        header("Location: error.php?error=missing_data");
        exit();
    }

    try {
        // Benutzer aus der Datenbank abrufen
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_name = :user_name");
        $stmt->execute(['user_name' => $user_name]);
        $user = $stmt->fetch();

        // Benutzername und Passwort überprüfen
        if ($user && password_verify($password, $user['passwort'])) {
            // Login erfolgreich, Session-Daten setzen
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Ungültige Login-Daten
            header("Location: error.php?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
        // Fehler bei der Datenbankabfrage
        error_log("Login-Fehler: " . $e->getMessage());
        header("Location: error.php?error=database_error");
        exit();
    }
} else {
    // Kein POST-Request
    header("Location: error.php?error=invalid_request");
    exit();
}
