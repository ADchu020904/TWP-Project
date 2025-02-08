<?php
$conn = new mysqli('localhost', 'root', '', 'staff_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

$staff = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $staff[] = $row;
    }
}

echo json_encode($staff);

$conn->close();
?>