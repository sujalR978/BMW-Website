<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - Home</title>
    
    <link rel="stylesheet" href="home.css">
    <?php 
    session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
    }
    ?>
   
   <style>
   




    </style>
  </head>

  <body class="main" style="background-color:#fafafa;">
       

      <div class="main-vi">
          <video width="100%" autoplay muted>
              <source src="video/bmw-storm-drive.mp4">
          </video>
          <h1 class="text-main">BMW</h1>
      </div>

      <div class="main-cn">
          <div class="cn-sub">
              <p class="main-text">Drive the Future</p>
              <p class="main-text-1">Experience unrivaled performance and innovative technology.</p>
              <div class="main-sub-text">
                  <div>
                      <a href="test_drive.php"><input class="btn-link" type="button" value="Book Test Drive"></a>

                  </div>
                  <div>
                      <a href="car_models.php"><input class="btn-link-1" type="button" value="Explore Models"></a>
                  </div>
              </div>
          </div>
          <div class="img-cn">
              <img src="img/home-drive-future.jpg" alt="img">
              
          </div>
      </div>
      <div class="card-section">
      <div class="main-cn-text">
          <p class="model-text">Our Featured Models</p>
          <p class="mini-text">Discover the latest in automotive innovation.</p>
          <a href="car_models.php"><input class="text-btn" type="button" value="View All Models"></a>
      </div>
      <div class="model-cn">
          <div class="sub-cn">
              <div class="img-cn-sub">
                    <img src="img/bmw-sport-mode.jpg" alt="bmw">
              </div>
              <div class="text-sub-img">
                  <p class="main-text-boled">Sport Model</p>
                  <p class="main-text-boled-sub">Unmatched Performance</p>
                  <p class="main-text-description">Engineered for excellence with a turbocharged engine and<br> aerodynamic design.</p>
              </div>
          </div>

          <div class="sub-cn">
              <div class="img-cn-sub">
                     <img src="img/bmw-lux.jpg" alt="bmw">
              </div>
              <div class="text-sub-img">
                  <p class="main-text-boled">Luxury Sedan</p>
                  <p class="main-text-boled-sub">Pure Comfort</p>
                  <p class="main-text-description">Crafted with premium materials for an exquisite driving <br> experience.</p>
              </div>
          </div>
          <div class="sub-cn">
              <div class="img-cn-sub">
                    <img src="img/electric-bmw.jpg" alt="bmw">
              </div>
              <div class="text-sub-img">
                  <p class="main-text-boled">Electric SUV</p>
                  <p class="main-text-boled-sub">Sustainable Performance</p>
                  <p class="main-text-description">A powerful electric vehicle that combines style with<br>
                      sustainability.</p>
              </div>
          </div>
    </div>
    </div>

      <div class="bg-cn card-section">
          <div class="bg-cn-text">
              <p class="home-text">What Our Customers Say</p>
              <p class="home-text-des">Real stories from real drivers.</p>
          </div>
          <div class="bg-cn-side">
              <div class="bg-cn-sub-side">
                  <div class="bg-sub-cn">
                      <div class="circul">
                         
                          <img class="profile-img" src="img/profile1.jpg" alt="profile">
                          <p class="prof-name">Alice Johnson</p>
                      </div>
                      <p class="review">An extraordinary driving experience!</p>
                  </div>
                  <div class="bg-sub-cn">
                      <div class="circul">
                          <img class="profile-img" src="img/profile1.jpg" alt="profile">
                          <p class="prof-name">Brian Davis</p>
                      </div>
                      <p>The electric SUV exceeded my expectations!</p>
                  </div>
              </div>

              <div class="bg-sub-cn">
                  <div class="circul">
                      <img class="profile-img" src="img/profile1.jpg" alt="profile">
                      <p class="prof-name">Chloe Smith</p>
                  </div>
                  <p>Luxury and performance perfectly combined!</p>
              </div>
          </div>
      </div>

      
    <section class="main-section-unique">

        <!-- Left Content -->
        <div class="left-content-wrapper-unique">
            <h1 class="main-heading-unique">Key Selling Points</h1>
            <p class="sub-heading-unique">Why Choose Us?</p>
        </div>

        <!-- Right Cards Section -->
        <div class="cards-container-unique">

            <!-- Card 1 -->
            <div class="card-box-performance-unique" style="background-image: url('img/performance-icon.jpg'); background-size: cover; background-position: center;">
                <span class="card-label-performance-unique">Fast</span>
                <div class="card-content-performance-unique">
                    <p class="card-title-performance-unique">Performance</p>
                    <h3 class="card-highlight-performance-unique">0-60 in 3.5 seconds</h3>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card-box-safety-unique" style="background-image: url('img/sefty.jpg'); background-size: cover; background-position: center;">
                <span class="card-label-safety-unique">Reliable</span>
                <div class="card-content-safety-unique">
                    <p class="card-title-safety-unique">Safety Features</p>
                    <h3 class="card-highlight-safety-unique">5-Star Rating</h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card-box-innovation-unique" style="background-image: url('img/inovation.jpg'); background-size: cover; background-position: center;">
                <span class="card-label-innovation-unique">Advanced</span>
                <div class="card-content-innovation-unique">
                    <p class="card-title-innovation-unique">Innovative Tech</p>
                    <h3 class="card-highlight-innovation-unique">Smart Drive Assist</h3>
                </div>
            </div>

        </div>

    </section>

      <div class="card-section">
      <div class="mid-2-text">
          <p class="mid-text-2">Explore More</p>
          <p class="mid-text-2-1">Dive into specialized categories.</p>
      </div>

      <div class="cn-last-row">
          <div class="CENTER">
          <a href="Electric_modeliti.php">
            
                <img class="bg-img-round" src="img/electric-feature.jpg" alt="electric">
            
                </a>
              <p>Electric Future</p>
              <p>Sustainable Mobility</p>
              <p>Explore our electric range.</p>
          </div>
          <div>
           <a href="sound.php">
             <img class="bg-img-round" src="img/sound.jpg" alt="electric">
                </a>
              <p>Sound Experience</p>
              <p>Premier Audio Systems </p>
              <p>Immerse yourself in music.</p>
          </div>
          <div><a href="Profile.php">
            <img class="bg-img-round" src="img/garage1.jpg" alt="electric">
                </a>
              <p>My Garage</p>
              <p>Your Personal Collection</p>
              <p>Manage your favorite models.</p>
          </div>
    </div>
    </div>


    <div class="subscribe">
          <div class="subscribe-left">
              <h3>Stay Updated</h3>
              <p>Subscribe to our newsletter for the latest offers.</p>
          </div>
          <div class="subscribe-right">
              <div class="field">
                  <input id="subscribe-email" type="email" placeholder=" " value="">
                  <label for="subscribe-email">Email Address</label>
              </div>
              <p class="subscribe-note">Stay informed about our latest models.</p>
              <button class="btn-subscribe" type="button">Subscribe</button>
          </div>
      </div>
    
    
    <?php
        include 'Footer.php';
        ?>
  </body>


  </html>