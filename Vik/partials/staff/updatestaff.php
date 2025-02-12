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
        // Update session email if it was changed
        if (isset($_SESSION['email']) && $_SESSION['email'] !== $email) {
            $_SESSION['email'] = $email;
        }
        
        // Check if request came from settings page
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

if (isset($_POST['btn_save'])) {
    // Process saving new photo, e.g. file upload
} elseif (isset($_POST['btn_update'])) {
    // Process updating existing photo
} elseif (isset($_POST['btn_delete'])) {
    // Process deleting existing photo
}
header("Location: /TWP-Project/Vik/settings.php");
exit;
?>

<form action="process_updatestaff.php" method="post" enctype="multipart/form-data">
    <!-- ...existing fields like name, email, etc... -->
    <div>
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" value="<?php // echo current phone_number ?>" required>
    </div>
    <div>
        <label for="bio">Bio</label>
        <textarea name="bio" id="bio" rows="4"><?php // echo current bio ?></textarea>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <!-- Note: leave blank to keep current password -->
    </div>
    <div>
        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" accept="image/*">
    </div>
    <!-- ...existing submit button... -->
</form>
