<?php



include 'php/database.php';
include 'admin_hader.php';

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

    // Upload folder
    $folder = "uploads/" . $image_name;

    // Move file to folder
    move_uploaded_file($tmp_name, $folder);


    $query = "INSERT INTO cars (car_name, model, year, price, category, fuel_type, description, car_image) VALUES ('$car_name', '$car_model', '$car_year', '$car_price', '$car_category', '$car_fuel', '$car_description', '$image_name')";
    $data = mysqli_query($cann, $query);
    

    if ($data) {
        echo "<script>alert('Car added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to add car. Please try again.');</script>";
    }





} else {
    // echo "<script>alert('Please fill in all fields.');</script>";
}

    //fetch data   
    $current_id = mysqli_insert_id($cann); 
    $query_car = "SELECT * FROM cars ORDER BY id DESC";
    $data_car = mysqli_query($cann, $query_car);
    // $result = mysqli_fetch_assoc($data_car);
    $total = mysqli_num_rows($data_car);

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
        <h1 class="admin-title">Admin Panel - Car Management</h1>
        <p class="admin-subtitle">Add new cars and manage the car inventory.</p>

        <div class="add-car-form">
            <h2>Add New Car</h2>
            <form action="#" method="post" id="addCarForm" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="car_name">Car Name</label>
                        <input type="text" id="car_name" name="car_name">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_model">Model</label>
                        <input type="text" id="car_model" name="car_model">
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="car_year">Year</label>
                        <input type="number" id="car_year" name="car_year" min="1900" max="2030">
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_price">Price ($)</label>
                        <input type="number" id="car_price" name="car_price" step="0.01">
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="car_category">Category</label>
                        <select id="car_category" name="car_category">
                            <option value="">Select Category</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="coupe">Coupe</option>
                            <option value="convertible">Convertible</option>
                        </select>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="car_fuel">Fuel Type</label>
                        <select id="car_fuel" name="car_fuel">
                            <option value="">Select Fuel Type</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        <div class="error-message"></div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="car_description">Description</label>
                    <textarea id="car_description" name="car_description" rows="4"></textarea>
                    <div class="error-message"></div>
                </div>

                <div class="form-group full-width">
                    <label for="car_image">Car Image</label>
                    <input type="file" id="car_image" name="car_image" accept="image/*"><br><br>
                    <div class="error-message"></div>
                </div>

                <button type="submit" name="add_car" class="add-btn">Add Car</button>
            </form>
        </div>

        <div class="car-list-container">
            <h2>Car Inventory</h2>
            <table class="car-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Fuel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($data_car)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['id']);?></td>
                        <td><img src="uploads/<?php  echo htmlspecialchars($result['car_image']); ?>" alt="BMW X5" class="car-image"></td>
                        <td><?php echo htmlspecialchars($result['car_name']); ?></td>
                        <td><?php echo htmlspecialchars($result['model']); ?></td>
                        <td><?php echo htmlspecialchars($result['year']); ?></td>
                        <td><?php echo htmlspecialchars($result['price']); ?></td>
                        <td><?php echo htmlspecialchars($result['category']); ?></td>
                        <td><?php echo htmlspecialchars($result['fuel_type']); ?></td>
                        <td>
                            <button class="action-btn edit-btn" onclick="window.location.href='edit_car_add_list.php?id=<?php echo htmlspecialchars($result['id']); ?>'">Edit</button>
                           <a href="delete_car.php?id=<?php echo htmlspecialchars($result['id']); ?>" class="action-btn delete-btn" style="text-decoration: none;"  onclick="return confirm('Are you sure you want to delete this car?');">Delete</a>
           
                        </td>
                    </tr>
                     <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include 'admin_footer.php';
    ?>
    <script src="js/form-validation.js"></script>
</body>

</html>