<?php
include 'php/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $contact_id = intval($_POST['contact_id']);
    $reply_message = trim($_POST['reply_message']);

    if (empty($contact_id) || empty($reply_message)) {
        $_SESSION['error_msg'] = "Reply message cannot be empty.";
        header("Location: admin_contact.php");
        exit();
    }

    // Insert reply
    $insert_query = "INSERT INTO bmw_contact_replies (contact_id, reply_message, read_by_user) VALUES (?, ?, 0)";
    $insert_stmt = mysqli_prepare($cann, $insert_query);

    if (!$insert_stmt) {
        die("Prepare failed: " . mysqli_error($cann));
    }

    mysqli_stmt_bind_param($insert_stmt, 'is', $contact_id, $reply_message);

    if (mysqli_stmt_execute($insert_stmt)) {
        $_SESSION['success_msg'] = "Reply saved successfully!";
    } else {
        die("Insert failed: " . mysqli_error($cann));
    }

    header("Location: admin_contact.php");
    exit();
}
?>
