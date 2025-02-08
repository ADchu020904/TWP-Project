<?php
// filepath: /c:/xampp/htdocs/twp_project/TWP-Project/Template/addstaff.php
<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO staff (name, email, position, department, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $position, $department, $description);

    if ($stmt->execute()) {
        echo "New staff added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>