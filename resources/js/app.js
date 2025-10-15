// Global functions that will be used across all pages
window.toggleDropdown = function(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');

    // Close other dropdowns
    document.querySelectorAll('[id^="order-"]').forEach(el => {
        if (el.id !== id) {
            el.classList.add('hidden');
        }
    });
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.relative')) {
        document.querySelectorAll('[id^="order-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});

window.toggleMobileSidebar = function() {
    document.getElementById('mobile-sidebar').classList.toggle('hidden');
}

window.toggleDarkMode = function() {
    document.body.classList.toggle('dark-mode');
    // Save preference to localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
}

// Check for saved dark mode preference
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
});
