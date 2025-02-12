<?php
// Only output debug messages if the request is not expecting JSON
if (!isset($_SERVER['HTTP_ACCEPT']) || strpos($_SERVER['HTTP_ACCEPT'], 'application/json') === false) {
    echo "\n<!-- bootstrap.php: __DIR__ = " . __DIR__ . " -->\n";
}
$initFile = __DIR__ . '/init.php';
if (!file_exists($initFile)) {
    if (!isset($_SERVER['HTTP_ACCEPT']) || strpos($_SERVER['HTTP_ACCEPT'], 'application/json') === false) {
        echo "\n<!-- bootstrap.php ERROR: File $initFile does not exist -->\n";
    }
    die("Error: init.php not found at $initFile");
} else {
    if (!isset($_SERVER['HTTP_ACCEPT']) || strpos($_SERVER['HTTP_ACCEPT'], 'application/json') === false) {
        echo "\n<!-- bootstrap.php: Found init.php at $initFile -->\n";
    }
}
require_once $initFile;
if (!isset($_SERVER['HTTP_ACCEPT']) || strpos($_SERVER['HTTP_ACCEPT'], 'application/json') === false) {
    echo "\n<!-- bootstrap.php finished loading init.php -->\n";
}
?>
