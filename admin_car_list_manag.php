<?php
include 'php/database.php';
include 'admin_hader.php';

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
    <title>Admin - Car Management System</title>
    <link rel="stylesheet" href="admin_car_list_manag.css">

</head>

<body>

    <div class="admin-container">
        <h1 class="admin-title">Car Management System</h1>
        <p class="admin-subtitle">Manage BMW car inventory, add new models, edit details, and remove listings</p>

        <div class="actions-bar">
            <button class="add-car-btn" type="submit" onclick="window.location.href='admin_car_add_list.php'">Add New Car</button>
            <div class="search-bar">
                <input type="text" placeholder="Search cars..." id="search-input">
                <button class="search-btn">Search</button>
            </div>
        </div>

        <div class="cars-section">
            <h2>Car Inventory</h2>
            <table class="cars-table">
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
                        <td><img src="uploads/<?php  echo htmlspecialchars($result['car_image']); ?>" alt="BMW X5" class="car-image" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($result['car_name']); ?></td>
                        <td><?php echo htmlspecialchars($result['model']); ?></td>
                        <td><?php echo htmlspecialchars($result['year']); ?></td>
                        <td><?php echo htmlspecialchars($result['price']); ?></td>
                        <td><?php echo htmlspecialchars($result['category']); ?></td>
                        <td><?php echo htmlspecialchars($result['fuel_type']); ?></td>
                        <td>
                            <a href="edit_car_add_list.php?id=<?php echo htmlspecialchars($result['id']); ?>" class="action-btn edit-btn" style="text-decoration: none;">Edit</a>
                            <a href="delete_car.php?id=<?php echo htmlspecialchars($result['id']); ?>" class="action-btn delete-btn" style="text-decoration: none;" onclick="return confirm('Are you sure you want to delete this car?');">Delete</a>

                            <button class="view-btn" type="submit" onclick="window.location.href='learn_more.php?id=<?php echo htmlspecialchars($result['id']) ?>'" >View</button>
                        </td>
                    </tr>
                             <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="stats-section">
            <h2>Inventory Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Cars</h3>
                    <p><?php echo $total; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Available</h3>
                    <p><?php echo $total; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Sold</h3>
                    <p>5</p>
                </div>
                <div class="stat-card">
                    <h3>Revenue</h3>
                    <p>$1,250,000</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'admin_footer.php';
    ?>

</body>

</html>