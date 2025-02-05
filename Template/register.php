<?php

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['FName'];
    $lastName = $_POST['LName'];
    $email = $_POST['useremail'];
    $password = $_POST['password'];
    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email already exists";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
        if($conn->query($insertQuery) === TRUE){
            header("location: usersignup.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if(isset($_POST['login'])){
    $email = $_POST['useremail'];
    $password = $_POST['password'];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        // Verify the password using bcrypt
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['email'] = $row['email'];
            header("location: index.php");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}

?>