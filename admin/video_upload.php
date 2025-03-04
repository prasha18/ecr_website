<?php
include("connect.php");

// Function to save data into the database
function saveData($pdo, $data) {
    $video_file_name = $data['video']['file_name'];
    $video_original_file_name = $data['video']['original_file_name'];
    $video_moderation_required = $data['video']['moderation_required'];
    $video_type = $data['video']['type'];
    $video_url = $data['video']['url'];
    $thumb_file_name = $data['thumbnail']['file_name'];
    $thumb_original_file_name = $data['thumbnail']['original_file_name'];
    $thumb_moderation_required = $data['thumbnail']['moderation_required'];
    $thumb_type = $data['thumbnail']['type'];
    $thumb_url = $data['thumbnail']['url'];
    $bookid = $data['bookid'];
    $videoName = $data['video_name'];

    // SQL query with prepared statements
    $sql = "INSERT INTO book_artist_video 
            (bookid, videourl, vid_thumbnail, description, file_name, original_file_name, moderation_required, type) 
            VALUES 
            (:bookid, :video_url, :thumb_url, :videoName, :video_file_name, :video_original_file_name, :video_moderation_required, :video_type)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bookid', $bookid);
    $stmt->bindParam(':video_url', $video_url);
    $stmt->bindParam(':thumb_url', $thumb_url);
    $stmt->bindParam(':video_file_name', $video_file_name);
    $stmt->bindParam(':video_original_file_name', $video_original_file_name);
    $stmt->bindParam(':video_moderation_required', $video_moderation_required, PDO::PARAM_BOOL);
    $stmt->bindParam(':video_type', $video_type);
        $stmt->bindParam(':videoName', $videoName);


    if ($stmt->execute()) {
        return $pdo->lastInsertId(); // Return the last inserted ID
    } else {
        throw new Exception('Failed to insert data into the database.');
    }
}

// Main logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['video']) || !isset($input['thumbnail'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        exit;
    }

    try {
        $pdo = connectDatabase(); // Assuming `connectDatabase()` is in `connect.php`
        $recordId = saveData($pdo, $input);
        echo json_encode(['success' => true, 'record_id' => $recordId]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
