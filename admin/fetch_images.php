<?php
// Include database connection
include("../includes/connect.php");

$sql = "SELECT * FROM book_artist_img WHERE bookid='0'";
$result = $connect->query($sql);

// Prepare an array to hold images
$images = [];

foreach ($result as $row) {
    $images[] = [
        'img_id' => $row['img_id'],
        'url' => $row['imgurl'],
        'description' => $row['description'],
    ];
}

// Return the images as JSON
echo json_encode(['success' => true, 'images' => $images]);
?>
