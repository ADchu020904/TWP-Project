<?php
// filepath: /c:/xampp/htdocs/twp_project/TWP-Project/Template/logout.php
session_start();
session_destroy();
header("Location: admin-login.php");
exit();
?>