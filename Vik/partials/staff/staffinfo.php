<?php
// staffinfo.php - common code for admin pages

// Fix the path to connect.php (go up two levels from current directory)
include dirname(__FILE__) . '/../../connect.php';

// Check if the admin is logged in
$loggedIn = isset($_SESSION['email']);

// Only check login status, don't include any functionality that might conflict with other scripts
if (!$loggedIn) {
    define('LOGIN_REQUIRED', true);
    return; // Exit early if not logged in
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Basic database functions
function getAllStaff($conn) {
    $sql = "SELECT id, name, phone_number, email, position, department, bio FROM staff";
    return $conn->query($sql);
}

function getStaffById($conn, $id) {
    $stmt = $conn->prepare("SELECT id, name, phone_number, email, position, department, bio FROM staff WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Initialize staff data only when needed
$allStaff = null;
$currentStaff = null;

// Load staff data only when explicitly requested
if (defined('LOAD_STAFF_DATA')) {
    $allStaff = getAllStaff($conn);
    if (isset($_SESSION['email'])) {
        $stmt = $conn->prepare("SELECT * FROM staff WHERE email = ?");
        $stmt->bind_param("s", $_SESSION['email']);
        $stmt->execute();
        $currentStaff = $stmt->get_result()->fetch_assoc();
    }
}
?>
