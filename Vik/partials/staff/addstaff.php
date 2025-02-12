<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include dirname(__FILE__) . '/../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize/format input data
    $name         = ucwords(strtolower(trim($_POST['name'])));
    $phone_number = trim($_POST['phone_number']);
    $email        = trim($_POST['email']);
    $position     = trim($_POST['position']);
    $department   = trim($_POST['department']);
    $bio          = trim($_POST['bio']);
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Initialize photo handling variables
    $photoProvided = false;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Read the photo's binary data
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        $photoProvided = true;
    } else {
        $photo = null;
    }

    // Validate required fields
    if (empty($name) || empty($email) || empty($_POST['password'])) {
        die("Error: Required fields are missing.");
    }

    // Prepare the SQL statement.
    // This statement inserts 8 values into staff (name, phone_number, email, position, department, bio, password, photo)
    $stmt = $conn->prepare("INSERT INTO staff (name, phone_number, email, position, department, bio, password, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // For binding, we use a type string:
    //   s: name, phone_number, email, position, department, bio, password  (7 parameters)
    //   b: photo (1 parameter)
    // Note: The parameters are zero-indexed when using send_long_data, so the 8th parameter has index 7.
    $null = null; // Placeholder for the blob data
    $stmt->bind_param("sssssssb", $name, $phone_number, $email, $position, $department, $bio, $password, $null);

    // If a photo was uploaded, stream its data into the blob parameter.
    if ($photoProvided) {
        // Parameter index 7 corresponds to the 8th parameter (the photo) in the bind_param call.
        $stmt->send_long_data(7, $photo);
    }

    // Execute the statement.
    if ($stmt->execute()) {
        header("Location: /../../admin-staff.php");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}
?>
