<?php
include 'php/database.php';
session_start();

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'second_hadder.php';
} else {
    include 'Header.php';
}

// FETCH ALL CARS
$query = "SELECT * FROM cars ORDER BY id DESC";
$data = mysqli_query($cann, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BMW Car Models</title>
<link rel="stylesheet" href="car_models.css">
</head>

<body>

<p class="Mtext-1">FIND YOUR BMW.</p>
<p class="MtextSmal-1">0 Vehicles found</p>

<!-- 🔍 SEARCH + FILTER -->
<div class="model-search-container">
    <input type="search" id="search" placeholder="🔎 Search by name or model...">
   
    <select id="fuelFilter">
        <option value="">⛽ All Fuel Types</option>
        <option value="petrol">Petrol</option>
        <option value="diesel">Diesel</option>
        <option value="electric">⚡ Electric</option>
    </select>
    <select id="priceFilter">
        <option value="">💰 All Prices</option>
        <option value="budget">Budget-Friendly (&lt; ₹30L)</option>
        <option value="midrange">Mid-Range (₹30L - ₹50L)</option>
        <option value="premium">Premium (₹50L - ₹80L)</option>
        <option value="luxury">Luxury (&gt; ₹80L)</option>
    </select>
</div>

<hr>

<!-- 🚗 ALL CARS -->
<div class="Model-1" id="carContainer">

<?php while($row = mysqli_fetch_assoc($data)) { ?>
    
<div class="model-item"
     data-model="<?php echo strtolower($row['model']); ?>"
     data-fuel="<?php echo strtolower($row['fuel_type']); ?>"
     data-price="<?php echo intval($row['price']); ?>">

    <a href="learn_more.php?id=<?php echo $row['id']; ?>">
        <img class="model-image" src="uploads/<?php echo $row['car_image']; ?>">
    </a>

    <p class="bmw-title"><?php echo $row['car_name']; ?></p>
    <p class="bmw-type"><?php echo $row['fuel_type']; ?></p>
    <p class="bmw-price">₹<?php echo $row['price']; ?></p>

    <div class="car-actions">
        <a href="wishlist.php?id=<?php echo $row['id']; ?>" class="btn btn-wishlist">💙 Wishlist</a>
        <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-cart">🛒 Add to Cart</a>
    </div>

</div>

<?php } ?>

</div>

<?php include 'Footer.php'; ?>

<!-- 🔥 FILTER SCRIPT -->
<script>
const search = document.getElementById('search');
const fuelFilter = document.getElementById('fuelFilter');
const priceFilter = document.getElementById('priceFilter');
const items = document.querySelectorAll('.model-item');
const count = document.querySelector('.MtextSmal-1');

function getPriceRange(category) {
    const ranges = {
        'budget': [0, 3000000],
        'midrange': [3000000, 5000000],
        'premium': [5000000, 8000000],
        'luxury': [8000000, Infinity]
    };
    return ranges[category] || null;
}

function filterCars() {
    let visible = 0;

    items.forEach(item => {
        let text = item.innerText.toLowerCase();
        let fuel = item.dataset.fuel;
        let price = parseInt(item.dataset.price);

        let searchVal = search.value.toLowerCase();
        let fuelVal = fuelFilter.value.toLowerCase();
        let priceVal = priceFilter.value;

        let show = true;

        // Search filter
        if (searchVal && !text.includes(searchVal)) {
            show = false;
        }
        
        // Fuel type filter
        if (fuelVal && fuel !== fuelVal) {
            show = false;
        }
        
        // Price filter logic
        if (priceVal) {
            const range = getPriceRange(priceVal);
            if (range && (price < range[0] || price > range[1])) {
                show = false;
            }
        }

        item.style.display = show ? "block" : "none";

        if (show) visible++;
    });

    count.innerText = visible + " Vehicles found";
}

// EVENTS - Add event listeners only to elements that exist
search.addEventListener('input', filterCars);
fuelFilter.addEventListener('change', filterCars);
priceFilter.addEventListener('change', filterCars);

// INITIAL COUNT
document.addEventListener('DOMContentLoaded', function() {
    filterCars();
});

// Also run on page load
window.addEventListener('load', filterCars);
</script>

</body>
</html>