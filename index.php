<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW - The Ultimate Driving Machine</title>
    
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Page Stylesheets -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="header-footer.css">
    
    <!-- Dark Theme Stylesheets -->
    <link rel="stylesheet" href="dark-theme/dark-common.css">
    <link rel="stylesheet" href="dark-theme/dark-header-footer.css">
    <link rel="stylesheet" href="dark-theme/dark-index.css">
</head>
<body>
    <?php 
    session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
    }
    ?>
    <br>
  
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">The Ultimate Driving Machine</h1>
            <p class="hero-subtitle">Experience Luxury, Performance & Innovation</p>
            <p class="hero-description">BMW stands as a symbol of German engineering excellence, combining cutting-edge technology with timeless design. Discover what makes BMW the world's leading luxury automotive brand.</p>
        </div>
        <div class="hero-background">
            <div class="hero-gradient"></div>
            <div class="floating-car-icon">
                <i class="fas fa-car"></i>
            </div>
        </div>
    </section>

    <!-- Featured Cars Section -->
    <section class="featured-cars py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Featured BMW Models</h2>
            <div class="grid-row">
                <!-- Car Card 1 -->
                <div class="grid-col-3">
                    <div class="car-card">
                        <div class="car-image">
                            <i class="fas fa-car"></i>
                            <span class="badge-new">NEW</span>
                        </div>
                        <div class="car-info">
                            <h5>BMW M340i</h5>
                            <p class="car-subtitle">Luxury Sport Sedan</p>
                            <p class="car-description">The BMW M340i represents the perfect blend of luxury and performance. With its powerful engine and sophisticated design, it delivers an unforgettable driving experience.</p>
                            <div class="car-specs mb-3">
                                <div class="spec-item">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span><strong>387 HP</strong> - Turbocharged Power</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-gas-pump"></i>
                                    <span><strong>Petrol Engine</strong> - Premium Fuel</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-gauge"></i>
                                    <span><strong>0-100 km/h: 4.4s</strong> - Acceleration</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-palette"></i>
                                    <span><strong>Jet Black</strong> - Premium Color</span>
                                </div>
                            </div>
                            <div class="price-info">
                                <p class="car-price">₹75,90,000</p>
                                <p class="car-availability"><i class="fas fa-check-circle"></i> Available Now</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Card 2 -->
                <div class="grid-col-3">
                    <div class="car-card">
                        <div class="car-image">
                            <i class="fas fa-car"></i>
                            <span class="badge-electric">ELECTRIC</span>
                        </div>
                        <div class="car-info">
                            <h5>BMW i7</h5>
                            <p class="car-subtitle">Luxury Electric Sedan</p>
                            <p class="car-description">The BMW i7 is the future of luxury driving. With zero emissions and extended battery range, it offers supreme comfort without compromising environmental responsibility.</p>
                            <div class="car-specs mb-3">
                                <div class="spec-item">
                                    <i class="fas fa-bolt"></i>
                                    <span><strong>516 HP</strong> - Electric Power</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-plug"></i>
                                    <span><strong>Fully Electric</strong> - Zero Emissions</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-battery-full"></i>
                                    <span><strong>625 km Range</strong> - Extended Battery</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-leaf"></i>
                                    <span><strong>Eco-Friendly</strong> - Sustainable Luxury</span>
                                </div>
                            </div>
                            <div class="price-info">
                                <p class="car-price">₹2,50,00,000</p>
                                <p class="car-availability"><i class="fas fa-check-circle"></i> Pre-Order Available</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Card 3 -->
                <div class="grid-col-3">
                    <div class="car-card">
                        <div class="car-image">
                            <i class="fas fa-car"></i>
                            <span class="badge-suv">SUV</span>
                        </div>
                        <div class="car-info">
                            <h5>BMW X5</h5>
                            <p class="car-subtitle">Luxury SUV</p>
                            <p class="car-description">The BMW X5 is the ultimate luxury SUV, offering spacious interiors, advanced technology, and commanding performance. Perfect for those who demand the best in every way.</p>
                            <div class="car-specs mb-3">
                                <div class="spec-item">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span><strong>523 HP</strong> - Powerful Engine</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-gas-pump"></i>
                                    <span><strong>Petrol Engine</strong> - Premium Fuel</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-gauge"></i>
                                    <span><strong>0-100 km/h: 4.3s</strong> - Fast Acceleration</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-users"></i>
                                    <span><strong>Seating for 5-7</strong> - Spacious Interior</span>
                                </div>
                            </div>
                            <div class="price-info">
                                <p class="car-price">₹1,47,00,000</p>
                                <p class="car-availability"><i class="fas fa-check-circle"></i> Available Now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMW Features & Information Section -->
    <section class="features-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Why BMW Sets The Standard</h2>
            <div class="grid-row grid-3">
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5>Premium Quality</h5>
                        <p>Every BMW is handcrafted with the finest materials and cutting-edge technology, ensuring uncompromising quality and luxury in every detail.</p>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5>Superior Performance</h5>
                        <p>Experience thrilling acceleration, superior handling, and responsive steering with our advanced engineering and powerful engine technologies.</p>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5>Eco-Friendly Innovation</h5>
                        <p>Our next-generation electric vehicles offer zero emissions without compromising performance, paired with extended battery range and efficiency.</p>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5>24/7 Customer Support</h5>
                        <p>Round-the-clock customer service and roadside assistance ensure your peace of mind and complete satisfaction throughout your BMW ownership.</p>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Comprehensive Warranty</h5>
                        <p>Comprehensive warranty coverage and premium maintenance packages protects your investment and ensures long-term reliability and performance.</p>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h5>Advanced Technology</h5>
                        <p>State-of-the-art infotainment systems, AI-powered driving assistance, and connected vehicle technology keep you ahead of the curve.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMW Heritage Section -->
    <section class="heritage-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Our Heritage & Legacy</h2>
            <div class="grid-row grid-2 align-items-center">
                <div class="grid-col-2">
                    <div class="heritage-content">
                        <h3>Excellence Since 1916</h3>
                        <p>BMW was founded in 1916 and has since established itself as one of the world's leading luxury automotive manufacturers. Our commitment to innovation, quality, and performance has remained unwavering for over a century.</p>
                        <p>From our early days as an aircraft engine manufacturer to becoming a global leader in luxury vehicles, BMW has consistently pushed the boundaries of automotive engineering.</p>
                        <p>Today, BMW continues to set industry standards in design, technology, and sustainability, with a presence in over 140 countries worldwide.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="heritage-stats">
                        <div class="stat-box">
                            <h4>110+</h4>
                            <p>Years of Excellence</p>
                        </div>
                        <div class="stat-box">
                            <h4>30M+</h4>
                            <p>Vehicles Sold Worldwide</p>
                        </div>
                        <div class="stat-box">
                            <h4>140+</h4>
                            <p>Countries Served</p>
                        </div>
                        <div class="stat-box">
                            <h4>50+</h4>
                            <p>Award-Winning Models</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMW Lineup Information -->
    <section class="lineup-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Complete BMW Lineup</h2>
            <div class="grid-row grid-4">
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-compact-disc"></i> Compact Series</h5>
                        <p>The 1 and 2 Series offer nimble handling and premium comfort in a compact package, ideal for urban driving.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-sedan"></i> Sedan Series</h5>
                        <p>The 3, 5, and 7 Series showcase ultimate luxury and performance in sophisticated sedan designs.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-car"></i> SUV & XDrive</h5>
                        <p>The X Series provides versatile luxury SUVs with advanced all-wheel-drive technology and spacious interiors.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-bolt"></i> Electric i Series</h5>
                        <p>The i Series represents the future with innovative electric vehicles combining sustainability with performance.</p>
                    </div>
                </div>
            
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-rocket"></i> M Sport</h5>
                        <p>M models deliver extreme performance, agility, and power for driving enthusiasts seeking ultimate thrills.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-gem"></i> Z Series</h5>
                        <p>The legendary Z roadster series offers open-air luxury with stunning performance and timeless design.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-leaf"></i> Hybrid Technology</h5>
                        <p>BMW's plug-in hybrid models combine traditional engines with electric motors for optimal efficiency.</p>
                    </div>
                </div>
                <div class="grid-col-4">
                    <div class="lineup-card">
                        <h5><i class="fas fa-crown"></i> Special Editions</h5>
                        <p>Limited edition and concept vehicles showcase BMW's vision for the future of automotive luxury.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials Section -->
    <section class="testimonials-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">What BMW Owners Say</h2>
            <div class="grid-row grid-3">
                <div class="grid-col-3">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"The BMW M340i is an absolute masterpiece! Outstanding performance, luxury, and handling combined perfectly."</p>
                        <div class="testimonial-author">
                            <strong>Rajesh Kumar</strong>
                            <p>BMW M340i Owner, Mumbai</p>
                        </div>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"I decided to go electric with the BMW i7 and I couldn't be happier. Amazing range, zero emissions, pure luxury!"</p>
                        <div class="testimonial-author">
                            <strong>Priya Singh</strong>
                            <p>BMW i7 Owner, Delhi</p>
                        </div>
                    </div>
                </div>
                <div class="grid-col-3">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"The BMW X5 is perfect for my family. Spacious, powerful, and the luxury is unmatched. Excellent service support!"</p>
                        <div class="testimonial-author">
                            <strong>Vikram Patel</strong>
                            <p>BMW X5 Owner, Bangalore</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMW Technology Information -->
    <section class="technology-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Cutting-Edge Technology</h2>
            <div class="grid-row grid-2">
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-microchip"></i> AI Integration</h5>
                        <p>Advanced artificial intelligence systems understand driver behavior and adjust vehicle performance for personalized driving experience.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-mobile-alt"></i> Connectivity</h5>
                        <p>Seamless integration with smartphones and smart home devices, allowing remote monitoring and control of your vehicle.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-eye"></i> Advanced Safety</h5>
                        <p>State-of-the-art safety systems including collision avoidance, adaptive cruise control, and 360-degree camera with night vision.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-chart-line"></i> Performance Analytics</h5>
                        <p>Real-time performance data and analytics help optimize driving efficiency and provide insights into your vehicle's condition.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-wifi"></i> 5G Connectivity</h5>
                        <p>5G-enabled vehicles offer lightning-fast internet speeds for entertainment, navigation, and real-time traffic updates.</p>
                    </div>
                </div>
                <div class="grid-col-2">
                    <div class="tech-info">
                        <h5><i class="fas fa-leaf"></i> Efficiency Monitoring</h5>
                        <p>Advanced energy management systems monitor and optimize fuel or battery consumption for maximum range and efficiency.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'Footer.php'; ?>

    <!-- Dark Theme Script -->
    <script src="dark-theme/theme-toggle.js"></script>
    <!-- Page Script -->
    <script src="index.js"></script>
</body>
</html>
