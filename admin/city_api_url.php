<?php
include("login_action.php");
user_log_vals();
require('api_integration.php');

$country_name = isset($_GET['country_name']) ? $_GET['country_name'] : null;
$state_name = isset($_GET['state_name']) ? $_GET['state_name'] : null;

if ($country_name && $state_name) {
    $response = cityapiCallFunction($country_name, $state_name);

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Missing country_name or state_name']);
}

?>

