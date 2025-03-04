<?php
include("login_action.php");
user_log_vals();
require('api_integration.php');
$data = [
    "request_type" => "MEMBER",
    "device_id" => "string",
    "device_type" => "ANDROID",
    "device_token" => "string",
];
$country_name = isset($_GET['country_name']) ? $_GET['country_name'] : null;
// Check if country_name is passed
if ($country_name) {
    // Make the API call to fetch states based on the country_name
    $response = stateapiCallFunction($country_name); // Make the actual API call

    header('Content-Type: application/json');
    echo json_encode($response); // Return the data in JSON format
} else {
    // No country_name provided
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No country_name provided']);
}

?>
