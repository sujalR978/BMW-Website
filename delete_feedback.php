<?php
include 'php/database.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    $_SESSION['error_msg'] = "Invalid request.";
    header("Location: Profile.php");
    exit();
}

$feedback_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Verify the feedback belongs to the user
$verify_query = "SELECT * FROM bmw_feedback WHERE id='$feedback_id' AND user_id='$user_id'";
$verify_result = mysqli_query($cann, $verify_query);

if (mysqli_num_rows($verify_result) == 0) {
    $_SESSION['error_msg'] = "You don't have permission to delete this feedback.";
    header("Location: Profile.php");
    exit();
}

$feedback = mysqli_fetch_assoc($verify_result);

// Delete the feedback
$delete_query = "DELETE FROM bmw_feedback WHERE id='$feedback_id' AND user_id='$user_id'";

if (mysqli_query($cann, $delete_query)) {
    // Delete associated image if it exists
    if (!empty($feedback['image_url'])) {
        $image_path = "uploads/feedback/" . $feedback['image_url'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    
    $_SESSION['success_msg'] = "Feedback deleted successfully!";
} else {
    $_SESSION['error_msg'] = "Error deleting feedback. Please try again.";
}

header("Location: Profile.php");
exit();
?>
