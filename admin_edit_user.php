<?php
// database connection
include 'php/database.php';


// If user is already logged in, redirect to home
// error_reporting(0);
// if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
//     header("Location: admin_register_detail.php");
//     exit();
// }
//update logic
$id = $_GET['id'];

$query = "SELECT * FROM register_page WHERE id = '$id' ";
$data = mysqli_query($cann, $query);

$total = mysqli_num_rows($data);// Check if there are records to display
$result = mysqli_fetch_assoc($data);


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password =$_POST['password'];

   
   
        // $query = "INSERT INTO register_page (name, email, phone_number, password)
        //     VALUES ('$name', '$email', '$phone', '$password')";

        $query = "UPDATE register_page SET name='$name', email='$email', phone_number='$phone', password='$password' WHERE id='$id'";

        $data = mysqli_query($cann, $query);

        if ($data) { 



            // Redirect to home page
            header("Location: admin_register_detail.php");
            
            exit();
            

        } 
        else {

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
    include 'admin_hader.php';
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section class="hero">
        <h1>Join Us Today!</h1>
        <p>Create your account to start saving your favorite cars, booking test drives, and managing your garage effortlessly.</p>
        <button class="btn-dark">Update an Account</button>
    </section>

    <hr class="divider">

    <section class="container registration-grid">
        <div class="reg-text">
            <h2>Update Register</h2>
            <p>Update details to get started.</p>
        </div>
        <div class="reg-form">

            <form action="#" method="POST" id="registrationForm">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text"  name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($result['name']); ?>" >
                    <div class="error-message"></div>
                    <small>e.g. John Doe</small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($result['email']); ?>" >
                    <div class="error-message"></div>
                    <small> e.g. xyz123@gmail.com<br>We'll never share your email.</small>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($result['phone_number']); ?>">
                    <div class="error-message"></div>
                    <small>e.g. +1234567890 <br>phone number length must be 10 digit.</small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" value="<?php echo htmlspecialchars($result['password']); ?>">
                    <div class="error-message"></div>
                    <small>At least 8 characters, including one uppercase letter.</small>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Re-enter your password" value="<?php echo htmlspecialchars($result['password']); ?>">
                    <div class="error-message"></div>
                    <small>Must match the password above.</small>
                </div>

                <div class="form-buttons">
                    <button type="reset" name="cancel" onclick="window.location.href='admin_register_detail.php';" class="btn-outline">Cancel</button>
                    <button type="submit" name="update" class="btn-dark">Update</button>
                </div>
            </form>
        </div>
    </section>


    <?php


    ?>


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

