<?php
include("login_action.php");
user_log_vals();
ini_set("display_errors",1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $mobileno = $_POST['mobileno'];
    $status = $_POST['status'];

    // Check if the ID and status are provided
    if (!empty($mobileno) && !empty($status)) {
        // Update query
    $sql = "UPDATE form_data SET status = ? WHERE mobileno = ?";
        $stmt = $connect->prepare($sql);

        // Execute the query
        if ($stmt->execute([$status, $mobileno])) {
            echo "Status updated successfully!";
        } else {
            echo "Error updating status.";
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
