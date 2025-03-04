<?php
// Include database connection
include("../includes/connect.php");

// Check if id is passed properly (could be from GET or POST)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; // Ensure $id is passed correctly
} else {
    die("Invalid or missing ID.");
}

// SQL query to get videos based on bookid
$sql = "SELECT * FROM book_artist_video WHERE bookid='$id'";

$result = $connect->query($sql);

// Prepare an array to hold images
$images = [];

// Fetch all rows
while ($row = $result->fetch_assoc()) {
    $images[] = [
        'vid' => $row['vid'],
        'url' => $row['videourl'],
        'thumburl' => $row['vid_thumbnail'],
        'description' => $row['description'],
    ];
}

// Return the images as JSON
echo json_encode(['success' => true, 'images' => $images]);

?>
