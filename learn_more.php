<?php
include 'php/database.php';
    session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
        Header('Location: user_login.php');
    }

    $id = $_GET['id']; 
    $query = "SELECT * FROM cars where id = '$id'";
    $data = mysqli_query($cann, $query);
    $result = mysqli_fetch_assoc($data);

    $query1 = "SELECT *FROM car_learn_more WHERE id ='$id'";
    $data1=mysqli_query($cann,$query1);
    $result1=mysqli_fetch_assoc($data1);
    $car_features = explode(", ", $result1['features']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More About BMW - Innovation & Excellence</title>
    <link rel="stylesheet" href="learn_more.css">
    <!-- <link rel="stylesheet" href="header-footer.css"> -->
</head>
<body>

    <div class="car-details-container">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
               
                <h1><?php echo htmlspecialchars($result['car_name']); ?></h1>
                <p class="hero-subtitle">The Ultimate Luxury <?php echo htmlspecialchars($result['category']); ?> </p>
                <div class="hero-price">
                    <span class="price"><?php echo htmlspecialchars($result['price']); ?></span>
                    <span class="starting">Starting at</span>
                </div>
                <a href="test_drive.php" class="cta-btn" style="text-decoration: none;">Book Test Drive</a>

            </div>
            <div class="hero-image">
                <img  src="uploads/<?php  echo htmlspecialchars($result['car_image']); ?>" alt="BMW X5">
            </div>
        </section>

        <!-- Overview Section -->
        <section class="overview-section">
            <h2>Overview</h2>
            <p>The BMW X5 is a luxury SUV that combines sporty performance with everyday practicality. With its powerful engine, advanced technology, and premium interior, the X5 delivers an unparalleled driving experience.</p>
            <div class="key-features">
                <div class="feature">
                    <h3>Performance</h3>
                    <p><?php echo htmlspecialchars($result1['performance']) ?></p>
                    <p><?php echo htmlspecialchars($result1['horsepower']) ?></p>
                </div>
                <div class="feature">
                    <h3>Efficiency</h3>
                    <p><?php echo htmlspecialchars($result1['efficiency'])?></p>
                    <p><?php echo htmlspecialchars($result1['fuel_economy']) ?></p>
                </div>
                <div class="feature">
                    <h3>Safety</h3>
                    <p><?php echo htmlspecialchars($result1['safety']) ?></p>
                    <p>MAX : 5-Star Safety Rating<br>
                MIN : 0-Star Safety Rating</p>
                </div>
            </div>
        </section>

        <!-- Specifications Section -->
        <section class="specs-section">
            <h2>Specifications</h2>
            <div class="specs-grid">
                <div class="spec-item">
                    <h3>Engine</h3>
                    <p><?php echo htmlspecialchars($result1['engine']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Horsepower</h3>
                    <p><?php echo htmlspecialchars($result1['horsepower']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Torque</h3>
                    <p><?php echo htmlspecialchars($result1['torque']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Transmission</h3>
                    <p><?php echo htmlspecialchars($result1['transmission']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Drivetrain</h3>
                    <p><?php echo htmlspecialchars($result1['drivetrain']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Seating</h3>
                    <p><?php echo htmlspecialchars($result1['seating']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Cargo Space</h3>
                    <p><?php echo htmlspecialchars($result1['cargo_space']) ?></p>
                </div>
                <div class="spec-item">
                    <h3>Fuel Economy</h3>
                    <p><?php echo htmlspecialchars($result1['fuel_economy']) ?></p>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
    <h2>Key Features</h2>
    <div class="features-grid">

        <?php if(in_array('iDrive System', $car_features)){ ?>
        <div class="feature-card">
            <h3>iDrive System</h3>
            <p>Intuitive touchscreen interface with voice control</p>
        </div>
        <?php } ?>

        <?php if(in_array('Adaptive Suspension', $car_features)){ ?>
        <div class="feature-card">
            <h3>Adaptive Suspension</h3>
            <p>Adjusts for optimal comfort and handling</p>
        </div>
        <?php } ?>

        <?php if(in_array('Panoramic Sunroof', $car_features)){ ?>
        <div class="feature-card">
            <h3>Panoramic Sunroof</h3>
            <p>Large glass roof for natural light</p>
        </div>
        <?php } ?>

        <?php if(in_array('Wireless Charging', $car_features)){ ?>
        <div class="feature-card">
            <h3>Wireless Charging</h3>
            <p>Charge your devices without cables</p>
        </div>
        <?php } ?>

        <?php if(in_array('Premium Audio', $car_features)){ ?>
        <div class="feature-card">
            <h3>Premium Audio</h3>
            <p>Harman Kardon surround sound system</p>
        </div>
        <?php } ?>

        <?php if(in_array('Head-Up Display', $car_features)){ ?>
        <div class="feature-card">
            <h3>Head-Up Display</h3>
            <p>Projects information on windshield</p>
        </div>
        <?php } ?>

    </div>
</section>
     

        <!-- Gallery Section -->
        <section class="gallery-section">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                 <?php
                    $images = explode(",", $result1['gallery']);

                    foreach ($images as $img) {
                    ?>
                       <img src="uploads/<?php echo $img; ?>">
                   <?php } ?>
                <!-- <img src="img/bmw-x5.jpg" alt="BMW X5 Exterior">
                <img src="img/bmw-x5-interior.jpg" alt="BMW X5 Interior">
                <img src="img/bmw-x5-engine.jpg" alt="BMW X5 Engine">
                <img src="img/bmw-x5-side.jpg" alt="BMW X5 Side View"> -->
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="reviews-section">
            <h2>Customer Reviews</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-header">
                        <div class="stars">★★★★★</div>
                        <cite>John D.</cite>
                    </div>
                    <p>"The BMW X5 is an incredible SUV. The performance is outstanding, and the interior is luxurious. Highly recommend!"</p>
                </div>
                <div class="review-card">
                    <div class="review-header">
                        <div class="stars">★★★★☆</div>
                        <cite>Sarah M.</cite>
                    </div>
                    <p>"Great vehicle for family trips. Spacious and comfortable. The tech features are top-notch."</p>
                </div>
                <div class="review-card">
                    <div class="review-header">
                        <div class="stars">★★★★★</div>
                        <cite>Mike R.</cite>
                    </div>
                    <p>"BMW quality at its finest. The X5 handles like a sports car but rides like a luxury sedan."</p>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section">
            <h2>Ready to Experience the BMW X5?</h2>
            <p>Contact us today to schedule a test drive or get more information.</p>
            <div class="cta-buttons">
                <a href="test_drive.php" class="primary-btn" style="text-decoration: none;">Book Test Drive</a>
                <a href="contact.php" class="secondary-btn" style="text-decoration: none;">Contact Dealer</a>
            </div>
        </section>
    </div>

    <?php
    include 'Footer.php';
    ?>

</body>
</html>
