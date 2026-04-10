<?php
ob_start();
include "php/database.php";

session_start();





$user_id = $_SESSION['user_id'];
$error_msg = "";
$success_msg = "";

// Check if inquiry ID is provided
if (!isset($_GET['id'])) {
    header('Location: Profile.php');
    exit();
}

$inquiry_id = intval($_GET['id']);

// Fetch the inquiry data
$fetch_query = "SELECT * FROM bmw_inquiries WHERE id=? AND user_id=?";
$fetch_stmt = mysqli_prepare($cann, $fetch_query);
mysqli_stmt_bind_param($fetch_stmt, 'ii', $inquiry_id, $user_id);
mysqli_stmt_execute($fetch_stmt);
$fetch_data = mysqli_stmt_get_result($fetch_stmt);
$inquiry = mysqli_fetch_assoc($fetch_data);

if (!$inquiry) {
    $_SESSION['error_msg'] = "Inquiry not found or unauthorized access.";
    header('Location: Profile.php');
    exit();
}

// Fetch user data for prefilling
$user_query = "SELECT * FROM register_page WHERE id=?";
$user_stmt = mysqli_prepare($cann, $user_query);
mysqli_stmt_bind_param($user_stmt, 'i', $user_id);
mysqli_stmt_execute($user_stmt);
$user_data = mysqli_stmt_get_result($user_stmt);
$user_result = mysqli_fetch_assoc($user_data);

if (!$user_result) {
    $user_result = array('name' => '', 'email' => '', 'phone' => '');
}

if (isset($_POST['update'])) {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        $error_msg = "All fields are required.";
    } else {
        
        $dest_path = $inquiry['image']; // Keep existing image if not updated
        
        // Handle new image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
            
            if (in_array($fileExtension, $allowedfileExtensions)) {
                
                $uploadFileDir = 'uploads/';
                $new_dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $new_dest_path)) {
                    // Delete old image if it exists
                    if (!empty($inquiry['image']) && file_exists($inquiry['image'])) {
                        unlink($inquiry['image']);
                    }
                    $dest_path = $new_dest_path;
                } else {
                    $error_msg = "Error uploading new image.";
                }
            } else {
                $error_msg = "Invalid file type. Allowed formats: JPG, JPEG, PNG, GIF";
            }
        }
        
        // Update the inquiry if no errors
        if (empty($error_msg)) {
            
            $update_query = "UPDATE bmw_inquiries 
            SET name=?, email=?, phone=?, subject=?, message=?, image=? 
            WHERE id=? AND user_id=?";
            
            $update_stmt = mysqli_prepare($cann, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'ssssssii', $name, $email, $phone, $subject, $message, $dest_path, $inquiry_id, $user_id);
            
            if (mysqli_stmt_execute($update_stmt)) {
                $_SESSION['success_msg'] = "Inquiry updated successfully!";
                ob_end_clean();
                header("Location: Profile.php");
                exit();
            } else {
                $error_msg = "Error updating inquiry: " . mysqli_error($cann);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update BMW Inquiry</title>
    <link rel="stylesheet" href="view_inquire.css">
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
                <h1>📝 Update Your Inquiry</h1>
                <p>Modify your BMW inquiry details below</p>
            </div>
            
            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger" style="color: #d32f2f; padding: 15px; margin-bottom: 20px; border: 1px solid #d32f2f; border-radius: 6px; background-color: #ffebee;">
                    ⚠️ <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form class="inquiry-form" id="inquiryForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($inquiry['name']); ?>" required>
                    <div class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($inquiry['email']); ?>" required>
                    <div class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($inquiry['phone']); ?>" required>
                    <div class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                        <option value="sales" <?php echo $inquiry['subject'] === 'sales' ? 'selected' : ''; ?>>Sales Inquiry</option>
                        <option value="service" <?php echo $inquiry['subject'] === 'service' ? 'selected' : ''; ?>>Service Inquiry</option>
                        <option value="parts" <?php echo $inquiry['subject'] === 'parts' ? 'selected' : ''; ?>>Parts Inquiry</option>
                        <option value="general" <?php echo $inquiry['subject'] === 'general' ? 'selected' : ''; ?>>General Inquiry</option>
                    </select>
                    <div class="error-message"></div>
                </div>

                <div class="form-group full-width">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter your message here..." rows="5" required><?php echo htmlspecialchars($inquiry['message']); ?></textarea>
                    <div class="error-message"></div>
                </div>

                <div class="form-group full-width">
                    <label for="image">Upload Image (Optional)</label>
                    <?php if (!empty($inquiry['image']) && file_exists($inquiry['image'])): ?>
                        <div style="margin-bottom: 15px; padding: 15px; background: #f5f5f5; border-radius: 6px;">
                            <p><strong>Current Image:</strong></p>
                            <img src="<?php echo htmlspecialchars($inquiry['image']); ?>" alt="Current Inquiry Image" style="max-width: 200px; border-radius: 6px; margin-top: 10px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="image" name="image" accept="image/*">
                    <small>Leave blank to keep the current image. Supported formats: JPG, PNG, GIF. Max size: 5MB</small>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" name="update" class="submit-btn" style="flex: 1;">✅ Update Inquiry</button>
                    <a href="Profile.php" style="flex: 1; padding: 12px; text-align: center; background: #666; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#444';" onmouseout="this.style.background='#666';">↩️ Cancel</a>
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