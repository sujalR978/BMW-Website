// Admin Dashboard JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Animate bars on scroll into view with enhanced effects
    const barItems = document.querySelectorAll('.bar-item');
    barItems.forEach((item, index) => {
        const bar = item.querySelector('.bar');
        if (bar) {
            // bar.style.animation = `slideUp 0.8s ease-out ${index * 0.05 + 0.1}s forwards`;
        }
    });

    // Add glow effect on hover for stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            // this.style.animation = 'glow 2s ease-in-out infinite';
        });
        card.addEventListener('mouseleave', function() {
            // this.style.animation = 'none';
        });
    });

    // Add ripple effect on table rows
    document.querySelectorAll('.inquiry-row').forEach(row => {
        row.addEventListener('click', function() {
            // this.style.animation = 'pulse 0.6s ease-out';
            setTimeout(() => {
                // this.style.animation = 'none';
            }, 600);
        });
    });

    // Add button click handlers with enhanced feedback
    document.querySelectorAll('.btn-confirm, .btn-cancel').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.classList.contains('btn-confirm') ? 'Confirmed' : 'Cancelled';
            const bookingCard = this.closest('.booking-card');
            const userName = bookingCard.querySelector('.user-info h3').textContent;
            console.log(`${action}: ${userName}`);
            
            // Add visual feedback with pulse
            // this.style.animation = 'pulse 0.4s ease-out';
            setTimeout(() => {
                // this.style.animation = 'none';
            }, 400);
        });
    });

    // Enhanced intersection observer for lazy animations
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                
                // Add different animations based on element type
                if (element.classList.contains('stat-card')) {
                    // element.style.animation = 'scaleIn 0.6s ease-out forwards';
                } else if (element.classList.contains('booking-card')) {
                    // element.style.animation = 'scaleIn 0.6s ease-out forwards';
                } else if (element.classList.contains('inquiry-row')) {
                    // element.style.animation = 'slideInUp 0.6s ease-out forwards';
                } else {
                    // element.style.animation = 'slideUp 0.8s ease-out forwards';
                }
                
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Observe all animatable elements
    document.querySelectorAll('section, .stat-card, .booking-card, .inquiry-row').forEach(el => {
        observer.observe(el);
    });

    // Add smooth number counter animation for stat cards
    const statValues = document.querySelectorAll('.stat-value');
    statValues.forEach(element => {
        const finalValue = element.textContent;
        element.addEventListener('mouseenter', function() {
            // Trigger a subtle highlight animation
            // this.style.animation = 'pulse 1s ease-in-out infinite';
        });
        element.addEventListener('mouseleave', function() {
            // this.style.animation = 'none';
        });
    });

    // Add scroll reveal effect for headings
    const headings = document.querySelectorAll('h1, h2, h3');
    headings.forEach(heading => {
        observer.observe(heading);
    });

    // Add floating animation to welcome stats on load
    window.addEventListener('load', function() {
        document.querySelectorAll('.welcome-stat').forEach((stat, index) => {
            // stat.style.animationDelay = `${index * 0.2}s`;
        });
    });
});

// Mouse move effect for enhanced interactivity
document.addEventListener('mousemove', function(e) {
    const cards = document.querySelectorAll('.booking-card, .stat-card');
    cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        // Create subtle tilt effect
        const xPercent = (x / rect.width - 0.5) * 2;
        const yPercent = (y / rect.height - 0.5) * 2;
        
        // Apply subtle transform on hover
        if (e.target.closest(card.className)) {
            card.style.setProperty('--mouse-x', `${xPercent * 5}deg`);
            card.style.setProperty('--mouse-y', `${yPercent * 5}deg`);
        }
    });
});
