<?php
include 'php/database.php';
error_reporting(0);
session_start();

// Check if user is admin (you can add this check based on your auth system)
// For now, we'll assume only admins can access this page

// Fetch all inquiries from database
$inquiries_query = "SELECT * FROM bmw_inquiries ORDER BY id DESC";
$inquiries_result = mysqli_query($cann, $inquiries_query);
$inquiries = mysqli_fetch_all($inquiries_result, MYSQLI_ASSOC);
$total_inquiries = count($inquiries);

// Count pending inquiries (you can add a status column to track this)
$pending_count = 0;
$replied_count = 0;

// For now, we'll use a simple logic - you can add a 'status' column to the database
// Let's assume if there's no reply_sent field, it's pending
foreach ($inquiries as $inquiry) {
    if (!isset($inquiry['reply_sent']) || $inquiry['reply_sent'] == 0) {
        $pending_count++;
    } else {
        $replied_count++;
    }
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $inquiry_id = intval($_GET['id']);
    
    // Fetch the inquiry to get image path
    $fetch_query = "SELECT image FROM bmw_inquiries WHERE id='$inquiry_id'";
    $fetch_result = mysqli_query($cann, $fetch_query);
    $inquiry_data = mysqli_fetch_assoc($fetch_result);
    
    // Delete image file if it exists
    if (!empty($inquiry_data['image']) && file_exists($inquiry_data['image'])) {
        unlink($inquiry_data['image']);
    }
    
    // Delete from database
    $delete_query = "DELETE FROM bmw_inquiries WHERE id='$inquiry_id'";
    if (mysqli_query($cann, $delete_query)) {
        $_SESSION['success_msg'] = "Inquiry deleted successfully!";
        header("Location: admin_inquire.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error deleting inquiry!";
    }
}

include 'admin_hader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Inquiries</title>
    <link rel="stylesheet" href="admin_inquire.css">
    <link rel="stylesheet" href="header-footer.css">
</head>
<body>

    <div class="admin-container">
        <h1 class="admin-title">Admin Panel - Customer Inquiries</h1>
        <p class="admin-subtitle">Manage and view all customer inquiries here.</p>

        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="success-alert" style="background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 6px;">
                ✅ <?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="error-alert" style="background-color: #f44336; color: white; padding: 15px; margin-bottom: 20px; border-radius: 6px;">
                ⚠️ <?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?>
            </div>
        <?php endif; ?>

        <div class="inquiry-table-container">
            <?php if ($total_inquiries > 0): ?>
            <table class="inquiry-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>User ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td><?php echo $inquiry['id']; ?></td>
                        <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['phone']); ?></td>
                        <td>
                            <span style="display: inline-block; padding: 5px 10px; background: #e3f2fd; color: #0066cc; border-radius: 4px; font-weight: 600;">
                                <?php 
                                $subject = $inquiry['subject'];
                                $subject_labels = [
                                    'sales' => '🏪 Sales',
                                    'service' => '🔧 Service',
                                    'parts' => '⚙️ Parts',
                                    'general' => '📌 General'
                                ];
                                echo isset($subject_labels[$subject]) ? $subject_labels[$subject] : ucfirst($subject);
                                ?>
                            </span>
                        </td>
                        <td style="max-width: 300px; word-wrap: break-word;"><?php echo htmlspecialchars(substr($inquiry['message'], 0, 50)); ?>...</td>
                        <td>
                            <?php if (!empty($inquiry['image']) && file_exists($inquiry['image'])): ?>
                                <img src="<?php echo htmlspecialchars($inquiry['image']); ?>" alt="Image" class="table-image" style="max-width: 50px; height: 50px; border-radius: 4px; cursor: pointer;" onclick="openImageModal('<?php echo htmlspecialchars($inquiry['image']); ?>')">
                            <?php else: ?>
                                <span style="color: #999;">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $inquiry['user_id']; ?></td>
                        <td>
                            <button class="action-btn view-btn" onclick="viewInquiry(<?php echo $inquiry['id']; ?>)">👁️ View</button>
                            <button class="action-btn reply-btn" onclick="replyInquiry(<?php echo $inquiry['id']; ?>, '<?php echo htmlspecialchars($inquiry['email']); ?>')">✉️ Reply</button>
                            <button class="action-btn delete-btn" onclick="deleteInquiry(<?php echo $inquiry['id']; ?>)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div style="text-align: center; padding: 40px; background: #f5f5f5; border-radius: 8px;">
                <h3 style="color: #999;">No inquiries found</h3>
                <p style="color: #999;">There are no inquiries to display at this time.</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Inquiries</h3>
                <p style="font-size: 32px; color: #0066cc; font-weight: bold;"><?php echo $total_inquiries; ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending</h3>
                <p style="font-size: 32px; color: #ff9800; font-weight: bold;"><?php echo $pending_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>Replied</h3>
                <p style="font-size: 32px; color: #4CAF50; font-weight: bold;"><?php echo $replied_count; ?></p>
            </div>
        </div>
    </div>

    <!-- Modal for viewing full inquiry -->
    <div id="inquiryModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-content" style="background-color: #fefefe; margin: 30px auto; padding: 0; border: none; width: 90%; max-width: 800px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background: linear-gradient(135deg, #0066cc, #00a8ff); border-radius: 12px 12px 0 0;">
                <h3 style="margin: 0; color: white; font-size: 22px;">📋 Inquiry Details</h3>
                <span class="close" onclick="closeModal()" style="color: white; font-size: 32px; font-weight: bold; cursor: pointer; line-height: 20px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</span>
            </div>
            <div id="modalContent" style="padding: 30px;"></div>
            <div style="padding: 20px 30px; background: #f8f9fa; border-top: 1px solid #e0e0e0; border-radius: 0 0 12px 12px; text-align: right;">
                <button onclick="closeModal()" style="padding: 10px 25px; background: #666; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#444'" onmouseout="this.style.background='#666'">Close</button>
            </div>
        </div>
    </div>

    <!-- Modal for image viewing -->
    <div id="imageModal" class="modal" style="display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); text-align: center;">
        <img id="modalImage" style="max-width: 90%; max-height: 90%; margin-top: 5%; border-radius: 8px;" src="">
        <span class="close" onclick="closeImageModal()" style="color: #aaa; position: absolute; top: 20px; right: 30px; font-size: 32px; font-weight: bold; cursor: pointer;">&times;</span>
    </div>

    <!-- Modal for replying to inquiry -->
    <div id="replyModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-content" style="background-color: #fefefe; margin: 30px auto; padding: 0; border: none; width: 90%; max-width: 700px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background: linear-gradient(135deg, #4CAF50, #45a049); border-radius: 12px 12px 0 0;">
                <h3 style="margin: 0; color: white; font-size: 22px;">✉️ Reply to Inquiry</h3>
                <span class="close" onclick="closeReplyModal()" style="color: white; font-size: 32px; font-weight: bold; cursor: pointer; line-height: 20px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</span>
            </div>
            <form id="replyForm" method="POST" action="reply_inquiry.php">
                <div style="padding: 30px;">
                    <input type="hidden" id="replyInquiryId" name="inquiry_id">
                    
                    <div style="margin-bottom: 20px;">
                        <label for="replyMessage" style="display: block; font-weight: 700; color: #333; margin-bottom: 10px; font-size: 14px;">📝 Your Reply Message</label>
                        <textarea id="replyMessage" name="reply_message" placeholder="Enter your reply here..." rows="8" style="width: 100%; padding: 15px; border: 2px solid #ddd; border-radius: 6px; font-family: Arial, sans-serif; font-size: 14px; resize: vertical; transition: border-color 0.3s ease;" onmouseover="this.style.borderColor='#4CAF50'" onmouseout="this.style.borderColor='#ddd'" required></textarea>
                        <small style="display: block; margin-top: 8px; color: #666;">This reply will be stored in the database and displayed to the customer in their profile.</small>
                    </div>

                    <div style="background: #f0f7f0; border-left: 4px solid #4CAF50; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        <p style="margin: 0; color: #333; font-size: 13px;">
                            <strong>ℹ️ Note:</strong> The reply will be saved to the database and the customer will see it in their "View Inquiries" section on their profile page.
                        </p>
                    </div>
                </div>
                <div style="padding: 20px 30px; background: #f8f9fa; border-top: 1px solid #e0e0e0; border-radius: 0 0 12px 12px; display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeReplyModal()" style="padding: 12px 25px; background: #999; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#777'" onmouseout="this.style.background='#999'">❌ Cancel</button>
                    <button type="submit" style="padding: 12px 25px; background: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#45a049'" onmouseout="this.style.background='#4CAF50'">✅ Save Reply</button>
                </div>
            </form>
        </div>
    </div>

   <?php
    include 'admin_footer.php';
    ?>

    <script>
        function viewInquiry(id) {
            // Fetch inquiry details via AJAX
            fetch('get_inquiry_details.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalContent').innerHTML = data;
                    document.getElementById('inquiryModal').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        }

        function closeModal() {
            document.getElementById('inquiryModal').style.display = 'none';
        }

        function openImageModal(imagePath) {
            document.getElementById('modalImage').src = imagePath;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        function replyInquiry(id, email) {
            document.getElementById('replyInquiryId').value = id;
            document.getElementById('replyMessage').value = '';
            document.getElementById('replyModal').style.display = 'block';
        }

        function closeReplyModal() {
            document.getElementById('replyModal').style.display = 'none';
        }

        function deleteInquiry(id) {
            if (confirm('Are you sure you want to delete this inquiry? This action cannot be undone.')) {
                window.location.href = 'admin_inquire.php?action=delete&id=' + id;
            }
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('inquiryModal');
            const imageModal = document.getElementById('imageModal');
            const replyModal = document.getElementById('replyModal');
            
            if (event.target == modal) {
                modal.style.display = 'none';
            }
            if (event.target == imageModal) {
                imageModal.style.display = 'none';
            }
            if (event.target == replyModal) {
                replyModal.style.display = 'none';
            }
        }
    </script>

</body>
</html>