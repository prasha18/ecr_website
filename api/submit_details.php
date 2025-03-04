<?php
include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check if the data is valid JSON
if (!$data) {
    echo json_encode([
        "status" => false,
        "statusCode" => 400,
        "message" => "Invalid JSON input."
    ]);
    exit;
}

// Debugging: log incoming data (use stderr for logging)
file_put_contents('php://stderr', print_r($data, true));

// Prepare the insert query and validate data based on type
if ($data['type'] == 'Individual') {
    if (empty($data['name']) || empty($data['mobileno']) || empty($data['email']) || empty($data['reason'])) {
        echo json_encode([
            "status" => false,
            "statusCode" => 400,
            "message" => "Missing required fields for Individual."
        ]);
        exit;
    }

    $otp = "0";
    $query = "INSERT INTO form_data (actor_id, type, name, countryCode, mobileno, email, letsfameUrl, reason, otp) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param(
        "sssssssss",
        $data['actor_id'],
        $data['type'],
        $data['name'],
        $data['countryCode'],
        $data['mobileno'],
        $data['email'],
        $data['letsfameUrl'],
        $data['reason'],
        $otp
    );

} elseif ($data['type'] == 'Company') {
    // Ensure all required fields for Company are provided
    if (
        empty($data['actor_id']) || empty($data['name']) || 
        empty($data['companyName']) || empty($data['mobileno']) || 
        empty($data['email']) || empty($data['reason'])
    ) {
        echo json_encode([
            "status" => false,
            "statusCode" => 400,
            "message" => "Missing required fields for Company."
        ]);
        exit;
    }

    $otp = "0";

    // Prepare the query
    $query = "INSERT INTO form_data (actor_id, type, name, companyName, countryCode, mobileno, email, designation, letsfameUrl, linkedInUrl, reason, otp) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "status" => false,
            "statusCode" => 500,
            "message" => "Failed to prepare query: " . $connect->error
        ]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssssssssss",
        $data['actor_id'],   // Actor ID
        $data['type'],       // Type: Company
        $data['name'],       // Name
        $data['companyName'], // Company Name
        $data['countryCode'], // Country Code
        $data['mobileno'],   // Mobile Number
        $data['email'],      // Email
        $data['designation'], // Designation
        $data['letsfameUrl'], // LetsFame URL
        $data['linkedInUrl'], // LinkedIn URL
        $data['reason'],     // Reason
        $otp                 // OTP
    );

    // Execute the query
    if ($stmt->execute()) {
        $lastInsertId = $connect->insert_id;
        $selectQuery = "SELECT * FROM form_data WHERE id = ?";
        $selectStmt = $connect->prepare($selectQuery);
        $selectStmt->bind_param("i", $lastInsertId);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        if ($result->num_rows > 0) {
            $insertedData = $result->fetch_assoc();
            echo json_encode([
                "status" => true,
                "statusCode" => 200,
                "message" => "Company data inserted successfully.",
                "data" => $insertedData
            ]);
        } else {
            echo json_encode([
                "status" => false,
                "statusCode" => 404,
                "message" => "Company data not found after insertion."
            ]);
        }
    } else {
        echo json_encode([
            "status" => false,
            "statusCode" => 500,
            "message" => "Error inserting company data: " . $stmt->error
        ]);
    }
}
