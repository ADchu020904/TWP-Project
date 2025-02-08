<?php
session_start();
include 'connect.php'; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, email, password FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password (assuming it's hashed in the database)
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin_id'] = $user['id'];

            header("Location: staff.php");
            exit();
        } else {
            header("Location: admin-login.html?error=Invalid password");
            exit();
        }
    } else {
        header("Location: admin-login.html?error=User not found");
        exit();
    }
}
?>
