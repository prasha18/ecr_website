<?php
include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$authkey = "413580AfMYE2I7659fcef0P1";  
$template_id = "659fce73d6fc0510593f4342";  
$mobile = $_GET['mobile'] ?? null;

// Validate if mobile number is provided
if (empty($mobile)) {
    $response_data = [
        "status" => false,
        "statusCode" => 400,
        "data" => null,
        "message" => "Mobile number is required."
    ];
    header('Content-Type: application/json');
    echo json_encode($response_data, JSON_PRETTY_PRINT);
    exit;
}

// Trim the mobile number if needed
$mobile_trimmed = substr($mobile, 2);

// Check if the account is blocked
$sql = "SELECT status FROM form_data WHERE mobileno = '$mobile_trimmed' AND status = 'Blocked'";
$result = $connect->query($sql);

if ($result && $result->num_rows == 1) {
    // If the account is blocked
    $response_data = [
        "status" => false,
        "statusCode" => 403,
        "data" => null,
        "message" => "Access denied. Your account is blocked."
    ];
} else {
    // Generate OTP
    $otp = mt_rand(10000, 90000);

    // Check if OTP record already exists
    $sql1 = "SELECT otp FROM otp_valid WHERE mobileno = '$mobile'";
    $results = $connect->query($sql1);

    if ($results && $results->num_rows == 1) {
        // Update existing OTP
        $sql2 = "UPDATE otp_valid SET otp = '$otp' WHERE mobileno = '$mobile'";
    } else {
        // Insert new OTP record
        $sql2 = "INSERT INTO otp_valid (mobileno, otp) VALUES ('$mobile', '$otp')";
    }

    if ($connect->query($sql2)) {
        // Send OTP via external API
        $url = "https://control.msg91.com/api/v5/otp?authkey=" . urlencode($authkey) . 
               "&template_id=" . urlencode($template_id) . 
               "&mobile=" . urlencode($mobile) . 
               "&otp=" . urlencode($otp);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle cURL error
            $response_data = [
                "status" => false,
                "statusCode" => 400,
                "data" => null,
                "message" => "Failed to send OTP. cURL Error: " . curl_error($ch)
            ];
        } else {
            // OTP sent successfully
            $response_data = [
                "status" => true,
                "statusCode" => 200,
                "data" => null,
                "message" => "OTP sent successfully."
            ];
        }

        curl_close($ch);
    } else {
        // Database error
        $response_data = [
            "status" => false,
            "statusCode" => 500,
            "data" => null,
            "message" => "Database error: " . $connect->error
        ];
    }
}

// Set the response header to JSON
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response_data, JSON_PRETTY_PRINT);
exit;
?>
