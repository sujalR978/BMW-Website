<?php
include 'admin_hader.php';
include 'php/database.php';

$query = "SELECT * FROM test_drive";
$data = mysqli_query($cann, $query);

$query_pending = "SELECT * FROM test_drive WHERE booking_status = 'Pending'";
$data_pending = mysqli_query($cann, $query_pending);

$query_approved = "SELECT * FROM test_drive WHERE booking_status = 'Approved'";
$data_approved = mysqli_query($cann, $query_approved);

$query_rejected = "SELECT * FROM test_drive WHERE booking_status = 'Rejected'";
$data_rejected = mysqli_query($cann, $query_rejected);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Test Drive Management</title>
    <link rel="stylesheet" href="admin_test_drive.css">

</head>
<body>

    <div class="admin-container">
        <h1 class="admin-title">Test Drive Bookings Management</h1>
        <p class="admin-subtitle">Manage and handle customer test drive requests</p>

        <div class="bookings-section">
            <h2>Pending Bookings</h2>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Model</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php  while($row = mysqli_fetch_assoc($data_pending)): ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['preferred_date']; ?></td>
                        <td><?php echo $row['preferred_time']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>Pending</td>
                        <td>
                            <button class="approve-btn"
onclick="window.location.href='approve_test_drive.php?id=<?php echo $row['id']; ?>'">
Approve
</button>
                          <button class="reject-btn"
onclick="window.location.href='reject_test_drive.php?id=<?php echo $row['id']; ?>'">
Reject
</button>
                            <button type="submit" onclick="window.location.href='view_test_drive_details.php?id=<?php echo $row['id']; ?>'" class="view-btn">View Details</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </table>
        </div>

        <div class="bookings-section">
            <h2>Approved Bookings</h2>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Model</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                 
                    </tr>
                </thead>
                <?php  while($row = mysqli_fetch_assoc($data_approved)): ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['preferred_date']; ?></td>
                        <td><?php echo $row['preferred_time']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>Approved</td>
                        <td>              
                       <button class="reject-btn"
onclick="window.location.href='reject_test_drive.php?id=<?php echo $row['id']; ?>'">
Reject
</button> 
                        <button type="submit" onclick="window.location.href='view_test_drive_details.php?id=<?php echo $row['id']; ?>'" class="view-btn">View Details</button></td>
                        
                     
                    </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </table>
        </div>

        <div class="bookings-section">
            <h2>Rejected Bookings</h2>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Model</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                 
                    </tr>
                </thead>
                <?php  while($row = mysqli_fetch_assoc($data_rejected)): ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['preferred_date']; ?></td>
                        <td><?php echo $row['preferred_time']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>rejected</td>
                        <td>
                                                   <button class="approve-btn"
onclick="window.location.href='approve_test_drive.php?id=<?php echo $row['id']; ?>'">
Approve
</button>
                        <button type="submit" onclick="window.location.href='view_test_drive_details.php?id=<?php echo $row['id']; ?>'" class="view-btn">View Details</button></td>
                        </td>
                     
                    </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </table>
        </div>

        <div class="stats-section">
            <h2>Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Bookings</h3>
                    <p><?php echo mysqli_num_rows($data); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pending</h3>
                    <p><?php echo mysqli_num_rows($data_pending); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Approved</h3>
                    <p><?php echo mysqli_num_rows($data_approved); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Rejected</h3>
                    <p><?php echo mysqli_num_rows($data_rejected); ?></p>
                </div>
            </div>
        </div>
    </div>

   <?php
    include 'admin_footer.php';
    ?>
</body>
</html>
