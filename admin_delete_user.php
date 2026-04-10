<?php
    include "php/database.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM register_page WHERE id='$id'";
        $data = mysqli_query($cann, $query);
        if ($data) {
            echo "<script>alert('User deleted successfully!');</script>";
            header("Location: admin_register_detail.php");
            exit();
        } else {
            echo "<script>alert('Failed to delete user. Please try again.');</script>";
        }
    }
?>