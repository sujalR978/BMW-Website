<?php
include 'php/database.php';
error_reporting(0);
session_start();

// Fetch all contacts from database
$contacts_query = "SELECT * FROM bmw_contacts ORDER BY id DESC";
$contacts_result = mysqli_query($cann, $contacts_query);

if (!$contacts_result) {
    die("Error: " . mysqli_error($cann));
}

$contacts = mysqli_fetch_all($contacts_result, MYSQLI_ASSOC);
$total_contacts = count($contacts);

// Count pending contacts
$pending_count = 0;
$replied_count = 0;

foreach ($contacts as $contact) {
    if (!isset($contact['reply_sent']) || $contact['reply_sent'] == 0) {
        $pending_count++;
        $replied_count++;
    } else {
        $replied_count++;
    }
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $contact_id = intval($_GET['id']);
    
    $delete_query = "DELETE FROM bmw_contacts WHERE id='$contact_id'";
    if (mysqli_query($cann, $delete_query)) {
        $_SESSION['success_msg'] = "Contact deleted successfully!";
        header("Location: admin_contact.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error deleting contact!";
    }
}

include 'admin_hader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Contacts</title>
    <link rel="stylesheet" href="admin_inquire.css">
    <link rel="stylesheet" href="header-footer.css">
</head>
<body>

    <div class="admin-container">
        <h1 class="admin-title">Admin Panel - Customer Contacts</h1>
        <p class="admin-subtitle">Manage and view all customer contact messages here.</p>

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
            <?php if ($total_contacts > 0): ?>
            <table class="inquiry-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Message</th>
                        <th>User ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo $contact['id']; ?></td>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                        <td>
                            <span style="display: inline-block; padding: 5px 10px; background: #e3f2fd; color: #0066cc; border-radius: 4px; font-weight: 600;">
                                <?php 
                                $type_icons = ['Sales' => '🛒', 'Service' => '🔧'];
                                echo (isset($type_icons[$contact['inquiry_type']]) ? $type_icons[$contact['inquiry_type']] . ' ' : '') . htmlspecialchars($contact['inquiry_type']);
                                ?>
                            </span>
                        </td>
                        <td style="max-width: 300px; word-wrap: break-word;"><?php echo htmlspecialchars(substr($contact['message'], 0, 50)); ?>...</td>
                        <td><?php echo $contact['user_id']; ?></td>
                        <td>
                            <button class="action-btn view-btn" onclick="viewContact(<?php echo $contact['id']; ?>)">👁️ View</button>
                            <button class="action-btn reply-btn" onclick="replyContact(<?php echo $contact['id']; ?>)">✉️ Reply</button>
                            <button class="action-btn delete-btn" onclick="deleteContact(<?php echo $contact['id']; ?>)">🗑️ Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div style="text-align: center; padding: 40px; background: #f5f5f5; border-radius: 8px;">
                <h3 style="color: #999;">No contacts found</h3>
                <p style="color: #999;">There are no contacts to display at this time.</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Contacts</h3>
                <p style="font-size: 32px; color: #0066cc; font-weight: bold;"><?php echo $total_contacts; ?></p>
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

    <!-- Modal for viewing full contact -->
    <div id="contactModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-content" style="background-color: #fefefe; margin: 30px auto; padding: 0; border: none; width: 90%; max-width: 800px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background: linear-gradient(135deg, #0066cc, #00a8ff); border-radius: 12px 12px 0 0;">
                <h3 style="margin: 0; color: white; font-size: 22px;">📧 Contact Details</h3>
                <span class="close" onclick="closeContactModal()" style="color: white; font-size: 32px; font-weight: bold; cursor: pointer; line-height: 20px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</span>
            </div>
            <div id="modalContent" style="padding: 30px;"></div>
            <div style="padding: 20px 30px; background: #f8f9fa; border-top: 1px solid #e0e0e0; border-radius: 0 0 12px 12px; text-align: right;">
                <button onclick="closeContactModal()" style="padding: 10px 25px; background: #666; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#444'" onmouseout="this.style.background='#666'">Close</button>
            </div>
        </div>
    </div>

    <!-- Modal for replying to contact -->
    <div id="replyModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-content" style="background-color: #fefefe; margin: 30px auto; padding: 0; border: none; width: 90%; max-width: 700px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background: linear-gradient(135deg, #4CAF50, #45a049); border-radius: 12px 12px 0 0;">
                <h3 style="margin: 0; color: white; font-size: 22px;">✉️ Reply to Contact</h3>
                <span class="close" onclick="closeReplyContactModal()" style="color: white; font-size: 32px; font-weight: bold; cursor: pointer; line-height: 20px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</span>
            </div>
            <form id="replyContactForm" method="POST" action="reply_contact.php">
                <div style="padding: 30px;">
                    <input type="hidden" id="replyContactId" name="contact_id">
                    
                    <div style="margin-bottom: 20px;">
                        <label for="replyContactMessage" style="display: block; font-weight: 700; color: #333; margin-bottom: 10px; font-size: 14px;">📝 Your Reply Message</label>
                        <textarea id="replyContactMessage" name="reply_message" placeholder="Enter your reply here..." rows="8" style="width: 100%; padding: 15px; border: 2px solid #ddd; border-radius: 6px; font-family: Arial, sans-serif; font-size: 14px; resize: vertical; transition: border-color 0.3s ease;" onmouseover="this.style.borderColor='#4CAF50'" onmouseout="this.style.borderColor='#ddd'" required></textarea>
                        <small style="display: block; margin-top: 8px; color: #666;">This reply will be stored in the database and displayed to the customer in their profile.</small>
                    </div>

                    <div style="background: #f0f7f0; border-left: 4px solid #4CAF50; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        <p style="margin: 0; color: #333; font-size: 13px;">
                            <strong>ℹ️ Note:</strong> The reply will be saved to the database and the customer will see it in their "Contact Messages" section on their profile page.
                        </p>
                    </div>
                </div>
                <div style="padding: 20px 30px; background: #f8f9fa; border-top: 1px solid #e0e0e0; border-radius: 0 0 12px 12px; display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeReplyContactModal()" style="padding: 12px 25px; background: #999; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#777'" onmouseout="this.style.background='#999'">❌ Cancel</button>
                    <button type="submit" style="padding: 12px 25px; background: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#45a049'" onmouseout="this.style.background='#4CAF50'">✅ Save Reply</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include 'admin_footer.php';
    ?>

    <script>
        function viewContact(id) {
            fetch('get_contact_details.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalContent').innerHTML = data;
                    document.getElementById('contactModal').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        }

        function closeContactModal() {
            document.getElementById('contactModal').style.display = 'none';
        }

        function replyContact(id) {
            document.getElementById('replyContactId').value = id;
            document.getElementById('replyContactMessage').value = '';
            document.getElementById('replyModal').style.display = 'block';
        }

        function closeReplyContactModal() {
            document.getElementById('replyModal').style.display = 'none';
        }

        function deleteContact(id) {
            if (confirm('Are you sure you want to delete this contact? This action cannot be undone.')) {
                window.location.href = 'admin_contact.php?action=delete&id=' + id;
            }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('contactModal');
            const replyModal = document.getElementById('replyModal');
            
            if (event.target == modal) {
                modal.style.display = 'none';
            }
            if (event.target == replyModal) {
                replyModal.style.display = 'none';
            }
        }
    </script>

</body>
</html>
