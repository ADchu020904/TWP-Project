<?php
include dirname(__FILE__) . '/../../connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio FROM staff WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();
    
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($staff);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No ID provided']);
}
