<?php
// Start session if needed
if (!isset($_GET['id'])) {
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else {
        echo json_encode(null);
        exit();
    }
} else {
    $id = $_GET['id'];
}

include dirname(__FILE__) . '/../../connect.php';

$stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio, photo FROM staff WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();

if ($staff) {
    // Convert the photo data to base64
    if ($staff['photo']) {
        $staff['photo'] = base64_encode($staff['photo']);
    }
    echo json_encode($staff);
} else {
    echo json_encode(null);
}
exit();
?>
