  <?php
ob_start();
include "php/database.php";
session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'second_hadder.php';
} else {
    include 'Header.php';
    Header('Location: user_login.php');
}

$id = $_SESSION['user_id'];
$query = "SELECT * FROM register_page WHERE id='$id'";
$data = mysqli_query($cann, $query);
$result = mysqli_fetch_assoc($data);

$error_msg = "";
$success_msg = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    $inquiry_type = isset($_POST['inquiry-type']) ? htmlspecialchars(trim($_POST['inquiry-type'])) : '';
    
    if (empty($name) || empty($email) || empty($subject) || empty($message) || empty($inquiry_type)) {
        $error_msg = "All fields are required.";
    } else {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg = "Please enter a valid email address.";
        } else {
            // Insert into contacts table
            $insert_query = "INSERT INTO bmw_contacts (user_id, name, email, subject, message, inquiry_type) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            
            $insert_stmt = mysqli_prepare($cann, $insert_query);
            
            if (!$insert_stmt) {
                $error_msg = "Database error: " . mysqli_error($cann);
            } else {
                mysqli_stmt_bind_param($insert_stmt, 'isssss', $id, $name, $email, $subject, $message, $inquiry_type);
                
                if (mysqli_stmt_execute($insert_stmt)) {
                    $_SESSION['success_msg'] = "Contact message sent successfully!";
                    ob_end_clean();
                    header("Location: Profile.php");
                    exit();
                } else {
                    $error_msg = "Error: " . mysqli_error($cann);
                }
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
    <title>Contact BMW - Get in Touch</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <style>
        .form-section {
            max-width: 700px;
            margin: 40px auto;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        
        .form-section h2 {
            color: #0066cc;
            font-size: 28px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .input-container {
            margin-bottom: 20px;
        }
        
        .input-container label {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }
        
        .input-container input,
        .input-container textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
        }
        
        .input-container input:focus,
        .input-container textarea:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
            outline: none;
        }
        
        .input-container textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .categories {
            background: #f0f7ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #0066cc;
        }
        
        .categories span {
            display: block;
            font-weight: 700;
            color: #0066cc;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .category-options {
            display: flex;
            gap: 20px;
        }
        
        .category-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .category-item input[type="radio"] {
            width: auto;
            margin: 0;
            cursor: pointer;
        }
        
        .category-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 600;
            color: #333;
        }
        
        .primary-btn {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #0066cc, #0052a3);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
            background: linear-gradient(135deg, #0052a3, #003d80);
        }
    </style>
</head>
<body>



    <br>
    <br>
      <br>
  
    <section class="get-in-touch">
        <h1>Get in Touch</h1>
        <p>We are here to help you. Please fill out the form below.</p>
    </section>

    
    <section class="form-section">
        <h2>Contact Us</h2>

        <?php if (!empty($error_msg)): ?>
            <div style="color: #d32f2f; padding: 15px; margin-bottom: 20px; border: 1px solid #d32f2f; border-radius: 6px; background-color: #ffebee;">
                ⚠️ <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form class="inquiry-form" id="contactForm" method="POST">
           <div class="input-container">
            <label>Name</label><br>
             <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($result['name']); ?>" required>
             <div class="error-message"></div>
              </div>
           <div class="input-container">
            <label>E-mail</label><br>
              <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($result['email']); ?>" required>
              <div class="error-message"></div>
           </div>
            <div class="input-container">
                <label>Subject</label><br>
                <input type="text" name="subject" placeholder="Subject of your inquiry" required>
                <div class="error-message"></div>
            </div>
            <div class="input-container">
                <label>Message</label><br>
                <textarea name="message" placeholder="Your message here" required></textarea>
                <div class="error-message"></div>
            </div>

            <div class="categories">
                <span>Quick Inquiry Categories</span>
                <div class="category-options">
                    <div class="category-item">
                        <input type="radio" id="sales" name="inquiry-type" value="Sales" required>
                        <label for="sales">Sales</label>
                    </div>
                    <div class="category-item">
                        <input type="radio" id="service" name="inquiry-type" value="Service" required>
                        <label for="service">Service</label>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="primary-btn">Send Message</button>
        </form>
    </section>

    
    <section class="contact-details">
        <h2>Contact Details</h2>

        <div class="details-grid">
            <div class="detail-box">
                <h4>Phone Number</h4>
                <p>+1-234-567-890</p>
            </div>

            <div class="detail-box">
                <h4>Email</h4>
                <p>info@company.com</p>
            </div>

            <div class="detail-box">
                <h4>Showroom Address</h4>
                <p>123 Business Rd,<br>Suite 456, City,<br>State, Zip</p>
            </div>

            <div class="detail-box">
                <h4>Business Hours</h4>
                <p>Mon-Fri: 9am - 5pm</p>
            </div>
        </div>
    </section>

    
    <section class="map-section">
        <div class="map-placeholder">
            <span>Our Location</span>
        </div>
    </section>

       <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <?php
            include 'Footer.php';
        ?>
    <script src="js/form-validation.js"></script>
</body>
</html>
