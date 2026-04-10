<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
    <link rel="stylesheet" href="header-footer.css">
    <?php
    if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark') {
        echo '<link rel="stylesheet" href="dark-theme/dark-common.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-header-footer.css">';
    }
    ?>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">

        
        <div class="logo">
            <a href="admin_login.php"><img src="icon/bmw-logo.jpg" alt="BMW Logo"></a>
            <hr class="line">
            <span class="nav-text-main">Sheer Driving <strong class="nav-text">Pleasure</strong></span>
        </div>

       
        <ul class="nav-links">
            <li><a href="admin_dashboard.php">Dashboard</a></li>
     
            <li><a href="admin_car_list_manag.php">Car Manager</a></li>
            <li><a href="admin_inquire.php">View Inquiries</a></li>
            <li><a href="admin_test_Drive.php">Test Drives</a></li>
            <li><a href="admin_learn_more.php">Learn More</a></li>
            <li><a href="admin_register_detail.php">Registrations</a></li>
            <li><a href="admin_contact.php">Contact</a></li>
        </ul>

        <div class="nav-actions">
            <a href="admin_logout.php" class="login">Logout</a>
           
    </div>
</nav>

</body>
</html>

