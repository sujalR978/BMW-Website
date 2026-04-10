<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Process logout
if (isset($_POST['confirm_logout'])) {
    // Destroy session
    session_destroy();
    
    // Redirect to admin login
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout - BMW Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
 

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ==================== Logout Container ==================== */
        .logout-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 60px 40px;
            max-width: 500px;
            width: 100%;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ==================== Header Section ==================== */
        .logout-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logout-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: fadeIn 0.6s ease;
        }

        .logout-icon i {
            font-size: 45px;
            color: white;
        }

        .logout-header h1 {
            font-size: 28px;
            color: #1a1a1a;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .logout-header p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        /* ==================== Admin Info ==================== */
        .admin-info {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .admin-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .admin-info-item:last-child {
            margin-bottom: 0;
        }

        .admin-info-item i {
            color: #667eea;
            width: 20px;
            text-align: center;
        }

        .admin-info-label {
            color: #888;
            font-weight: 500;
        }

        .admin-info-value {
            color: #1a1a1a;
            font-weight: 600;
        }

        /* ==================== Warning Message ==================== */
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .warning-box i {
            color: #ff9800;
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .warning-box p {
            color: #856404;
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ==================== Buttons ==================== */
        .logout-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-logout {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout-confirm {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-logout-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-logout-cancel {
            background: #e8e8e8;
            color: #1a1a1a;
        }

        .btn-logout-cancel:hover {
            background: #d0d0d0;
            color: #1a1a1a;
            text-decoration: none;
        }

        /* ==================== Footer ==================== */
        .logout-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .logout-footer p {
            font-size: 13px;
            color: #999;
            margin: 0;
        }

        .logout-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .logout-footer a:hover {
            color: #764ba2;
        }

        /* ==================== Responsive ==================== */
        @media (max-width: 576px) {
            .logout-container {
                padding: 40px 25px;
                border-radius: 15px;
            }

            .logout-header h1 {
                font-size: 24px;
            }

            .logout-header p {
                font-size: 14px;
            }

            .logout-buttons {
                flex-direction: column;
            }

            .btn-logout {
                width: 100%;
            }

            .logout-icon {
                width: 80px;
                height: 80px;
            }

            .logout-icon i {
                font-size: 35px;
            }

            .admin-info {
                padding: 15px;
            }

            .admin-info-item {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .logout-container {
                padding: 30px 20px;
            }

            .logout-header h1 {
                font-size: 22px;
            }

            .logout-header {
                margin-bottom: 30px;
            }

            .logout-icon {
                width: 70px;
                height: 70px;
                margin-bottom: 15px;
            }

            .logout-icon i {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>

    <!-- Logout Container -->
    <div class="logout-container">
        <!-- Header Section -->
        <div class="logout-header">
            <div class="logout-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h1>Confirm Logout</h1>
            <p>You are about to end your admin session. Are you sure you want to continue?</p>
        </div>

        <!-- Admin Info -->
        <div class="admin-info">
            <div class="admin-info-item">
                <i class="fas fa-user-shield"></i>
                <span><span class="admin-info-label">Role:</span> <span class="admin-info-value">Administrator</span></span>
            </div>
            <div class="admin-info-item">
                <i class="fas fa-clock"></i>
                <span><span class="admin-info-label">Session Active:</span> <span class="admin-info-value">Yes</span></span>
            </div>
            <div class="admin-info-item">
                <i class="fas fa-shield-alt"></i>
                <span><span class="admin-info-label">Security:</span> <span class="admin-info-value">Secure Connection</span></span>
            </div>
        </div>

        <!-- Warning Message -->
        <div class="warning-box">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Once you logout, you'll need to log in again to access the admin panel. Make sure you've saved any important work.</p>
        </div>

        <!-- Action Buttons -->
        <div class="logout-buttons">
            <a href="admin_dashboard.php" class="btn-logout btn-logout-cancel">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <form action="admin_logout.php" method="POST" style="flex: 1;">
                <button type="submit" name="confirm_logout" class="btn-logout btn-logout-confirm w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="logout-footer">
            <p>Need help? <a href="#"><i class="fas fa-question-circle"></i> Contact Support</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
