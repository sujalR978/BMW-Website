<?php
include 'php/database.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}
//  include 'second_hadder.php'; 

$user_id = $_SESSION['user_id'];



// Fetch user information
$user_query = "SELECT * FROM register_page WHERE id='$user_id'";
$user_data = mysqli_query($cann, $user_query);
$user = mysqli_fetch_assoc($user_data);

// Fetch all cart items for the user
$query = "SELECT cars.*, cart.id as cart_id
FROM cart
JOIN cars ON cart.product_id = cars.id
WHERE cart.user_id='$user_id'";
$cart_result = mysqli_query($cann, $query);

if (!$cart_result) {
    die("Error: " . mysqli_error($cann));
}

$cart_items = mysqli_fetch_all($cart_result, MYSQLI_ASSOC);
$total_items = count($cart_items);

// Calculate totals
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += floatval($item['price']);
}

$tax_rate = 0.08; // 8% tax
$estimated_tax = $subtotal * $tax_rate;
$destination_charge = 995;
$total = $subtotal + $estimated_tax + $destination_charge;

// Handle order placement
$order_placed = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : 'credit_card';
    $shipping_address = isset($_POST['shipping_address']) ? trim($_POST['shipping_address']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    
    if (empty($shipping_address) || empty($phone) || empty($payment_method)) {
        $error_msg = "Please fill in all required fields.";
    } else {
        // Create order in database
        $order_query = "INSERT INTO orders (user_id, total_amount, payment_method, shipping_address, phone, order_status) 
                       VALUES ('$user_id', '$total', '$payment_method', '$shipping_address', '$phone', 'pending')";
        
        if (mysqli_query($cann, $order_query)) {
            $order_id = mysqli_insert_id($cann);
            
            // Insert order items
            foreach ($cart_items as $item) {
                $order_item_query = "INSERT INTO order_items (order_id, car_id, price) VALUES ('$order_id', '{$item['id']}', '{$item['price']}')";
                mysqli_query($cann, $order_item_query);
            }
            
            // Clear cart
            $clear_cart_query = "DELETE FROM cart WHERE user_id='$user_id'";
            mysqli_query($cann, $clear_cart_query);
            
            $_SESSION['success_msg'] = "Order placed successfully! Order ID: #" . str_pad($order_id, 5, '0', STR_PAD_LEFT);
            $order_placed = true;
            $order_id_display = str_pad($order_id, 5, '0', STR_PAD_LEFT);
        } else {
            $error_msg = "Error placing order. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - BMW</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
    

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
           
        }

        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .checkout-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .checkout-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.7);
        }

        .step.active {
            color: white;
            font-weight: 600;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .step.active .step-number {
            background: white;
            color: #667eea;
        }

        .checkout-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .order-form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 12px;
        }

        .payment-method {
            position: relative;
        }

        .payment-method input[type="radio"] {
            display: none;
        }

        .payment-method label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
            font-weight: 500;
        }

        .payment-method input[type="radio"]:checked + label {
            border-color: #667eea;
            background: #f0f3ff;
            color: #667eea;
        }

        .order-summary {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .order-summary h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .cart-items-list {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .summary-item-name {
            flex: 1;
            color: #333;
            font-weight: 500;
        }

        .summary-item-price {
            color: #667eea;
            font-weight: 600;
        }

        .summary-divider {
            height: 1px;
            background: #ecf0f1;
            margin: 15px 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .summary-row.total {
            font-size: 1.3rem;
            font-weight: 700;
            color: #667eea;
            padding: 15px 0;
            border-top: 2px solid #ecf0f1;
            border-bottom: 2px solid #ecf0f1;
        }

        .btn-place-order {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-place-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
            color: #28a745;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-color: #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .success-message {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            margin: 30px 0;
        }

        .success-message h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .success-message p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .order-details {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .order-details p {
            margin: 8px 0;
            font-size: 0.95rem;
        }

        @media (max-width: 968px) {
            .checkout-content {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: relative;
                top: auto;
            }

            .checkout-header h1 {
                font-size: 1.8rem;
            }

            .progress-steps {
                gap: 20px;
            }
        }

        @media (max-width: 600px) {
            .checkout-container {
                padding: 10px;
            }

            .order-form,
            .order-summary {
                padding: 20px;
            }

            .checkout-header {
                padding: 25px;
            }

            .progress-steps {
                flex-direction: column;
                gap: 15px;
            }

            .payment-methods {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
  

    <div class="checkout-container">
        <div class="checkout-header">
            <h1>🛒 Secure Checkout</h1>
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <span>Cart Review</span>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <span>Checkout</span>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <span>Confirmation</span>
                </div>
            </div>
        </div>

        <?php if ($order_placed): ?>
            <div class="success-message">
                <h2>✓ Order Placed Successfully!</h2>
                <p>Thank you for your purchase!</p>
                <div class="order-details">
                    <p><strong>Order ID:</strong> #<?php echo $order_id_display; ?></p>
                    <p><strong>Total Amount:</strong> ₹<?php echo number_format($total, 2); ?></p>
                    <p><strong>Status:</strong> Pending Confirmation</p>
                    <p style="margin-top: 15px; font-size: 0.9rem;">You will receive an email confirmation shortly.</p>
                </div>
                <a href="Profile.php" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: white; color: #28a745; text-decoration: none; border-radius: 6px; font-weight: 600;">View My Orders</a>
            </div>
        <?php else: ?>
            <?php 
            if (isset($error_msg)) {
                echo "<div class='alert alert-error'>" . htmlspecialchars($error_msg) . "</div>";
            }
            if (isset($_SESSION['success_msg'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['success_msg'] . "</div>";
                unset($_SESSION['success_msg']);
            }
            if ($total_items == 0) {
                echo "<div class='alert alert-error'><strong>Your cart is empty!</strong> <a href='car_models.php' style='color: #721c24; text-decoration: underline;'>Continue Shopping</a></div>";
            }
            ?>

            <div class="checkout-content">
                <!-- Order Form -->
                <form method="POST" class="order-form">
                    <div class="form-section">
                        <h3>📍 Shipping Information</h3>
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label>Shipping Address *</label>
                            <textarea name="shipping_address" placeholder="Enter your complete shipping address" required></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>💳 Payment Method</h3>
                        <div class="payment-methods">
                            <div class="payment-method">
                                <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked>
                                <label for="credit_card">💳 Credit Card</label>
                            </div>
                            <div class="payment-method">
                                <input type="radio" id="debit_card" name="payment_method" value="debit_card">
                                <label for="debit_card">🏧 Debit Card</label>
                            </div>
                            <div class="payment-method">
                                <input type="radio" id="upi" name="payment_method" value="upi">
                                <label for="upi">📱 UPI</label>
                            </div>
                            <div class="payment-method">
                                <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer">
                                <label for="bank_transfer">🏦 Bank Transfer</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-place-order">Place Order - ₹<?php echo number_format($total, 2); ?></button>
                    <div class="secure-badge">
                        🔒 Secure Checkout - Your data is encrypted
                    </div>
                </form>

                <!-- Order Summary Sidebar -->
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    
                    <div class="cart-items-list">
                        <?php 
                        if ($total_items > 0) {
                            foreach ($cart_items as $item) {
                                echo "
                                <div class='summary-item'>
                                    <div class='summary-item-name'>" . htmlspecialchars($item['car_name']) . "</div>
                                    <div class='summary-item-price'>₹" . number_format($item['price'], 2) . "</div>
                                </div>
                                ";
                            }
                        } else {
                            echo "<p style='text-align: center; color: #999; padding: 20px;'>No items in cart</p>";
                        }
                        ?>
                    </div>

                    <div class="summary-divider"></div>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>₹<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Estimated Tax (8%)</span>
                        <span>₹<?php echo number_format($estimated_tax, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Destination Charge</span>
                        <span>₹<?php echo number_format($destination_charge, 2); ?></span>
                    </div>
                    
                    <div class="summary-divider"></div>
                    
                    <div class="summary-row total">
                        <span>Total Amount</span>
                        <span>₹<?php echo number_format($total, 2); ?></span>
                    </div>
                    
                    <div class="secure-badge">
                        🔒 100% Secure Payment
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>
