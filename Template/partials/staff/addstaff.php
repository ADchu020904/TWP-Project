<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include dirname(__FILE__) . '/../../connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $bio = $_POST['bio'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handling photo upload
    $photo = NULL;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    // Debugging: Check if variables are set correctly
    if (empty($name) || empty($email) || empty($password)) {
        die("Error: Required fields are missing.");
    }

    $stmt = $conn->prepare("INSERT INTO staff (name, phone_number, email, position, department, bio, password, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $name, $phone_number, $email, $position, $department, $bio, $password, $photo);

    if ($stmt->execute()) {
        header("Location: ../../admin-staff.php"); // Correct path to redirect
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form action="process_addstaff.php" method="post" enctype="multipart/form-data">
    <!-- ...existing fields like name, email, etc... -->
    <div>
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" required>
    </div>
    <div>
        <label for="bio">Bio</label>
        <textarea name="bio" id="bio" rows="4"></textarea>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" accept="image/*">
    </div>
    <!-- ...existing submit button... -->
</form>
