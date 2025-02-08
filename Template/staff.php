<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        $sql = "INSERT INTO staff (name, email, position, department, description, image) VALUES ('$name', '$email', '$position', '$department', '$description', '$image')";
        $conn->query($sql);
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        $sql = "UPDATE staff SET name='$name', email='$email', position='$position', department='$department', description='$description', image='$image' WHERE id=$id";
        $conn->query($sql);
    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM staff WHERE id=$id";
        $conn->query($sql);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);
    $staff = [];
    while ($row = $result->fetch_assoc()) {
        $staff[] = $row;
    }
    echo json_encode($staff);
}

$conn->close();
?>