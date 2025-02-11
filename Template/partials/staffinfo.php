<?php
session_start();
include '../connect.php';  // Adjust relative path if needed

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio, password, photo FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();
} else {
    $staff = null;
}
?>
