   <?php
    include 'php/database.php';
    include 'admin_hader.php';


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


        //image upload code
        $gallery_names = [];

        if (!empty($_FILES['gallery']['name'][0])) {

            foreach ($_FILES['gallery']['tmp_name'] as $key => $tmp_name) {

                $image_name = $_FILES['gallery']['name'][$key];
                $folder = "uploads/" . $image_name;

                move_uploaded_file($tmp_name, $folder);

                $gallery_names[] = $image_name;
            }
        }

        $gallery = implode(",", $gallery_names);


        $query = "INSERT INTO car_learn_more (performance, efficiency, safety, engine, horsepower, torque, transmission, drivetrain, seating, cargo_space, fuel_economy, features, gallery) VALUES ('$performance', '$efficiency', '$safety', '$engine', '$horsepower', '$torque', '$transmission', '$drivetrain', '$seating', '$cargo_space', '$fuel_economy', '$features', '$gallery')";
        $data = mysqli_query($cann, $query);

        if ($data) {
            echo "<script>alert('Content saved successfully!');</script>";
        } else {
            echo "<script>alert('Failed to save content. Please try again.');</script>";
        }
    } else {
        // echo "<script>alert('Please fill in all fields.');</script>";
    }




    $id = mysqli_insert_id($cann);
    $query = "SELECT * FROM car_learn_more order by id desc ";
    $result = mysqli_query($cann, $query);




    ?>

   <br>
   <br>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Admin - Learn More Page Editor</title>
       <link rel="stylesheet" href="admin_learn_more.css">
       <link rel="stylesheet" href="css/form-validation.css">
       <link rel="stylesheet" href="css/admin_inventory.css">
   </head>

   <body>

       <main class="admin-container">
           <header class="admin-header">
               <h1>Learn More Page Editor</h1>
               <p>Manage the content for the Learn More page</p>
           </header>

           <form class="admin-form" id="learnMoreForm" action="#" method="post" enctype="multipart/form-data">
               <!-- Overview Section -->
               <section class="form-section">
                   <h2>Overview</h2>
                   <div class="overview-fields">
                       <div class="field">
                           <input type="text" id="performance" name="performance">
                           <label for="performance">Performance</label>
                       </div>
                       <div class="field">
                           <input type="text" id="efficiency" name="efficiency">
                           <label for="efficiency">Efficiency</label>
                       </div>
                       <div class="field">
                           <input type="text" id="safety" name="safety">
                           <label for="safety">Safety</label>
                       </div>
                   </div>
               </section>

               <!-- Specifications Section -->
               <section class="form-section">
                   <h2>Specifications</h2>
                   <div class="specs-grid">
                       <div class="field">
                           <input type="text" id="engine" name="engine">
                           <label for="engine">Engine</label>
                       </div>
                       <div class="field">
                           <input type="text" id="horsepower" name="horsepower">
                           <label for="horsepower">Horsepower</label>
                       </div>
                       <div class="field">
                           <input type="text" id="torque" name="torque">
                           <label for="torque">Torque</label>
                       </div>
                       <div class="field">
                           <input type="text" id="transmission" name="transmission">
                           <label for="transmission">Transmission</label>
                       </div>
                       <div class="field">
                           <input type="text" id="drivetrain" name="drivetrain">
                           <label for="drivetrain">Drivetrain</label>
                       </div>
                       <div class="field">
                           <input type="text" id="seating" name="seating">
                           <label for="seating">Seating</label>
                       </div>
                       <div class="field">
                           <input type="text" id="cargo_space" name="cargo_space">
                           <label for="cargo_space">Cargo Space</label>
                       </div>
                       <div class="field">
                           <input type="text" id="fuel_economy" name="fuel_economy">
                           <label for="fuel_economy">Fuel Economy</label>
                       </div>
                   </div>
               </section>

               <!-- Key Features Section -->
               <section class="form-section">
                   <h2>Key Features</h2>
                   <div class="features-grid">
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="iDrive System">
                           <span>iDrive System</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Adaptive Suspension">
                           <span>Adaptive Suspension</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Panoramic Sunroof">
                           <span>Panoramic Sunroof</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Wireless Charging">
                           <span>Wireless Charging</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Premium Audio">
                           <span>Premium Audio</span>
                       </label>
                       <label class="checkbox-label">
                           <input type="checkbox" name="features[]" value="Head-Up Display">
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
               </section>

               <!-- Submit Button -->
               <div class="form-actions">
                   <button type="submit" class="btn primary" name="add_car">Save Changes</button>
                   <button type="reset" class="btn secondary" onclick="window.location.reload()">Reset</button>
               </div>
           </form>
       </main>
       <br>

       <table class="inventory-table">

           <thead>
               <tr>
                   <th>ID</th>
                   <th>Image</th>

                   <th>Engine</th>
                   <th>Horsepower</th>
                   <th>Torque</th>
                   <th>Fuel Economy</th>
                   <th>Seating</th>
                   <th>Features</th>
                   <th>Actions</th>
               </tr>
           </thead>

           <tbody>

               <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                   <tr>

                       <td><?php echo $row['id']; ?></td>

                       <td>
                           <?php
                            $images = explode(",", $row['gallery']);
                            if (!empty($images[0])) {
                            ?>

                               <img src="uploads/<?php echo $images[0]; ?>" width="80">

                           <?php } ?>
                       </td>



                       <td><?php echo $row['engine']; ?></td>

                       <td><?php echo $row['horsepower']; ?></td>

                       <td><?php echo $row['torque']; ?></td>

                       <td><?php echo $row['fuel_economy']; ?></td>

                       <td><?php echo $row['seating']; ?></td>

                       <td><?php echo $row['features']; ?></td>

                       <td>

                           <a href="edit_learn_more.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>

                            <a href="delete_learn_more.php?id=<?php echo $row['id']; ?>" class="btn delete">delete</a>

                           <a href="learn_more.php?id=<?php echo $row['id']; ?>" class="btn view">View</a>

                       </td>

                   </tr>

               <?php } ?>

           </tbody>
       </table>
       <br>
       <?php
        include 'admin_footer.php';
        ?>
       <script src="js/form-validation.js"></script>
   </body>

   </html>