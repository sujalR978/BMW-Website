<?php
include 'php/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inquiry_id = intval($_POST['inquiry_id']);
    $reply_message = htmlspecialchars(trim($_POST['reply_message']));
    
    if (empty($inquiry_id) || empty($reply_message)) {
        $_SESSION['error_msg'] = "Reply message cannot be empty.";
        header("Location: admin_inquire.php");
        exit();
    }
    
    // Check if replies table exists, if not create it
    $check_table = "SHOW TABLES LIKE 'bmw_replies'";
    $table_check = mysqli_query($cann, $check_table);
    
    if (mysqli_num_rows($table_check) == 0) {
        // Create replies table if it doesn't exist
        $create_table = "CREATE TABLE bmw_replies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            inquiry_id INT NOT NULL,
            reply_message LONGTEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            read_by_user INT DEFAULT 0,
            FOREIGN KEY (inquiry_id) REFERENCES bmw_inquiries(id) ON DELETE CASCADE
        )";
        mysqli_query($cann, $create_table);
    }
    
    // Insert reply into database
    $insert_query = "INSERT INTO bmw_replies (inquiry_id, reply_message, read_by_user) VALUES (?, ?, 0)";
    $insert_stmt = mysqli_prepare($cann, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, 'is', $inquiry_id, $reply_message);
    
    if (mysqli_stmt_execute($insert_stmt)) {
        // Mark inquiry as replied
        $update_query = "UPDATE bmw_inquiries SET reply_sent = 1 WHERE id = ?";
        $update_stmt = mysqli_prepare($cann, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'i', $inquiry_id);
        mysqli_stmt_execute($update_stmt);
        
        $_SESSION['success_msg'] = "Reply saved successfully! Customer will see it in their profile.";
    } else {
        $_SESSION['error_msg'] = "Failed to save reply: " . mysqli_error($cann);
    }
    
    header("Location: admin_inquire.php");
    exit();
} else {
    header("Location: admin_inquire.php");
    exit();
}
?>
