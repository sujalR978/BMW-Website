<?php
// database connection
include 'php/database.php';

session_start();
// If user is already logged in, redirect to home
// error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: Profile.php");
    exit();
}

// handle submission before any output
if (isset($_POST['sing_up'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    //$password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $password = $_POST['password'] ?? '';


        $query = "INSERT INTO register_page (name, email, phone_number, password)
            VALUES ('$name', '$email', '$phone', '$password')";
   

        $data = mysqli_query($cann, $query);
        if ($data) { 
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = mysqli_insert_id($cann); // Get the ID of the newly inserted user                                        
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            // Redirect to home page
            header("Location: Profile.php");
            exit();
        } else {
            $error_message = "Registration failed. Please try again.";
        }
  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join BMW Community - Register Now</title>
    <link rel="stylesheet" href="registration-style.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>

<body>

    <?php
    include 'Header.php';
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section class="hero">
        <h1>Join Us Today!</h1>
        <p>Create your account to start saving your favorite cars, booking test drives, and managing your garage effortlessly.</p>
        <button class="btn-dark">Create an Account</button>
    </section>

    <hr class="divider">

    <section class="container registration-grid">
        <div class="reg-text">
            <h2>Register</h2>
            <p>Fill in your details to get started.</p>
        </div>
        <div class="reg-form">

            <form action="#" method="POST" id="registrationForm">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                    <div class="error-message"></div>
                    <small>e.g. John Doe</small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email">
                    <div class="error-message"></div>
                    <small> e.g. xyz123@gmail.com<br>We'll never share your email.</small>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="Enter your phone number">
                    <div class="error-message"></div>
                    <small>e.g. +1234567890 <br>phone number length must be 10 digit.</small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password">
                    <div class="error-message"></div>
                    <small>At least 8 characters, including one uppercase letter.</small>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Re-enter your password">
                    <div class="error-message"></div>
                    <small>Must match the password above.</small>
                </div>

                <div class="form-buttons">
                    <button type="reset" name="cancel" onclick="window.location.reload();" class="btn-outline">Cancel</button>
                    <button type="submit" name="sing_up" class="btn-dark">Sign Up</button>
                </div>
            </form>
        </div>
    </section>


    <?php


    ?>

    <hr class="divider">

    <section class="container features-grid">
        <div class="feature-title">
            <h2>Why Register?</h2>
            <p>Enjoy exclusive features by creating an account.</p>
        </div>
        <div class="feature-cards">
            <div class="card">

                <img class="square-img" src="img/favorite-cars3.jpg">
                <div>
                    <h3>Save Favorite Cars</h3>
                    <p>Keep track of cars you love.</p>
                </div>
            </div>
            <div class="card">
                <img class="square-img" src="img/book-test-drives.jpg">
                <div>
                    <h3>Book Test Drives</h3>
                    <p>Schedule test drives with ease.</p>
                </div>
            </div>
            <div class="card">
                <img class="square-img" src="img/garage1.jpg">
                <div>
                    <h3>Manage Your Garage</h3>
                    <p>All your vehicles in one place.</p>
                </div>
            </div>
        </div>
    </section>

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