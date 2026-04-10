<?php 
include 'php/database.php';
// error_reporting(0);

$query = "SELECT * FROM test_drive";
$data = mysqli_query($cann,$query);
$total = mysqli_num_rows($data);

$query1 = "SELECT * FROM register_page";
$data1 = mysqli_query($cann,$query1);
$total1 = mysqli_num_rows($data1);

// Fetch all inquiries
$inquiry_query = "SELECT * FROM bmw_inquiries ORDER BY id DESC LIMIT 10";
$inquiry_data = mysqli_query($cann, $inquiry_query);
if (!$inquiry_data) {
    $inquiry_data = false;
}

// Fetch all contacts
$contact_query = "SELECT * FROM bmw_contacts ORDER BY id DESC LIMIT 10";
$contact_data = mysqli_query($cann, $contact_query);
if (!$contact_data) {
    $contact_data = false;
}

// Fetch all feedback
$feedback_query = "SELECT * FROM bmw_feedback ORDER BY id DESC LIMIT 10";
$feedback_data = mysqli_query($cann, $feedback_query);
if (!$feedback_data) {
    $feedback_data = false;
}

// Fetch all orders
$orders_query = "SELECT o.* FROM orders o ORDER BY o.id DESC LIMIT 10";
$orders_data = mysqli_query($cann, $orders_query);
if (!$orders_data) {
    $orders_data = false;
}

// Calculate total orders and revenue
$total_orders_query = "SELECT COUNT(*) as total_orders, SUM(total_amount) as total_revenue FROM orders";
$total_orders_result = mysqli_query($cann, $total_orders_query);
$orders_stats = mysqli_fetch_assoc($total_orders_result);
$total_orders = $orders_stats['total_orders'] ?? 0;
$total_revenue = $orders_stats['total_revenue'] ?? 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BMW</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>
    <?php include 'admin_hader.php'; ?>
    <br>
    <br>
    <br>
    <br>

    <div class="dashboard-container">
        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="welcome-content">
                <h1>Welcome to the Admin Dashboard</h1>
                <p>Monitor and manage all website activities in real-time</p>
                <div class="welcome-stats">
                    <div class="welcome-stat">
                        <span class="stat-number"><?php echo $total1; ?></span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="welcome-stat">
                        <span class="stat-number"><?php echo ($inquiry_data && mysqli_num_rows($inquiry_data) > 0) ? mysqli_num_rows($inquiry_data) : '0'; ?></span>
                        <span class="stat-label">Inquiries</span>
                    </div>
                    <div class="welcome-stat">
                        <span class="stat-number"><?php echo $total; ?></span>
                        <span class="stat-label">Test Drives</span>
                    </div>
                    <div class="welcome-stat">
                        <span class="stat-number">$45.2K</span>
                        <span class="stat-label">Revenue</span>
                    </div>
                </div>
            </div>
        </section>
   <br>
    <br>
    <br>
    <br>
        <!-- Quick Stats Overview -->
        <section class="stats-section">
            <h2>Quick Stats Overview</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon inquiries">📋</div>
                    <div class="stat-details">
                        <h3>New Inquiries</h3>
                        <p class="stat-value"><?php echo ($inquiry_data && mysqli_num_rows($inquiry_data) > 0) ? mysqli_num_rows($inquiry_data) : '0'; ?></p>
                        <p class="stat-change">+12% from last week</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bookings">🚗</div>
                    <div class="stat-details">
                        <h3>Test Drive Bookings</h3>
                        <p class="stat-value"><?php echo $total; ?></p>
                        <p class="stat-change">+8% from last week</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon users">👥</div>
                    <div class="stat-details">
                        <h3>Active Users</h3>
                        <p class="stat-value"><?php echo $total1; ?></p>
                        <p class="stat-change">+15% from last week</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon revenue">📦</div>
                    <div class="stat-details">
                        <h3>Total Orders</h3>
                        <p class="stat-value"><?php echo $total_orders; ?></p>
                        <p class="stat-change">Revenue: $<?php echo number_format($total_revenue, 2); ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon revenue">⭐</div>
                    <div class="stat-details">
                        <h3>User Feedback</h3>
                        <p class="stat-value"><?php echo ($feedback_data && mysqli_num_rows($feedback_data) > 0) ? mysqli_num_rows($feedback_data) : '0'; ?></p>
                        <p class="stat-change ">View all feedback</p>
                    </div>
                </div>
            </div>
        </section>
   <br>
    <br>
    <br>
    <br>
       
    <br>
    <br>
        <!-- Recent Inquiries -->
        <section class="inquiries-section">
            <h2>Recent Inquiries</h2>
            <div class="inquiries-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($inquiry_data && mysqli_num_rows($inquiry_data) > 0): ?>
                            <?php while($inquiry_row = mysqli_fetch_assoc($inquiry_data)): ?>
                        <tr class="inquiry-row">
                            <td><?php echo str_pad($inquiry_row['id'], 3, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo htmlspecialchars($inquiry_row['name']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry_row['email']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry_row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry_row['subject']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($inquiry_row['created_at'])); ?></td>
                            <td><span class="status pending">Pending</span></td>
                            <td><a href="admin_inquire.php" class="action-link">Manage</a></td>
                        </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <tr><td colspan="8" style="text-align: center; padding: 20px;">No inquiries found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
   <br>
    <br>
    <br>
    <br>
        <!-- Test Drive Bookings -->
        <section class="bookings-section">
            <h2>Test Drive Bookings</h2>
            <div class="bookings-grid">
                <?php while($row = mysqli_fetch_assoc($data)) : ?>
                <div class="booking-card">
                    <div class="booking-header">
                        <div class="user-profile">
                            <div class="profile-avatar"><?php echo strtoupper(substr($row['first_name'],0,1)); ?></div>
                            <div class="user-info">
                                <h3><?php echo $row['first_name']. " ". $row['last_name']; ?></h3>
                                <p><?php echo $row['email']; ?></p>
                            </div>
                        </div>
                        <span class="booking-status active">Active</span>
                    </div>
                    <div class="booking-details">
                        <div class="detail-row">
                            <span class="label">Vehicle:</span>
                            <span class="value"><?php echo $row['model']; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Date:</span>
                            <span class="value"><?php echo $row['preferred_date']; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Time:</span>
                            <span class="value"><?php echo $row['preferred_time']; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Phone:</span>
                            <span class="value"><?php echo $row['phone']; ?></span>
                        </div>
                         <div class="detail-row">
                            <span class="label">status:</span>
                            <span class="value"><?php echo $row['booking_status']; ?></span>
                        </div>
                    </div>
                    <?php ?>
                    <div class="booking-actions">
                        <?php
                            $status = isset($row['booking_status']) ? strtolower($row['booking_status']) : 'pending';
                            
                            if ($status === 'approved') {
                                echo '<button class="btn-cancel">Cancel</button>';
                            } elseif ($status === 'rejected') {
                                echo '<button class="btn-confirm">Confirm</button>';
                            } else {
                                echo '<button class="btn-confirm">Confirm</button>';
                                echo '<button class="btn-cancel">Cancel</button>';
                            }
                        ?>
                    </div>
                </div>
                    <?php endwhile; ?>
               
            </div>
        </section>
    </div>
        <!-- Contact Details Section -->
        <section class="inquiries-section">
            <h2>Recent Contact Messages</h2>
            <div class="inquiries-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Inquiry Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($contact_data && mysqli_num_rows($contact_data) > 0): ?>
                            <?php while($contact_row = mysqli_fetch_assoc($contact_data)): ?>
                        <tr class="inquiry-row">
                            <td><?php echo str_pad($contact_row['id'], 3, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo htmlspecialchars($contact_row['name']); ?></td>
                            <td><?php echo htmlspecialchars($contact_row['email']); ?></td>
                            <td><?php echo htmlspecialchars(substr($contact_row['subject'], 0, 30)); ?></td>
                            <td><?php echo htmlspecialchars($contact_row['inquiry_type']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($contact_row['created_at'])); ?></td>
                            <td><span class="status pending">Pending</span></td>
                            <td><a href="admin_contact.php" class="action-link">Manage</a></td>
                        </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <tr><td colspan="8" style="text-align: center; padding: 20px;">No contact messages found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
       <br>
    <br>
    <br>
    <br>

        <!-- Feedback Section -->
        <section class="inquiries-section">
            <h2>Recent User Feedback</h2>
            <div class="inquiries-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Rating</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($feedback_data && mysqli_num_rows($feedback_data) > 0): ?>
                            <?php while($feedback_row = mysqli_fetch_assoc($feedback_data)): ?>
                        <tr class="inquiry-row" style="background: <?php echo ($feedback_row['is_negative'] == 1) ? '#fff5f5' : '#f0fff4'; ?>;">
                            <td><?php echo str_pad($feedback_row['id'], 3, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo htmlspecialchars($feedback_row['name']); ?></td>
                            <td><?php echo htmlspecialchars($feedback_row['email']); ?></td>
                            <td><?php echo htmlspecialchars($feedback_row['feedback_type']); ?></td>
                            <td style="color: #ffc107; font-weight: 600;"><?php echo str_repeat('⭐', $feedback_row['rating']); ?> <?php echo $feedback_row['rating']; ?>/5</td>
                            <td><?php echo date('Y-m-d', strtotime($feedback_row['created_at'])); ?></td>
                            <td>
                                <?php 
                                if ($feedback_row['is_negative'] == 1) {
                                    echo "<span class='status' style='background: #ffe0e0; color: #d32f2f; padding: 5px 10px; border-radius: 4px;'>⚠️ NEGATIVE</span>";
                                } else {
                                    echo "<span class='status pending' style='background: #e0f0e0; color: #388e3c;'>✓ POSITIVE</span>";
                                }
                                ?>
                            </td>
                            <td><a href="admin_feedback.php" class="action-link">Manage</a></td>
                        </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <tr><td colspan="8" style="text-align: center; padding: 20px;">No feedback found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
       <br>
    <br>
    <br>
    <br>

        <!-- Orders Section -->
        <section class="inquiries-section">
            <h2>Recent Orders</h2>
            <div class="inquiries-table">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Payment Method</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($orders_data && mysqli_num_rows($orders_data) > 0): ?>
                            <?php while($order_row = mysqli_fetch_assoc($orders_data)): ?>
                        <tr class="inquiry-row">
                            <td><?php echo str_pad($order_row['id'], 5, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo htmlspecialchars($order_row['customer_name'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($order_row['customer_email'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($order_row['payment_method'] ?? 'N/A'); ?></td>
                            <td style="font-weight: 600; color: #667eea;">$<?php echo number_format($order_row['total_amount'], 2); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($order_row['created_at'])); ?></td>
                            <td>
                                <?php 
                                $status = strtolower($order_row['order_status']);
                                if ($status === 'completed') {
                                    echo "<span class='status' style='background: #e0f0e0; color: #388e3c; padding: 5px 10px; border-radius: 4px;'>✓ Completed</span>";
                                } elseif ($status === 'shipped') {
                                    echo "<span class='status' style='background: #e3f2fd; color: #1976d2; padding: 5px 10px; border-radius: 4px;'>📦 Shipped</span>";
                                } elseif ($status === 'cancelled') {
                                    echo "<span class='status' style='background: #ffe0e0; color: #d32f2f; padding: 5px 10px; border-radius: 4px;'>✗ Cancelled</span>";
                                } else {
                                    echo "<span class='status pending'>⏳ Pending</span>";
                                }
                                ?>
                            </td>
                            <td><a href="admin_orders.php?id=<?php echo $order_row['id']; ?>" class="action-link">View Details</a></td>
                        </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <tr><td colspan="8" style="text-align: center; padding: 20px;">No orders found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
       <br>
    <br>
    <br>
    <br>

    <?php include 'admin_footer.php'; ?>

    <script src="admin_dashboard.js"></script>
</body>

</html>
