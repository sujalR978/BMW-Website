/* ============================================
   DARK THEME - TOGGLE SCRIPT
   ============================================ */

// Initialize dark theme on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeDarkTheme();
    setupThemeToggle();
});

// Initialize dark theme based on user preference
function initializeDarkTheme() {
    // Check localStorage for saved theme preference
    const savedTheme = localStorage.getItem('bmw-theme');
    
    // Check system preference
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // Set theme: saved preference > system preference > light theme
    const isDarkTheme = savedTheme === 'dark' || (savedTheme === null && prefersDark);
    
    if (isDarkTheme) {
        enableDarkTheme();
    } else {
        disableDarkTheme();
    }
}

// Enable dark theme
function enableDarkTheme() {
    document.body.classList.add('dark-theme');
    document.documentElement.style.colorScheme = 'dark';
    localStorage.setItem('bmw-theme', 'dark');
    
    loadDarkThemeCSS();
    updateThemeToggleButton(true);
}

// Disable dark theme
function disableDarkTheme() {
    document.body.classList.remove('dark-theme');
    document.documentElement.style.colorScheme = 'light';
    localStorage.setItem('bmw-theme', 'light');
    
    removeDarkThemeCSS();
    updateThemeToggleButton(false);
}

// Load dark theme CSS files
function loadDarkThemeCSS() {
    const darkThemeSheets = [
        'dark-theme/dark-common.css',
        'dark-theme/dark-header-footer.css',
        'dark-theme/dark-index.css',
        'dark-theme/dark-sound.css',
        'dark-theme/dark-car-models.css'
    ];
    
    darkThemeSheets.forEach(sheet => {
        if (!document.querySelector(`link[href="${sheet}"]`)) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = sheet;
            link.className = 'dark-theme-css';
            document.head.appendChild(link);
        }
    });
}

// Remove dark theme CSS files
function removeDarkThemeCSS() {
    const darkThemeLinks = document.querySelectorAll('.dark-theme-css');
    darkThemeLinks.forEach(link => link.remove());
}

// Setup theme toggle button
function setupThemeToggle() {
    // First, check for footer button
    let toggleButton = document.querySelector('#theme-toggle-footer');
    
    // If no footer button found, create a floating button
    if (!toggleButton) {
        toggleButton = document.createElement('button');
        toggleButton.className = 'theme-toggle-btn';
        toggleButton.innerHTML = '<span class="theme-icon">🌙</span>';
        toggleButton.id = 'theme-toggle-floating';
        toggleButton.title = 'Toggle Dark Mode';
        toggleButton.setAttribute('aria-label', 'Toggle Dark Mode');
        document.body.appendChild(toggleButton);
    }
    
    // Update button state
    const isDarkTheme = document.body.classList.contains('dark-theme');
    updateThemeToggleButton(isDarkTheme);
    
    // Add click event listener to the button
    toggleButton.addEventListener('click', toggleTheme);
    
    // Also check for any other toggle buttons that might exist
    const allToggleButtons = document.querySelectorAll('[data-theme-toggle]');
    allToggleButtons.forEach(btn => {
        btn.addEventListener('click', toggleTheme);
    });
}

// Toggle theme
function toggleTheme() {
    const isDarkTheme = document.body.classList.contains('dark-theme');
    
    if (isDarkTheme) {
        disableDarkTheme();
    } else {
        enableDarkTheme();
    }
}

// Update toggle button appearance
function updateThemeToggleButton(isDarkTheme) {
    // Update footer button
    const footerBtn = document.querySelector('#theme-toggle-footer');
    if (footerBtn) {
        const icon = footerBtn.querySelector('.theme-icon');
        if (isDarkTheme) {
            if (icon) icon.innerHTML = '☀️';
            footerBtn.title = 'Switch to Light Mode';
        } else {
            if (icon) icon.innerHTML = '🌙';
            footerBtn.title = 'Switch to Dark Mode';
        }
    }
    
    // Update floating button if it exists
    const floatingBtn = document.querySelector('#theme-toggle-floating');
    if (floatingBtn) {
        const icon = floatingBtn.querySelector('.theme-icon');
        if (isDarkTheme) {
            if (icon) icon.innerHTML = '☀️';
            floatingBtn.classList.add('dark-mode');
            floatingBtn.title = 'Switch to Light Mode';
        } else {
            if (icon) icon.innerHTML = '🌙';
            floatingBtn.classList.remove('dark-mode');
            floatingBtn.title = 'Switch to Dark Mode';
        }
    }
}

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    // Only auto-switch if user hasn't manually set a preference
    if (localStorage.getItem('bmw-theme') === null) {
        if (e.matches) {
            enableDarkTheme();
        } else {
            disableDarkTheme();
        }
    }
});

// Function to manually set theme
function setTheme(theme) {
    if (theme === 'dark') {
        enableDarkTheme();
    } else if (theme === 'light') {
        disableDarkTheme();
    }
}

// Function to get current theme
function getTheme() {
    return localStorage.getItem('bmw-theme') || 'light';
}

// Function to toggle theme with callback
function toggleThemeWithCallback(callback) {
    toggleTheme();
    if (typeof callback === 'function') {
        callback(getTheme());
    }
}
