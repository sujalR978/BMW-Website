<?php

include 'php/database.php';

// Get the test drive ID from URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($cann, $_GET['id']) : null;

if (!$id) {
    echo "Invalid test drive ID";
    exit;
}

// Fetch test drive details
$query = "SELECT * FROM test_drive WHERE id = '$id'";
$result = mysqli_query($cann, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Test drive not found";
    exit;
}

// Handle update
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = mysqli_real_escape_string($cann, $_POST['status']);
    $notes = mysqli_real_escape_string($cann, $_POST['notes']);
    
    $updateQuery = "UPDATE test_drive SET booking_status = '$status', note = '$notes' WHERE id = '$id'";
    
    if (mysqli_query($cann, $updateQuery)) {
        $message = '<div class="alert alert-success">Test drive updated successfully!</div>';
        // Refresh the data
        $result = mysqli_query($cann, $query);
        $row = mysqli_fetch_assoc($result);
    } else {
        $message = '<div class="alert alert-danger">Error updating test drive: ' . mysqli_error($cann) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Drive Details</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .details-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .details-section {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #333;
            width: 30%;
        }
        .detail-value {
            color: #666;
            width: 70%;
        }
        .form-section {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .back-btn {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .page-title {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <a href="admin_test_Drive.php" class="back-btn">← Back to Bookings</a>
        
        <h1 class="page-title">Test Drive Booking Details</h1>
        
        <?php echo $message; ?>
        
        <div class="details-section">
            <h2>Booking Information</h2>
            <div class="detail-row">
                <span class="detail-label">Booking ID:</span>
                <span class="detail-value"><?php echo $row['id']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">First Name:</span>
                <span class="detail-value"><?php echo $row['first_name']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Last Name:</span>
                <span class="detail-value"><?php echo $row['last_name']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value"><?php echo $row['email']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Phone:</span>
                <span class="detail-value"><?php echo $row['phone']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Car Model:</span>
                <span class="detail-value"><?php echo $row['model']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Preferred Date:</span>
                <span class="detail-value"><?php echo $row['preferred_date']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Preferred Time:</span>
                <span class="detail-value"><?php echo $row['preferred_time']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Location:</span>
                <span class="detail-value"><?php echo $row['location']; ?></span>
            </div>
             <div class="detail-row">
                <span class="detail-label">notes</span>
                <span class="detail-value"><?php echo $row['note']; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Current Status:</span>
                <span class="detail-value">
                    <?php 
                    $status = isset($row['booking_status']) ? $row['booking_status'] : 'Pending';
                    $status = isset($row['booking_status']) ? $row['booking_status'] : 'approved';
                    $status = isset($row['booking_status']) ? $row['booking_status'] : 'rejected';
                    echo ucfirst($status); 
                    ?>
                </span>
            </div>
        </div>

        <div class="form-section">
            <h2>Update Booking</h2>
            <form method="POST" action="">
                <div style="margin-bottom: 15px;">
                    <label for="status" style="display: block; margin-bottom: 5px; font-weight: bold;">Status:</label>
                    <select name="status" id="status" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="pending" <?php echo (isset($row['booking_status']) && $row['booking_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?php echo (isset($row['booking_status']) && $row['booking_status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                        <option value="rejected" <?php echo (isset($row['booking_status']) && $row['booking_status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="notes" style="display: block; margin-bottom: 5px; font-weight: bold;">Notes:</label>
                    <textarea name="notes" id="notes" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"><?php echo isset($row['notes']) ? $row['notes'] : ''; ?></textarea>
                </div>

                <button type="submit" onclick="window.location.href='admin_test_drive.php'" class="submit-btn">Update Booking</button>
            </form>
        </div>
    </div>

    <?php include 'admin_footer.php'; ?>
</body>
</html>
