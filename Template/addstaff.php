<?php
$conn = new mysqli('localhost', 'root', '', 'staff_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$position = $_POST['position'];
$department = $_POST['department'];
$description = $_POST['description'];

// 插入数据到 staff 表
$sql = "INSERT INTO staff (name, email, position, department, description) 
        VALUES ('$name', '$email', '$position', '$department', '$description')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>
