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
$stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio FROM staff WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();

// Handle staff information update
if(isset($_POST['update_staff'])) {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $bio = $_POST['bio'];

    $stmt = $conn->prepare("UPDATE staff SET name = ?, phone_number = ?, email = ?, position = ?, department = ?, bio = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $name, $phone_number, $email, $position, $department, $bio, $staff['id']);
    $stmt->execute();
}

// Handle logout
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" style="margin: 0; padding: 0;">
<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Staff Account</title>
   <!-- Style -->
   <?php include 'partials/user/userstyle.html'; ?>
   <style>
   /* Specific to account page */
    .header_section {
        margin-bottom: 30px !important;
    }
    </style>
</head>
<!-- header section start -->
 <?php include 'partials/user/userheader.html'; ?>    
     <!-- footer section start -->
    <?php include 'partials/user/userfooter.html'; ?>
    <!-- footer section end -->
</body>
</html>