<?php
// Function to authenticate and fetch the base token
function apiBaseUrlFunction($data) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/members/guest/token';
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';

    // cURL request for authentication
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password); // Basic Auth using username:password
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode and return the response
    $responseData = json_decode($response, true);
// print_r($responseData);die
    if (isset($responseData['token'])) {
        return $responseData['token']; // Return token if available (even though we are not using it)
    } else {
        echo 'Failed to authenticate.';
        exit;
    }
}

// Function to fetch professions
function professionapiCallFunction($data) {
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';
    
    // Authentication is already handled in apiBaseUrlFunction, but if needed, we are using basic authentication here.
    $apiUrl = 'https://dev.letsfame.com/api/v2.0/professions?page=0&size=250';

    // cURL request to fetch professions
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password); // Use Basic Authentication for the second API
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode and return the response
    $userData = json_decode($response, true);
    return $userData;
}
function countryapiCallFunction($data) {
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';
    
    // Authentication is already handled in apiBaseUrlFunction, but if needed, we are using basic authentication here.
    $countryapiUrl = 'https://dev.letsfame.com/api/v1.0/reference_data/countries?page=0&size=300';

    // cURL request to fetch professions
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $countryapiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password); // Use Basic Authentication for the second API
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decode and return the response
    $countryData = json_decode($response, true);
    return $countryData;
}

function stateapiCallFunction($country_name) {
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';
    
    // Construct the API URL with country_name
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/reference_data/states?filter_by=country_name:eq:' . urlencode($country_name) . '&page=0&size=100';

    // cURL request to fetch states
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password); // Basic authentication
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch)); // Log the error
        curl_close($ch);
        return ['error' => 'API call failed'];
    }

    curl_close($ch);

    return json_decode($response, true);
}
function cityapiCallFunction($country_name, $state_name) {
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';

    $apiUrl = 'https://dev.letsfame.com/api/v1.0/reference_data/cities?filter_by=country_name:eq:' 
        . urlencode($country_name) 
        . ',state_name:eq:' 
        . urlencode($state_name) 
        . '&page=0&size=100';

    error_log('City API URL: ' . $apiUrl);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password); // Basic Authentication

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch)); // Log the error
        curl_close($ch);
        return ['error' => 'API call failed'];
    }

    curl_close($ch);

    // Decode the response
    $decodedResponse = json_decode($response, true);

    // Log the API response for debugging
    error_log('City API Response: ' . print_r($decodedResponse, true));

    return $decodedResponse;
}

?>
