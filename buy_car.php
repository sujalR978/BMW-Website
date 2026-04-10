   <?php 
  session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
        Header('Location: user_login.php');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Checkout - Complete Your Purchase</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
    <link rel="stylesheet" href="buy_car.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>
<body class="rework-checkout-page">
 
<br>
<br>

    <!-- Main Content -->
    <div class="rework-main-container">
        <!-- Progress Steps -->
        <div class="rework-checkout-steps">
            <div class="rework-step rework-step-active">
                <div class="rework-step-number">1</div>
                <div class="rework-step-label">Cart Review</div>
            </div>
            <div class="rework-step-line"></div>
            <div class="rework-step">
                <div class="rework-step-number">2</div>
                <div class="rework-step-label">Shipping</div>
            </div>
            <div class="rework-step-line"></div>
            <div class="rework-step">
                <div class="rework-step-number">3</div>
                <div class="rework-step-label">Payment</div>
            </div>
            <div class="rework-step-line"></div>
            <div class="rework-step">
                <div class="rework-step-number">4</div>
                <div class="rework-step-label">Confirmation</div>
            </div>
        </div>

        <div class="rework-row-grid">
            <!-- Left Column - Checkout Form -->
            <div class="rework-col-lg-8">
                <!-- Order Review Section -->
                <div class="rework-card rework-checkout-card">
                    <div class="rework-card-header rework-header-primary">
                        <h5><i class="fas fa-shopping-cart"></i> Order Review</h5>
                    </div>
                    <div class="rework-card-body">
                        <!-- Car Items -->
                        <div class="rework-cart-item">
                            <div class="rework-row-items">
                                <div class="rework-col-item-3">
                                    <div class="rework-car-image-box">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                                <div class="rework-col-item-6">
                                    <h6>BMW M340i Sedan</h6>
                                    <p class="rework-text-subtle">Luxury Sport Edition</p>
                                    <div class="rework-car-specs">
                                        <span class="rework-badge-custom">Jet Black</span>
                                        <span class="rework-badge-custom">8-Speed Auto</span>
                                        <span class="rework-badge-custom">Petrol</span>
                                    </div>
                                </div>
                                <div class="rework-col-item-3 rework-text-right">
                                    <h6>₹75,90,000</h6>
                                    <small class="rework-text-subtle">Qty: 1</small>
                                </div>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <button class="rework-btn rework-btn-outline">
                            <i class="fas fa-plus"></i> Add Another Car
                        </button>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="rework-card rework-checkout-card">
                    <div class="rework-card-header rework-header-primary">
                        <h5><i class="fas fa-map-marker-alt"></i> Shipping Information</h5>
                    </div>
                    <div class="rework-card-body">
                        <form class="rework-shipping-form" id="shippingForm">
                            <div class="rework-form-row">
                                <div class="rework-form-group-col-6">
                                    <label class="rework-form-label">First Name *</label>
                                    <input type="text" name="first_name" class="rework-form-control" placeholder="John">
                                    <div class="rework-error-message"></div>
                                </div>
                                <div class="rework-form-group-col-6">
                                    <label class="rework-form-label">Last Name *</label>
                                    <input type="text" name="last_name" class="rework-form-control" placeholder="Doe">
                                    <div class="rework-error-message"></div>
                                </div>
                            </div>
<br>
                            <div class="rework-form-group">
                                <label class="rework-form-label">Email Address *</label>
                                <input type="email" name="email" class="rework-form-control" placeholder="john@example.com">
                                <div class="rework-error-message"></div>
                            </div>

                            <div class="rework-form-group">
                                <label class="rework-form-label">Phone Number *</label>
                                <input type="tel" name="phone" class="rework-form-control" placeholder="+91 9876543210">
                                <div class="rework-error-message"></div>
                            </div>

                            <div class="rework-form-group">
                                <label class="rework-form-label">Street Address *</label>
                                <input type="text" name="address" class="rework-form-control" placeholder="123 BMW Drive">
                                <div class="rework-error-message"></div>
                            </div>

                            <div class="rework-form-row">
                                <div class="rework-form-group-col-6">
                                    <label class="rework-form-label">City *</label>
                                    <input type="text" name="city" class="rework-form-control" placeholder="Mumbai">
                                    <div class="rework-error-message"></div>
                                </div>
                                <div class="rework-form-group-col-3">
                                    <label class="rework-form-label">State *</label>
                                    <input type="text" name="state" class="rework-form-control" placeholder="Maharashtra">
                                    <div class="rework-error-message"></div>
                                </div>
                                <div class="rework-form-group-col-3">
                                    <label class="rework-form-label">ZIP Code *</label>
                                    <input type="text" name="zip" class="rework-form-control" placeholder="400001">
                                    <div class="rework-error-message"></div>
                                </div>
                            </div>

                            <div class="rework-form-group"><br>
                                <label class="rework-form-label">Country *</label>
                                <select class="rework-form-control" name="country">
                                    <option value="">Select Country</option>
                                    <option value="india" selected>India</option>
                                    <option value="usa">USA</option>
                                    <option value="uk">UK</option>
                                    <option value="germany">Germany</option>
                                </select>
                                <div class="rework-error-message"></div>
                            </div>

                            <div class="rework-form-check">
                                <input class="rework-form-check-input" type="checkbox" id="billingSame" checked>
                                <label class="rework-form-check-label" for="billingSame">
                                    Billing address same as shipping address
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="rework-card rework-checkout-card">
                    <div class="rework-card-header rework-header-primary">
                        <h5><i class="fas fa-credit-card"></i> Payment Information</h5>
                    </div>
                    <div class="rework-card-body">
                        <!-- Payment Method Selection -->
                        <div class="rework-payment-methods">
                            <div class="rework-payment-grid">
                                <div class="rework-payment-option">
                                    <input type="radio" name="payment" id="card" value="card">
                                    <label for="card">
                                        <i class="fas fa-credit-card"></i> Credit Card
                                    </label>
                                </div>
                                <div class="rework-payment-option">
                                    <input type="radio" name="payment" id="upi" value="upi">
                                    <label for="upi">
                                        <i class="fas fa-mobile-alt"></i> UPI
                                    </label>
                                </div>
                                <div class="rework-payment-option">
                                    <input type="radio" name="payment" id="netbanking" value="netbanking">
                                    <label for="netbanking">
                                        <i class="fas fa-bank"></i> Net Banking
                                    </label>
                                </div>
                                <div class="rework-payment-option">
                                    <input type="radio" name="payment" id="emi" value="emi">
                                    <label for="emi">
                                        <i class="fas fa-calculator"></i> EMI
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Card Payment Form -->
                        <div id="cardPayment" class="rework-payment-form">
                            <div class="rework-form-group">
                                <label class="rework-form-label">Cardholder Name *</label>
                                <input type="text" class="rework-form-control" placeholder="John Doe">
                            </div>

                            <div class="rework-form-group">
                                <label class="rework-form-label">Card Number *</label>
                                <input type="text" class="rework-form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>

                            <div class="rework-form-row">
                                <div class="rework-form-group-col-6">
                                    <label class="rework-form-label">Expiry Date *</label>
                                    <input type="text" class="rework-form-control" placeholder="MM/YY">
                                </div>
                                <div class="rework-form-group-col-6">
                                    <label class="rework-form-label">CVV *</label>
                                    <input type="text" class="rework-form-control" placeholder="123" maxlength="3">
                                </div>
                            </div>

                            <div class="rework-form-check">
                                <input class="rework-form-check-input" type="checkbox" id="saveCard">
                                <label class="rework-form-check-label" for="saveCard">
                                    Save this card for future purchases
                                </label>
                            </div>
                        </div>

                        <!-- EMI Options -->
                        <div id="emiPayment" class="rework-payment-form" style="display: none;">
                            <div class="rework-form-group">
                                <label class="rework-form-label">EMI Tenure *</label>
                                <select class="rework-form-control">
                                    <option>Select EMI Duration</option>
                                    <option value="12">12 Months - ₹6,32,500/month</option>
                                    <option value="24">24 Months - ₹3,16,250/month</option>
                                    <option value="36">36 Months - ₹2,10,833/month</option>
                                    <option value="48">48 Months - ₹1,58,125/month</option>
                                    <option value="60">60 Months - ₹1,26,500/month</option>
                                </select>
                                <small class="rework-text-subtle">At 8% per annum interest</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="rework-card rework-checkout-card">
                    <div class="rework-card-body">
                        <div class="rework-form-check">
                            <input class="rework-form-check-input" type="checkbox" id="terms">
                            <label class="rework-form-check-label" for="terms">
                                I agree to the <a href="#" class="rework-link-primary">Terms and Conditions</a> and <a href="#" class="rework-link-primary">Privacy Policy</a>
                            </label>
                        </div>
                        <div class="rework-form-check">
                            <input class="rework-form-check-input" type="checkbox" id="newsletter">
                            <label class="rework-form-check-label" for="newsletter">
                                Send me BMW updates and special offers
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="rework-col-lg-4">
                <div class="rework-card rework-checkout-summary rework-sticky">
                    <div class="rework-card-header rework-header-dark">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="rework-card-body">
                        <!-- Items -->
                        <div class="rework-summary-item">
                            <div class="rework-row-items">
                                <div class="rework-col-item-8">
                                    <p><strong>BMW M340i</strong></p>
                                    <small class="rework-text-subtle">Jet Black, Auto, Petrol</small>
                                </div>
                                <div class="rework-col-item-4 rework-text-right">
                                    <p>₹75,90,000</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Breakdown -->
                        <div class="rework-pricing-breakdown">
                            <div class="rework-row-items">
                                <div class="rework-col-item-8">Subtotal</div>
                                <div class="rework-col-item-4 rework-text-right">₹75,90,000</div>
                            </div>
                            <div class="rework-row-items">
                                <div class="rework-col-item-8">Delivery Charges</div>
                                <div class="rework-col-item-4 rework-text-right">₹50,000</div>
                            </div>
                            <div class="rework-row-items">
                                <div class="rework-col-item-8">Insurance</div>
                                <div class="rework-col-item-4 rework-text-right">₹1,50,000</div>
                            </div>
                            <div class="rework-row-items">
                                <div class="rework-col-item-8">GST (18%)</div>
                                <div class="rework-col-item-4 rework-text-right">₹13,86,000</div>
                            </div>
                            <div class="rework-row-items rework-promo-row">
                                <div class="rework-col-item-8">
                                    <input type="text" class="rework-form-control" placeholder="Enter promo code">
                                </div>
                                <div class="rework-col-item-4">
                                    <button class="rework-btn rework-btn-outline">Apply</button>
                                </div>
                            </div>
                        </div>

                        <!-- Discount Alert -->
                        <div class="rework-alert rework-alert-success">
                            <small><i class="fas fa-check-circle"></i> You save ₹5,00,000 with our special offer!</small>
                        </div>

                        <!-- Total -->
                        <div class="rework-total-amount">
                            <div class="rework-row-items">
                                <div class="rework-col-item-8"><strong>Total Amount</strong></div>&nbsp;
                                <div class="rework-col-item-4 rework-text-right"><strong>₹91,76,000</strong></div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="rework-alert rework-alert-info">
                            <small><i class="fas fa-info-circle"></i> Free delivery on all BMW orders across India</small>
                        </div>

                        <!-- Trust Badges -->
                        <div class="rework-trust-badges">
                            <div class="rework-badge-item">
                                <i class="fas fa-lock rework-icon-success"></i>
                                <small>Secure Checkout</small>
                            </div>
                            <div class="rework-badge-item">
                                <i class="fas fa-truck rework-icon-info"></i>
                                <small>Free Delivery</small>
                            </div>
                            <div class="rework-badge-item">
                                <i class="fas fa-undo rework-icon-warning"></i>
                                <small>Easy Returns</small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <button class="rework-btn rework-btn-primary rework-btn-block" onclick="window.location.href='home.php'">
                            <i class="fas fa-check"></i> Complete Purchase
                        </button>
                        <button class="rework-btn rework-btn-outline rework-btn-block" onclick="window.location.href='car_models.php'">
                            <i class="fas fa-arrow-left"></i> Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'Footer.php'; ?>

    <script>
        // Payment method switching
        document.querySelectorAll('input[name="payment"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('cardPayment').style.display = this.value === 'card' ? 'block' : 'none';
                document.getElementById('emiPayment').style.display = this.value === 'emi' ? 'block' : 'none';
            });
        });

        // Card number formatting
        document.querySelector('input[placeholder="1234 5678 9012 3456"]')?.addEventListener('input', function(e) {
            this.value = this.value.replace(/\s/g, '').replace(/(\d{4})/g, '$1 ').trim();
        });
    </script>
    <script src="js/form-validation.js"></script>
</body>
</html>
