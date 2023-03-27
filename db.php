<?php
// Database connection details
$host = 'localhost';
$dbname = 'wOBE';
$port = '3307';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message if the connection fails
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
