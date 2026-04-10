<?php
include 'php/database.php';

session_start();

/* LOGIN CHECK */
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: user_login.php");
    exit();
}

include 'second_hadder.php';

$user_id = $_SESSION['user_id'];

/* GET BOOKED TIME SLOTS */
$booked_times = [];

$selected_date = date('Y-m-d'); // default today

if(isset($_POST['preferred_date'])){
    $selected_date = $_POST['preferred_date'];
}

$time_query = "SELECT preferred_time FROM test_drive 
WHERE preferred_date='$selected_date'";

$time_data = mysqli_query($cann,$time_query);

while($row = mysqli_fetch_assoc($time_data)){
    $booked_times[] = $row['preferred_time'];
}

/* GET USER BOOKING STATUS */
$status_query = "SELECT booking_status FROM test_drive 
WHERE user_id='$user_id' 
ORDER BY id DESC LIMIT 1";

$status_data = mysqli_query($cann, $status_query);
$status_row = mysqli_fetch_assoc($status_data);
$booking_status = $status_row['booking_status'] ?? '';

/* BOOK TEST DRIVE */
if (isset($_POST['book'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $model = $_POST['model'];
    $preferred_date = $_POST['preferred_date'];
    $preferred_time = $_POST['preferred_time'];
    $location = $_POST['location'];
    $comments = $_POST['comments'];

    /* CHECK IF SLOT ALREADY BOOKED */
    $check_query = "SELECT * FROM test_drive 
    WHERE preferred_date='$preferred_date' 
    AND preferred_time='$preferred_time'";

    $check_data = mysqli_query($cann,$check_query);

    if(mysqli_num_rows($check_data) > 0){

        echo "<script>alert('This time slot is already booked');</script>";

    }else{

        $query = "INSERT INTO test_drive 
        (user_id, first_name, last_name, email, phone, model, preferred_date, preferred_time, location, comments, booking_status) 
        VALUES 
        ('$user_id','$first_name','$last_name','$email','$phone','$model','$preferred_date','$preferred_time','$location','$comments','pending')";

        $data = mysqli_query($cann, $query);

        if($data){

            echo "<script>
            alert('Test drive booked successfully');
            window.location.href='Profile.php';
            </script>";

        }else{

            echo "<script>alert('Error booking test drive');</script>";

        }

    }

}

// display wishlist items to test drive page

$query = "SELECT cars.*, wishlist.id as wishlist_id
FROM wishlist
JOIN cars ON wishlist.product_id = cars.id
WHERE wishlist.user_id='$user_id'";
$data = mysqli_query($cann, $query);
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
        .booked{
background:#ccc;
pointer-events:none;
opacity:0.6;
}
    </style>
</head>

<body>




<div class="test-drive-container">

<div class="hero-section">
<h1 class="hero-title">Book Your BMW Test Drive</h1>
<p class="hero-subtitle">Experience the thrill of driving a BMW.</p>
</div>

<?php if ($booking_status != '') { ?>

<div class="status-container">

<h2>Your Test Drive Status</h2>

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
        

        <div class="form-section">
            <div class="form-card">
                <h2>Test Drive Booking Form</h2>
                <p>Fill out the form below to book your test drive. We'll contact you to confirm your appointment.</p>

                <form class="test-drive-form" id="testDriveForm" method="post">

                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first_name" placeholder="Enter your first name">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last_name" placeholder="Enter your last name">
                        <div class="error-message"></div>
                    </div>


                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                        <div class="error-message"></div>
                    </div>


                    <div class="form-group">
                        <label for="model">Preferred BMW Model</label>
                        <select id="model" name="model">
                            <option value="">Select a model</option>
                            <option value="x5">BMW X5</option>
                            <option value="3series">BMW 3 Series</option>
                            <option value="x3">BMW X3</option>
                            <option value="5series">BMW 5 Series</option>
                            <option value="x1">BMW X1</option>
                            <option value="7series">BMW 7 Series</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="preferred-date">Preferred Date</label>
                        <input type="date" id="preferred-date" name="preferred_date">
                    </div>

                    <div class="form-group">
                        <label for="preferred-time">Preferred Time</label>
                        <select id="preferred-time" name="preferred_time">
                            <option value="">Select a time</option>
                            <option value="9:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">1:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Preferred Location</label>
                        <select id="location" name="location">
                            <option value="">Select a location</option>
                            <option value="munich">BMW Munich Showroom</option>
                            <option value="berlin">BMW Berlin Showroom</option>
                            <option value="hamburg">BMW Hamburg Showroom</option>
                            <option value="frankfurt">BMW Frankfurt Showroom</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comments">Additional Comments</label>
                        <textarea id="comments" name="comments" placeholder="Any special requests or comments..." rows="4"></textarea>
                    </div>

                    <button type="submit" name="book" class="submit-btn">Book Test Drive</button>
                </form>
            </div>

            <div class="info-card">
                <h3>Test Drive Information</h3>
                <div class="info-item">
                    <h4>Duration</h4>
                    <p>Approximately 45-60 minutes</p>
                </div>
                <div class="info-item">
                    <h4>Requirements</h4>
                    <p>Valid driver's license, ID proof</p>
                </div>
                <div class="info-item">
                    <h4>Contact</h4>
                    <p>+1 (555) 123-4567</p>
                    <p>testdrive@bmw.com</p>
                </div>
                <div class="info-item">
                    <h4>Hours</h4>
                    <p>Mon-Fri: 9 AM - 6 PM</p>
                    <p>Sat: 10 AM - 4 PM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- AVAILABLE TIME SLOTS -->

<div class="time-slots-section">

<h2>Available Time Slots</h2>

<div class="time-slots-grid">

<?php

$slots = [
"9:00"=>"9:00 AM",
"10:00"=>"10:00 AM",
"11:00"=>"11:00 AM",
"12:00"=>"12:00 PM",
"13:00"=>"1:00 PM",
"14:00"=>"2:00 PM",
"15:00"=>"3:00 PM",
"16:00"=>"4:00 PM",
"17:00"=>"5:00 PM"
];

foreach($slots as $value=>$label){

if(!in_array($value,$booked_times)){

echo "<div class='time-slot'>$label</div>";

}else{

echo "<div class='time-slot booked'>$label</div>";

}

}

?>

</div>

</div>

    <!-- Car Preview Section -->
    <div class="car-preview-section">
        <h2>Car Preview</h2>
        <p>Take a closer look at the BMW models available for test drive.</p>
        <div class="car-preview-grid">
            <?php while($row = mysqli_fetch_assoc($data)): ?>
            <div class="car-preview-card">
                <img src="uploads/<?php echo $row['car_image']; ?>" alt="<?php echo $row['car_name']; ?>">
                <h3><?php echo $row['car_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
            </div>
            <?php endwhile; ?>
           
        </div>
    </div>

    <!-- Customer Reviews Section -->
    <div class="reviews-section">
        <h2>Customer Reviews</h2>
        <p>Hear what our customers have to say about their BMW test drive experience.</p>
        <div class="reviews-grid">
            <div class="review-card">
                <div class="review-stars">★★★★★</div>
                <p>"Amazing experience! The BMW X5 drove like a dream. Highly recommend!"</p>
                <cite>- John Doe</cite>
            </div>
            <div class="review-card">
                <div class="review-stars">★★★★☆</div>
                <p>"Great handling and comfort. The 3 Series is perfect for city driving."</p>
                <cite>- Jane Smith</cite>
            </div>
            <div class="review-card">
                <div class="review-stars">★★★★★</div>
                <p>"Loved the X3! Smooth ride and excellent features."</p>
                <cite>- Mike Johnson</cite>
            </div>
        </div>
    </div>

    <?php
    include 'Footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>
</html>