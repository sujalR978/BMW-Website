<?php
include 'php/database.php';

if (isset($_GET['id'])) {
    $inquiry_id = intval($_GET['id']);
    
    $query = "SELECT * FROM bmw_inquiries WHERE id='$inquiry_id'";
    $result = mysqli_query($cann, $query);
    $inquiry = mysqli_fetch_assoc($result);
    
    if ($inquiry) {
        $subject_icons = [
            'sales' => '🛒',
            'service' => '🔧',
            'parts' => '⚙️',
            'general' => '📌'
        ];
        $icon = isset($subject_icons[$inquiry['subject']]) ? $subject_icons[$inquiry['subject']] : '📋';
        ?>
        
        <style>
            .inquiry-detail-header {
                background: linear-gradient(135deg, #0066cc 0%, #00a8ff 100%);
                color: white;
                padding: 25px;
                border-radius: 8px 8px 0 0;
                margin: -20px -20px 20px -20px;
            }
            
            .inquiry-detail-header h2 {
                margin: 0 0 10px 0;
                font-size: 26px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .inquiry-detail-header .status {
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
            
            .detail-card a:hover {
                text-decoration: underline;
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
            
            .image-section {
                margin-top: 25px;
                padding-top: 25px;
                border-top: 2px solid #e0e0e0;
            }
            
            .image-section h4 {
                color: #1a1a1a;
                font-size: 16px;
                margin-bottom: 15px;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .image-container {
                background: #f8f9fa;
                padding: 15px;
                border-radius: 8px;
                text-align: center;
            }
            
            .image-container img {
                max-width: 100%;
                max-height: 400px;
                border-radius: 6px;
                box-shadow: 0 4px 12px rgba(0,102,204,0.2);
            }
            
            .no-image {
                color: #999;
                padding: 20px;
                text-align: center;
                font-style: italic;
            }
            
            @media (max-width: 600px) {
                .detail-grid {
                    grid-template-columns: 1fr;
                }
                
                .inquiry-detail-header h2 {
                    font-size: 20px;
                }
            }
        </style>
        
        <div class="inquiry-detail-header">
            <h2><?php echo $icon; ?> <?php echo htmlspecialchars($inquiry['subject']); ?> Inquiry</h2>
            <span class="status">📋 ID: #<?php echo $inquiry['id']; ?></span>
        </div>
        
        <div class="detail-grid">
            <div class="detail-card">
                <label>👤 Customer Name</label>
                <p><?php echo htmlspecialchars($inquiry['name']); ?></p>
            </div>
            
            <div class="detail-card">
                <label>📧 Email Address</label>
                <p><a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>"><?php echo htmlspecialchars($inquiry['email']); ?></a></p>
            </div>
            
            <div class="detail-card">
                <label>📱 Phone Number</label>
                <p><a href="tel:<?php echo htmlspecialchars($inquiry['phone']); ?>"><?php echo htmlspecialchars($inquiry['phone']); ?></a></p>
            </div>
            
            <div class="detail-card">
                <label>🔖 Subject Type</label>
                <p>
                    <span style="display: inline-block; padding: 6px 12px; background: #e3f2fd; color: #0066cc; border-radius: 4px; font-weight: 600;">
                        <?php 
                        $subject_labels = ['sales' => 'Sales Inquiry', 'service' => 'Service Inquiry', 'parts' => 'Parts Inquiry', 'general' => 'General Inquiry'];
                        echo isset($subject_labels[$inquiry['subject']]) ? $subject_labels[$inquiry['subject']] : ucfirst($inquiry['subject']);
                        ?>
                    </span>
                </p>
            </div>
            
            <div class="detail-card">
                <label>👤 User ID</label>
                <p><?php echo $inquiry['user_id']; ?></p>
            </div>
            
            <div class="detail-card">
                <label>📅 Submitted</label>
                <p><?php echo isset($inquiry['created_at']) ? date('M d, Y - H:i', strtotime($inquiry['created_at'])) : 'N/A'; ?></p>
            </div>
        </div>
        
        <div class="message-section">
            <h4>💬 Customer Message</h4>
            <div class="message-content">
                <?php echo htmlspecialchars($inquiry['message']); ?>
            </div>
        </div>
        
        <?php if (!empty($inquiry['image']) && file_exists($inquiry['image'])): ?>
            <div class="image-section">
                <h4>🖼️ Attached Image</h4>
                <div class="image-container">
                    <img src="<?php echo htmlspecialchars($inquiry['image']); ?>" alt="Inquiry Image">
                    <p style="margin-top: 10px; color: #666; font-size: 13px;">
                        📁 <?php echo htmlspecialchars(basename($inquiry['image'])); ?>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <div class="image-section">
                <h4>🖼️ Attached Image</h4>
                <div class="no-image">
                    ❌ No image attached to this inquiry
                </div>
            </div>
        <?php endif; ?>
        
        <?php
    } else {
        echo "<div style='text-align: center; padding: 40px; color: #d32f2f;'><h3>⚠️ Inquiry Not Found</h3><p>The requested inquiry could not be found in the database.</p></div>";
    }
}
?>

