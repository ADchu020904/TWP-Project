<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: admin-login.html?error=Please log in first");
    exit();
}
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: usersignup.php");
    exit();
}

// Fetch staff data
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio, password, photo FROM staff WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();

?>