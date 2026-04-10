<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BMW Footer</title>
    <link rel="stylesheet" href="header-footer.css">
    <?php
    if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark') {
        echo '<link rel="stylesheet" href="dark-theme/dark-common.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-header-footer.css">';
    }
    ?>
</head>

<body>

    <footer class="footer">
        <!-- Brand -->
        <div class="footer-brand">
            <img class="footer-img" src="icon/bmw-logo.jpg" alt="BMW Logo">
            <h2>BMW</h2>
        </div>

        <div class="footer-container">

            <!-- Quick Links -->
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="admin_car_add_list.php">Add Car</a></li>
                    <li><a href="admin_car_list_manag.php">Car Manager</a></li>
                    <li><a href="admin_inquire.php">Inquire</a></li>
                    <li><a href="admin_login.php">Log in</a></li>
                    <li><a href="admin_test_Drive.php">Test Drive</a></li>
                    <li><a href="admin_learn_more.php">Learn more</a></li>
                    <li><a href="admin_feedback.php">Feedback</a></li>
                    <li><a href="admin_contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>User Pages</h3>
                    <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="car_models.php">Machine</a></li>
                    <li><a href="Electric_modeliti.php">Electric Future</a></li>
                    <li><a href="sound.php">Frequency</a></li>
                    <li><a href="user_login.php">Log in</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Account</h3>
            
                <ul>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="wish-list.php">Wish-list</a></li>
                    <li><a href="Profile.php">Profile</a></li>
                    <li><a href="booking">Booking Service</a></li>
                    <li><a href="learn_more.php">learn more</a></li>
                    <li><a href="quiz.php">Quick Quiz</a></li>
                    <li><a href="test_drive.php">Test Drive</a></li>
                    <li><a href="contact.php">Help us</a></li>
                    <li><a href="view_inquire.php">inquire</a></li>
                    <li><a href="log-out.php">Log Out</a></li>
                </ul>
            </div>

            <!-- Machine -->
            <div class="footer-column">
                <h3>Machine</h3>
                <ul>
                   <ul>
                    <li><a href="car_models.php?series=X">BMW X series</a></li>
                    <li><a href="car_models.php?series=7">BMW 7 series</a></li>
                    <li><a href="car_models.php?series=5">BMW 5 series</a></li>
                    <li><a href="car_models.php?series=3">BMW 3 series</a></li>
                    <li><a href="car_models.php?series=2">BMW 2 series</a></li>
                    <li><a href="car_models.php?series=M">BMW M series</a></li>
                    <li><a href="car_models.php?series=Concept">BMW Concept Cars</a></li>
                    <li><a href="car_models.php?series=Protection">BMW Protection Vehicles</a></li>
                    <li><a href="car_models.php?series=GKL">GKL Cars</a></li>
                </ul>
                </ul>
            </div>

            <!-- Category -->
            <div class="footer-column">
                <h3>Category</h3>
                <ul>
                    <li><a href="#">Sedan</a></li>
                    <li><a href="#">SUV</a></li>
                    <li><a href="#">Coupe</a></li>
                    <li><a href="#">Convertible</a></li>
                </ul>
            </div>

            <!-- Drivetrain -->
            <div class="footer-column">
                <h3>Drivetrain variants</h3>
                <ul>
                    <li><a href="#">Fully Electronic</a></li>
                    <li><a href="#">Plug in Hybrid</a></li>
                    <li><a href="#">Petrol</a></li>
                    <li><a href="#">Diesel</a></li>
                </ul>
            </div>

        </div>
        <!-- https://upload.wikimedia.org/wikipedia/commons/4/44/BMW.svg -->
        <!-- Social Media Section -->
        <div class="footer-social-container">
            <div class="social-links-wrapper">
                <a href="https://youtube.com" class="social-link youtube" title="YouTube" target="_blank">
                    <img src="icon/youtub-icon.avif" alt="YouTube">
                    <span class="social-name">YouTube</span>
                </a>
                <a href="https://instagram.com" class="social-link instagram" title="Instagram" target="_blank">
                    <img src="icon/instagram-icon.avif" alt="Instagram">
                    <span class="social-name">Instagram</span>
                </a>
                <a href="https://twitter.com" class="social-link twitter" title="Twitter" target="_blank">
                    <img src="icon/twitter-icon.png" alt="Twitter">
                    <span class="social-name">Twitter</span>
                </a>
                <a href="https://facebook.com" class="social-link facebook" title="Facebook" target="_blank">
                    <img src="icon/facebook-icon.avif" alt="Facebook">
                    <span class="social-name">Facebook</span>
                </a>
                <a href="https://wa.me/" class="social-link whatsapp" title="WhatsApp" target="_blank">
                    <img src="icon/telegram-icon.png" alt="WhatsApp">
                    <span class="social-name">WhatsApp</span>
                </a>
            </div>
        </div>



    </footer>




</body>

</html>