<?php
include 'php/database.php';
error_reporting(0); 
header('refresh: 2'); // Suppress error reporting (not recommended for production)
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'second_hadder.php';
} else {
    include 'Header.php';
    Header('Location: user_login.php');
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id']; // Assuming the product ID is passed as a query parameter

$check = mysqli_query($cann,"SELECT * FROM wishlist 
WHERE user_id='$user_id' AND product_id='$product_id'");

if(mysqli_num_rows($check) == 0){
    mysqli_query($cann,"INSERT INTO wishlist(user_id,product_id) 
    VALUES('$user_id','$product_id')");
}

$query = "
SELECT cars.*, wishlist.id as wishlist_id
FROM wishlist
JOIN cars ON wishlist.product_id = cars.id
WHERE wishlist.user_id='$user_id'
";

$data = mysqli_query($cann,$query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="wishlist.css">
</head>

<body>



    <div class="wishlist-container">
        <div class="wishlist-header">
            <h1>My Dream Garage</h1>
            <p>Your curated collection of the Ultimate Driving Machines.</p>
        </div>
        <br>
        <br>
        <br>


        <div class="wishlist-grid">

            <div class="wishlist-grid">

                <?php while ($result = mysqli_fetch_assoc($data)) { ?>

                    <div class="wishlist-card">

                        <div class="card-image">
                            <img src="img/<?php echo $result['car_image']; ?>">
                            <span class="tag"><?php echo $result['category']; ?></span>
                        </div>

                        <div class="card-details">

                            <h3><?php echo $result['car_name']; ?></h3>

                            <p class="price">₹<?php echo $result['price']; ?></p>
                             <div class="specs">
                        <span>Year : <?php echo $result['year']; ?></span> 
                    </div>

                            <div class="card-actions">

                                <a href="cart.php?id=<?php echo $result['id']; ?>" class="btn-cart">
                                    Add to Cart
                                </a>

                                <a href="remove_wishlist.php?id=<?php echo $result['wishlist_id']; ?>" class="btn-remove">
                                    Remove
                                </a>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>
           
        <div class="empty-state" style="display: none;">
            <h2>Your wishlist is empty</h2>
            <a href="car_models.php" class="btn-explore">Explore Models</a>
        </div>
    </div>

    <?php include 'Footer.php'; ?>
</body>

</html>