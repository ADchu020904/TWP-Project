<?php

$host='localhost';
$user='root';
$pass='';
$db='userlogin';
$conn=new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    echo "Failed to connect to the database".$conn->connect_error;
}
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>