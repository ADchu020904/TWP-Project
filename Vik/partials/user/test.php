<?php
echo __DIR__ . "<br>";
$initPath = __DIR__ . "/../../../init.php";
echo "Looking for init.php at: " . $initPath . "<br>";
if (file_exists($initPath)) {
    echo "File exists.";
} else {
    echo "File does NOT exist.";
}
?>
