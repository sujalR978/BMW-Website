<?php
error_reporting(0);
session_start();
include 'php/database.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM wishlist WHERE user_id='$user_id'";
$data = mysqli_query($cann, $query);
$wishlist_count = mysqli_num_rows($data);

$query_cart = "SELECT * FROM cart WHERE user_id='$user_id'";
$data_cart = mysqli_query($cann, $query_cart);
$cart_count = mysqli_num_rows($data_cart);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark') {
        echo '<link rel="stylesheet" href="dark-theme/dark-common.css">';
        echo '<link rel="stylesheet" href="dark-theme/dark-header-footer.css">';
    }
    ?>
    <style>
  

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #ffffff;
        }

        /* Main Navbar */
        /* .navbar {
            padding: 12px 30px;
            background: white;
            margin: 10px 15px;
            border-radius: 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        } */

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Logo Section */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            text-decoration: none;
            color: #000;
        }

        .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: contain;
        }

        .logo .line {
            width: 2px;
            height: 30px;
            background: #333;
            border: none;
            margin: 0 5px;
        }

        .nav-text-main {
            font-size: 13px;
            color: #666;
            font-weight: 500;
            line-height: 1.3;
        }

        .nav-text {
            color: #000;
            font-weight: 700;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 35px;
            flex: 1;
            text-decoration: none;
            justify-content: center;
        }

        .nav-links li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s ease;
            padding: 5px 0;
            /* border-bottom: 2px solid transparent; */
        }

        .nav-links li a:hover {
            color: #000000;
            /* border-bottom-color: #0066cc; */
            text-decoration: none;
        }

        /* Action Buttons */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .nav-actions .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e8eef5;
            border: none;
            color: #333;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-actions .icon-btn:hover {
            background: #0066cc;
            color: white;
            transform: scale(1.05);
        }

        .nav-actions .profile-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 40px;
            height: 40px;
        }

        .nav-actions .profile-icon:hover {
            transform: scale(1.05);
        }

        /* Badge for cart/wishlist */
        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #d32f2f;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            border: 2px solid white;
        }

        .nav-actions .icon-btn {
            position: relative;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .navbar-container {
                gap: 20px;
            }

            .nav-links {
                gap: 20px;
            }

            .navbar {
                padding: 10px 20px;
                margin: 8px 10px;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-links {
                order: 3;
                width: 100%;
                gap: 15px;
                justify-content: flex-start;
            }

            .nav-links li a {
                font-size: 13px;
            }

            .navbar {
                padding: 8px 15px;
            }

            .logo img {
                width: 40px;
                height: 40px;
            }

            .nav-text-main {
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .navbar-container {
                gap: 10px;
            }

            .nav-links {
                gap: 10px;
            }

            .nav-links li a {
                font-size: 12px;
            }

            .nav-actions {
                gap: 8px;
            }

            .nav-actions .icon-btn {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <!-- BMW Logo & Brand -->
        <a href="admin_login.php" class="logo">
            <svg width="45" height="45" viewBox="0 0 100 100" style="border-radius: 50%; overflow: hidden;">
                <circle cx="50" cy="50" r="48" stroke="#000" stroke-width="2" fill="none"/>
                <path d="M 50 50 L 50 2 A 48 48 0 0 0 2 50 Z" fill="#003d7a"/>
                <path d="M 50 50 L 98 50 A 48 48 0 0 0 50 2 Z" fill="#ffffff"/>
                <path d="M 50 50 L 50 98 A 48 48 0 0 0 98 50 Z" fill="#003d7a"/>
                <path d="M 50 50 L 2 50 A 48 48 0 0 0 50 98 Z" fill="#ffffff"/>
            </svg>
            <hr class="line">
            <span class="nav-text-main">Sheer Driving <strong class="nav-text">Pleasure</strong></span>
        </a>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="Electric_modeliti.php">Electric Future</a></li>
            <li><a href="car_models.php">Machines</a></li>
            <li><a href="sound.php">Frequency</a></li>
            <li><a href="products.php">Products</a></li>
        </ul>

        <!-- Action Buttons -->
        <div class="nav-actions">
            <!-- Search Button -->
            <a href="car_models.php" class="icon-btn" title="Search">
                <i class="fas fa-search"></i>
            </a>

            <!-- Wishlist Button -->
            <a href="wishlist.php" class="icon-btn" title="Wishlist">
                <i class="fas fa-heart"></i>
                <span class="badge"><?php echo htmlspecialchars($wishlist_count) ?></span>
            </a>

            <!-- Cart Button -->
            <a href="cart.php" class="icon-btn" title="Cart">
                <i class="fas fa-shopping-bag"></i>
                <span class="badge"><?php echo htmlspecialchars($cart_count) ?></span>
            </a>

            <!-- Profile Button -->
            <a href="Profile.php" class="icon-btn profile-icon" title="Profile">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</nav>

</body>
</html>

