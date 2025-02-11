<?php
session_start();
include 'connect.php';

// Process login if form is submitted
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id, name, email, password FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();
    
    if ($staff && password_verify($password, $staff['password'])) {
        $_SESSION['email'] = $staff['email'];
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

?>