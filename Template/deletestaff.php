<?php
$conn = new mysqli('localhost', 'root', '', 'userlogin');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 检查是否收到删除请求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $staffId = intval($_POST['id']);  // 确保 ID 是整数，防止 SQL 注入

    // 删除员工的 SQL 语句
    $sql = "DELETE FROM staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staffId);

    if ($stmt->execute()) {
        echo "Staff deleted successfully.";
    } else {
        echo "Error deleting staff: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();  // 终止脚本，防止后续代码执行
}

// 如果不是删除请求，返回员工列表供下拉菜单使用
$sql = "SELECT id, name FROM staff";
$result = $conn->query($sql);

$options = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}

echo $options;
$conn->close();
?>
