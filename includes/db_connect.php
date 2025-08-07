<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/error_handler.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the database connection error
    ErrorHandler::logCustomError(
        "Database connection failed: " . $e->getMessage(),
        'CRITICAL',
        ['host' => $host, 'database' => $dbname]
    );
    
    // Redirect to error page instead of showing raw error
    header("Location: /error.php?type=500");
    exit();
}
