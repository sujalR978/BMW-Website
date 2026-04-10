<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_login.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>

<body>
    <?php
    session_start();
    // If admin is already logged in, redirect to dashboard
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        header("Location: admin_dashboard.php");
        exit();
    }
    include 'Header.php';
    ?>

    <br>
    <br>
    <br>


    <!-- Main -->
    <div class="container">
        <div class="title">
            <h1>Secure Admin Login</h1>
            <p>Please enter your credentials to access the admin panel.</p>
        </div>

        <div class="content">
            <!-- Left -->
            <div class="left">
                <h2>Login to Your Account</h2>
            </div>

            <!-- Right -->
            <div class="right">

                <form method="POST" action="" id="adminLoginForm">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="name" placeholder="Enter your username">
                        <div class="error-message"></div>
                        <div class="hint">Your unique username.</div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password">
                        <div class="error-message"></div>
                        <div class="hint">Your secure password.</div>
                    </div>

                    <div class="form-group">
                        <label>Captcha</label>
                        <div class="captcha-box">
                            <div class="captcha">
                                <input type="checkbox" name="captcha">
                                <span>I'm not a robot</span>
                            </div>
                            <button type="button" class="captcha-btn">Captcha verification</button>
                        </div>
                        <div class="hint">Please complete the captcha to continue.</div>
                    </div>

                    <div class="buttons">
                        <button type="button" class="btn btn-outline" onclick="window.location.href='home.php';">Cancel</button>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        $error_message = "";

        // Hardcoded admin credentials
        $admin_username = "sujal";
        $admin_password = "123";

        if (isset($_POST['login'])) {
            $username = $_POST['name'];
            $password = $_POST['password'];

            // Check credentials
            if ($username == $admin_username && $password == $admin_password) {
                // Login successful
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;

                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error_message = "Invalid username or password. Please try again.";
            }
        }
        ?>
        <br>
        <br>


        <?php if ($error_message): ?>
            <div style="background-color: #ffe6e6; color: red; padding: 10px; border: 1px solid red; border-radius: 5px; margin-bottom: 15px;">
                ❌ <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <!-- Bottom -->
        <div class="bottom">
            <div class="notice">
                <h3>Security Notice</h3>
                <p>Your information is protected with industry-standard encryption.</p>
            </div>

            <div>
                <div class="info-card">

                    <img src="img/security.jpg" alt="Security Icon" class="icon-placeholder">
                    <div>
                        <h4>Authentication Security</h4>
                        <p>We ensure a secure connection with SSL encryption.</p>
                    </div>
                </div>

                <div class="info-card">

                    <img src="img/two-factor-auth.jpg" alt="Two-factor Authentication Icon" class="icon-placeholder">
                    <div>
                        <h4>Two-factor Authentication</h4>
                        <p>For added security, enable two-factor authentication in your settings.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
    include 'admin_footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>

</html>