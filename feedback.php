<?php
include 'php/database.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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

// Handle feedback submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rating = intval($_POST['rating']);
    $feedback_type = trim($_POST['feedback_type']);
    $message = trim($_POST['message']);
    $is_negative = ($rating <= 2) ? 1 : 0;

    if (empty($name) || empty($email) || empty($message) || empty($feedback_type)) {
        $_SESSION['error_msg'] = "All fields are required!";
    } else {
        // Handle file upload
        $image_url = NULL;
        if (isset($_FILES['feedback_image']) && $_FILES['feedback_image']['size'] > 0) {
            $target_dir = "uploads/feedback/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            
            $file_name = time() . '_' . basename($_FILES['feedback_image']['name']);
            $target_file = $target_dir . $file_name;
            
            if (move_uploaded_file($_FILES['feedback_image']['tmp_name'], $target_file)) {
                $image_url = $file_name;
            }
        }

        $insert_query = "INSERT INTO bmw_feedback (user_id, name, email, rating, feedback_type, message, image_url, is_negative) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($cann, $insert_query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'issiissi', $user_id, $name, $email, $rating, $feedback_type, $message, $image_url, $is_negative);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success_msg'] = "Thank you! Your feedback has been submitted.";
                ob_start();
                header("Location: Profile.php");
                ob_end_flush();
                exit();
            } else {
                $_SESSION['error_msg'] = "Error submitting feedback. Please try again.";
            }
        }
    }
}

// Fetch user data
$user_query = "SELECT * FROM register_page WHERE id='$user_id'";
$user_data = mysqli_query($cann, $user_query);
$user = mysqli_fetch_assoc($user_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form - BMW</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/feedback.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .feedback-container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .feedback-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .feedback-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .feedback-header p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .feedback-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .rating-group {
            display: flex;
            gap: 10px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .rating-btn {
            flex: 1;
            min-width: 50px;
            padding: 12px;
            border: 2px solid #ecf0f1;
            background: white;
            cursor: pointer;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
        }

        .rating-btn:hover {
            border-color: #667eea;
            background: #f0f3ff;
        }

        .rating-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-label {
            display: block;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #667eea;
            font-weight: 600;
        }

        .file-upload-label:hover {
            background: #f0f3ff;
            border-color: #764ba2;
        }

        .file-name {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-cancel {
            background: #ecf0f1;
            color: #333;
        }

        .btn-cancel:hover {
            background: #d5d8dc;
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

        .feedback-type-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 8px;
        }

        .feedback-type-btn {
            padding: 10px;
            border: 2px solid #ecf0f1;
            background: white;
            cursor: pointer;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .feedback-type-btn:hover {
            border-color: #667eea;
            background: #f0f3ff;
        }

        .feedback-type-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        @media (max-width: 600px) {
            .feedback-container {
                margin: 20px 10px;
            }

            .feedback-header {
                padding: 30px 20px;
            }

            .feedback-header h1 {
                font-size: 1.6rem;
            }

            .feedback-form {
                padding: 20px;
            }

            .rating-btn {
                min-width: 40px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
   

    <div class="feedback-container">
        <div class="feedback-header">
            <h1>Share Your Feedback</h1>
            <p>Help us improve your BMW experience</p>
        </div>

        <div class="feedback-form">
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<div class='alert alert-error'>" . $_SESSION['error_msg'] . "</div>";
                unset($_SESSION['error_msg']);
            }
            if (isset($_SESSION['success_msg'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['success_msg'] . "</div>";
                unset($_SESSION['success_msg']);
            }
            ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Feedback Type *</label>
                    <div class="feedback-type-group">
                        <button type="button" class="feedback-type-btn" data-type="Service" onclick="selectFeedbackType('Service', this)">🔧 Service</button>
                        <button type="button" class="feedback-type-btn" data-type="Product" onclick="selectFeedbackType('Product', this)">🚗 Product</button>
                        <button type="button" class="feedback-type-btn" data-type="Experience" onclick="selectFeedbackType('Experience', this)">⭐ Experience</button>
                        <button type="button" class="feedback-type-btn" data-type="Suggestion" onclick="selectFeedbackType('Suggestion', this)">💡 Suggestion</button>
                    </div>
                    <input type="hidden" id="feedback_type" name="feedback_type" required>
                </div>

                <div class="form-group">
                    <label>Rate Your Experience *</label>
                    <div class="rating-group">
                        <button type="button" class="rating-btn" onclick="setRating(5, this)">⭐⭐⭐⭐⭐ Excellent</button>
                        <button type="button" class="rating-btn" onclick="setRating(4, this)">⭐⭐⭐⭐ Good</button>
                        <button type="button" class="rating-btn" onclick="setRating(3, this)">⭐⭐⭐ Average</button>
                        <button type="button" class="rating-btn" onclick="setRating(2, this)">⭐⭐ Poor</button>
                        <button type="button" class="rating-btn" onclick="setRating(1, this)">⭐ Terrible</button>
                    </div>
                    <input type="hidden" id="rating" name="rating" value="5" required>
                </div>

                <div class="form-group">
                    <label for="message">Your Feedback *</label>
                    <textarea id="message" name="message" placeholder="Please share your detailed feedback..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="feedback_image">Attach Image (Optional)</label>
                    <div class="file-upload">
                        <label for="file" class="file-upload-label">
                            📸 Click or drag to upload image
                        </label>
                        <input type="file" id="file" name="feedback_image" accept="image/*" onchange="updateFileName(this)">
                        <div class="file-name" id="file-name"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">Submit Feedback</button>
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='Profile.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'Footer.php'; ?>

    <script>
        function setRating(value, btn) {
            document.getElementById('rating').value = value;
            document.querySelectorAll('.rating-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function selectFeedbackType(type, btn) {
            document.getElementById('feedback_type').value = type;
            document.querySelectorAll('.feedback-type-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function updateFileName(input) {
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileName.textContent = '✓ ' + input.files[0].name;
            } else {
                fileName.textContent = '';
            }
        }

        // Set default rating
        document.querySelector('.rating-btn').classList.add('active');
    </script>
</body>
</html>
