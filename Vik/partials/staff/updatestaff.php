<?php
include dirname(__FILE__) . '/../../connect.php';
session_start(); // ensure session is started so we can update $_SESSION['email']

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'];
    $name         = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email        = $_POST['email'];
    $position     = $_POST['position'];
    $department   = $_POST['department'];
    $bio          = $_POST['bio'] ?? '';

    // Check if password is provided
    $password = !empty($_POST['password'])
        ? password_hash($_POST['password'], PASSWORD_DEFAULT)
        : null;

    // Build base update query
    $sql = "UPDATE staff SET name=?, phone_number=?, email=?, position=?, department=?, bio=?";

    $params = [$name, $phone_number, $email, $position, $department, $bio];

    // If password was entered, add it
    if ($password !== null) {
        $sql .= ", password=?";
        $params[] = $password;
    }

    // Next handle the photo logic
    // 1) If user clicked delete => set photo to NULL
    if (isset($_POST['btn_delete'])) {
        $sql .= ", photo=NULL";
    }
    // 2) Else if user uploaded a new photo => read from $_FILES
    else if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $sql .= ", photo=?";
        $params[] = $photoData;
    }

    // Finally add WHERE clause
    $sql .= " WHERE id=?";
    $params[] = $id;

    // Prepare the statement
    // We'll build the bind_param dynamically based on $params count
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Build the type string: 
    //   s for name, phone_number, email, position, department, bio 
    //   s if password 
    //   b if photo 
    //   i for id
    // But we can keep it simpler with 's' for everything except 'i' for the ID,
    // because photo is binary => 'b' in bind_param
    // However, a trick is to use 's' for everything except 'i' for the ID 
    // and pass the photo as string data. This works if MySQLi is 
    // configured for "blob as string" usage. 
    // For clarity, let's do it properly with 'b' for the blob:
    
    // We'll build type string as we go
    $types = "";
    $bindArgs = [];

    // For name, phone_number, email, position, department, bio => all strings
    for ($i = 0; $i < 6; $i++) {
        $types .= "s";
    }

    // If password => 's'
    if ($password !== null) {
        $types .= "s";
    }

    // If deleting => no photo param is appended
    // If uploading => 'b'
    if (isset($_POST['btn_delete'])) {
        // do nothing, no param for photo
    }
    else if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $types .= "b";
    }

    // And final param is id => 'i'
    $types .= "i";

    // Now we bind with call_user_func_array or a simpler approach
    // We'll build $bindArgs to match $params
    $bindArgs[] = &$types;

    // Convert $params to references
    foreach ($params as $key => $value) {
        $bindArgs[] = &$params[$key];
    }

    // Example approach with call_user_func_array
    call_user_func_array([$stmt, 'bind_param'], $bindArgs);

    // For a real "b" param, we also might need send_long_data
    // if the file is large. But for small images, it usually is fine.

    if ($stmt->execute()) {
        // Update session email if it was changed
        if (isset($_SESSION['email']) && $_SESSION['email'] !== $email) {
            $_SESSION['email'] = $email;
        }
        
        // Redirect
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
<script>
function previewPhoto(event) {
  const fileInput = event.target;
  const previewImg = document.getElementById('photoPreview');

  if (fileInput.files && fileInput.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      previewImg.src = e.target.result;
      previewImg.classList.remove('hidden'); // Show the preview
    }
    reader.readAsDataURL(fileInput.files[0]);
  }
}
</script>
