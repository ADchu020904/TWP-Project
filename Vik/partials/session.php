<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Uncomment the following lines to display errors
    ini_set('display_errors', 1);
        error_reporting(E_ALL);
?>
