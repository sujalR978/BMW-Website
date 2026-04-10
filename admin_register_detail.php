<?php
    include "php/database.php";

    $query ="SELECT * FROM register_page";
    $data = mysqli_query($cann, $query);

    $total = mysqli_num_rows($data);// Check if there are records to display
  //  $result = mysqli_fetch_assoc($data);// take data as form of array // echo "Total registrations: " . $total;
    


    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Registrations</title>
    <link rel="stylesheet" href="admin_car_list_manag.css"> <!-- reuse some admin styles or create new -->
    <style>
        body {
            font-family: sans-serif;
            /* background: #f0f4f8; */
            /* margin: 0;
            padding: 0; */
        }
        .container {
            /* max-width: 1000px; */
            /* margin-left: 40px; */
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .container h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 18px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }
        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {background:#fafafa;}
        tr:hover {background:#f1f3f4;transform:scale(1.01);transition:all .2s ease;}
        .action-link {padding:6px 10px;border-radius:5px;text-decoration:none;font-size:14px;display:inline-block;transition:background .3s ease,transform .2s ease;}
        .actions { display: flex; gap: 8px; }
        .action-link.edit {background:#667eea;color:#fff;}
        .action-link.edit:hover {background:#764ba2;transform:scale(1.05);}
        .action-link.delete {background:#ff6b6b;color:#fff;}
        .action-link.delete:hover {background:#ff5252;transform:scale(1.05);}
        .no-record {text-align:center;color:#666;font-size:1.2rem;padding:40px 0;}
        /* responsive adjustments */
        @media (max-width: 768px) {
            .container { padding: 10px; }
            table { font-size: 14px; }
            th, td { padding: 8px 10px; }
            .action-link { padding: 4px 8px; font-size: 12px; }
        }
        @media (max-width: 576px) {
            .container { padding: 5px; }
            table { display: block; overflow-x: auto; white-space: nowrap; }
            th, td { white-space: nowrap; }
            .container h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

<?php include 'admin_hader.php'; ?>

<div class="container">
    <h1>User Registration Details</h1>

    <?php if ($total > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password (hashed)</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['id']); ?></td>
                        <td><?php echo htmlspecialchars($result['name']); ?></td>
                        <td><?php echo htmlspecialchars($result['email']); ?></td>
                        <td><?php echo htmlspecialchars($result['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($result['password']); ?></td>
                         <td><?php echo htmlspecialchars($result['time']); ?></td>
                        <td>
                            <div class="actions">
                                <a href="admin_edit_user.php?id=<?php echo urlencode($result['id']); ?>" class="action-link edit">Edit</a>
                                <a href="admin_delete_user.php?id=<?php echo urlencode($result['id']); ?>" class="action-link delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-record">No registrations found.</p>
    <?php endif; ?>
</div>
        

<?php include 'admin_footer.php'; ?>

</body>
</html>

