<?php 


include 'php/database.php';
session_start();


$cart_id = $_GET['id'];

// Delete item from cart
$query = "DELETE FROM cart WHERE id='$cart_id'";
$result = mysqli_query($cann, $query);

if($result) {
    // Redirect to cart page after deletion
    header("Location: cart.php");
    exit();
} else {
    echo "Error removing item from cart.";

}


?>