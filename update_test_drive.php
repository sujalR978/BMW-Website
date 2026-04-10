<?php
include 'php/database.php';

session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'second_hadder.php';
} else {
    include 'Header.php';
    Header('Location: user_login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$status_query = "SELECT booking_status FROM test_drive 
WHERE user_id='$user_id' 
ORDER BY id DESC LIMIT 1";

$status_data = mysqli_query($cann, $status_query);
$status_row = mysqli_fetch_assoc($status_data);

$booking_status = $status_row['booking_status'] ?? '';

if (isset($_POST['book'])) {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $model = $_POST['model'];
    $preferred_date = $_POST['preferred_date'];
    $preferred_time = $_POST['preferred_time'];
    $location = $_POST['location'];
    $comments = $_POST['comments'];

    // Here you would typically insert the booking details into a database

    $query = "UPDATE test_drive 
SET first_name='$first_name',
last_name='$last_name',
email='$email',
phone='$phone',
model='$model',
preferred_date='$preferred_date',
preferred_time='$preferred_time',
location='$location',
comments='$comments'
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 1";

    $data = mysqli_query($cann, $query);
    // For demonstration, we'll just display a confirmation message
    if ($data) {
        echo "<script>
                alert('Test drive updated successfully');
                window.location.href='Profile.php';
                </script>";
    } else {
        echo "<script>alert('Sorry, there was an error updating your test drive. Please try again later.');</script>";
    }

    
    // echo "<script>alert('Thank you, $first_name! Your BMW test drive has been booked for $preferred_date at $preferred_time. We will contact you shortly to confirm the details.');</script>";
}
$query = "SELECT * FROM test_drive 
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 1";
    $data = mysqli_query($cann, $query);
    $result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Test Drive - Experience Performance</title>
    <link rel="stylesheet" href="test_drive.css">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <style>
        .status-container {
            width: 80%;
            margin: 30px auto;
            text-align: center;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .step {
            flex: 1;
            padding: 12px;
            margin: 5px;
            border-radius: 20px;
            background: #ddd;
            font-weight: 600;
        }

        .step.active {
            background: #007bff;
            color: white;
        }
    </style>
</head>

<body>



    <div class="test-drive-container">
        <div class="hero-section">
            <h1 class="hero-title">Update Your BMW Test Drive Form</h1>
            <p class="hero-subtitle">Experience the thrill of driving a BMW. Schedule your test drive today and feel the difference.</p>
        </div>

        <?php if ($booking_status != '') { ?>

            <div class="status-container">

                <h2>Your Current Test Drive Status</h2>

                <div class="status-bar">

                    <div class="step <?php if ($booking_status == 'pending' || $booking_status == 'approved' || $booking_status == 'completed') echo 'active'; ?>">
                        Booking Requested
                    </div>

                    <div class="step <?php if ($booking_status == 'approved' || $booking_status == 'completed') echo 'active'; ?>">
                        Approved
                    </div>

                    <div class="step <?php if ($booking_status == 'completed') echo 'active'; ?>">
                        Completed
                    </div>
                    <div class="step <?php if ($booking_status == 'rejected') echo 'active'; ?>">
                        Rejected
                    </div>

                </div>

            </div>

        <?php } ?>

       

        <div class="form-section" style="text-align: center;">
          
                <h2 style="margin-top: 80%;" >Update <br>Test Drive Booking Form</h2>
                <!-- <p>Fill out the form below to book your test drive. We'll contact you to confirm your appointment.</p> -->

                <form class="test-drive-form" id="testDriveForm" method="post">

                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first_name" placeholder="Enter your first name" value="<?php echo htmlspecialchars($result['first_name']) ?>">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last_name" placeholder="Enter your last name" value="<?php echo htmlspecialchars($result['last_name']) ?>">
                        <div class="error-message"></div>
                    </div>


                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($result['email']) ?>">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($result['phone']) ?>">
                        <div class="error-message"></div>
                    </div>


                    <div class="form-group">
                        <label for="model">Preferred BMW Model</label>
                        <select id="model" name="model">
                            <option value="">Select a model</option>
                            <option value="x5" <?php if (isset($result['model']) && $result['model'] == 'x5') echo 'selected'; ?>>BMW X5</option>
                            <option value="3series" <?php if (isset($result['model']) && $result['model'] == '3series') echo 'selected'; ?>>BMW 3 Series</option>
                            <option value="x3" <?php if (isset($result['model']) && $result['model'] == 'x3') echo 'selected'; ?>>BMW X3</option>
                            <option value="5series" <?php if (isset($result['model']) && $result['model'] == '5series') echo 'selected'; ?>>BMW 5 Series</option>
                            <option value="x1" <?php if (isset($result['model']) && $result['model'] == 'x1') echo 'selected'; ?>>BMW X1</option>
                            <option value="7series" <?php if (isset($result['model']) && $result['model'] == '7series') echo 'selected'; ?>>BMW 7 Series</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="preferred-date">Preferred Date</label>
                        <input type="date" id="preferred-date" name="preferred_date" value="<?php echo htmlspecialchars($result['preferred_date']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="preferred-time">Preferred Time</label>
                        <select id="preferred-time" name="preferred_time">
                            <option value="">Select a time</option>
                            <option value="9:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '9:00') echo 'selected'; ?>>9:00 AM</option>
                            <option value="10:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '10:00') echo 'selected'; ?>>10:00 AM</option>
                            <option value="11:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '11:00') echo 'selected'; ?>>11:00 AM</option>
                            <option value="12:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '12:00') echo 'selected'; ?>>12:00 PM</option>
                            <option value="13:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '13:00') echo 'selected'; ?>>1:00 PM</option>
                            <option value="14:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '14:00') echo 'selected'; ?>>2:00 PM</option>
                            <option value="15:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '15:00') echo 'selected'; ?>>3:00 PM</option>
                            <option value="16:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '16:00') echo 'selected'; ?>>4:00 PM</option>
                            <option value="17:00" <?php if (isset($result['preferred_time']) && $result['preferred_time'] == '17:00') echo 'selected'; ?>>5:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Preferred Location</label>
                        <select id="location" name="location">
                            <option value="">Select a location</option>
                            <option value="munich" <?php if (isset($result['location']) && $result['location'] == 'munich') echo 'selected'; ?>>BMW Munich Showroom</option>
                            <option value="berlin" <?php if (isset($result['location']) && $result['location'] == 'berlin') echo 'selected'; ?>>BMW Berlin Showroom</option>
                            <option value="hamburg" <?php if (isset($result['location']) && $result['location'] == 'hamburg') echo 'selected'; ?>>BMW Hamburg Showroom</option>
                            <option value="frankfurt" <?php if (isset($result['location']) && $result['location'] == 'frankfurt') echo 'selected'; ?>>BMW Frankfurt Showroom</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comments">Additional Comments</label>
                        <textarea id="comments" name="comments" placeholder="Any special requests or comments..." rows="4"><?php echo isset($result['comments']) ? htmlspecialchars($result['comments']) : ''; ?></textarea>
                    </div>

                    <button type="submit" name="book" class="submit-btn">Update Test Drive Form</button>
                </form>
            </div>

      
    </div>

    <!-- Available Time Slots Section -->
    <div class="time-slots-section">
        <h2>Available Time Slots</h2>
        <p>Select from our available time slots for your test drive.</p>
        <div class="time-slots-grid">
            <div class="time-slot" data-time="9:00 AM">9:00 AM</div>
            <div class="time-slot" data-time="10:00 AM">10:00 AM</div>
            <div class="time-slot" data-time="11:00 AM">11:00 AM</div>
            <div class="time-slot" data-time="12:00 PM">12:00 PM</div>
            <div class="time-slot" data-time="1:00 PM">1:00 PM</div>
            <div class="time-slot" data-time="2:00 PM">2:00 PM</div>
            <div class="time-slot" data-time="3:00 PM">3:00 PM</div>
            <div class="time-slot" data-time="4:00 PM">4:00 PM</div>
            <div class="time-slot" data-time="5:00 PM">5:00 PM</div>
        </div>
    </div>



  

    <?php
    include 'Footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>

</html>