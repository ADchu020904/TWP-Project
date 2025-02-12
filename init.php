<?php
ob_start(); // Start output buffering

// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// DEBUG: Output current directory and list files in it
echo "\n<!-- init.php: __DIR__ = " . __DIR__ . " -->\n";
echo "\n<!-- init.php: Files in __DIR__: " . implode(", ", scandir(__DIR__)) . " -->\n";

// Verify the session file exists and include it
$sessionFile = __DIR__ . '/Vik/partials/session.php';
if (!file_exists($sessionFile)) {
    echo "\n<!-- init.php ERROR: Session file not found at $sessionFile -->\n";
} else {
    echo "\n<!-- init.php: Found session file at $sessionFile -->\n";
}
include_once $sessionFile;

// Database connection variables
$servername = 'localhost';
$username   = 'root';
$password   = '';  // typical for XAMPP
$dbname     = 'userlogin';

// Connect without specifying the database
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "\n<!-- init.php: Connected to MySQL successfully. -->\n";

// Check if the 'userlogin' database exists
$result = $conn->query("SHOW DATABASES LIKE '$dbname'");
if (!$result) {
    echo "\n<!-- init.php ERROR: Query failed: " . $conn->error . " -->\n";
}

if ($result && $result->num_rows === 0) {
    echo "\n<!-- init.php: Database '$dbname' does not exist. Attempting to import SQL file. -->\n";
    $sqlFilePath = __DIR__ . '/Vik/Vik.sql';
    if (!file_exists($sqlFilePath)) {
        echo "\n<!-- init.php ERROR: SQL file not found at $sqlFilePath -->\n";
    } else {
        echo "\n<!-- init.php: Found SQL file at $sqlFilePath. -->\n";
        $commands = file_get_contents($sqlFilePath);
        if ($conn->multi_query($commands)) {
            echo "\n<!-- init.php: SQL file imported successfully. -->\n";
            // Flush any additional results
            while ($conn->more_results() && $conn->next_result()) { }
        } else {
            echo "\n<!-- init.php ERROR: SQL file import failed: " . $conn->error . " -->\n";
        }
    }
} else {
    echo "\n<!-- init.php: Database '$dbname' exists. -->\n";
}

$conn->close();
echo "\n<!-- init.php: Finished. -->\n";

// Flush the output buffer so that the debug messages are sent to the browser
ob_end_flush();
?>
