<?php

include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
$search = isset($_GET['search']) ? trim($_GET['search']) : ''; // Get search query if passed

$start = ($page - 1) * $pageSize;

// Base SQL query
$whereClause = "status = 'Active'";
$params = [];

// Add search condition if `search` parameter is provided
if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (name LIKE ? OR profession LIKE ? OR insname LIKE ? OR inscnt LIKE ? OR facename LIKE ? OR facecnt LIKE ? OR youname LIKE ? OR youcnt LIKE ?)";
    $params = array_fill(0, 8, $searchTerm); // Fill with 8 placeholders for all search fields
}

$sql = "SELECT id, name, profession, country, state, city, 
        profile AS profile_image, banner AS cover_image, 
        about AS biography, insimg, insname, insurl, inscnt, 
        faceimg, facename, faceurl, facecnt, youimg, youname, 
        youurl, youcnt, status, datetime 
        FROM book_artist  
        WHERE $whereClause
        ORDER BY id DESC 
        LIMIT $start, $pageSize";

// Prepare the statement
$stmt = $connect->prepare($sql);

// Bind parameters
if (!empty($params)) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params); // Bind all search parameters
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

$response = [];
$data = [];
$data['posts'] = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $followers = [];

        if (!empty($row['inscnt'])) {
            $followers['instagram'] = [
                'img' => $row['insimg'],  
                'name' => $row['insname'],  
                'url' => $row['insurl'],    
                'followers' => $row['inscnt']   
            ];
        }

        if (!empty($row['facecnt'])) {
            $followers['twitter'] = [
                'img' => $row['faceimg'],  
                'name' => $row['facename'],  
                'url' => $row['faceurl'],    
                'followers' => $row['facecnt'] 
            ];
        }

        if (!empty($row['youcnt'])) {
            $followers['youtube'] = [
                'img' => $row['youimg'],  
                'name' => $row['youname'], 
                'url' => $row['youurl'],    
                'followers' => $row['youcnt']  
            ];
        }

        $post = [
            'id' => $row['id'],
            'name' => $row['name'],
            'profession' => $row['profession'],
            'country' => $row['country'],
            'state' => $row['state'],
            'city' => $row['city'],
            'profile_image' => $row['profile_image'],
            'cover_image' => $row['cover_image'],
            'biography' => $row['biography'],
            'status' => $row['status'],
            'datetime' => $row['datetime'],
            'followers' => $followers 
        ];

        $data['posts'][] = $post;
    }

    // Count total rows for pagination
    $countSql = "SELECT COUNT(*) as total FROM book_artist WHERE $whereClause";
    $countStmt = $connect->prepare($countSql);

    if (!empty($params)) {
        $countStmt->bind_param(str_repeat('s', count($params)), ...$params);
    }

    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalRows = $countResult->fetch_assoc()['total'];

    $data['pagination'] = [
        'page' => $page,
        'pageSize' => $pageSize,
        'totalPages' => ceil($totalRows / $pageSize),
        'totalPosts' => $totalRows
    ];

    $response['status'] = true;
    $response['statusCode'] = 200;
    $response['data'] = $data;
    $response['message'] = "Data fetched successfully.";
} else {
    $data['pagination'] = [
        'page' => $page,
        'pageSize' => $pageSize,
        'totalPages' => 0,
        'totalPosts' => 0
    ];

    $response['status'] = false;
    $response['statusCode'] = 404;
    $response['data'] = $data;
    $response['message'] = "No data found.";
}

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

$connect->close();

?>
