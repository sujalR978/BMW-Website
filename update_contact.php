<?php
ob_start();
include "php/database.php";

session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

include 'second_hadder.php';

$user_id = $_SESSION['user_id'];
$error_msg = "";

// Check if contact ID is provided
if (!isset($_GET['id'])) {
    header('Location: Profile.php');
    exit();
}

$contact_id = intval($_GET['id']);

// Fetch the contact data
$fetch_query = "SELECT * FROM bmw_contacts WHERE id=? AND user_id=?";
$fetch_stmt = mysqli_prepare($cann, $fetch_query);
mysqli_stmt_bind_param($fetch_stmt, 'ii', $contact_id, $user_id);
mysqli_stmt_execute($fetch_stmt);
$fetch_data = mysqli_stmt_get_result($fetch_stmt);
$contact = mysqli_fetch_assoc($fetch_data);

if (!$contact) {
    $_SESSION['error_msg'] = "Contact not found or unauthorized access.";
    header('Location: Profile.php');
    exit();
}

if (isset($_POST['update'])) {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    $inquiry_type = htmlspecialchars(trim($_POST['inquiry-type']));
    
    if (empty($name) || empty($email) || empty($subject) || empty($message) || empty($inquiry_type)) {
        $error_msg = "All fields are required.";
    } else {
        
        $update_query = "UPDATE bmw_contacts 
        SET name=?, email=?, subject=?, message=?, inquiry_type=? 
        WHERE id=? AND user_id=?";
        
        $update_stmt = mysqli_prepare($cann, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'sssssii', $name, $email, $subject, $message, $inquiry_type, $contact_id, $user_id);
        
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['success_msg'] = "Contact updated successfully!";
            ob_end_clean();
            header("Location: Profile.php");
            exit();
        } else {
            $error_msg = "Error updating contact: " . mysqli_error($cann);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact Message</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <style>
        .update-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #0066cc, #00a8ff);
            color: white;
            border-radius: 8px;
        }
        
        .update-header h1 {
            margin: 0;
            font-size: 28px;
        }
        
        .update-header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="info-section">
            <h2>Contact Information</h2>
            <div class="info-item">
                <h3>Phone</h3>
                <p>+1 (555) 123-4567</p>
            </div>
            <div class="info-item">
                <h3>Email</h3>
                <p>inquiries@bmw.com</p>
            </div>
            <div class="info-item">
                <h3>Address</h3>
                <p>123 BMW Drive, Munich, Germany</p>
            </div>
        </div>
        <div class="inquiry-section">
            <div class="update-header">
                <h1>📝 Update Your Message</h1>
                <p>Modify your contact message below</p>
            </div>
            
            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger" style="color: #d32f2f; padding: 15px; margin-bottom: 20px; border: 1px solid #d32f2f; border-radius: 6px; background-color: #ffebee;">
                    ⚠️ <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form class="inquiry-form" id="contactForm" method="post">
                
                <div class="input-container">
                    <label>Name</label><br>
                    <input type="text" name="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
                    <div class="error-message"></div>
                </div>
                
                <div class="input-container">
                    <label>Email</label><br>
                    <input type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
                    <div class="error-message"></div>
                </div>
                
                <div class="input-container">
                    <label>Subject</label><br>
                    <input type="text" name="subject" placeholder="Subject of your message" value="<?php echo htmlspecialchars($contact['subject']); ?>" required>
                    <div class="error-message"></div>
                </div>

                <div class="input-container">
                    <label>Message</label><br>
                    <textarea name="message" placeholder="Your message here" required><?php echo htmlspecialchars($contact['message']); ?></textarea>
                    <div class="error-message"></div>
                </div>

                <div class="categories">
                    <span>Quick Inquiry Categories</span>
                    <div class="category-options">
                        <div class="category-item">
                            <input type="radio" id="sales" name="inquiry-type" value="Sales" <?php echo $contact['inquiry_type'] === 'Sales' ? 'checked' : ''; ?> required>
                            <label for="sales">Sales</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" id="service" name="inquiry-type" value="Service" <?php echo $contact['inquiry_type'] === 'Service' ? 'checked' : ''; ?> required>
                            <label for="service">Service</label>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" name="update" class="primary-btn" style="flex: 1;">✅ Update Message</button>
                    <a href="Profile.php" style="flex: 1; padding: 15px; text-align: center; background: #666; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#444';" onmouseout="this.style.background='#666';">↩️ Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    include 'Footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>

</html>
