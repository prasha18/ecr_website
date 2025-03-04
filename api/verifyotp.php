<?php
include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
ini_set("display_errors", 1);
error_reporting(E_ALL);

$mobile = $_GET['mobile'];  
$otp = $_GET['otp'];  
$sql = "SELECT otp FROM otp_valid WHERE mobileno = '$mobile'";

$result = $connect->query($sql);

$response_data = [];

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    if ($row['otp'] == $otp) {
       
      
        $response_data = [
            "status" => true,
            "statusCode" => 200,
            "data" => null,
            "message" => "OTP verified successfully."
        ];
       
    } else {
        $response_data = [
            "status" => false,
            "statusCode" => 400,
            "data" => null,
            "message" => "Invalid OTP. Please try again."
        ];
    }
} else {
    // If no record found for the mobile number
    $response_data = [
        "status" => false,
        "statusCode" => 400,
        "data" => null,
        "message" => "Mobile number not registered."
    ];
}

header('Content-Type: application/json');

echo json_encode($response_data, JSON_PRETTY_PRINT);

$connect->close();

exit;
?>
