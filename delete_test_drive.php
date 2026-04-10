<?php
include 'php/database.php';

session_start();

$user_id = $_SESSION['user_id'];


if (isset($_GET['id'])) {
    $test_drive_id = $_GET['id'];

    $delete_query = "DELETE FROM test_drive WHERE id='$test_drive_id' AND user_id='$user_id'";
    $delete_data = mysqli_query($cann, $delete_query);

    if ($delete_data) {
        Header('Location: Profile.php');
        exit();
    } else {
        echo "Error deleting test drive.";
    }
} else {
    echo "Invalid request.";
}
?>