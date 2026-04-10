<?php
    include 'php/database.php';
    include 'Header.php';
    session_start();
    // If user is already logged in, redirect to home
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        header("Location: Profile.php");
        exit();
    }

    $error_message = "";

    // Handle Sign Up
    if (isset($_POST['signup'])) {
        $email = mysqli_real_escape_string($cann, $_POST['email']);
        $password = mysqli_real_escape_string($cann, $_POST['password']);

        // Check if email and password match in database
        $query = "SELECT * FROM register_page WHERE email = '$email' AND password = '$password'";
        $data = mysqli_query($cann, $query);
        $user_found = mysqli_num_rows($data) > 0;
        $result = mysqli_fetch_assoc($data);

        if ($user_found) {
            // Sign up successful - user verified
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['name'];
            $_SESSION['user_email'] = $result['email'];
            
            // Redirect to profile page
            header("Location: Profile.php");
            exit();
        } else {
            $error_message = "Email and password do not match our records. Please check and try again.";
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $quary = "SELECT * FROM register_page WHERE email = '$email' AND password = '$password'";
        $data = mysqli_query($cann, $quary);
        $user_found = mysqli_num_rows($data) > 0;
        $result = mysqli_fetch_assoc($data);
   

        if ($user_found) {
            // Login successful
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $result['id'];
             $_SESSION['user_name'] = $result['name'];
            $_SESSION['user_email'] = $result['email'];
          
            // Redirect to home page
            header("Location: Profile.php");
            exit();
        } else {
            $error_message = "Invalid email or password. Please try again. Test: user@example.com / password123";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My BMW Applications</title>
    <link rel="stylesheet" href="my_application.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>
<body>
<!-- Hero Section -->
<section class="hero">
    <div class="hero-text">
        <h1>Welcome to Our Service</h1>
        <p>Your one-stop solution for everything you need.</p>
        <div class="buttons">
            <a href="learn_more.php" class="btn-outline" style="text-decoration: none;">Learn More</a>
            <a href="car_models.php" class="btn-primary" style="text-decoration: none;">Get Started</a>
        </div>
        <div class="tags">
            <span>Feature</span>
            <span>Pricing</span>
            <span>Testimonials</span>
        </div>
    </div>
    
    <img src="img/my_application.jpg" alt="Hero Image" class="hero-image">
</section>

<!-- Products -->
<section class="products">
    <h2>Our Products</h2>
    <p>Explore our wide range of products</p>
    <a href="car_models.php" class="btn-primary" style="text-decoration: none;">Shop Now</a>

    <div class="product-grid">
        <div class="product-card">
            
            <img src="img/hadlight.jpg" alt="BMW X5" class="img-placeholder">
            <h3>Product 1</h3>
            <p>$29.99</p>
        </div>
        <div class="product-card">
            <img src="img/steering-wheel.jpg" alt="BMW M3" class="img-placeholder">
            <h3>Product 2</h3>
            <p>$39.99</p>
        </div>
        <div class="product-card">
            <img src="img/engine.jpg" alt="BMW iX" class="img-placeholder">
            <h3>Product 3</h3>
            <p>$49.99</p>
        </div>
    </div>
</section>

<!-- Metrics -->
<section class="metrics">
    <div class="metrics-info">
        <h2>Key Metrics</h2>
        <p>Track our performance at a glance</p>
        <a href="car_models.php" class="btn-primary" style="text-decoration: none;">View More</a>

        <div class="stats">
            <div>
                <h3>1500</h3>
                <p>Users</p>
            </div>
            <div>
                <h3>$500K</h3>
                <p>Revenue</p>
            </div>
        </div>
    </div>

    <div class="chart">
        <h3>Monthly Revenue Trend</h3>
        <div class="chart-bars">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
    </div>
</section>

<!-- Reviews -->
<section class="reviews">
    <h2>Customer Reviews</h2>
    <p>What our customers say about us</p>

    <div class="review-grid">
        <div class="review-card">
            <h4>John Doe ⭐⭐⭐⭐⭐</h4>
            <p>Amazing service! Highly recommended.</p>
        </div>
        <div class="review-card">
            <h4>Jane Smith ⭐⭐⭐⭐☆</h4>
            <p>Quality products at great prices.</p>
        </div>
    </div>
</section>

<!-- Sign Up -->
<section class="signup">
    <h2>Sign Up Now</h2>
    <p>Join us for exclusive offers</p>

    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-error" style="color: #d32f2f; background-color: #ffebee; padding: 12px; border-radius: 4px; margin-bottom: 15px;">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" id="signupForm">
        <input type="email" name="email" placeholder="Email address" required>
        <div class="error-message"></div>
        <input type="password" name="password" placeholder="Enter password" required>
        <div class="error-message"></div>
        <div class="form-buttons">
            <button type="reset" class="btn-outline">Cancel</button>
            <button type="submit" name="signup" value="signup" class="btn-primary">Sign Up</button>
        </div>
    </form>
</section>


<?php
include 'Footer.php';
?>
<script src="js/form-validation.js"></script>
</body>
</html>
