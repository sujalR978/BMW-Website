<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Electric Mobility</title>
	<link rel="stylesheet" href="Electric_modeliti.css">
</head>

<body>
	<?php 
	session_start();
	if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
		include 'second_hadder.php';
	} else {
		include 'Header.php';
	}
	?><br>
    <br>
    <Br>
    <br>
    <br>

	<main class="hero-wrap">
		<div class="container hero">
			<div class="hero-left">
				<h1 class="hero-title">Drive the Future with Electric Mobility!</h1>
				<p class="hero-sub">Join the movement towards sustainability and innovation. Explore our range of electric vehicles designed for you and the planet.</p>
				<div class="hero-cta">
					<a class="btn btn-outline" href="test_drive.php">Book an Electric Test Drive</a>
					<a class="btn btn-primary" href="car_models.php">Explore Electric Models</a>
				</div>
			</div>
			<div class="hero-right">
				<img src="img/electric-car-page.jpg" alt="Electric model" class="hero-img">
			</div>
		</div>
	</main>
     <br>
    <Br>
    <br>
    <br>

	<section class="models-section">
		<div class="container">
			<div class="section-head">
				<h2>Our Electric Models</h2>
				<p>Innovative design, outstanding range, and thrilling performance — crafted for a sustainable tomorrow.</p>
			</div>

			<div class="models-grid">
				<article class="model-card">
					<div class="model-img" style="background-image:url('img/sport-ev.jpg')"></div>
					<h3>Sport EV</h3>
					<p>High-performance electric sports car with cutting-edge dynamics.</p>
					<a class="card-btn" href="learn_more.php">Learn More</a>
				</article>

				<article class="model-card">
					<div class="model-img" style="background-image:url('img/luxury-sedan-img1.jpg')"></div>
					<h3>Luxury Sedan EV</h3>
					<p>Refined comfort and long-range capability for premium travel.</p>
					<a class="card-btn" href="learn_more.php">Learn More</a>
				</article>

				<article class="model-card">
					<div class="model-img" style="background-image:url('img/electric-suv-img.jpg')"></div>
					<h3>Electric SUV</h3>
					<p>Spacious, capable, and sustainable — ready for every journey.</p>
					<a class="card-btn" href="learn_more.php">Learn More</a>
				</article>
			</div>
		</div>
	</section> <br>
    <Br>
    <br>
    <br>

	<!-- Impact section: Emissions histogram + stats -->
	<section class="impact-section">
		<div class="container impact-grid">
			<div class="impact-left">
				<h2>Impact of Electric Vehicles</h2>
				<p class="impact-lead">See how electric mobility is making a difference.</p>
				<div class="impact-cards">
					<div class="impact-card">
						<p class="small">Emissions Reduced</p>
						<p class="big">60%</p>
						<p class="muted">+10%</p>
					</div>
					<div class="impact-card">
						<p class="small">Cost Savings</p>
						<p class="big">$2,000<span class="muted">/year</span></p>
						<p class="muted">+20%</p>
					</div>
				</div>
			</div>

			<div class="impact-right">
				<div class="chart-card">
					<p class="chart-title">Emissions Reduction Over the Years</p>
					<div class="histogram" aria-hidden="true">
						<div class="bar" style="--h:70%"><span>2018</span></div>
						<div class="bar" style="--h:55%"><span>2019</span></div>
						<div class="bar" style="--h:45%"><span>2020</span></div>
						<div class="bar" style="--h:60%"><span>2021</span></div>
						<div class="bar" style="--h:50%"><span>2022</span></div>
						<div class="bar" style="--h:68%"><span>2023</span></div>
					</div>
				</div>
			</div>
		</div>
	</section>

 <br>
    <Br>
    <br>
    <br>

	<!-- Fast Charging and Battery Range Section -->
	<section class="charging-section">
		<div class="container">
			<div class="charging-header">
				<h2>Fast Charging & Battery Range</h2>
				<p class="charging-lead">Charge faster, drive farther.</p>
			</div>
			<div class="charging-stats">
				<div class="stat-item">
					<div class="stat-img-box">
						<img src="img/sport-model-bmw1.jpg" alt="Fast Charging" class="stat-img">
					</div>
					<div class="stat-content">
						<p class="stat-label">Fast Charging (80%)</p>
						<p class="stat-value">25 min</p>
					</div>
				</div>
				<div class="stat-item">
					<div class="stat-img-box">
						<img src="img/luxury-sedan-img2.jpg" alt="Full Charge" class="stat-img">
					</div>
					<div class="stat-content">
						<p class="stat-label">Full Charge Time</p>
						<p class="stat-value">6 hours</p>
					</div>
				</div>
				<div class="stat-item">
					<div class="stat-img-box">
						<img src="img/electric-suv-img1.jpg" alt="Battery Range" class="stat-img">
					</div>
					<div class="stat-content">
						<p class="stat-label">Range per Charge</p>
						<p class="stat-value">450+ km</p>
					</div>
				</div>
			</div>
		</div>
	</section>
     <br>
    <Br>
    <br>
    <br>

    <section class="charging">
        <div class="charging-right">
				<div class="chart-container">
					<p class="chart-title">Electric Car Usage Over 10 Years</p>
					<svg viewBox="0 0 200 200" class="pie-chart">
						<circle cx="100" cy="100" r="80" fill="none" stroke="#e74c3c" stroke-width="40" stroke-dasharray="113 251" stroke-dashoffset="0" class="pie-segment"></circle>
						<circle cx="100" cy="100" r="80" fill="none" stroke="#3498db" stroke-width="40" stroke-dasharray="63 251" stroke-dashoffset="-113" class="pie-segment"></circle>
						<circle cx="100" cy="100" r="80" fill="none" stroke="#2ecc71" stroke-width="40" stroke-dasharray="50 251" stroke-dashoffset="-176" class="pie-segment"></circle>
						<circle cx="100" cy="100" r="80" fill="none" stroke="#f39c12" stroke-width="40" stroke-dasharray="25 251" stroke-dashoffset="-226" class="pie-segment"></circle>
					</svg>
					<div class="pie-legend">
						<div class="legend-item"><span class="dot red"></span> Commercial Fleet (45%)</div>
						<div class="legend-item"><span class="dot blue"></span> Private Owners (25%)</div>
						<div class="legend-item"><span class="dot green"></span> Taxi Services (20%)</div>
						<div class="legend-item"><span class="dot orange"></span> Ride-share (10%)</div>
					</div>
				</div>
			</div>
    </section>
     <br>
    <Br>
    <br>
    <br>

    	<!-- Reviews -->
	<section class="reviews-section">
		<div class="container">
			<h2 class="reviews-title">What Our Customers Say</h2>
			<div class="reviews-grid">
				<div class="review-card">
					<img class="avatar" src="img/profile1.jpg" alt="avtar">
					<p class="name">Alice Johnson</p>
					<p class="review-text">"An extraordinary driving experience! The electric SUV exceeded my expectations in range and comfort."</p>
				</div>
				<div class="review-card">
					<img class="avatar" src="img/profile1.jpg" alt="avtar">
					<p class="name">Brian Davis</p>
					<p class="review-text">"Smooth, quiet, and powerful — the test drive convinced me to switch to electric."</p>
				</div>
				<div class="review-card">
					<img class="avatar" src="img/profile1.jpg" alt="avtar">
					<p class="name">Chloe Smith</p>
					<p class="review-text">"Love the tech and design. Charging is easy and the range handles my daily commute."</p>
				</div>
			</div>
		</div>
	</section>
     <br>
    <Br>
    <br>
    <br>
	<?php include 'Footer.php'; ?>
</body>

</html>
