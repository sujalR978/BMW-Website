<?php
include 'php/database.php';

if (isset($_GET['id'])) {
    $contact_id = intval($_GET['id']);
    
    $query = "SELECT * FROM bmw_contacts WHERE id='$contact_id'";
    $result = mysqli_query($cann, $query);
    $contact = mysqli_fetch_assoc($result);
    
    if ($contact) {
        $type_icons = ['Sales' => '🛒', 'Service' => '🔧'];
        $icon = isset($type_icons[$contact['inquiry_type']]) ? $type_icons[$contact['inquiry_type']] : '📧';
        ?>
        
        <style>
            .contact-detail-header {
                background: linear-gradient(135deg, #0066cc 0%, #00a8ff 100%);
                color: white;
                padding: 25px;
                border-radius: 8px 8px 0 0;
                margin: -30px -30px 20px -30px;
            }
            
            .contact-detail-header h2 {
                margin: 0 0 10px 0;
                font-size: 26px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .contact-detail-header .status {
                display: inline-block;
                background: rgba(255,255,255,0.3);
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 13px;
                margin-top: 10px;
                font-weight: 600;
            }
            
            .detail-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 25px;
            }
            
            .detail-card {
                background: #f8f9fa;
                padding: 18px;
                border-radius: 8px;
                border-left: 4px solid #0066cc;
            }
            
            .detail-card label {
                display: block;
                font-weight: 700;
                color: #0066cc;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 8px;
            }
            
            .detail-card p {
                margin: 0;
                color: #333;
                font-size: 15px;
                line-height: 1.6;
            }
            
            .detail-card a {
                color: #0066cc;
                text-decoration: none;
                font-weight: 600;
            }
            
            .message-section {
                margin-bottom: 25px;
            }
            
            .message-section h4 {
                color: #1a1a1a;
                font-size: 16px;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .message-content {
                background: #fff;
                border: 2px solid #e0e0e0;
                padding: 20px;
                border-radius: 8px;
                line-height: 1.8;
                color: #333;
                white-space: pre-wrap;
                word-wrap: break-word;
            }
        </style>
        
        <div class="contact-detail-header">
            <h2><?php echo $icon; ?> <?php echo htmlspecialchars($contact['subject']); ?></h2>
            <span class="status">📧 ID: #<?php echo $contact['id']; ?></span>
        </div>
        
        <div class="detail-grid">
            <div class="detail-card">
                <label>👤 Customer Name</label>
                <p><?php echo htmlspecialchars($contact['name']); ?></p>
            </div>
            
            <div class="detail-card">
                <label>📧 Email Address</label>
                <p><a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>"><?php echo htmlspecialchars($contact['email']); ?></a></p>
            </div>
            
            <div class="detail-card">
                <label>📋 Subject</label>
                <p><?php echo htmlspecialchars($contact['subject']); ?></p>
            </div>
            
            <div class="detail-card">
                <label>🏷️ Contact Type</label>
                <p>
                    <span style="display: inline-block; padding: 6px 12px; background: #e3f2fd; color: #0066cc; border-radius: 4px; font-weight: 600;">
                        <?php echo htmlspecialchars($contact['inquiry_type']); ?>
                    </span>
                </p>
            </div>
            
            <div class="detail-card">
                <label>👤 User ID</label>
                <p><?php echo $contact['user_id']; ?></p>
            </div>
            
            <div class="detail-card">
                <label>📅 Submitted</label>
                <p><?php echo isset($contact['created_at']) ? date('M d, Y - H:i', strtotime($contact['created_at'])) : 'N/A'; ?></p>
            </div>
        </div>
        
        <div class="message-section">
            <h4>💬 Customer Message</h4>
            <div class="message-content">
                <?php echo htmlspecialchars($contact['message']); ?>
            </div>
        </div>
        
        <?php
    } else {
        echo "<div style='text-align: center; padding: 40px; color: #d32f2f;'><h3>⚠️ Contact Not Found</h3><p>The requested contact could not be found in the database.</p></div>";
    }
}
?>
