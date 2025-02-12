<?php
header('Content-Type: application/json');

// Clear any output that may have been auto-prepended
if (ob_get_length() > 0) {
    ob_clean();
}

// Start session if needed
if (!isset($_GET['id'])) {
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else {
        echo json_encode(['error' => 'No ID provided']);
        exit();
    }
} else {
    $id = $_GET['id'];
}

include dirname(__FILE__) . '/../../connect.php';

try {
    $stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio, photo FROM staff WHERE id = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();

    if ($staff) {
        // Convert the photo data to base64 if it exists
        if ($staff['photo']) {
            $staff['photo'] = base64_encode($staff['photo']);
        }
        echo json_encode($staff);
    } else {
        echo json_encode(['error' => 'Staff not found']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
exit();
?>