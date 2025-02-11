<?php
// staffinfo.php - common code for admin pages
session_start();
include 'connect.php';

// Check if the admin is logged in
$loggedIn = isset($_SESSION['email']);

if (!$loggedIn) {
    // Set a flag instead of redirecting
    define('LOGIN_REQUIRED', true);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
