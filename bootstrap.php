<?php
// bootstrap.php (located in TWP-Project/)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// DEBUG: Output the current directory
echo "\n<!-- bootstrap.php: __DIR__ = " . __DIR__ . " -->\n";

// Build the path to init.php using __DIR__
$initFile = __DIR__ . '/init.php';

// DEBUG: Check if init.php exists
if (!file_exists($initFile)) {
    echo "\n<!-- bootstrap.php ERROR: File $initFile does not exist -->\n";
    die("Error: init.php not found at $initFile");
} else {
    echo "\n<!-- bootstrap.php: Found init.php at $initFile -->\n";
}

// Require init.php
require_once $initFile;

// DEBUG: End of bootstrap.php
echo "\n<!-- bootstrap.php finished loading init.php -->\n";
?>
