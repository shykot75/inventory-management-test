// navbar.js

document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown toggle on user menu button click
    if (document.getElementById('user-menu-button')){
        document.getElementById('user-menu-button').addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent click from propagating to document
            const profileDropdown = document.getElementById('profile-dropdown');
            profileDropdown.classList.toggle('hidden');
            profileDropdown.classList.toggle('opacity-0');
            profileDropdown.classList.toggle('scale-95');
            profileDropdown.classList.toggle('opacity-100');
            profileDropdown.classList.toggle('scale-100');
        });
    }


    // Hide profile dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#profile-dropdown, #user-menu-button')) {
            const profileDropdown = document.getElementById('profile-dropdown');
            profileDropdown.classList.add('hidden');
            profileDropdown.classList.remove('opacity-100');
            profileDropdown.classList.remove('scale-100');
            profileDropdown.classList.add('opacity-0');
            profileDropdown.classList.add('scale-95');
        }
    });

    // Notification drawer toggle
    const notificationToggle = document.getElementById('notification-toggle');
    const notificationDrawer = document.getElementById('notification-drawer');
    const overlay = document.getElementById('overlay');

    if (notificationToggle){
        notificationToggle.addEventListener('click', () => {
            notificationDrawer.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        });

    }

    if (overlay){
        // Hide notification drawer when clicking outside
        overlay.addEventListener('click', () => {
            notificationDrawer.classList.add('hidden');
            overlay.classList.add('hidden');
        });
    }

});
