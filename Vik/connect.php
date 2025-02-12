<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'userlogin';
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}
?>