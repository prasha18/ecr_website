<?php 
// DB credentials.
$localhost = "15.207.105.223";
$username = "ankai";
$password = "Anandtech@12#12$123";
$dbname = "letsfame";

$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}
?>