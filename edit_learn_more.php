   <?php
    include 'php/database.php';
    include 'admin_hader.php';

$id = $_GET['id'] ?? 0;
    if (isset($_POST['add_car'])) {

        $performance = $_POST['performance'] ?? '';
        $efficiency = $_POST['efficiency'] ?? '';
        $safety = $_POST['safety'] ?? '';
        $engine = $_POST['engine'] ?? '';
        $horsepower = $_POST['horsepower'] ?? '';
        $torque = $_POST['torque'] ?? '';
        $transmission = $_POST['transmission'] ?? '';
        $drivetrain = $_POST['drivetrain'] ?? '';
        $seating = $_POST['seating'] ?? '';
        $cargo_space = $_POST['cargo_space'] ?? '';
        $fuel_economy = $_POST['fuel_economy'] ?? '';

        $features = isset($_POST['features']) ? implode(', ', $_POST['features']) : '';




        

        /* get previous gallery images */
        $old_query = "SELECT gallery FROM car_learn_more WHERE id='$id'";
        $old_result = mysqli_query($cann, $old_query);
        $old_data = mysqli_fetch_assoc($old_result);
        $old_gallery = $old_data['gallery'];


        /* CHECK IF NEW IMAGE UPLOADED */

        if (!empty($_FILES['gallery']['name'][0])) {

            $gallery_names = [];

            foreach ($_FILES['gallery']['tmp_name'] as $key => $tmp_name) {

                $image_name = time() . "_" . $_FILES['gallery']['name'][$key];
                $folder = "uploads/" . $image_name;

                move_uploaded_file($tmp_name, $folder);

                $gallery_names[] = $image_name;
            }

            $gallery = implode(",", $gallery_names);
        } else {

            // keep old images
            $gallery = $old_gallery;
        }

        $query = "UPDATE car_learn_more SET performance='$performance', efficiency='$efficiency', safety='$safety', engine='$engine', horsepower='$horsepower', torque='$torque', transmission='$transmission', drivetrain='$drivetrain', seating='$seating', cargo_space='$cargo_space', fuel_economy='$fuel_economy', features='$features', gallery='$gallery' WHERE id = $id";

        $data = mysqli_query($cann, $query);


        if ($data) {
            echo "<script>alert('Content saved successfully!');</script>";
            header("Location: admin_learn_more.php");
            exit;
        } else {
            echo "<script>alert('Failed to save content. Please try again.');</script>";
        }
    } else {
        // echo "<script>alert('Please fill in all fields.');</script>";
    }





    $query = "SELECT * FROM car_learn_more WHERE id = $id";
    $result = mysqli_query($cann, $query);
    $data = mysqli_fetch_assoc($result);
    $total = mysqli_num_rows($result);




    ?>

   <br>
   <br>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Admin - Update Learn More Page</title>
       <link rel="stylesheet" href="admin_learn_more.css">
       <link rel="stylesheet" href="css/form-validation.css">
       <link rel="stylesheet" href="css/admin_inventory.css">
   </head>

   <body>

       <main class="admin-container">
           <header class="admin-header">
               <h1>Update Learn More Page</h1>
               <p>Manage the content for the Learn More page</p>
           </header>

           <form class="admin-form" id="learnMoreForm" action="#" method="post" enctype="multipart/form-data">
               <!-- Overview Section -->
               <section class="form-section">
                   <h2>Overview</h2>
                   <div class="overview-fields">
                       <div class="field">
                           <input type="text" id="performance" name="performance" value="<?php echo $data['performance']; ?>">

                           <label for="performance">Performance</label>
                       </div>
                       <div class="field">
                           <input type="text" id="efficiency" name="efficiency" value="<?php echo $data['efficiency']; ?>">
                           <label for="efficiency">Efficiency</label>
                       </div>
                       <div class="field">
                           <input type="text" id="safety" name="safety" value="<?php echo $data['safety']; ?>  ">
                           <label for="safety">Safety</label>
                       </div>
                   </div>
               </section>

               <!-- Specifications Section -->
               <section class="form-section">
                   <h2>Specifications</h2>
                   <div class="specs-grid">
                       <div class="field">
                           <input type="text" id="engine" name="engine" value="<?php echo $data['engine']; ?>">
                           <label for="engine">Engine</label>
                       </div>
                       <div class="field">
                           <input type="text" id="horsepower" name="horsepower" value="<?php echo $data['horsepower']; ?>">
                           <label for="horsepower">Horsepower</label>
                       </div>
                       <div class="field">
                           <input type="text" id="torque" name="torque" value="<?php echo $data['torque']; ?>">
                           <label for="torque">Torque</label>
                       </div>
                       <div class="field">
                           <input type="text" id="transmission" name="transmission" value="<?php echo $data['transmission']; ?> ">
                           <label for="transmission">Transmission</label>
                       </div>
                       <div class="field">
                           <input type="text" id="drivetrain" name="drivetrain" value="<?php echo $data['drivetrain']; ?>">
                           <label for="drivetrain">Drivetrain</label>
                       </div>
                       <div class="field">
                           <input type="text" id="seating" name="seating" value="<?php echo $data['seating']; ?>">
                           <label for="seating">Seating</label>
                       </div>
                       <div class="field">
                           <input type="text" id="cargo_space" name="cargo_space" value="<?php echo $data['cargo_space']; ?>">
                           <label for="cargo_space">Cargo Space</label>
                       </div>
                       <div class="field">
                           <input type="text" id="fuel_economy" name="fuel_economy" value="<?php echo $data['fuel_economy']; ?>">
                           <label for="fuel_economy">Fuel Economy</label>
                       </div>
                   </div>
               </section>

               <!-- Key Features Section -->
               <section class="form-section">
                   <h2>Key Features</h2>
                   <div class="features-grid">
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="iDrive System" <?php echo in_array('iDrive System', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>iDrive System</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Adaptive Suspension" <?php echo in_array('Adaptive Suspension', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>Adaptive Suspension</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Panoramic Sunroof" <?php echo in_array('Panoramic Sunroof', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>Panoramic Sunroof</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Wireless Charging" <?php echo in_array('Wireless Charging', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>Wireless Charging</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Premium Audio" <?php echo in_array('Premium Audio', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>Premium Audio</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Head-Up Display" <?php echo in_array('Head-Up Display', explode(', ', $data['features'])) ? 'checked' : ''; ?>>
                           <span>Head-Up Display</span>
                       </label>
                   </div>
               </section>

               <!-- Gallery Section -->
               <section class="form-section">
                   <h2>Gallery</h2><br><br><br>
                   <div class="field file-field">
                       <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
                       <label for="gallery">Upload Car Images</label>
                   </div>
                   <div id="image-preview" class="image-preview"></div>

                   <?php
                    $images = explode(",", $data['gallery']);

                    foreach ($images as $img) {
                    ?>
                       <img src="uploads/<?php echo $img; ?>" width="80">
                   <?php } ?>
               </section>

               <!-- Submit Button -->
               <div class="form-actions">
                   <button type="submit" class="btn primary" name="add_car">Save Changes</button>
                   <button type="reset" class="btn secondary" onclick="window.location.href='admin_learn_more.php';">Cancel</button>
               </div>
           </form>
       </main>
       <br>


       <br>
       <?php
        include 'admin_footer.php';
        ?>
       <script src="js/form-validation.js"></script>
   </body>

   </html>