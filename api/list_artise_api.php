<?php
include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

ini_set("display_errors", 1);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
$profession = isset($_GET['profession']) ? $_GET['profession'] : ''; 
$search = isset($_GET['search']) ? $_GET['search'] : ''; 

$start = ($page - 1) * $pageSize;

$whereClause = "status = 'Active'";
$params = [];
$types = ""; // Placeholder for binding parameter types

if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (name LIKE ? OR profession LIKE ? OR insname LIKE ? OR inscnt LIKE ? OR facename LIKE ? OR facecnt LIKE ? OR youname LIKE ? OR youcnt LIKE ?)";
    $params = array_fill(0, 8, $searchTerm); // Fill with 8 placeholders for all search fields
    $types = str_repeat("s", 8); // All placeholders are strings
}

// Modify SQL query based on whether profession is passed
if (!empty($profession)) {
    $sql = "SELECT id, name, profession, country, state, city, 
            profile AS profile_image, banner AS cover_image, 
            about AS biography, insimg, insname, insurl, inscnt, 
            faceimg, facename, faceurl, facecnt, youimg, youname, 
            youurl, youcnt, status, datetime 
            FROM book_artist  
            WHERE status = 'Active' AND profession = ? 
            ORDER BY id DESC 
            LIMIT ?, ?";
    $params = [$profession, $start, $pageSize];
    $types = "sii"; // profession is a string, start and pageSize are integers
} else if (!empty($search)) {
    $sql = "SELECT id, name, profession, country, state, city, 
            profile AS profile_image, banner AS cover_image, 
            about AS biography, insimg, insname, insurl, inscnt, 
            faceimg, facename, faceurl, facecnt, youimg, youname, 
            youurl, youcnt, status, datetime 
            FROM book_artist  
            WHERE $whereClause
            ORDER BY id DESC 
            LIMIT ?, ?";
    $params[] = $start;
    $params[] = $pageSize;
    $types .= "ii"; // Adding two integers to the types string
} else {
    $sql = "SELECT id, name, profession, country, state, city, 
            profile AS profile_image, banner AS cover_image, 
            about AS biography, insimg, insname, insurl, inscnt, 
            faceimg, facename, faceurl, facecnt, youimg, youname, 
            youurl, youcnt, status, datetime 
            FROM book_artist  
            WHERE status = 'Active' 
            ORDER BY id DESC 
            LIMIT ?, ?";
    $params = [$start, $pageSize];
    $types = "ii"; // Both parameters are integers
}

$stmt = $connect->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: (" . $connect->errno . ") " . $connect->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params); // Bind the parameters dynamically
}

$stmt->execute();
$result = $stmt->get_result();
$response = array();
$data = array();
$data['posts'] = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $followers = array();

        if (!empty($row['inscnt'])) {
            $followers['instagram'] = array(
                'img' => $row['insimg'],  
                'name' => $row['insname'],  
                'url' => $row['insurl'],    
                'followers' => $row['inscnt']   
            );
        }

        if (!empty($row['facecnt'])) {
            $followers['twitter'] = array(
                'img' => $row['faceimg'],  
                'name' => $row['facename'],  
                'url' => $row['faceurl'],    
                'followers' => $row['facecnt'] 
            );
        }

        if (!empty($row['youcnt'])) {
            $followers['youtube'] = array(
                'img' => $row['youimg'],  
                'name' => $row['youname'], 
                'url' => $row['youurl'],    
                'followers' => $row['youcnt']  
            );
        }

        $post = array(
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
        );

        $data['posts'][] = $post;
    }

    $countSql = "SELECT COUNT(*) as total FROM book_artist WHERE status = 'Active'";
    // If profession is passed, count only those with the given profession
    if (!empty($profession)) {
        $countSql .= " AND profession = ?";
        $countStmt = $connect->prepare($countSql);
        $countStmt->bind_param("s", $profession);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $totalRows = $countResult->fetch_assoc()['total'];
        $countStmt->close();
    } else {
        $countResult = $connect->query($countSql);
        $totalRows = $countResult->fetch_assoc()['total'];
    }

    $data['pagination'] = array(
        'page' => $page,
        'pageSize' => $pageSize,
        'totalPages' => ceil($totalRows / $pageSize),
        'totalPosts' => $totalRows
    );

    $response['status'] = true;
    $response['statusCode'] = 200;
    $response['data'] = $data;
    $response['message'] = "Data fetched successfully.";
} else {
    $data['pagination'] = array(
        'page' => $page,
        'pageSize' => $pageSize,
        'totalPages' => 0,
        'totalPosts' => 0
    );

    $response['status'] = false;
    $response['statusCode'] = 404;
    $response['data'] = $data;
    $response['message'] = "No data found.";
}

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

$stmt->close();
$connect->close();
?>
