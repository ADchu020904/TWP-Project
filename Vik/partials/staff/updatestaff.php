<?php
include dirname(__FILE__) . '/../../connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'];
    $name         = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email        = $_POST['email'];
    $position     = $_POST['position'];
    $department   = $_POST['department'];
    $bio          = $_POST['bio'] ?? '';

    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $sql = "UPDATE staff SET name=?, phone_number=?, email=?, position=?, department=?, bio=?";
    $params = [$name, $phone_number, $email, $position, $department, $bio];
    $types = "ssssss"; // All strings initially

    if ($password !== null) {
        $sql .= ", password=?";
        $params[] = $password;
        $types .= "s";
    }

    // Handle photo deletion
    if (isset($_POST['btn_delete'])) {
        $sql .= ", photo=NULL";
    }
    // Handle photo upload
    else if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $sql .= ", photo=?";
        $params[] = $photoData;
        $types .= "b"; // BLOB type
    }

    $sql .= " WHERE id=?";
    $params[] = $id;
    $types .= "i"; // ID is an integer

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Use a simpler bind_param approach
    $bindParams = array_merge(array($types), $params);
    $refs = array();
    foreach ($bindParams as $key => $value) {
        $refs[$key] = &$bindParams[$key];
    }

    call_user_func_array(array($stmt, 'bind_param'), $refs);

    if ($stmt->execute()) {
        if (isset($_SESSION['email']) && $_SESSION['email'] !== $email) {
            $_SESSION['email'] = $email;
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        if (strpos($referer, 'settings.php') !== false) {
            header("Location: ../../settings.php?success=1");
        } else {
            header("Location: ../../admin-staff.php");
        }
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
