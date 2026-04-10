<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'second_hadder.php';
} else {
    include 'Header.php';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound & Audio Experience</title>
    <link rel="stylesheet" href="sound.css">
    <link rel="stylesheet" href="header-footer.css">
</head>
<body>


<!-- HERO -->
<section class="hero">
    <h1>Immerse Yourself in Sound</h1>
    <p>Experience premium engine acoustics and digital sound innovation</p>
    <a href="car_models.php" class="btn-primary" style="text-decoration: none;color:white;background-color:black;border:2px solid white;padding:9px;border-radius:8px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Explore Models</a>
</section>

<!-- ADVANCED TECH -->
<section class="advanced">
    <h2>Advanced Engine Sound <br> Technology</h2>
    <p>Discover the future of immersive automotive acoustic engineering.</p>

    <div class="advanced-container">
        <div class="adv-card">
            <div class="img-placeholder small" style="background-image: url('img/engine-bmw.jpg'); background-size: cover; background-position: center;"></div>
           
            <h3>Engine Sound Enhancer</h3>
            <p>A cutting-edge solution to enhance the depth of engine acoustics.</p>
        </div>

        <div class="adv-card">
            <div class="img-placeholder small" style="background-image: url('img/audio-system.jpg'); background-size: cover; background-position: center;"></div>
            <h3>Premium In-Car Audio Systems</h3>
            <p>Ultra-high-fidelity speaker systems designed for all interiors.</p>
        </div>
    </div>
</section>

<!-- FEATURED MODELS -->
<section class="featured">
    <h2>Featured Models with <br> Superior Sound Systems</h2>

    <div class="model-grid">

        <div class="model-card">
         
            <img class="img-placeholder medium" src="img/model-a.jpg">
            <p class="model-name">Model A</p>
            <p class="model-desc">Advanced Engine Sound</p>
        </div>

        <div class="model-card">
       <img class="img-placeholder medium" src="img/model-b.jpg">
            <p class="model-name">Model B</p>
            <p class="model-desc">Digital Sound Technology</p>
        </div>

        <div class="model-card">
           <img class="img-placeholder medium" src="img/model-c.jpg">
            <p class="model-name">Model C</p>
            <p class="model-desc">Noise Cancellation</p>
        </div>

    </div>
</section>

<!-- REVIEWS -->
<section class="reviews">
    <h2>What Our Users Are Saying</h2>

    <div class="review-row">

        <div class="review-card">
            <div class="review-header">
                <p>@john</p>
                <p class="stars">⭐⭐⭐⭐⭐</p>
            </div>
            <p>The sound quality is truly unbelievable. Amazing experience.</p>
        </div>

        <div class="review-card">
            <div class="review-header">
                <p>@soundlover</p>
                <p class="stars">⭐⭐⭐⭐⭐</p>
            </div>
            <p>The depth and clarity of the audio blew my mind.</p>
        </div>

        <div class="review-card">
            <div class="review-header">
                <p>@mark</p>
                <p class="stars">⭐⭐⭐⭐⭐</p>
            </div>
            <p>No other car delivers sound like this. Simply awesome.</p>
        </div>

    </div>

    <div class="review-large img-placeholder"></div>
</section>

<!-- METRICS -->
<!-- <section class="metrics">
    <h2>Audio Performance Metrics</h2>
    <p>Explore the most accurate sound metrics across modern automotive acoustics</p>

    <div class="metric-grid">

        <div class="metric-box">
            <p class="metric-label">Clarity Level</p>
            <h3>97%</h3>
        </div>

        <div class="metric-box">
            <p class="metric-label">Max Volume</p>
            <h3>540W</h3>
        </div>

        <div class="metric-box">
            <p class="metric-label">Noise Reduction</p>
            <h3>45 dB</h3>
        </div>

        <div class="metric-box">
            <p class="metric-label">Audio Spread</p>
            <h3>360 Degrees</h3>
        </div>

    </div>
</section> -->



     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">X</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/7.png" alt="BMW X1">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW X1</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 50,80,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio-1.mp3">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/8.png" alt="BMW X3">
                <div class="card-content">
                    <h5 class="bmw-title">THE ALL-NEW X3</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 75,80,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/videoplayback-10.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/9.png" alt="BMW X5">
                <div class="card-content">
                    <h5 class="bmw-title">THE NEW BMW X5</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 97,80,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-x5m-exhaust.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/10.png" alt="BMW X7">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW X7</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 1,31,40,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-x7-exhaust.mp4">
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">M</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/11.png" alt="BMW M2">
                <div class="card-content">
                    <h5 class="bmw-title">THE NEW BMW M2</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 1,03,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio.mp3">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/13.png" alt="BMW Z4">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW Z4</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 92,90,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-z4-m40-exhaust.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/12.png" alt="BMW X5">
                <div class="card-content">
                    <h5 class="bmw-title">THE NEW BMW X5</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 97,80,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/videoplayback-100.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/14.png" alt="BMW M8">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW M8 COMPETITION</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 2,44,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/sound-1.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/15.png" alt="BMW i7">
                <div class="card-content">
                    <h5 class="bmw-title">THE FIRST-EVER BMW i7 M70 xDRIVE</h5>
                    <p class="bmw-type">Full-Electric</p>
                    <p class="bmw-price">Starting from ₹ 2,50,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio-2.mp3">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/16.png" alt="BMW XM">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW XM</h5>
                    <p class="bmw-type">Plug-in Hybrid</p>
                    <p class="bmw-price">Starting from ₹ 2,60,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-xm-exhaust.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/18.png" alt="BMW M4">
                <div class="card-content">
                    <h5 class="bmw-title">THE NEW BMW M4 COMPETITION COUPÉ</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 1,56,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-m4-exhaust.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/19.png" alt="BMW M4 CS">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW M4 CS</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 1,89,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-m4-exhaust.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/20.png" alt="BMW M5">
                <div class="card-content">
                    <h5 class="bmw-title">THE ALL-NEW BMW M5</h5>
                    <p class="bmw-type">Plug-in Hybrid</p>
                    <p class="bmw-price">Starting from ₹ 1,99,00,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-m5-exhaust.mp4">
                    </audio>
                </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">7</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/21.png" alt="BMW 7 Series">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW 7 SERIES SEDAN</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 1,84,20,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-x7-exhaust.mp4">
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">5</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/23.png" alt="BMW 5 Series">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW 5 SERIES LONG WHEELBASE</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 1,84,20,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio-3.mp3">
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">3</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/24.png" alt="BMW M340i">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW M340i</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 75,90,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/videoplayback-10.mp4">
                    </audio>
                </div>
            </div>

            <div class="car-card">
                <img class="card-image" src="cars/25.png" alt="BMW 3 Series">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW 3 SERIES LONG WHEELBASE</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 62,60,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio-4.mp3">
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">2</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/26.png" alt="BMW 2 Series">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW 2 SERIES GRAN COUPÉ</h5>
                    <p class="bmw-type">Petrol•Diesel</p>
                    <p class="bmw-price">Starting from ₹ 44,40,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/audio-5.mp3">
                    </audio>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

     <div class="container cars-section-spacing">
        <div class="content section-title">
            <h2 class="selected-model">Z4</h2>
        </div>

        <div class="cars-grid">
            <div class="car-card">
                <img class="card-image" src="cars/27.png" alt="BMW Z4">
                <div class="card-content">
                    <h5 class="bmw-title">THE BMW Z4</h5>
                    <p class="bmw-type">Petrol</p>
                    <p class="bmw-price">Starting from ₹ 92,90,000</p>
                    <audio class="audio-player" controls loop>
                        <source src="sound/bmw-z4-m40-exhaust.mp4">
                    </audio>
                </div>
            </div>
        </div>
    </div>
       
     
    </div>

<?php
include 'Footer.php';
?>

</body>
</html>