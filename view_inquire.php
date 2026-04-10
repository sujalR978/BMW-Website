<?php
ob_start(); // Start output buffering to prevent header issues
include "php/database.php";

session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

include 'second_hadder.php';

$id = $_SESSION['user_id'];
$query = "SELECT * FROM register_page WHERE id=?";
$stmt = mysqli_prepare($cann, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);
$result = mysqli_fetch_assoc($data);
if (!$result) {
    $result = array('name' => '', 'email' => '', 'phone' => '');
}

if (isset($_POST['submit'])) {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        $error_msg = "All fields are required.";
    } else {

    $dest_path = ""; // important fix

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedfileExtensions)) {

            $uploadFileDir = 'uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // File uploaded successfully
            } else {
                $dest_path = ""; // reset if failed
                echo "Error uploading file";
            }
        } else {
            $dest_path = ""; // invalid file type
        }
    }

    $query = "INSERT INTO bmw_inquiries 
    (user_id, name, email, phone, subject, message, image) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($cann, $query);
    mysqli_stmt_bind_param($stmt, 'issssss', $id, $name, $email, $phone, $subject, $message, $dest_path);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_msg'] = "Inquiry submitted successfully!";
        ob_end_clean(); // Clear output buffer
        header("Location: Profile.php");
        exit();
    } else {
        $error_msg = "Error: " . mysqli_error($cann);
    }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My BMW Inquiries</title>
    <link rel="stylesheet" href="view_inquire.css">
    <link rel="stylesheet" href="css/form-validation.css">
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
            <h1 class="title">BMW Inquiry Form</h1>
            <p class="subtitle">Get in touch with us for any questions or inquiries about BMW vehicles.</p>
            
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger" style="color: red; padding: 10px; margin-bottom: 15px; border: 1px solid red; border-radius: 4px;">
                    <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form class="inquiry-form" id="inquiryForm" method="post" enctype="multipart/form-data">
                <!-- <div class="form-row"> -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($result['name']) ?>">
                    <div class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($result['email']) ?>">
                    <div class="error-message"></div>
                </div>
                <!-- </div> -->

                <!-- <div class="form-row"> -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo isset($result['phone']) ? htmlspecialchars($result['phone']) : ''; ?>">
                    <div class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select id="subject" name="subject">
                        <option value="">Select Subject</option>
                        <option value="sales">Sales Inquiry</option>
                        <option value="service">Service Inquiry</option>
                        <option value="parts">Parts Inquiry</option>
                        <option value="general">General Inquiry</option>
                    </select>
                    <div class="error-message"></div>
                </div>
                <!-- </div> -->

                <div class="form-group full-width">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter your message here..." rows="5"></textarea>
                    <div class="error-message"></div>
                </div>

                <div class="form-group full-width">
                    <label for="image">Upload Image (Optional)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <small>Supported formats: JPG, PNG, GIF. Max size: 5MB</small>
                </div>

                <button type="submit" name="submit" class="submit-btn">Send Inquiry</button>
            </form>
        </div>


    </div>

    <?php
    include 'Footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>

</html>