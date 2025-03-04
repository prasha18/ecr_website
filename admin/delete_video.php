<?php
include("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Fetch the image URL to delete the file from the server
    $sql = "SELECT * FROM book_artist_video WHERE vid = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $imgPath = $row['imgurl'];
        if (file_exists($imgPath)) {
            unlink($imgPath); // Delete the image file
        }
        // Delete the record from the database
        $deleteSql = "DELETE FROM book_artist_video WHERE vid = ?";
        $deleteStmt = $connect->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);
        if ($deleteStmt->execute()) {
            echo "Success";
        } else {
            echo "Failed to delete Video.";
        }
    } else {
        echo "Video not found.";
    }
} else {
    echo "Invalid request.";
}
?>
