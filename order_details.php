<?php 
include 'php/database.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

// Check if order ID is provided
if (!isset($_GET['id'])) {
    header("Location: Profile.php");
    exit;
}

$order_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch order details - verify it belongs to the user
$order_query = "SELECT o.* FROM orders o WHERE o.id = '$order_id' AND o.user_id = '$user_id'";
$order_result = mysqli_query($cann, $order_query);
if (!$order_result || mysqli_num_rows($order_result) == 0) {
    echo "Order not found or access denied!";
    exit;
}
$order = mysqli_fetch_assoc($order_result);

// Fetch order items with car details
$items_query = "SELECT oi.*, c.* FROM order_items oi 
                LEFT JOIN cars c ON oi.car_id = c.id 
                WHERE oi.order_id = '$order_id'";
$items_result = mysqli_query($cann, $items_query);
$items = [];
if ($items_result && mysqli_num_rows($items_result) > 0) {
    while ($item = mysqli_fetch_assoc($items_result)) {
        $items[] = $item;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - BMW</title>
    <link rel="stylesheet" href="header-footer.css">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .order-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #5a6268;
        }

        .order-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .order-header-section h3 {
            margin-top: 15px;
            opacity: 0.9;
            font-size: 14px;
            text-transform: uppercase;
        }

        .order-header-section p {
            font-size: 18px;
            margin: 5px 0;
            font-weight: 500;
        }

        .section-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .section-card h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
        }

        .car-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            transition: all 0.3s;
        }

        .car-item:hover {
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .car-image {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            background: #fff;
        }

        .car-details {
            flex: 1;
        }

        .car-details h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 1.3rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-weight: 600;
        }

        .detail-value {
            color: #333;
            font-weight: 500;
        }

        .price-highlight {
            color: #667eea;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .summary-item {
            padding: 20px;
            background: linear-gradient(135deg, #f0f3ff, #f8f9fa);
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .summary-item-label {
            color: #666;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .summary-item-value {
            color: #333;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-shipped {
            background: #cfe2ff;
            color: #084298;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #f0f3ff;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .info-label {
            color: #666;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #333;
            font-weight: 600;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <?php include 'second_hadder.php'; ?>
    
    <div class="order-container">
        <a href="Profile.php" class="back-button">← Back to Profile</a>
        
        <div class="order-header">
            <div class="order-header-section">
                <h1>Order #<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></h1>
                <h3>Order Date</h3>
                <p><?php echo date('F d, Y - g:i A', strtotime($order['created_at'])); ?></p>
                <h3>Total Amount</h3>
                <p style="font-size: 28px; color: #4ade80;">₹<?php echo number_format($order['total_amount'], 2); ?></p>
            </div>
            <div class="order-header-section">
                <h3>Current Status</h3>
                <p style="font-size: 20px; margin: 10px 0;">
                    <span class="status-badge status-<?php echo strtolower($order['order_status'] ?? 'pending'); ?>">
                        <?php 
                        $status = strtolower($order['order_status'] ?? 'pending');
                        if ($status === 'completed') {
                            echo "✓ COMPLETED";
                        } elseif ($status === 'shipped') {
                            echo "📦 SHIPPED";
                        } elseif ($status === 'cancelled') {
                            echo "✗ CANCELLED";
                        } else {
                            echo "⏳ PENDING";
                        }
                        ?>
                    </span>
                </p>
                <h3>Payment Method</h3>
                <p><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order['payment_method'] ?? 'N/A'))); ?></p>
            </div>
        </div>

        <!-- Cars Ordered -->
        <div class="section-card">
            <h2>🚗 Cars Ordered</h2>
            <?php if (count($items) > 0): ?>
                <?php foreach ($items as $item): ?>
                <div class="car-item">
                    <img src="<?php echo htmlspecialchars($item['car_image'] ?? $item['images'] ?? 'img/placeholder.jpg'); ?>" 
                         alt="<?php echo htmlspecialchars($item['car_name'] ?? $item['model'] ?? 'Car'); ?>" class="car-image">
                    <div class="car-details">
                        <h3><?php echo htmlspecialchars($item['car_name'] ?? $item['model'] ?? 'Car'); ?></h3>
                        <div class="detail-row">
                            <span class="detail-label">Price:</span>
                            <span class="detail-value price-highlight">₹<?php echo number_format($item['price'], 2); ?></span>
                        </div>
                        <?php if (!empty($item['description'])): ?>
                        <div class="detail-row">
                            <span class="detail-label">Description:</span>
                            <span class="detail-value"><?php echo htmlspecialchars(substr($item['description'], 0, 60)); ?>...</span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($item['engine'])): ?>
                        <div class="detail-row">
                            <span class="detail-label">Engine:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($item['engine']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div style="margin-top: 15px;">
                            <a href="learn_more.php?id=<?php echo $item['car_id']; ?>" class="btn btn-primary" style="display: inline-block;">👁️ View Full Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No cars in this order.</p>
            <?php endif; ?>
        </div>

        <!-- Shipping Information -->
        <div class="section-card">
            <h2>📦 Shipping Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Shipping Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['shipping_address'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Payment Method</div>
                    <div class="info-value"><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $order['payment_method'] ?? 'N/A'))); ?></div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="section-card">
            <h2>💰 Order Summary</h2>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-item-label">Subtotal</div>
                    <div class="summary-item-value">₹<?php echo number_format($order['subtotal'] ?? ($order['total_amount'] * 0.9), 2); ?></div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-label">Tax (8%)</div>
                    <div class="summary-item-value">₹<?php echo number_format($order['tax'] ?? ($order['total_amount'] * 0.08), 2); ?></div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-label">Destination Charge</div>
                    <div class="summary-item-value">₹<?php echo number_format($order['destination_charge'] ?? 0, 2); ?></div>
                </div>
                <div class="summary-item" style="border-left: 4px solid #4ade80;">
                    <div class="summary-item-label">Total Amount</div>
                    <div class="summary-item-value" style="color: #4ade80;">₹<?php echo number_format($order['total_amount'], 2); ?></div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="section-card">
            <div class="action-buttons">
                <button onclick="window.print()" class="btn btn-outline">🖨️ Print Order</button>
                <a href="contact.php" class="btn btn-primary">📞 Contact Support</a>
            </div>
        </div>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>
