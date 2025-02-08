<?php
$conn = new mysqli('localhost', 'root', '', 'userlogin');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM staff";  // 确保你查询了正确的字段
$result = $conn->query($sql);

$options = "";  // 存储下拉选项

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}

echo $options;  // 直接输出选项
$conn->close();
?>
