<?php
include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'vendor/autoload.php';
use Twilio\Rest\Client;

// Twilio credentials
$sid = "AC91cc4e51692d4b6400a1a3bc3fdd98df";
$token = "ead9bb74514a5b003ee8eb7c399a13a1";
$twilio = new Client($sid, $token);


if ($connect->connect_error) {
    $response_data = [
        "status" => false,
        "statusCode" => 500,
        "data" => null,
        "message" => "Database connection failed: " . $connect->connect_error
    ];
    header('Content-Type: application/json');
    echo json_encode($response_data, JSON_PRETTY_PRINT);
    exit;
}

$to = $_GET['mobile'];

$messagingServiceSid = "MG8611afa9a98881d05d11e05c2f97d591";

$otp = mt_rand(10000, 90000);
$otpMessage = "Your OTP code is: $otp";

try {
    $message = $twilio->messages->create(
        $to,
        array(
            "messagingServiceSid" => $messagingServiceSid,
            "body" => $otpMessage
        )
    );

    $msid = $message->sid;

    $sql = "SELECT otp FROM otp_valid WHERE mobileno = '$to'";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        // Update existing record
        $connect->query("UPDATE otp_valid SET otp='$otp', msid='$msid' WHERE mobileno='$to'");
    } else {
        // Insert new record
        $connect->query("INSERT INTO otp_valid (mobileno, otp, msid) VALUES ('$to', '$otp', '$msid')");
    }

    // Response on success
    $response_data = [
        "status" => true,
        "statusCode" => 200,
        "data" => null,
        "message" => "OTP sent successfully."
    ];
} catch (Exception $e) {
    // Response on error
    $response_data = [
        "status" => false,
        "statusCode" => 400,
        "data" => null,
        "message" => "Failed to send OTP. Error: " . $e->getMessage()
    ];
}

// Set the response header to JSON
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response_data, JSON_PRETTY_PRINT);

exit;
?>
