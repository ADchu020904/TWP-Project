<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $name        = trim($_POST['name']);
    $phone       = trim($_POST['phone_number']);
    $email       = trim($_POST['email']);
    $position    = trim($_POST['position']);
    $department  = trim($_POST['department']);
    $bio         = trim($_POST['bio']);
    $password    = $_POST['password'];
    $hashedPass  = password_hash($password, PASSWORD_DEFAULT);

    // Handle photo upload, if provided
    $photoData = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTemp = $_FILES['photo']['tmp_name'];
        $photoData = file_get_contents($fileTemp);
    }
    
    // Prepare and execute insert
    $stmt = $conn->prepare("INSERT INTO staff (name, phone_number, email, position, department, bio, password, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters. (Binding blob data as a string is acceptable in many cases.)
    $stmt->bind_param("ssssssss", $name, $phone, $email, $position, $department, $bio, $hashedPass, $photoData);
    
    if ($stmt->execute()) {
        header("Location: ../admin-staff.php?msg=Staff+added+successfully");
        exit();
    } else {
        die("Error inserting staff: " . $stmt->error);
    }
} else {
    // If the request is not POST, redirect back to admin-staff.php
    header("Location: ../admin-staff.php");
    exit();
}
?>
