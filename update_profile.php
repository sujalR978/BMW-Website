<?php
include 'php/database.php';

session_start();

$id = $_SESSION['user_id']; // Get the user ID from the session

$query = "SELECT * FROM register_page WHERE id = '$id'";
$data = mysqli_query($cann, $query);
$result = mysqli_fetch_assoc($data);


//update query
if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if($password == $result['password']) {

        $image_updated = false;
        $new_image_name = null;
        
        // Handle image upload - ONLY if image is provided
        if (!empty($_FILES['profile_image']['name'])) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];

            if (in_array($_FILES['profile_image']['type'], $allowed_types)) {
                $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $new_name = $id . "." . $extension;
                $upload_path = "uploads/" . $new_name;

                // Delete old images with different extensions
                $extensions = ['jpg', 'jpeg', 'png'];
                foreach ($extensions as $ext) {
                    $old_file = "uploads/" . $id . "." . $ext;
                    if (file_exists($old_file) && $ext !== $extension) {
                        unlink($old_file);
                    }
                }

                // Upload new image
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                    $image_updated = true;
                    $new_image_name = $new_name;
                }
            } else {
                die("Only JPG and PNG files allowed.");
            }
        }

        // Update database with new profile data (and image if updated)
        $query = "UPDATE register_page SET name='$name', email='$email', phone_number='$phone' WHERE id='$id'";
        $data = mysqli_query($cann, $query);

    
        if ($data) { 

            // Redirect to home page
            header("Location: Profile.php");
            exit();
            

        } 
        else {

            $error_message = "Registration failed. Please try again.";

        }

    }
    else{
        echo "wrong password";
    }


 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- link to stylesheet -->
    <link rel="stylesheet" href="css/update_profile.css">
</head>
<body>

    <!-- Static HTML version of the profile edit form -->
    <section class="edit-profile-container">
        <h2>Edit Your Profile</h2>
        <form class="profile-form" method="post" enctype="multipart/form-data">
            <div class="form-group image-group">
                <label>Profile Picture</label>
                <div class="image-preview">
                    <span>No image</span>
                </div>
                <input type="file" name="profile_image" accept="image/*">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($result['name']); ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($result['email']); ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($result['phone_number']); ?>">
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password"  >
                <label class="password-note">*Enter your current password to save changes</label>
            </div>
          
            <div class="form-group theme-group">
                <label>Theme</label>
                <select name="theme" id="themeSelect">
                    <option value="default" selected>Default</option>
                    <option value="dark">Dark</option>
                </select>
            </div>
            <div class="form-buttons">
                <button type="submit" name=update class="btn-dark">Save Changes</button>
                <button type="reset" class="btn-outline">Cancel</button>
            </div>
        </form>
    </section>

</body>
</html>
