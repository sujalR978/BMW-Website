<?php
include 'php/database.php';
session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

if (isset($_GET['id'])) {
    $inquiry_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Verify the inquiry belongs to the current user
    $verify_query = "SELECT image FROM bmw_inquiries WHERE id='$inquiry_id' AND user_id='$user_id'";
    $verify_result = mysqli_query($cann, $verify_query);
    
    if (mysqli_num_rows($verify_result) > 0) {
        $row = mysqli_fetch_assoc($verify_result);
        
        // Delete the image file if it exists
        if (!empty($row['image']) && file_exists($row['image'])) {
            unlink($row['image']);
        }
        
        // Delete the inquiry from database
        $delete_query = "DELETE FROM bmw_inquiries WHERE id='$inquiry_id' AND user_id='$user_id'";
        
        if (mysqli_query($cann, $delete_query)) {
            $_SESSION['success_msg'] = "Inquiry deleted successfully!";
            header('Location: Profile.php');
            exit();
        } else {
            $_SESSION['error_msg'] = "Error deleting inquiry: " . mysqli_error($cann);
            header('Location: Profile.php');
            exit();
        }
    } else {
        $_SESSION['error_msg'] = "Inquiry not found or unauthorized access.";
        header('Location: Profile.php');
        exit();
    }
} else {
    header('Location: Profile.php');
    exit();
}
?>
