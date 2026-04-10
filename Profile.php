<?php
ob_start();
include 'php/database.php';
session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: user_login.php');
    exit();
}

include 'second_hadder.php';

    // Show success message if inquiry was submitted
    if (isset($_SESSION['success_msg'])) {
        echo "<div style='position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 15px 20px; border-radius: 4px; z-index: 1000;'>" . $_SESSION['success_msg'] . "</div>";
        unset($_SESSION['success_msg']);
    }
 
  //live data fetching for profile
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM register_page WHERE id = '$user_id'";
    $data = mysqli_query($cann, $query);
    $result = mysqli_fetch_assoc($data);

  // Fetch wishlist and cart counts for the user
    $other_query ="SELECT cars.*, wishlist.id as wishlist_id
    FROM wishlist
    JOIN cars ON wishlist.product_id = cars.id
    WHERE wishlist.user_id='$user_id'";
    $other_data = mysqli_query($cann, $other_query);
    if (!$other_data) {
        $other_data = false;
    }

    // Fetch upcoming test drive details for the user
    $test_drive_query = "SELECT * FROM test_drive WHERE user_id='$user_id' ";
    $test_drive_data = mysqli_query($cann, $test_drive_query);
    if (!$test_drive_data) {
        $test_drive_data = false;
    }

    // Fetch inquiries for the user
    $inquiry_query = "SELECT * FROM bmw_inquiries WHERE user_id='$user_id' ORDER BY id DESC";
    $inquiry_data = mysqli_query($cann, $inquiry_query);
    if (!$inquiry_data) {
        $inquiry_data = false;
    }

    // Fetch contacts for the user
    $contact_query = "SELECT * FROM bmw_contacts WHERE user_id='$user_id' ORDER BY id DESC";
    $contact_data = mysqli_query($cann, $contact_query);
    if (!$contact_data) {
        $contact_data = false;
    }

    // Fetch feedback for the user
    $feedback_query = "SELECT * FROM bmw_feedback WHERE user_id='$user_id' ORDER BY id DESC LIMIT 10";
    $feedback_data = mysqli_query($cann, $feedback_query);
    if (!$feedback_data) {
        $feedback_data = false;
    }

    // Fetch orders for the user
    $orders_query = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC LIMIT 10";
    $orders_data = mysqli_query($cann, $orders_query);
    if (!$orders_data) {
        $orders_data = false;
    }

    // Function to fetch order items
    function getReplies($inquiry_id, $cann) {
        // Check if replies table exists
        $check_table = "SHOW TABLES LIKE 'bmw_replies'";
        $table_check = mysqli_query($cann, $check_table);
        
        if ($table_check && mysqli_num_rows($table_check) > 0) {
            $query = "SELECT * FROM bmw_replies WHERE inquiry_id='$inquiry_id' ORDER BY created_at DESC";
            $result = mysqli_query($cann, $query);
            return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
        }
        return [];
    }

    // Function to fetch contact replies
    function getContactReplies($contact_id, $cann) {
        // Check if contact_replies table exists
        $check_table = "SHOW TABLES LIKE 'bmw_contact_replies'";
        $table_check = mysqli_query($cann, $check_table);
        
        if ($table_check && mysqli_num_rows($table_check) > 0) {
            $query = "SELECT * FROM bmw_contact_replies WHERE contact_id='$contact_id' ORDER BY created_at DESC";
            $result = mysqli_query($cann, $query);
            return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
        }
        return [];
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="header-footer.css">
  <link rel="stylesheet" href="inquiries.css">
  <style>
    /* Fix for quick navigation overlapping the bottom navigation (footer) */
    .profile-layout-wrapper {
      display: flex;
      align-items: flex-start;
    }
    .profile-nav-sidebar {
      /* Change from fixed to sticky so it stops before the footer */
      position: sticky !important;
      top: 100px !important;
      height: calc(100vh - 100px) !important;
      z-index: 100;
    }
    .profile-main-content {
      flex: 1;
      /* Override the hardcoded fixed 220px margin since layout is now flex */
      margin-left: 20px !important;
      min-width: 0; /* Prevent flex children from overflowing */
    }
  </style>
</head>
<body>
  
<!-- Navigation Sidebar with Quick Links -->
<div class="profile-layout-wrapper">
<div class="profile-nav-sidebar" id="profileNav" style="position: fixed; left: 0; top: 100px; width: 200px; background: #f8f9fa; border-right: 2px solid #ddd; padding: 20px 0; height: calc(100vh - 100px); overflow-y: auto; z-index: 100;">
  <div style="padding: 0 15px; margin-bottom: 20px;">
    <h4 style="margin: 0 0 15px 0; color: #333; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Quick Navigation</h4>
    <ul style="list-style: none; padding: 0; margin: 0;">
      <li><a href="#profile-info" onclick="scrollToSection('profile-info')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">👤 Profile</a></li>
      <li><a href="#vehicles-section" onclick="scrollToSection('vehicles-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">🚗 Vehicles</a></li>
      <li><a href="#saved-cars-section" onclick="scrollToSection('saved-cars-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">❤️ Saved Cars</a></li>
      <li><a href="#test-drive-section" onclick="scrollToSection('test-drive-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">⏰ Test Drives</a></li>
      <li><a href="#inquiries-section" onclick="scrollToSection('inquiries-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">❓ Inquiries</a></li>
      <li><a href="#contact-messages-section" onclick="scrollToSection('contact-messages-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">💬 Messages</a></li>
      <li><a href="#feedback-section" onclick="scrollToSection('feedback-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">⭐ Feedback</a></li>
      <li><a href="#orders-section" onclick="scrollToSection('orders-section')" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s;" onmouseover="this.style.borderLeftColor='#667eea'; this.style.background='#e8ecff';" onmouseout="this.style.borderLeftColor='transparent'; this.style.background='transparent';">🛒 Orders</a></li>
    </ul>
  </div>
</div>

<!-- Main Content Area with Left Margin -->
<div class="profile-main-content" style="margin-left: 220px;">

    <br>
    <br>
      <br>

<!-- Profile Section -->
<section class="profile" id="profile-info">
  <div class="profile-left">
   
    <!-- <img class="profile-pic" src="img/profile1.jpg" alt="Profile Picture"> -->
    <?php
$extensions = ['jpg', 'jpeg', 'png'];
$image_found = false;

foreach ($extensions as $ext) {
    $image_path = "uploads/" . $_SESSION['user_id'] . "." . $ext;
    if (file_exists($image_path)) {
        // Add cache-busting parameter with file modification time
        $cache_bust = filemtime($image_path);
        echo '<img class="profile-pic" src="' .$image_path.'?v='.$cache_bust.'" width="150">';
        $image_found = true;
        break;
    }
    else{
      
      // echo '<img class="profile-pic" src="img/profile1.jpg" alt="Profile Picture" width="150">';
    }
}

if (!$image_found) {
    echo '<img class="profile-pic" src="img/profile1.jpg" alt="Profile Picture" width="150">';
}
?>

    <div class="profile-info">
      
      <h2><?php echo htmlspecialchars($result['name']); ?></h2>
      <h4><?php echo htmlspecialchars($result['email']); ?></h4>
      <!-- <h4></h4> -->
      <div class="badges">
        <span>Trustworthy Customer</span>
      </div>
      <p>Welcome to your exclusive BMW profile.</p>
    </div>
  </div>

  <div class="profile-actions">
    <a href="log-out.php" class="btn-outline">Log out</a>
    <a href="update_profile.php?id=<?php echo htmlspecialchars($result['id']); ?>" class="btn-dark">Edit Profile</a>
  </div>
</section>

<hr>

<!-- My Vehicles -->
<section class="vehicles-section" id="vehicles-section">
  <div class="vehicles-header">
    <div>
      <h2>My Vehicles</h2>
      <p>Your current BMW vehicles.</p>
    </div>

    <div class="vehicle-buttons">
      <button class="btn-outline" type="submit" onclick="window.location.href='car_models.php'" >View All</button>
      <button class="btn-dark" onclick="window.location.href='test_drive.php?redirect=profile#test-drive-section'">🆕 Book Test Drive</button>
    </div>
  </div>

  <div class="vehicles">
    <div class="vehicle-card">
  
      <img class="vehicle-icon" src="img/bmw-5-series.jpg" alt="BMW 5 Series">
      <strong>BMW 5 Series</strong>
      <small>2022 model</small>
      <h4>M Sport Package</h4>
    </div>

    <div class="vehicle-card">
      <img class="vehicle-icon" src="img/bmw-x3-img.jpg" alt="BMW X3">
      <strong>BMW X3</strong>
      <small>2021 model</small>
      <h4>Premium Package</h4>
    </div>
  </div>
</section>

<!-- Saved Cars -->
<section class="saved-cars-section" id="saved-cars-section">

  <div class="section-header">
    <h2>Your Saved Cars</h2>
    <p>Cars you've saved for later viewing.</p>
  </div> <div class="saved-cars-grid">    <?php if($other_data && mysqli_num_rows($other_data) > 0): ?>    <?php while($other_result = mysqli_fetch_assoc($other_data)): ?>
 
    <div class="saved-car-card">
      <img src="uploads/<?php echo $other_result['car_image']?>" alt="BMW X5">
      <h3><?php echo $other_result['car_name'] ?></h3>
      <p><?php echo $other_result['price'] ?></p>
      <button type="submit" onclick="window.location.href='remove_wishlist.php?id=<?php echo $other_result['wishlist_id'] ?>'" class="remove-btn">Remove</button>
  </div>
  <?php endwhile; ?>
    <?php else: ?>
    <p>No saved cars yet.</p>
    <?php endif; ?>
   
</section>

<!-- Comparison Car -->
<section class="comparison-section">
  <div class="section-header">
    <h2>Car Comparison</h2>
    <p>Compare your favorite BMW models.</p>
  </div>
  <div class="comparison-table">
    <div class="comparison-row header">
      <div>Feature</div>
      <div>BMW X5</div>
      <div>BMW 3 Series</div>
    </div>
    <div class="comparison-row">
      <div>Price</div>
      <div>$55,000</div>
      <div>$42,000</div>
    </div>
    <div class="comparison-row">
      <div>Fuel Type</div>
      <div>Petrol</div>
      <div>Petrol</div>
    </div>
    <div class="comparison-row">
      <div>Engine</div>
      <div>3.0L Turbo</div>
      <div>2.0L Turbo</div>
    </div>
    <div class="comparison-row">
      <div>Horsepower</div>
      <div>375 hp</div>
      <div>255 hp</div>
    </div>
  </div>
</section>

<!-- Owned Vehicle Service History -->
<section class="service-history-section">
  <div class="section-header">
    <h2>Owned Vehicle Service History</h2>
    <p>Track maintenance and service records for your vehicles.</p>
  </div>
  <div class="service-history">
    <div class="service-card">
      <h3>BMW 5 Series - Oil Change</h3>
      <p>Date: 2024-10-15</p>
      <p>Mileage: 25,000 miles</p>
      <p>Cost: $150</p>
    </div>
    <div class="service-card">
      <h3>BMW X3 - Tire Replacement</h3>
      <p>Date: 2024-09-20</p>
      <p>Mileage: 20,000 miles</p>
      <p>Cost: $400</p>
    </div>
    <div class="service-card">
      <h3>BMW 5 Series - Brake Inspection</h3>
      <p>Date: 2024-08-05</p>
      <p>Mileage: 18,000 miles</p>
      <p>Cost: $100</p>
    </div>
  </div>
</section>

<!-- Upcoming Test Drive -->
<section class="test-drive-section" id="test-drive-section">
  <div class="section-header">
    <h2>Upcoming Test Drives</h2>
    <p>Your scheduled test drive appointments.</p>
    <a href="test_drive.php?redirect=profile#test-drive-section" class="btn-dark" style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; margin-top: 10px; font-weight: 600;">🆕 New Test Drive</a>
  </div>

<?php
if($test_drive_data && mysqli_num_rows($test_drive_data) > 0){

while($test_drive_result = mysqli_fetch_assoc($test_drive_data)){
?>

  <div class="test-drive-card">

    <img class="test-drive-icon" 
src="uploads/<?php echo $test_drive_result['model']; ?>.jpg"
    style="width:100%; border-radius:8px; border:2px solid #000000; margin-bottom:15px;">


    <h3><?php echo $test_drive_result['model']; ?> Test Drive</h3>

    <p><strong>Date:</strong> <?php echo $test_drive_result['preferred_date']; ?></p>
    <p><strong>Time:</strong> <?php echo $test_drive_result['preferred_time']; ?></p>
    <p><strong>Location:</strong> <?php echo $test_drive_result['location']; ?></p>
    <p><strong>Status:</strong> <?php echo $test_drive_result['booking_status']; ?></p>

    <button type="button"
    onclick="window.location.href='update_test_drive.php?id=<?php echo $test_drive_result['id']; ?>'"
    class="reschedule-btn">
    Reschedule
    </button>

    <button type="button"
    onclick="window.location.href='delete_test_drive.php?id=<?php echo $test_drive_result['id']; ?>'"
    class="cancel-btn">
    Cancel
    </button>

  </div>




<?php
}

}else{

echo "<p>No upcoming test drives.</p>";
}
?>


</section>


<!-- View Inquiries -->
<section class="inquiries-section" id="inquiries-section">
  <div class="section-header">
    <h2>Your Inquiries</h2>
    <p>View all your submitted inquiries.</p>
    <a href="view_inquire.php?redirect=profile#inquiries-section" class="btn-dark" style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; margin-top: 10px; font-weight: 600;">🆕 New Inquiry</a>
  </div>

  <?php
  if($inquiry_data && mysqli_num_rows($inquiry_data) > 0){
    while($inquiry_result = mysqli_fetch_assoc($inquiry_data)){
      $replies = getReplies($inquiry_result['id'], $cann);
  ?>

  <div class="inquiry-card">
    <div style="display: flex; justify-content: space-between; align-items: start;">
      <div style="flex: 1;">
        <h3><?php echo htmlspecialchars($inquiry_result['subject']); ?></h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($inquiry_result['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($inquiry_result['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($inquiry_result['phone']); ?></p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($inquiry_result['message']); ?></p>
        
        <?php if(!empty($inquiry_result['image'])): ?>
          <div style="margin-top: 15px;">
            <img src="<?php echo htmlspecialchars($inquiry_result['image']); ?>" alt="Inquiry Image">
          </div>
        <?php endif; ?>
      </div>
    </div>
    
    <!-- Replies Section -->
    <?php if(!empty($replies)): ?>
      <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e0e0e0;">
        <h4 style="color: #4CAF50; margin-bottom: 15px;">💬 Admin Replies (<?php echo count($replies); ?>)</h4>
        
        <?php foreach($replies as $reply): ?>
          <div style="background: linear-gradient(135deg, #f0f7f0, #e8f5e9); border-left: 4px solid #4CAF50; padding: 15px; margin-bottom: 12px; border-radius: 6px;">
            <div style="margin-bottom: 8px;">
              <span style="background: #4CAF50; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">🏢 BMW Support</span>
              <span style="color: #666; font-size: 12px; margin-left: 10px;">
                <?php echo isset($reply['created_at']) ? date('M d, Y - H:i', strtotime($reply['created_at'])) : 'N/A'; ?>
              </span>
            </div>
            <p style="margin: 0; color: #333; line-height: 1.6; white-space: pre-wrap;">
              <?php echo htmlspecialchars($reply['reply_message']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div style="margin-top: 15px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 6px;">
        <p style="margin: 0; color: #856404; font-size: 14px;">⏳ Waiting for admin reply...</p>
      </div>
    <?php endif; ?>
    
    <div class="inquiry-actions">
      <a href="update_view_inquire.php?id=<?php echo $inquiry_result['id']; ?>" class="btn-outline">📝 Update Inquiry</a>
      <a href="delete_inquire.php?id=<?php echo $inquiry_result['id']; ?>" class="cancel-btn" onclick="return confirm('Are you sure you want to delete this inquiry?');">🗑️ Delete</a>
    </div>
  </div>

  <?php
    }
  } else {
    echo "<p style='text-align: center; padding: 20px;'>No inquiries submitted yet. <a href='view_inquire.php' style='color: #0066cc;'>Create one now</a></p>";
  }
  ?>

</section>

<!-- Contact Messages Section -->
<section class="inquiries-section" id="contact-messages-section">
  <div class="section-header">
    <h2>Your Contact Messages</h2>
    <p>View all your contact messages and responses.</p>
    <a href="contact.php?redirect=profile#contact-messages-section" class="btn-dark" style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; margin-top: 10px; font-weight: 600;">🆕 New Message</a>
  </div>

  <?php
  if($contact_data && mysqli_num_rows($contact_data) > 0){
    while($contact_result = mysqli_fetch_assoc($contact_data)){
      $contact_replies = getContactReplies($contact_result['id'], $cann);
  ?>

  <div class="inquiry-card">
    <div style="display: flex; justify-content: space-between; align-items: start;">
      <div style="flex: 1;">
        <h3><?php echo htmlspecialchars($contact_result['subject']); ?></h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($contact_result['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($contact_result['email']); ?></p>
        <p><strong>Type:</strong> 
          <span style="display: inline-block; padding: 4px 10px; background: #e3f2fd; color: #0066cc; border-radius: 4px; font-weight: 600; font-size: 12px;">
            <?php echo htmlspecialchars($contact_result['inquiry_type']); ?>
          </span>
        </p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($contact_result['message']); ?></p>
      </div>
    </div>
    
    <!-- Contact Replies Section -->
    <?php if(!empty($contact_replies)): ?>
      <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e0e0e0;">
        <h4 style="color: #4CAF50; margin-bottom: 15px;">💬 Admin Replies (<?php echo count($contact_replies); ?>)</h4>
        
        <?php foreach($contact_replies as $reply): ?>
          <div style="background: linear-gradient(135deg, #f0f7f0, #e8f5e9); border-left: 4px solid #4CAF50; padding: 15px; margin-bottom: 12px; border-radius: 6px;">
            <div style="margin-bottom: 8px;">
              <span style="background: #4CAF50; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">🏢 BMW Support</span>
              <span style="color: #666; font-size: 12px; margin-left: 10px;">
                <?php echo isset($reply['created_at']) ? date('M d, Y - H:i', strtotime($reply['created_at'])) : 'N/A'; ?>
              </span>
            </div>
            <p style="margin: 0; color: #333; line-height: 1.6; white-space: pre-wrap;">
              <?php echo htmlspecialchars($reply['reply_message']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div style="margin-top: 15px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 6px;">
        <p style="margin: 0; color: #856404; font-size: 14px;">⏳ Waiting for admin reply...</p>
      </div>
    <?php endif; ?>
    
    <div class="inquiry-actions">
      <a href="update_contact.php?id=<?php echo $contact_result['id']; ?>" class="btn-outline">📝 Update Message</a>
      <a href="delete_contact.php?id=<?php echo $contact_result['id']; ?>" class="cancel-btn" onclick="return confirm('Are you sure you want to delete this message?');">🗑️ Delete</a>
    </div>
  </div>

  <?php
    }
  } else {
    echo "<p style='text-align: center; padding: 20px;'>No contact messages submitted yet. <a href='contact.php' style='color: #0066cc;'>Send one now</a></p>";
  }
  ?>

</section>

    <br>
    <br>
    <br>
    <br>

<!-- Your Feedback Section -->
<section class="inquiries-section" id="feedback-section">
  <div class="section-header">
    <h2>Your Feedback</h2>
    <p>Share your experience with new feedback and track all your submissions.</p>
    <a href="feedback.php?redirect=profile#feedback-section" class="btn-dark" style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; margin-top: 10px; font-weight: 600;">🆕 Submit Feedback</a>
  </div>

  <?php
  if($feedback_data && mysqli_num_rows($feedback_data) > 0){
    while($feedback_result = mysqli_fetch_assoc($feedback_data)){
      $rating_stars = str_repeat('⭐', $feedback_result['rating']);
  ?>

  <div class="inquiry-card" style="border-left: 5px solid <?php echo ($feedback_result['is_negative'] == 1) ? '#dc3545' : '#28a745'; ?>; 
       background: <?php echo ($feedback_result['is_negative'] == 1) ? '#fff5f5' : '#f0fff4'; ?>;">
    
    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
      <div>
        <h3 style="margin: 0 0 5px 0; color: #333;"><?php echo htmlspecialchars($feedback_result['feedback_type']); ?> Feedback</h3>
        <p style="margin: 0; color: #666; font-size: 0.9rem;"><?php echo date('F j, Y - g:i A', strtotime($feedback_result['created_at'])); ?></p>
      </div>
      <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; 
                   background: <?php echo ($feedback_result['is_negative'] == 1) ? '#ffe0e0' : '#e0f0e0'; ?>;
                   color: <?php echo ($feedback_result['is_negative'] == 1) ? '#d32f2f' : '#388e3c'; ?>;">
        <?php echo ($feedback_result['is_negative'] == 1) ? '⚠️ NEGATIVE' : '✓ POSITIVE'; ?>
      </span>
    </div>

    <div style="margin: 12px 0; font-size: 1.1rem; color: #ffc107;">
      <?php echo $rating_stars; ?> <span style="color: #666; font-size: 0.9rem;">(<?php echo $feedback_result['rating']; ?>/5)</span>
    </div>

    <div style="margin: 15px 0; padding: 12px; background: white; border-radius: 6px; border-left: 3px solid #667eea;">
      <p style="margin: 0; color: #333; line-height: 1.6;">
        <?php echo htmlspecialchars($feedback_result['message']); ?>
      </p>
    </div>

    <?php if (!empty($feedback_result['image_url'])): ?>
    <div style="margin: 15px 0;">
      <img src="uploads/feedback/<?php echo $feedback_result['image_url']; ?>" alt="Feedback Image" 
           style="max-height: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    </div>
    <?php endif; ?>

    <div class="inquiry-actions">
      <a href="feedback.php?edit=<?php echo $feedback_result['id']; ?>" class="btn-outline">✎ Update Feedback</a>
      <a href="delete_feedback.php?id=<?php echo $feedback_result['id']; ?>" class="cancel-btn" 
         onclick="return confirm('Are you sure you want to delete this feedback?');">🗑️ Delete</a>
    </div>
  </div>

  <?php
    }
  } else {
    echo "<p style='text-align: center; padding: 20px; background: white; border-radius: 8px;'>No feedback submitted yet. <a href='feedback.php' style='color: #0066cc; font-weight: 600;'>Share your feedback now</a></p>";
  }
  ?>

  <div style="margin-top: 20px; text-align: center;">
    <a href="feedback.php?redirect=profile#feedback-section" class="btn-outline" style="display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
       color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">
      ➕ Submit New Feedback
    </a>
  </div>

</section>

    <br>
    <br>
    <br>
    <br>

<!-- Your Orders Section -->
<section class="inquiries-section" id="orders-section">
  <div class="section-header">
    <h2>Your Orders</h2>
    <p>Track and manage all your BMW car orders.</p>
  </div>

  <?php
  if($orders_data && mysqli_num_rows($orders_data) > 0){
    while($order_result = mysqli_fetch_assoc($orders_data)){
      $order_items_query = "SELECT order_items.*, cars.car_name, cars.car_image FROM order_items JOIN cars ON order_items.car_id = cars.id WHERE order_items.order_id=" . $order_result['id'];
      $order_items = mysqli_query($cann, $order_items_query);
      $items_array = mysqli_fetch_all($order_items, MYSQLI_ASSOC);
  ?>

  <div class="inquiry-card" style="border-left: 5px solid #667eea; background: #f0f3ff;">
    
    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px; flex-wrap: wrap;">
      <div>
        <h3 style="margin: 0 0 5px 0; color: #333;">Order #<?php echo str_pad($order_result['id'], 5, '0', STR_PAD_LEFT); ?></h3>
        <p style="margin: 0; color: #666; font-size: 0.9rem;">📅 <?php echo date('F j, Y - g:i A', strtotime($order_result['created_at'])); ?></p>
      </div>
      <span style="padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; 
                   background: <?php 
                     if ($order_result['order_status'] == 'completed') echo '#d4edda';
                     elseif ($order_result['order_status'] == 'shipped') echo '#cfe2ff';
                     elseif ($order_result['order_status'] == 'cancelled') echo '#f8d7da';
                     else echo '#fff3cd';
                   ?>;
                   color: <?php 
                     if ($order_result['order_status'] == 'completed') echo '#155724';
                     elseif ($order_result['order_status'] == 'shipped') echo '#084298';
                     elseif ($order_result['order_status'] == 'cancelled') echo '#721c24';
                     else echo '#856404';
                   ?>;">
        <?php 
          $status_icon = '⏳';
          if ($order_result['order_status'] == 'completed') $status_icon = '✓';
          elseif ($order_result['order_status'] == 'shipped') $status_icon = '📦';
          elseif ($order_result['order_status'] == 'cancelled') $status_icon = '✕';
          
          echo $status_icon . ' ' . ucfirst($order_result['order_status']);
        ?>
      </span>
    </div>

    <!-- Order Items -->
    <div style="margin: 15px 0; padding: 15px; background: white; border-radius: 8px; border-left: 3px solid #667eea;">
      <h4 style="color: #333; margin: 0 0 12px 0; font-size: 1rem;">Cars in this order:</h4>
      <?php 
      foreach ($items_array as $item) {
          echo "
          <div style='display: flex; gap: 12px; margin-bottom: 10px; padding: 10px; background: #f8f9fa; border-radius: 6px; align-items: center; cursor: pointer; transition: all 0.3s;' 
               onmouseover=\"this.style.background='#e8ecff'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.2)';\" 
               onmouseout=\"this.style.background='#f8f9fa'; this.style.boxShadow='none';\"
               onclick=\"window.location.href='learn_more.php?id={$item['car_id']}'\" >
            <img src='uploads/{$item['car_image']}' alt='{$item['car_name']}' style='width: 60px; height: 60px; border-radius: 6px; object-fit: cover;'>
            <div style='flex: 1;'>
              <p style='margin: 0; color: #333; font-weight: 600;'>{$item['car_name']}</p>
              <p style='margin: 0; color: #666; font-size: 0.9rem;'>Price: ₹" . number_format($item['price'], 2) . "</p>
              <p style='margin: 5px 0 0 0; color: #667eea; font-size: 0.85rem; font-weight: 600;'>Click to view full details →</p>
            </div>
          </div>
          ";
      }
      ?>
    </div>

    <!-- Order Details -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 15px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
      <div>
        <p style="margin: 0 0 5px 0; color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Payment Method</p>
        <p style="margin: 0; color: #333; font-weight: 600;"><?php echo ucfirst(str_replace('_', ' ', $order_result['payment_method'])); ?></p>
      </div>
      <div>
        <p style="margin: 0 0 5px 0; color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Amount</p>
        <p style="margin: 0; color: #667eea; font-weight: 700; font-size: 1.1rem;">₹<?php echo number_format($order_result['total_amount'], 2); ?></p>
      </div>
      <div>
        <p style="margin: 0 0 5px 0; color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Shipping Address</p>
        <p style="margin: 0; color: #333; font-size: 0.9rem;"><?php echo htmlspecialchars(substr($order_result['shipping_address'], 0, 40)); ?>...</p>
      </div>
    </div>

    <div class="inquiry-actions">
      <a href="order_details.php?id=<?php echo $order_result['id']; ?>" class="btn-outline" style="text-decoration: none;">📋 View Order Details</a>
      <a href="contact.php" class="btn-outline" style="text-decoration: none;">📞 Contact Support</a>
    </div>
  </div>

  <?php
    }
  } else {
    echo "<p style='text-align: center; padding: 20px; background: white; border-radius: 8px;'>No orders yet. <a href='car_models.php' style='color: #0066cc; font-weight: 600;'>Start shopping now</a></p>";
  }
  ?>

</section>

    <br>

</div> <!-- End of Main Content Area -->
</div> <!-- End of Layout wrapper -->

<!-- Scroll to Section Script -->
<script>
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    // Update URL without reload
    window.history.pushState({}, '', '#' + sectionId);
  }
}

// Handle on page load with hash
window.addEventListener('load', function() {
  const hash = window.location.hash.substring(1);
  if (hash) {
    setTimeout(() => {
      scrollToSection(hash);
    }, 500);
  }
});

// Also handle if redirect parameter is in URL
document.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const redirect = urlParams.get('redirect');
  const section = urlParams.get('section');
  
  if (redirect === 'profile' && window.location.hash) {
    setTimeout(() => {
      scrollToSection(window.location.hash.substring(1));
    }, 300);
  }
});
</script>

    <br>  
    <br>
    <br>
    <br>
        <?php
            include 'Footer.php';
        ?>
</body>
</html>
