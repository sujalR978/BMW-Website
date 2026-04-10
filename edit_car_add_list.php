<?php

include 'php/database.php';

$id = $_GET['id'];

$query = "SELECT * FROM cars WHERE id='$id'";
$data = mysqli_query($cann, $query);
$result = mysqli_fetch_assoc($data);

//update logic
//update logic
if (isset($_POST['add_car'])) {

    $car_name = $_POST['car_name'];
    $car_model = $_POST['car_model'];
    $car_year = $_POST['car_year'];
    $car_price = $_POST['car_price'];
    $car_category = $_POST['car_category'];
    $car_fuel = $_POST['car_fuel'];
    $car_description = $_POST['car_description'];

    // Image data
    $image_name = $_FILES['car_image']['name'];
    $tmp_name = $_FILES['car_image']['tmp_name'];

    // If user uploads new image
    if (!empty($image_name)) {

        $folder = "uploads/" . $image_name;
        move_uploaded_file($tmp_name, $folder);

        $query = "UPDATE cars SET 
        car_name='$car_name',
        model='$car_model',
        year='$car_year',
        price='$car_price',
        category='$car_category',
        fuel_type='$car_fuel',
        description='$car_description',
        car_image='$image_name'
        WHERE id='$id'";

    } 
    else {

        // Keep old image
        $query = "UPDATE cars SET 
        car_name='$car_name',
        model='$car_model',
        year='$car_year',
        price='$car_price',
        category='$car_category',
        fuel_type='$car_fuel',
        description='$car_description'
        WHERE id='$id'";

    }

    $data = mysqli_query($cann, $query);

    if ($data) {
        echo "<script>alert('Car updated successfully!');</script>";
        header("Location: admin_car_list_manag.php");
        exit();
    } else {
        echo "<script>alert('Failed to update car. Please try again.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Car Management</title>
    <link rel="stylesheet" href="admin_car_add_list.css">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>

<body>

    <div class="admin-container">
        <h1 class="admin-title">Update - Cars</h1>
        <p class="admin-subtitle">Update and manage the car inventory.</p>

        <div class="add-car-form">
            <h2>Update Car</h2>
            <form action="#" method="post" id="addCarForm" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="car_name">Car Name</label>
                        <input type="text" id="car_name" name="car_name" value="<?php echo htmlspecialchars($result['car_name']) ?>">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_model">Model</label>
                        <input type="text" id="car_model" name="car_model" value="<?php echo htmlspecialchars($result['model']) ?>">
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="car_year">Year</label>
                        <input type="number" id="car_year" name="car_year" min="1900" max="2030" value="<?php echo htmlspecialchars($result['year']) ?>">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_price">Price ($)</label>
                        <input type="number" id="car_price" name="car_price" step="0.01" value="<?php echo htmlspecialchars($result['price']) ?>">
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="car_category">Category</label>
                        <select id="car_category" name="car_category" value="">
                            <option value="">Select Category</option>
                            <option value="sedan" <?php echo ($result['category'] == 'sedan') ? 'selected' : ''; ?>>Sedan</option>
                            <option value="suv" <?php echo ($result['category'] == 'suv') ? 'selected' : ''; ?>>SUV</option>
                            <option value="coupe" <?php echo ($result['category'] == 'coupe') ? 'selected' : ''; ?>>Coupe</option>
                            <option value="convertible" <?php echo ($result['category'] == 'convertible') ? 'selected' : ''; ?>>Convertible</option>
                        </select>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_fuel">Fuel Type</label>
                        <select id="car_fuel" name="car_fuel">
                            <option value="">Select Fuel Type</option>
                            <option value="petrol" <?php echo ($result['fuel_type'] == 'petrol') ? 'selected' : ''; ?>>Petrol</option>
                            <option value="diesel" <?php echo ($result['fuel_type'] == 'diesel') ? 'selected' : ''; ?>>Diesel</option>
                            <option value="electric" <?php echo ($result['fuel_type'] == 'electric') ? 'selected' : ''; ?>>Electric</option>
                            <option value="hybrid" <?php echo ($result['fuel_type'] == 'hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                        </select>
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="car_description">Description</label>
                    <textarea id="car_description" name="car_description" rows="4"><?php echo htmlspecialchars($result['description']) ?></textarea>
                    <div class="error-message"></div>
                </div>

                <div class="form-group full-width">
                    <label for="car_image">Car Image</label>

                    <!-- Show current image -->
                    <img src="uploads/<?php echo $result['car_image']; ?>" width="120"><br><br>

                    <!-- File input for new image -->
                    <input type="file" id="car_image" name="car_image" accept="image/*">

                    <div class="error-message"></div>
                </div>
                <button type="submit" name="add_car" class="add-btn">Update Car</button>

                <br><br>
                <button type="button" class="add-btn cancel-btn" onclick="window.location.href='admin_car_list_manag.php';">Cancel</button>
            </form>
        </div>

    </div>

    <?php
    include 'admin_footer.php';
    ?>
    <!-- <script src="js/form-validation.js"></script> -->
</body>

</html>