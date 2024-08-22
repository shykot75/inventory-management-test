document.addEventListener('DOMContentLoaded', function() {
    const passwordFields = document.querySelectorAll('input[type="password"]');

    passwordFields.forEach(function(passwordInput) {
        const container = passwordInput.closest('.relative');
        if (container) {
            const eyeIcon = container.querySelector('.fa-eye');
            const eyeSlashIcon = container.querySelector('.fa-eye-slash');

            if (eyeIcon && eyeSlashIcon) {
                eyeIcon.addEventListener('click', function() {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                });

                eyeSlashIcon.addEventListener('click', function() {
                    passwordInput.type = 'password';
                    eyeSlashIcon.classList.add('hidden');
                    eyeIcon.classList.remove('hidden');
                });
            }
        }
    });
});


// Select the dark mode toggle button
const darkModeToggle = document.getElementById('dark-mode-toggle');
if (darkModeToggle){
    // Add an event listener to toggle dark mode
    darkModeToggle.addEventListener('click', () => {
        // Toggle the 'dark' class on the html element
        document.documentElement.classList.toggle('dark');

        // Check if the dark class is present and set the data-mode attribute accordingly
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.setAttribute('data-mode', 'dark');
        } else {
            document.documentElement.setAttribute('data-mode', 'light');
        }
    });

// Set the initial state of the data-mode attribute based on the presence of the 'dark' class
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.setAttribute('data-mode', 'dark');
    } else {
        document.documentElement.setAttribute('data-mode', 'light');
    }
}
