<?php

include 'php/database.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "UPDATE test_drive 
              SET booking_status='Rejected' 
              WHERE id='$id'";

    $data = mysqli_query($cann,$query);

    if($data)
    {
        header("Location: admin_test_drive.php");
        exit();
    }
    else
    {
        echo "Error updating status";
    }
}

?>