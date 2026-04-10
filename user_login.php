<?php
    include 'php/database.php';
    session_start();
    // If user is already logged in, redirect to home
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        header("Location: Profile.php");
        exit();
    }

    $error_message = "";



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
    <title>BMW Login - Access Your Account</title>
    <link rel="stylesheet" href="user_login.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>
<body class="main">
    <?php
        include 'Header.php';
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="heding-cn">

        <h1>Welcome Back!</h1>
        <p class="heding-text">Please enter your credentials to access your account.</p>

    </div>
       <?php if ($error_message): ?>
            <div style="background-color: #ffe6e6; color: red; padding: 15px; border: 1px solid red; border-radius: 5px; margin-bottom: 15px;">
                ❌ <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

    <div  class="main-login-pg">

        <div class="main-login-text">
            <h2>Login</h2>
            <p class="heding-text">Access your account securely.</p>
        </div>


        <div class="main-login-cont">
            <form action="user_login.php" method="post" id="loginForm">
            
            <table>
                <tr>
                    <td><label class="Email-text">Email</label></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-container">
                            <input class="login-input" type="email" name="email" placeholder=" ">
                            <span class="floating-label">Enter your Email or Username</span>
                        </div>
                        <div class="error-message"></div>
                    </td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-container">
                            <input class="login-input" type="password" name="password" placeholder=" ">
                            <span class="floating-label">Enter your Password</span>
                        </div>
                        <div class="error-message"></div>
                    </td>
                </tr>
                <tr>
                    <td><p class="login-input-error">Password must be at least 8 characters long.</p></td>
                </tr>
                <tr>
                    <td><label>Remember Me</label><br></td>
                </tr>
                <tr>
                    <td colspan="2" style="display: flex; gap: 10px; width: 162%;">
                        <input class="remember-btn" type="button" name="re-y" value="Yes">
                        <input class="remember-btn" type="button" name="re-n" value="No">
                    </td>
                </tr>
       
                <tr>
                    <td colspan="2" style="display: flex; gap: 20px; width: 162%;">
                        <input class="L-btn" type="reset" onclick="window.location.reload();" name="cancel" value="Cancel" style="flex: 1;">
                        <input class="L-btn" type="submit" name="login" value="Login" style="flex: 1;">
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
 
    <div class="main-login-pg-sec">
        <div class="login-second-text">
            <h1>Helpful Links</h1>
            <div><p class="heding-second-text">Forgot your password or need to <a class="rg-link" href="registration.php" ><u>register?</u></a></p></div>
        </div>
        <div class="sub-cn">
            <div class="sub-cn-1">
                <div class="img-cn">
                    <img class="img-newUser1" src="icon/forget-img.jpg" alt="img">
                </div>
                <div>
                    <h4><a class="link-cn" href="#">Forgot Password?</a></h4>
                    <p class="p-text"> Click here to reset your password.</p>
                </div>
            </div>
            <div class="sub-cn-2">
                <div class="img-cn">
                    <img class="img-newUser" src="icon/new-user.jpg" alt="new user">
                </div>
                <div>
                    <h4><a class="link-cn" href="registration.php">New User?</a></h4>
                    <p class="p-text-1">Register for an account.</p>
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
    <br>
    <br>
        <?php
            include 'Footer.php';
        ?>
    <script src="js/form-validation.js"></script>
</body>
</html>