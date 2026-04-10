<?php
ob_start();
session_start();
include 'php/database.php';

// Handle logout FIRST before any output
if (isset($_POST['logout'])) {

    $was_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    session_destroy();
    // Redirect to appropriate login page
    if ($was_admin) {
        header("Location: admin_login.php");
    } else {
        header("Location: user_login.php");
    }
    exit();
}

// Now include header and get user data
include 'second_hadder.php';
$id = $_SESSION['user_id'];
$query = "SELECT * FROM register_page WHERE id='$id'";
$data = mysqli_query($cann, $query);
$result = mysqli_fetch_assoc($data);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard – Logout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log-out.css">
</head>

<body>



    <br>
    <br>
    <br>
    <div class="confirm">
        <h1>Logout Confirmation</h1>
        <p>Are you sure you want to end our journey?</p>
        <div class="confirm-buttons">
            <form action="log-out.php" method="post">
                <button type="button" class="btn btn-outline" onclick="window.location.href='home.php'">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" name="logout">Logout</button>
            </form>

        </div>
    </div>

    <!-- Profile Bar -->
    <div class="profile-bar">
        <div class="profile-left">
            <!-- <img class="profile-pic" src="img/profile1.jpg" alt="Profile Picture"> -->
            <?php
            $extensions = ['jpg', 'jpeg', 'png'];
            $image_found = false;

            foreach ($extensions as $ext) {
                $image_path = "uploads/" . $_SESSION['user_id'] . "." . $ext;
                if (file_exists($image_path)) {
                    echo '<img class="avatar" src="' . "" . $image_path . '" width="150">';
                    $image_found = true;
                    break;
                } else {

                    // echo '<img class="profile-pic" src="img/profile1.jpg" alt="Profile Picture" width="150">';
                }
            }

            if (!$image_found) {
                echo '<img class="avatar" src="img/profile1.jpg" alt="Profile Picture" width="150">';
            }
            ?>
            <!-- <img src="img/profile1.jpg" alt="User Avatar" class="avatar"> -->
            <div class="profile-info">
                <h3><?php echo htmlspecialchars($result['name']) ?></h3>
                <h3><?php echo htmlspecialchars($result['email']) ?></h3>
                <div class="tags">
                    <span class="tag">User</span>
                    <span class="tag">Verified</span>
                </div>
                <div class="session">Active Session</div>
            </div>
        </div>

        <div class="profile-actions">
            <!-- <button class="btn-gray">Settings</button> -->
            <button class="btn-black" type="submit" onclick="window.location.href='Profile.php'">View Profile</button>
        </div>
    </div>

    <!-- Message -->
    <div class="message">
        Thank you for visiting. We hope to see you again soon.
    </div>

    <!-- Session Ended -->
    <div class="session-ended">
        <div class="ended">
            <h2>Journey Ended</h2>
            <p>Our journey has been successfully logged out.</p>
            <div class="ended-buttons">
                <button class="btn btn-outline"><a class="link-contact" href="contact.php">Contact Support</a></button>
                <button class="btn btn-primary"><a class="link-login" href="Profile.php">Return to Profile</a></button>
            </div>
        </div>

        <div class="help-card">

            <img src="img/help.jpg" alt="Help Icon" class="help-icon">
            <div>
                <h4>Need Assistance?</h4>
                <p>If you have any inconvince, feel free to reach out to our support team.</p>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
    include 'Footer.php';
    ?>

</body>

</html>