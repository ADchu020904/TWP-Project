<?php
// staffinfo.php - common code for admin pages
session_start();
include 'Template/connect.php';

// Check if the admin is logged in; if not, redirect to the login page.
if (!isset($_SESSION['email'])) {
    header("Location: admin.php");
    exit();
}
?>
