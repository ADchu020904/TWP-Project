<?php
include dirname(__FILE__) . '/../../connect.php';
session_start(); // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'];
    $name         = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email        = $_POST['email'];
    $position     = $_POST['position'];
    $department   = $_POST['department'];
    $bio          = $_POST['bio'] ?? '';

    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Build the base UPDATE statement.
    $sql = "UPDATE staff SET name=?, phone_number=?, email=?, position=?, department=?, bio=?";
    $params = [$name, $phone_number, $email, $position, $department, $bio];
    $types = "ssssss"; // These six fields are strings

    if ($password !== null) {
        $sql .= ", password=?";
        $params[] = $password;
        $types .= "s";
    }

    // Flag to check if a photo was provided for upload
    $photoProvided = false;
    if (isset($_POST['btn_delete'])) {
        // If the delete button was pressed, set the photo column to NULL.
        $sql .= ", photo=NULL";
    }
    // Handle photo upload (new photo chosen)
    else if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Read the file's contents.
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $sql .= ", photo=?";
        $params[] = $photoData;
        $types .= "b"; // Bind as BLOB type
        $photoProvided = true;
    }
    // If no new photo and no delete, do nothing with photo

    // Append the WHERE clause.
    $sql .= " WHERE id=?";
    $params[] = $id;
    $types .= "i"; // id is an integer

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters. We use call_user_func_array so we need an array of references.
    $bindParams = array_merge([$types], $params);
    $refs = [];
    foreach ($bindParams as $key => $value) {
        $refs[$key] = &$bindParams[$key];
    }
    call_user_func_array([$stmt, 'bind_param'], $refs);

    // If a new photo was uploaded, stream the blob data using send_long_data.
    if ($photoProvided) {
        // Determine the index of the photo parameter (0-indexed)
        // The ordering is:
        //   Without password:  0:name, 1:phone_number, 2:email, 3:position, 4:department, 5:bio, 6:photo, 7:id
        //   With password:     0:name, 1:phone_number, 2:email, 3:position, 4:department, 5:bio, 6:password, 7:photo, 8:id
        $photoIndex = ($password !== null) ? 7 : 6;
        $stmt->send_long_data($photoIndex, $photoData);
    }

    if ($stmt->execute()) {
        // Update session email if needed.
        if (isset($_SESSION['email']) && $_SESSION['email'] !== $email) {
            $_SESSION['email'] = $email;
        }

        // Redirect based on referrer.
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
