<?php
include 'staffinfo.php';
if (isset($_GET['id'])) {
    $staffId = intval($_GET['id']);
    $staffRow = getStaffById($conn, $staffId);
    echo json_encode($staffRow ?: null);
} else {
    echo json_encode(null);
}
