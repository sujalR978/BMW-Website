<?php 
include 'php/database.php';
error_reporting(0);
// Check if order ID is provided
if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$order_id = $_GET['id'];

// Fetch order details
$order_query = "SELECT o.* FROM orders o WHERE o.id = '$order_id'";
$order_result = mysqli_query($cann, $order_query);
if (!$order_result || mysqli_num_rows($order_result) == 0) {
    echo "Order not found!";
    exit;
}
$order = mysqli_fetch_assoc($order_result);

// Fetch order items
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

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($cann, $_POST['order_status']);
    $update_query = "UPDATE orders SET order_status = '$new_status' WHERE id = '$order_id'";
    if (mysqli_query($cann, $update_query)) {
        $order['order_status'] = $new_status;
        $success_msg = "Order status updated successfully!";
    }
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $delete_items = "DELETE FROM order_items WHERE order_id = '$order_id'";
    $delete_order = "DELETE FROM orders WHERE id = '$order_id'";
    
    if (mysqli_query($cann, $delete_items) && mysqli_query($cann, $delete_order)) {
        header("Location: admin_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - BMW Admin</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <style>
        .order-details-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
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
        
        .order-items-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .order-items-section h2 {
            margin-bottom: 20px;
            color: #333;
        }
        
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .item-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .item-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background: #f0f0f0;
        }
        
        .item-details {
            padding: 15px;
        }
        
        .item-details h4 {
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .item-price {
            font-size: 18px;
            color: #667eea;
            font-weight: 600;
        }
        
        .order-summary {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 30px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .summary-row:last-child {
            border-bottom: none;
        }
        
        .summary-total {
            font-size: 20px;
            font-weight: 600;
            color: #667eea;
        }
        
        .status-update-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 30px;
        }
        
        .status-update-section h3 {
            margin-top: 0;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
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
        
        .btn-danger {
            background: #ff6b6b;
            color: white;
        }
        
        .btn-danger:hover {
            background: #ee5a52;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background: #5a6268;
        }
        
        .success-message {
            background: #e0f0e0;
            color: #388e3c;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #388e3c;
        }
        
        .customer-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 30px;
        }
        
        .customer-info h3 {
            margin-top: 0;
            color: #333;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .info-item {
            padding: 10px 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .info-value {
            color: #333;
            font-size: 16px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php include 'admin_hader.php'; ?>
    
    <div class="order-details-container">
        <a href="admin_dashboard.php" class="btn-back">← Back to Dashboard</a>
        
        <?php if (isset($success_msg)): ?>
        <div class="success-message"><?php echo $success_msg; ?></div>
        <?php endif; ?>
        
        <div class="order-header">
            <div class="order-header-section">
                <h1>Order #<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></h1>
                <h3>Order Date</h3>
                <p><?php echo date('F d, Y at H:i', strtotime($order['created_at'])); ?></p>
                <h3>Total Amount</h3>
                <p style="font-size: 28px; color: #4ade80;">$<?php echo number_format($order['total_amount'] ?? 0, 2); ?></p>
            </div>
            <div class="order-header-section">
                <h3>Current Status</h3>
                <p style="font-size: 24px;">
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
                </p>
                <h3>Payment Method</h3>
                <p><?php echo htmlspecialchars($order['payment_method'] ?? 'N/A'); ?></p>
            </div>
        </div>
        
        <div class="customer-info">
            <h3>Customer Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Name</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['customer_name'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['customer_email'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Phone</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['phone'] ?? $order['customer_phone'] ?? 'N/A'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Shipping Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($order['shipping_address'] ?? 'N/A'); ?></div>
                </div>
            </div>
        </div>
        
        <div class="order-items-section">
            <h2>Order Items</h2>
            <?php if (count($items) > 0): ?>
            <div class="items-grid">
                <?php foreach ($items as $item): ?>
                <div class="item-card">
                    <img src="<?php echo htmlspecialchars($item['image'] ?? $item['images'] ?? 'img/placeholder.jpg'); ?>" alt="Car" class="item-image">
                    <div class="item-details">
                        <h4><?php echo htmlspecialchars($item['model'] ?? $item['name'] ?? 'Car'); ?></h4>
                        <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
                            Item ID: <?php echo $item['car_id']; ?>
                        </div>
                        <div class="item-price">$<?php echo number_format($item['price'], 2); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$<?php echo number_format($order['subtotal'] ?? ($order['total_amount'] * 0.8), 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax (8%):</span>
                    <span>$<?php echo number_format($order['tax'] ?? ($order['total_amount'] * 0.08 / 1.08), 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Destination Charge:</span>
                    <span>$<?php echo number_format($order['destination_charge'] ?? 0, 2); ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total Amount:</span>
                    <span>$<?php echo number_format($order['total_amount'], 2); ?></span>
                </div>
            </div>
        </div>
        
        <div class="status-update-section">
            <h3>Update Order Status</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="order_status">Select New Status:</label>
                    <select name="order_status" id="order_status" required>
                        <option value="pending" <?php echo (($order['order_status'] ?? 'pending') === 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="shipped" <?php echo (($order['order_status'] ?? '') === 'shipped') ? 'selected' : ''; ?>>Shipped</option>
                        <option value="completed" <?php echo (($order['order_status'] ?? '') === 'completed') ? 'selected' : ''; ?>>Completed</option>
                        <option value="cancelled" <?php echo (($order['order_status'] ?? '') === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>
                <div class="action-buttons">
                    <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
        
        <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            <h3 style="margin-top: 0; color: #333;">Danger Zone</h3>
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.');">
                <div class="action-buttons">
                    <button type="submit" name="delete_order" class="btn btn-danger">Delete Order</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'admin_footer.php'; ?>
</body>
</html>
