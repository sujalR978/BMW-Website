<?php
    include 'php/database.php';
    include 'second_hadder.php';
    session_start();
    // If user is already logged in, redirect to home


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My BMW Applications</title>
    <link rel="stylesheet" href="my_application.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <style>
        /* Remove background image as requested */
        body {
            background-image: none !important;
            background-color: #ffffff; /* Add clean white backgrounds */
        }
    </style>
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




<?php
include 'Footer.php';
?>
<script src="js/form-validation.js"></script>
</body>
</html>
