<?php
// filepath: /c:/xampp/htdocs/twp_project/TWP-Project/Template/admin-dashboard.php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// 用户已登录，显示管理页面内容
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the admin dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>