<?php
// ============================================
// DATABASE CONFIGURATION - InfinityFree
// ============================================
// Update these values with your InfinityFree
// database credentials from the control panel.
// ============================================

$host = "sql308.infinityfree.com";        // InfinityFree SQL host
$username = "if0_41583183";               // InfinityFree DB username
$password = "ubWkX4LqhzA1";               // InfinityFree DB password
$dbname = "if0_41583183_db_bmw";          // InfinityFree DB name

// Connect to database
$cann = mysqli_connect($host, $username, $password, $dbname);

if ($cann) {
    // Set charset to prevent encoding issues
    mysqli_set_charset($cann, "utf8mb4");
} else {
    echo "Connection failed. Error: " . mysqli_connect_error();
}

?>