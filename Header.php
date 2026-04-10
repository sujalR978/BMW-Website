<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <link rel="stylesheet" href="header-footer.css">
    <?php
    if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark') {
        echo '<link rel="stylesheet" href="dark-theme/dark-common.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-header-footer.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-index.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-car-models.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-sound.css">';
    }
    ?>

<!-- </head> -->
<body>
    

<nav class="navbar">
    <div class="navbar-container">

        
        <div class="logo">
            <a href="admin_login.php"><img src="icon/bmw-logo.jpg" alt="BMW Logo"></a>
            <hr class="line">
            <span class="nav-text-main">Sheer Driving <strong class="nav-text">Pleasure</strong></span>
        </div>

       
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="Electric_modeliti.php">Beamer Pride</a></li>
            <li><a href="car_models.php">Machines</a></li>
            <li><a href="sound.php">Frequency</a></li>
            <li><a href="my_application.php">Products</a></li>
        </ul>

        <div class="nav-actions">
            <a href="user_login.php" class="login">Login</a>
            <a href="registration.php" class="register">Registration</a>
        </div>

    </div>
</nav>

</body>
</html>

