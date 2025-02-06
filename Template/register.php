<?php

include 'connect.php';

if(isset($_POST['signUp'])){
    // Collect and sanitize user input
    $firstName = trim($_POST['FName']);
    $lastName = trim($_POST['LName']);
    $email = filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        echo "Invalid email format";
    } else {
        // Prepare a statement to check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            // Email already exists
            echo "Email already exists";
        } else {
            // Hash password and insert into the database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
            if($stmt->execute() === TRUE){
                header("location: usersignup.php");
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

if(isset($_POST['login'])){
    // Filter user input and fetch user record from DB
    $email = filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT email, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // If found, verify password
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            // Start a session and redirect on success
            session_start();
            $_SESSION['email'] = $row['email'];
            header("location: index.php");
            exit();
        } else {
            // Invalid email or password
            echo "Invalid email or password";
        }
    } else {
        // Invalid email or password
        echo "Invalid email or password";
    }
}

?>