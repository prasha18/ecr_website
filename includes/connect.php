<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// $localhost = "13.127.148.211";
$localhost = "13.127.148.211";
$username = "letsfame";
$password = "Letsfame@123#123";
$dbname = "letsfameblog";

$connect = new mysqli($localhost, $username, $password, $dbname);

if($connect->connect_error) {
    echo "Connection failed: " . $connect->connect_error;
} else {
    // echo "Successfully connected to the database!";
}
?>
