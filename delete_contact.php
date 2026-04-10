<?php
include 'php/database.php';
session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

if (isset($_GET['id'])) {
    $contact_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Verify the contact belongs to the current user
    $verify_query = "SELECT id FROM bmw_contacts WHERE id='$contact_id' AND user_id='$user_id'";
    $verify_result = mysqli_query($cann, $verify_query);
    
    if (mysqli_num_rows($verify_result) > 0) {
        
        // Delete the contact from database
        $delete_query = "DELETE FROM bmw_contacts WHERE id='$contact_id' AND user_id='$user_id'";
        
        if (mysqli_query($cann, $delete_query)) {
            $_SESSION['success_msg'] = "Contact deleted successfully!";
            header('Location: Profile.php');
            exit();
        } else {
            $_SESSION['error_msg'] = "Error deleting contact: " . mysqli_error($cann);
            header('Location: Profile.php');
            exit();
        }
    } else {
        $_SESSION['error_msg'] = "Contact not found or unauthorized access.";
        header('Location: Profile.php');
        exit();
    }
} else {
    header('Location: Profile.php');
    exit();
}
?>
