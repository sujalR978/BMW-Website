<?php
include 'php/database.php';
error_reporting(0);  
header('refresh: 2');// Suppress error reporting (not recommended for production)
  session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
        Header('Location: user_login.php');
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id']; // Assuming the product ID is passed as a query parameter

    
    $query_check= "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'";
    $check_result = mysqli_query($cann, $query_check);

    if (mysqli_num_rows($check_result) == 0) {
        $query_insert = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
        mysqli_query($cann, $query_insert);
    }

    $query = "SELECT cars.*, cart.id as cart_id
    FROM cart
    JOIN cars ON cart.product_id = cars.id
    WHERE cart.user_id='$user_id'";
    $data = mysqli_query($cann, $query);


    $other_query ="SELECT cars.*, wishlist.id as wishlist_id
    FROM wishlist
    JOIN cars ON wishlist.product_id = cars.id
    WHERE wishlist.user_id='$user_id'";
    $other_data = mysqli_query($cann, $other_query);

    $recent_query = "SELECT * FROM cars ORDER BY id DESC LIMIT 10";
    $recent_data = mysqli_query($cann, $recent_query);
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - BMW</title>
    <link rel="stylesheet" href="cart.css"> 
</head>

<body>
    <br><br><br><br>

    <div class="cart-wrapper">
        <h1 class="page-title">Your Cart</h1>
        
        <div class="cart-layout">
            
            <!-- Cart Items List -->
            <div class="cart-items">
                <?php while ($result = mysqli_fetch_assoc($data)) :?>
                <!-- Item 1 -->
                <div class="cart-item">
                    <div class="item-image">
                        <img src="uploads/<?php echo $result['car_image']; ?>" alt="BMW X5">
                    </div>
                    <div class="item-info">
                        <h3><?php echo $result['car_name']?> </h3>
                        <p class="item-category"><?php echo $result['category']?></p>
                        <div class="item-meta">
                            <span>year : <?php echo $result['year']?></span>
                            <span><?php echo $result['description']?></span>
                        </div>
                    </div>
                    <div class="item-price">
                        <?php echo "₹".$result['price']?>
                    </div>
                    <button type="submit" onclick="window.location.href='remove_from_cart.php?id=<?php echo $result['cart_id']; ?>'" class="item-remove">&times;</button>
                </div>
                <?php endwhile; ?>
                <!-- Item 2 -->
                </div>
            <!-- Order Summary -->
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$109,700</span>
                </div>
                <div class="summary-row">
                    <span>Estimated Tax</span>
                    <span>$8,776</span>
                </div>
                <div class="summary-row">
                    <span>Destination Charge</span>
                    <span>$995</span>
                </div>
                
                <div class="promo-section">
                    <input type="text" placeholder="Promo Code" class="promo-input">
                    <button class="btn-apply">Apply</button>
                </div>

                <div class="summary-divider"></div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>$119,471</span>
                </div>
                
                <button class="btn-checkout" onclick="window.location.href='checkout.php'" >Proceed to Checkout</button>
                <!-- <a href="buy_car.php" class="btn-checkout">Proceed to Checkout</a> -->
                <div class="secure-badge">
                    <span>🔒 Secure Checkout</span>
                </div>

                <a href="car_models.php" class="continue-shopping">Continue Shopping</a>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="related-products">
            <h2>You Might Also Like</h2>
            <div class="related-grid">
                <!-- Product 1 -->
                 <?php while ($other_result = mysqli_fetch_assoc($other_data)) :?>
                <div class="related-card">
                    <div class="related-image">
                        <img src="uploads/<?php echo $other_result['car_image']; ?>" alt="BMW X3">
                    </div>
                    <div class="related-info">
                        <h3><?php echo $other_result['car_name']?></h3>
                        <p class="related-price"> <?php echo htmlspecialchars($other_result['price']); ?> </p>
                        <button class="btn-add-related" type="submit" onclick="window.location.href='cart.php?id=<?php echo htmlspecialchars($other_result['id']); ?>'" >Add to Cart</button>
                    </div>
                </div>
                <?php endwhile; ?>
                <!-- Product 2 -->
              
            </div>
        </div>

        <!-- Recently Viewed Section -->
        <div class="recently-viewed">
            <h2>Recently Viewed</h2>
            <div class="recent-grid">
                <!-- Item 1 -->
                 <?php while ($recent_result = mysqli_fetch_assoc($recent_data)) :?>
                <div class="recent-card">
                    <img src="uploads/<?php echo $recent_result['car_image']; ?>" alt="BMW 7 Series">
                    <div class="recent-info">
                        <h4><?php echo htmlspecialchars($recent_result['car_name']); ?></h4>
                        <a href="learn_more.php?id=<?php echo htmlspecialchars($recent_result['id']) ?>" class="btn-view">View</a>
                    </div>
                </div>
                <?php endwhile;?>
              
                </div>
            </div>
        </div>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>