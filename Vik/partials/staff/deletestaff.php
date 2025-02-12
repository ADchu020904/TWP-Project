<?php
include dirname(__FILE__) . '/../../connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../admin-staff.php"); // Redirect back to staff page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
