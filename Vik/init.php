<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'partials/session.php'; // Automatically start session for all pages

$servername = 'localhost';
$username   = 'root';
$password   = '';  // typical for XAMPP
$dbname     = 'userlogin';

// Connect without specifying the DB (to check if it exists)
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if userlogin exists
$result = $conn->query("SHOW DATABASES LIKE '$dbname'");

if ($result && $result->num_rows === 0) {
    // DB does not exist => import Vik.sql
    $sqlFilePath = __DIR__ . '/Vik.sql';
    if (file_exists($sqlFilePath)) {
        $commands = file_get_contents($sqlFilePath);
        if ($conn->multi_query($commands)) {
            // flush remaining result sets
            while ($conn->more_results() && $conn->next_result()) { /* no-op */ }
            echo "Database 'userlogin' created!<br>";
        } else {
            echo "Error importing Vik.sql: " . $conn->error;
        }
    } else {
        echo "Vik.sql not found at $sqlFilePath<br>";
    }
}
$conn->close();
?>