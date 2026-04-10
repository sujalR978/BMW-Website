<?php

include 'php/database.php';
session_start();


$wishlist_id = $_GET['id'];

// Delete item from wishlist
$query = "DELETE FROM wishlist WHERE id='$wishlist_id'";
$result = mysqli_query($cann, $query);

if($result) {
    // Redirect to wishlist page after deletion
    header("Location: wishlist.php");
    exit();
} else {
    echo "Error removing item from wishlist.";

}

?>