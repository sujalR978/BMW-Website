<?php 
include 'php/database.php';


   if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM car_learn_more WHERE id='$id'";
        $data = mysqli_query($cann, $query);
        if ($data) {
            echo "<script>alert('Car deleted successfully!');</script>";
            header("Location: admin_learn_more.php");
            exit();
        } else {
            echo "<script>alert('Failed to delete car. Please try again.');</script>";
        }
    }
?>