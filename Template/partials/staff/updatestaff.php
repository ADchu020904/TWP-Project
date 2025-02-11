<?php
include dirname(__FILE__) . '/../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $bio = $_POST['bio'];

    // Check if password is provided
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Handling photo upload
    $photo = NULL;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    // Update Query
    $sql = "UPDATE staff SET name=?, phone_number=?, email=?, position=?, department=?, bio=?";

    if ($password !== null) {
        $sql .= ", password=?";
    }
    if ($photo !== null) {
        $sql .= ", photo=?";
    }
    $sql .= " WHERE id=?";

    $stmt = $conn->prepare($sql);

    if ($password !== null && $photo !== null) {
        $stmt->bind_param("ssssssssi", $name, $phone_number, $email, $position, $department, $bio, $password, $photo, $id);
    } elseif ($password !== null) {
        $stmt->bind_param("sssssssi", $name, $phone_number, $email, $position, $department, $bio, $password, $id);
    } elseif ($photo !== null) {
        $stmt->bind_param("sssssssi", $name, $phone_number, $email, $position, $department, $bio, $photo, $id);
    } else {
        $stmt->bind_param("ssssssi", $name, $phone_number, $email, $position, $department, $bio, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../admin-staff.php"); // Redirect back to staff page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
