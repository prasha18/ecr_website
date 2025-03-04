<?php
session_start();
include("../includes/connect.php");
ini_set("display_errors", 1);
error_reporting(E_ALL);

// File size limit (30MB)
$maxFileSize = 30 * 1024 * 1024; // 30MB

// API Authentication
function apiBaseUrlFunction($data) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/members/guest/token';
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['bearer_token'])) {
        return $responseData['bearer_token']; 
    } else {
        echo 'Failed to authenticate. Response: ' . $response;
        exit;
    }
}

// File upload API function
function fileuploadfapiCallFunction($filePath, $bearer_token) {
    if (empty($filePath['tmp_name'])) {
        return ['error' => 'File not uploaded or temporary file path is empty.'];
    }

    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    // Ensure the file exists and has a valid temporary path
    if (!file_exists($filePath['tmp_name'])) {
        return ['error' => 'Uploaded file does not exist.'];
    }

    $fileData = new CURLFile($filePath['tmp_name'], $filePath['type'], $filePath['name']); 
    $postData = [
        'file' => $fileData,  
        'moderation_required' => true,  
        'type' => 'IMAGE',  
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: multipart/form-data',
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $decodedResponse = json_decode($response, true);

    if (is_array($decodedResponse) && isset($decodedResponse[0])) {
        $responseData = $decodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}

// Main handler for file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['phfile'])) {

    // Debugging file details (can be removed later)
    // print_r($_FILES['phfile']); die;

    // Validate file size
    // print_r($_FILES['phfile']);die;
    if ($_FILES['phfile']['size'] > $maxFileSize) {
        echo json_encode([
            'success' => false,
            'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        ]);
        exit;
    }

    // Get the token
    $token = apiBaseUrlFunction([
        'request_type' => 'MEMBER',
        'device_id' => 'string',
        'device_type' => 'ANDROID',
        'device_token' => 'string',
    ]);

    // Get the uploaded file
    $filePath = $_FILES['phfile']; 

    // Upload file to API
    $response = fileuploadfapiCallFunction($filePath, $token);
    if (isset($response['url'])) {
        $url = $response['url'];
        $file_name = $response['file_name'];
        $original_file_name = $response['original_file_name'];
        $moderation_required = $response['moderation_required'];
        $type = $response['type'];
        $description = $_POST['phname'];
        $_SESSION['uploaded_image_url'] = $response['url'];

        $sql1 = $connect->query("INSERT INTO book_artist_img (bookid,imgurl, description, file_name, original_file_name, moderation_required, type) VALUES ('0','$url', '$description', '$file_name', '$original_file_name', '$moderation_required', '$type')");
        $last_inserted_id = $connect->insert_id;

        echo json_encode([
            'success' => true,
            'img_id' => $last_inserted_id,
            'url' => $url,
            'description' => $description
        ]);
        exit;
    } else {
        // Handle errors more gracefully for user-facing messages
        echo json_encode([
            'success' => false,
            'error_message' => $response['error'] ?? 'File upload failed. Please try again later.'
        ]);
        exit;
    }
}
?>
