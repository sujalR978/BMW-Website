/**
 * BMW Form Validation Script
 * Comprehensive validation for all forms in the project
 */

// Email validation
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone number validation (10 digits)
function validatePhone(phone) {
    const phoneRegex = /^\d{10}$/;
    return phoneRegex.test(phone.replace(/\D/g, ''));
}

// Password validation (min 8 chars, at least 1 uppercase, 1 lowercase, 1 number)
function validatePassword(password) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
}

// Name validation (letters and spaces only)
function validateName(name) {
    const nameRegex = /^[a-zA-Z\s]{3,}$/;
    return nameRegex.test(name);
}

// Text validation (not empty)
function validateText(text) {
    return text.trim().length > 0;
}

// Number validation
function validateNumber(number) {
    return !isNaN(number) && number !== '';
}

// Display error message
function showError(element, message) {
    element.classList.add('error');
    const errorDiv = element.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains('error-message')) {
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
    }
}

// Clear error message
function clearError(element) {
    element.classList.remove('error');
    const errorDiv = element.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains('error-message')) {
        errorDiv.style.display = 'none';
    }
}

// Validate registration form
function validateRegistrationForm(formElement) {
    let isValid = true;
    const name = formElement.querySelector('input[name="name"]');
    const email = formElement.querySelector('input[name="email"]');
    const phone = formElement.querySelector('input[name="phone"]');
    const password = formElement.querySelector('input[name="password"]');
    const confirmPassword = formElement.querySelector('input[name="confirm_password"]');

    // Validate name
    if (name && !validateName(name.value)) {
        showError(name, 'Name must be at least 3 characters and contain only letters');
        isValid = false;
    } else if (name) {
        clearError(name);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate phone
    if (phone && !validatePhone(phone.value)) {
        showError(phone, 'Phone number must be 10 digits');
        isValid = false;
    } else if (phone) {
        clearError(phone);
    }

    // Validate password
    if (password && !validatePassword(password.value)) {
        showError(password, 'Password must be at least 8 characters with uppercase, lowercase, and a number');
        isValid = false;
    } else if (password) {
        clearError(password);
    }

    // Validate password match
    if (confirmPassword && password && confirmPassword.value !== password.value) {
        showError(confirmPassword, 'Passwords do not match');
        isValid = false;
    } else if (confirmPassword) {
        clearError(confirmPassword);
    }

    return isValid;
}

// Validate signup form
function validateSignupForm(formElement) {
    let isValid = true;
    const email = formElement.querySelector('input[name="email"]');
    const password = formElement.querySelector('input[name="password"]');

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate password
    if (password && !validatePassword(password.value)) {
        showError(password, 'Password must be at least 8 characters with uppercase, lowercase, and a number');
        isValid = false;
    } else if (password) {
        clearError(password);
    }

    return isValid;
}

// Validate learn more form
function validateLearnMoreForm(formElement) {
    let isValid = true;
    const inputs = formElement.querySelectorAll('input[type="text"]');
    
    inputs.forEach(input => {
        if (input && !validateText(input.value)) {
            showError(input, 'This field is required');
            isValid = false;
        } else if (input) {
            clearError(input);
        }
    });

    return isValid;
}

// Validate add car form
function validateAddCarForm(formElement) {
    let isValid = true;
    const carName = formElement.querySelector('input[name="car_name"]');
    const carModel = formElement.querySelector('input[name="car_model"]');
    const carYear = formElement.querySelector('input[name="car_year"]');
    const carPrice = formElement.querySelector('input[name="car_price"]');
    const carCategory = formElement.querySelector('select[name="car_category"]');
    const carFuel = formElement.querySelector('select[name="car_fuel"]');
    const carDescription = formElement.querySelector('textarea[name="car_description"]');
    const carImage = formElement.querySelector('input[name="car_image"]');

    // Validate car name
    if (carName && !validateText(carName.value)) {
        showError(carName, 'Car name is required');
        isValid = false;
    } else if (carName) {
        clearError(carName);
    }

    // Validate car model
    if (carModel && !validateText(carModel.value)) {
        showError(carModel, 'Car model is required');
        isValid = false;
    } else if (carModel) {
        clearError(carModel);
    }

    // Validate car year
    if (carYear && (!validateNumber(carYear.value) || carYear.value < 1900)) {
        showError(carYear, 'Please enter a valid year (1900 or later)');
        isValid = false;
    } else if (carYear) {
        clearError(carYear);
    }

    // Validate car price
    if (carPrice && (!validateNumber(carPrice.value) || carPrice.value <= 0)) {
        showError(carPrice, 'Please enter a valid price');
        isValid = false;
    } else if (carPrice) {
        clearError(carPrice);
    }

    // Validate car category
    if (carCategory && !validateText(carCategory.value)) {
        showError(carCategory, 'Please select a category');
        isValid = false;
    } else if (carCategory) {
        clearError(carCategory);
    }

    // Validate car fuel type
    if (carFuel && !validateText(carFuel.value)) {
        showError(carFuel, 'Please select a fuel type');
        isValid = false;
    } else if (carFuel) {
        clearError(carFuel);
    }

    // Validate car description
    if (carDescription && !validateText(carDescription.value)) {
        showError(carDescription, 'Description is required');
        isValid = false;
    } else if (carDescription) {
        clearError(carDescription);
    }

    // Validate car image
    if (carImage && !carImage.value) {
        showError(carImage, 'Please select an image');
        isValid = false;
    } else if (carImage) {
        clearError(carImage);
    }

    return isValid;
}

// Validate login form
function validateLoginForm(formElement) {
    let isValid = true;
    const email = formElement.querySelector('input[name="email"]');
    const password = formElement.querySelector('input[name="password"]');

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate password
    if (password && !validateText(password.value)) {
        showError(password, 'Password is required');
        isValid = false;
    } else if (password) {
        clearError(password);
    }

    return isValid;
}

// Validate contact form
function validateContactForm(formElement) {
    let isValid = true;
    const name = formElement.querySelector('input[name="name"]');
    const email = formElement.querySelector('input[name="email"]');
    const phone = formElement.querySelector('input[name="phone"]');
    const message = formElement.querySelector('textarea[name="message"]');
    const subject = formElement.querySelector('input[name="subject"]');

    // Validate name
    if (name && !validateName(name.value)) {
        showError(name, 'Name must be at least 3 characters');
        isValid = false;
    } else if (name) {
        clearError(name);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate phone
    if (phone && phone.value && !validatePhone(phone.value)) {
        showError(phone, 'Phone number must be 10 digits');
        isValid = false;
    } else if (phone) {
        clearError(phone);
    }

    // Validate subject
    if (subject && !validateText(subject.value)) {
        showError(subject, 'Subject is required');
        isValid = false;
    } else if (subject) {
        clearError(subject);
    }

    // Validate message
    if (message && !validateText(message.value)) {
        showError(message, 'Message is required');
        isValid = false;
    } else if (message) {
        clearError(message);
    }

    return isValid;
}

// Validate test drive form (with separate first/last name fields)
function validateTestDriveFormByIds(formElement) {
    let isValid = true;
    const firstName = formElement.querySelector('input[name="first_name"]');
    const lastName = formElement.querySelector('input[name="last_name"]');
    const email = formElement.querySelector('input[name="email"]');
    const phone = formElement.querySelector('input[name="phone"]');
    const model = formElement.querySelector('select[name="model"]');
    const preferredDate = formElement.querySelector('input[name="preferred_date"]');

    // Validate first name
    if (firstName && !validateName(firstName.value)) {
        showError(firstName, 'First name must be at least 3 characters');
        isValid = false;
    } else if (firstName) {
        clearError(firstName);
    }

    // Validate last name
    if (lastName && !validateName(lastName.value)) {
        showError(lastName, 'Last name must be at least 3 characters');
        isValid = false;
    } else if (lastName) {
        clearError(lastName);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate phone
    if (phone && !validatePhone(phone.value)) {
        showError(phone, 'Phone number must be 10 digits');
        isValid = false;
    } else if (phone) {
        clearError(phone);
    }

    // Validate car model
    if (model && !validateText(model.value)) {
        showError(model, 'Please select a car model');
        isValid = false;
    } else if (model) {
        clearError(model);
    }

    // Validate date
    if (preferredDate && !validateText(preferredDate.value)) {
        showError(preferredDate, 'Please select a date');
        isValid = false;
    } else if (preferredDate) {
        clearError(preferredDate);
    }

    return isValid;
}

// Validate shipping form
function validateShippingForm(formElement) {
    let isValid = true;
    const firstName = formElement.querySelector('input[name="first_name"]');
    const lastName = formElement.querySelector('input[name="last_name"]');
    const email = formElement.querySelector('input[name="email"]');
    const phone = formElement.querySelector('input[name="phone"]');
    const address = formElement.querySelector('input[name="address"]');
    const city = formElement.querySelector('input[name="city"]');
    const state = formElement.querySelector('input[name="state"]');
    const zip = formElement.querySelector('input[name="zip"]');
    const country = formElement.querySelector('select[name="country"]');

    // Validate first name
    if (firstName && !validateName(firstName.value)) {
        showError(firstName, 'First name must be at least 3 characters');
        isValid = false;
    } else if (firstName) {
        clearError(firstName);
    }

    // Validate last name
    if (lastName && !validateName(lastName.value)) {
        showError(lastName, 'Last name must be at least 3 characters');
        isValid = false;
    } else if (lastName) {
        clearError(lastName);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate phone
    if (phone && !validatePhone(phone.value)) {
        showError(phone, 'Phone number must be 10 digits');
        isValid = false;
    } else if (phone) {
        clearError(phone);
    }

    // Validate address
    if (address && !validateText(address.value)) {
        showError(address, 'Address is required');
        isValid = false;
    } else if (address) {
        clearError(address);
    }

    // Validate city
    if (city && !validateText(city.value)) {
        showError(city, 'City is required');
        isValid = false;
    } else if (city) {
        clearError(city);
    }

    // Validate state
    if (state && !validateText(state.value)) {
        showError(state, 'State is required');
        isValid = false;
    } else if (state) {
        clearError(state);
    }

    // Validate ZIP code
    if (zip && !validateText(zip.value)) {
        showError(zip, 'ZIP code is required');
        isValid = false;
    } else if (zip) {
        clearError(zip);
    }

    // Validate country
    if (country && !validateText(country.value)) {
        showError(country, 'Please select a country');
        isValid = false;
    } else if (country) {
        clearError(country);
    }

    return isValid;
}

// Validate test drive form
function validateTestDriveForm(formElement) {
    let isValid = true;
    const name = formElement.querySelector('input[name="name"]');
    const email = formElement.querySelector('input[name="email"]');
    const phone = formElement.querySelector('input[name="phone"]');
    const carModel = formElement.querySelector('select[name="car_model"]');
    const date = formElement.querySelector('input[name="date"]');

    // Validate name
    if (name && !validateName(name.value)) {
        showError(name, 'Name is required');
        isValid = false;
    } else if (name) {
        clearError(name);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate phone
    if (phone && !validatePhone(phone.value)) {
        showError(phone, 'Phone number must be 10 digits');
        isValid = false;
    } else if (phone) {
        clearError(phone);
    }

    // Validate car model
    if (carModel && !validateText(carModel.value)) {
        showError(carModel, 'Please select a car model');
        isValid = false;
    } else if (carModel) {
        clearError(carModel);
    }

    // Validate date
    if (date && !validateText(date.value)) {
        showError(date, 'Please select a date');
        isValid = false;
    } else if (date) {
        clearError(date);
    }

    return isValid;
}

// Validate inquiry form
function validateInquiryForm(formElement) {
    let isValid = true;
    const name = formElement.querySelector('input[name="name"]');
    const email = formElement.querySelector('input[name="email"]');
    const message = formElement.querySelector('textarea[name="message"]');

    // Validate name
    if (name && !validateText(name.value)) {
        showError(name, 'Name is required');
        isValid = false;
    } else if (name) {
        clearError(name);
    }

    // Validate email
    if (email && !validateEmail(email.value)) {
        showError(email, 'Please enter a valid email address');
        isValid = false;
    } else if (email) {
        clearError(email);
    }

    // Validate message
    if (message && !validateText(message.value)) {
        showError(message, 'Message is required');
        isValid = false;
    } else if (message) {
        clearError(message);
    }

    return isValid;
}

// Initialize form validation
document.addEventListener('DOMContentLoaded', function() {
    // Registration form
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            if (!validateRegistrationForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Admin login form
    const adminLoginForm = document.getElementById('adminLoginForm');
    if (adminLoginForm) {
        adminLoginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Contact form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateContactForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Test drive form
    const testDriveForm = document.getElementById('testDriveForm');
    if (testDriveForm) {
        testDriveForm.addEventListener('submit', function(e) {
            if (!validateTestDriveFormByIds(this)) {
                e.preventDefault();
            }
        });
    }

    // Inquiry form
    const inquiryForm = document.getElementById('inquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            if (!validateInquiryForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Shipping form
    const shippingForm = document.getElementById('shippingForm');
    if (shippingForm) {
        shippingForm.addEventListener('submit', function(e) {
            if (!validateShippingForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Add car form
    const addCarForm = document.getElementById('addCarForm');
    if (addCarForm) {
        addCarForm.addEventListener('submit', function(e) {
            if (!validateAddCarForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Signup form
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            if (!validateSignupForm(this)) {
                e.preventDefault();
            }
        });
    }

    // Learn More form
    const learnMoreForm = document.getElementById('learnMoreForm');
    if (learnMoreForm) {
        learnMoreForm.addEventListener('submit', function(e) {
            if (!validateLearnMoreForm(this)) {
                e.preventDefault();
            }
        });
    }
});

// Real-time validation for inputs
document.addEventListener('input', function(e) {
    if (e.target.type === 'email') {
        if (validateEmail(e.target.value)) {
            clearError(e.target);
        }
    }
    if (e.target.name === 'phone') {
        if (validatePhone(e.target.value)) {
            clearError(e.target);
        }
    }
    if (e.target.name === 'password' || e.target.name === 'confirm_password') {
        if (validatePassword(e.target.value)) {
            clearError(e.target);
        }
    }
});
