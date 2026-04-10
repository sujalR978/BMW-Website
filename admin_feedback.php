<?php
include 'php/database.php';
error_reporting(0);
session_start();

// Create feedback table if not exists
$create_table = "CREATE TABLE IF NOT EXISTS bmw_feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100),
    email VARCHAR(100),
    rating INT DEFAULT 5,
    feedback_type VARCHAR(50),
    message LONGTEXT,
    image_url VARCHAR(255),
    is_negative INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES register_page(id)
)";
mysqli_query($cann, $create_table);

// Fetch all feedback
$feedback_query = "SELECT * FROM bmw_feedback ORDER BY created_at DESC";
$feedback_result = mysqli_query($cann, $feedback_query);

if (!$feedback_result) {
    die("Error: " . mysqli_error($cann));
}

$all_feedback = mysqli_fetch_all($feedback_result, MYSQLI_ASSOC);
$total_feedback = count($all_feedback);

// Count statistics
$positive_feedback = 0;
$negative_feedback = 0;

foreach ($all_feedback as $fb) {
    if ($fb['is_negative'] == 1) {
        $negative_feedback++;
    } else {
        $positive_feedback++;
    }
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $feedback_id = intval($_GET['id']);
    
    $delete_query = "DELETE FROM bmw_feedback WHERE id='$feedback_id'";
    if (mysqli_query($cann, $delete_query)) {
        $_SESSION['success_msg'] = "Feedback deleted successfully!";
        header("Location: admin_feedback.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error deleting feedback!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management - Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            padding: 20px 0;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
        }

        .page-header h1 {
            font-size: 2rem;
            margin: 0;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-left: 4px solid #667eea;
        }

        .stat-card.positive {
            border-left-color: #28a745;
        }

        .stat-card.negative {
            border-left-color: #dc3545;
        }

        .stat-card h3 {
            color: #667eea;
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card.positive h3 {
            color: #28a745;
        }

        .stat-card.negative h3 {
            color: #dc3545;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .filter-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 15px;
            border: 2px solid #ecf0f1;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: #667eea;
            background: #f0f3ff;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .feedback-list {
            display: grid;
            gap: 20px;
        }

        .feedback-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 5px solid #667eea;
        }

        .feedback-card.negative {
            border-left-color: #dc3545;
            background: #fff5f5;
        }

        .feedback-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .feedback-author {
            flex: 1;
        }

        .feedback-author h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 3px;
        }

        .feedback-author p {
            color: #666;
            font-size: 0.85rem;
        }

        .feedback-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 8px;
        }

        .badge-service {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-product {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .badge-experience {
            background: #fff3e0;
            color: #f57c00;
        }

        .badge-suggestion {
            background: #e8f5e9;
            color: #388e3c;
        }

        .feedback-rating {
            font-size: 1.2rem;
            color: #ffc107;
            margin: 8px 0;
        }

        .feedback-message {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            line-height: 1.6;
            color: #333;
        }

        .feedback-image {
            max-height: 250px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .feedback-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #999;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ecf0f1;
        }

        .feedback-actions {
            display: flex;
            gap: 10px;
        }

        .btn-delete {
            padding: 8px 12px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
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

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
            }

            .feedback-header {
                flex-direction: column;
            }

            .feedback-badge {
                display: block;
                margin: 8px 0;
            }

            .stats-summary {
                grid-template-columns: 1fr 1fr;
            }

            .feedback-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .feedback-actions {
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <div>
                <h1>📋 Feedback Management</h1>
                <p style="margin: 10px 0 0 0; opacity: 0.9;">Manage and monitor user feedback</p>
            </div>
        </div>

        <?php
        if (isset($_SESSION['success_msg'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success_msg'] . "</div>";
            unset($_SESSION['success_msg']);
        }
        if (isset($_SESSION['error_msg'])) {
            echo "<div class='alert alert-error'>" . $_SESSION['error_msg'] . "</div>";
            unset($_SESSION['error_msg']);
        }
        ?>

        <!-- Statistics -->
        <div class="stats-summary">
            <div class="stat-card">
                <h3>Total Feedback</h3>
                <div class="stat-number"><?php echo $total_feedback; ?></div>
            </div>
            <div class="stat-card positive">
                <h3>Positive Feedback</h3>
                <div class="stat-number"><?php echo $positive_feedback; ?></div>
            </div>
            <div class="stat-card negative">
                <h3>Negative Feedback</h3>
                <div class="stat-number"><?php echo $negative_feedback; ?></div>
            </div>
        </div>

        <!-- Feedback List -->
        <div class="feedback-list">
            <?php
            if (count($all_feedback) > 0) {
                foreach ($all_feedback as $feedback) {
                    $rating_stars = str_repeat('⭐', $feedback['rating']);
                    $badge_class = 'badge-' . strtolower(str_replace(' ', '', $feedback['feedback_type']));
                    $card_class = $feedback['is_negative'] == 1 ? 'negative' : '';
                    
                    echo "
                    <div class='feedback-card {$card_class}'>
                        <div class='feedback-header'>
                            <div class='feedback-author'>
                                <h3>{$feedback['name']}</h3>
                                <p>{$feedback['email']}</p>
                            </div>
                            <div style='display: flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end;'>
                                <span class='feedback-badge {$badge_class}'>{$feedback['feedback_type']}</span>
                                " . ($feedback['is_negative'] == 1 ? "<span class='feedback-badge' style='background: #ffe0e0; color: #d32f2f;'>⚠️ NEGATIVE</span>" : "<span class='feedback-badge' style='background: #e0f0e0; color: #388e3c;'>✓ POSITIVE</span>") . "
                            </div>
                        </div>
                        <div class='feedback-rating'>{$rating_stars} ({$feedback['rating']}/5)</div>
                        <div class='feedback-message'>" . htmlspecialchars($feedback['message']) . "</div>
                        " . (!empty($feedback['image_url']) ? "<img src='uploads/feedback/{$feedback['image_url']}' alt='Feedback Image' class='feedback-image'>" : "") . "
                        <div class='feedback-meta'>
                            <span>📅 " . date('F j, Y - g:i A', strtotime($feedback['created_at'])) . "</span>
                            <div class='feedback-actions'>
                                <a href='admin_feedback.php?action=delete&id={$feedback['id']}' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this feedback?');\">🗑️ Delete</a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "
                <div class='empty-state'>
                    <h3>No Feedback Yet</h3>
                    <p>There is no user feedback to display.</p>
                </div>
                ";
            }
            ?>
        </div>
    </div>

    <?php include 'admin_footer.php'; ?>
</body>
</html>
