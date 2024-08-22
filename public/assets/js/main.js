import './navbar.js'
import './sidebar.js'
import './modal.js'


document.addEventListener('DOMContentLoaded', function () {
    // Select all dropdown toggle buttons
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    // Add click event listeners to each dropdown toggle button
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent the event from bubbling up

            // Get the corresponding dropdown menu
            const dropdownMenu = toggle.nextElementSibling;

            // Get bounding rectangles
            const toggleRect = toggle.getBoundingClientRect();
            const menuRect = dropdownMenu.getBoundingClientRect();
            const viewportHeight = window.innerHeight;

            // Determine if there's enough space below
            if (toggleRect.bottom + menuRect.height > viewportHeight) {
                // Not enough space below, show above
                dropdownMenu.style.bottom = `${toggleRect.height}px`;
                dropdownMenu.style.top = 'auto';
            } else {
                // Enough space below, show below
                dropdownMenu.style.top = `${toggleRect.height}px`;
                dropdownMenu.style.bottom = 'auto';
            }

            // Toggle the dropdown visibility
            const isShown = dropdownMenu.getAttribute('data-show') === 'true';
            dropdownMenu.setAttribute('data-show', !isShown);

            // Hide other dropdowns
            dropdownToggles.forEach(otherToggle => {
                if (otherToggle !== toggle) {
                    const otherMenu = otherToggle.nextElementSibling;
                    otherMenu.setAttribute('data-show', 'false');
                }
            });
        });
    });

    // Close all dropdowns when clicking outside
    document.addEventListener('click', (event) => {
        dropdownToggles.forEach(toggle => {
            const dropdownMenu = toggle.nextElementSibling;
            if (!toggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.setAttribute('data-show', 'false');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    /**
     * animation progress bar load after dom load with animation
     */
    // Select all progress bars with the 'progress-bar' class
    const progressBars = document.querySelectorAll('.progress-bar');

    progressBars.forEach(progressBar => {
        // Select the inner div with the 'animate-progress' class
        const progressElement = progressBar.querySelector('.animate-progress');

        // Get the target progress value from the 'data-progress' attribute
        const targetProgress = parseFloat(progressElement.getAttribute('data-progress'));

        // Set the initial width to 0 to animate from 0%
        progressElement.style.width = '0%';

        // Function to animate the progress bar
        const animateProgressBar = () => {
            // Animate the width to the target value
            progressElement.style.width = `${targetProgress}%`;

            // Select the label element inside the progress bar
            const progressLabel = progressElement.querySelector('div');

            // Update the label text and position
            let progressValue = 0;
            const updateLabel = () => {
                // Update the label with the current percentage
                progressLabel.textContent = `${progressValue}%`;

                // Calculate the left position as a percentage of the progress bar's total width
                const progressBarWidth = progressBar.clientWidth;
                const labelWidth = progressLabel.offsetWidth; // Get the actual width of the label
                const leftPosition = (progressValue / 100) * progressBarWidth;

                // Ensure the label doesn't overflow the progress bar
                const maxLeftPosition = progressBarWidth - (labelWidth / 2);
                const safeLeftPosition = Math.min(leftPosition, maxLeftPosition) - 25;

                // Set the left position of the label
                progressLabel.style.left = `${safeLeftPosition}px`;
                progressLabel.style.transform = 'translateX(-50%)';

                // Animate the bar width to the target value
                progressElement.style.width = progressValue + '%';
            };

            // Increment the progress value smoothly over 2 seconds
            const interval = setInterval(() => {
                if (progressValue < targetProgress) {
                    progressValue++;
                    updateLabel();
                } else {
                    clearInterval(interval);
                    // Final update to ensure it ends precisely at targetProgress
                    progressLabel.textContent = `${targetProgress}%`;
                    const progressBarWidth = progressBar.clientWidth;
                    const labelWidth = progressLabel.offsetWidth;
                    const leftPosition = (targetProgress / 100) * progressBarWidth;
                    const maxLeftPosition = progressBarWidth - (labelWidth / 2);
                    const safeLeftPosition = Math.min(leftPosition, maxLeftPosition) - 25;
                    progressLabel.style.left = `${safeLeftPosition}px`;
                    progressLabel.style.transform = 'translateX(-50%)';
                }
            }, 20); // Adjust this interval to match the transition duration (2 seconds for 100% => 20ms for 1%)
        };

        // Start the animation after a short delay
        setTimeout(animateProgressBar, 100); // Adjust the delay as needed
    });



    /**
     * TAB active and with custom design
     */

    function handleTabChange(tabLinks, tabPanes, animationIn, animationOut) {
        tabLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                const targetId = this.getAttribute('data-tab-toggle');
                const targetPane = document.getElementById(targetId);
                const currentPane = tabPanes.find(pane => pane.classList.contains('tab-pane-active'));

                if (targetPane && targetPane !== currentPane) {
                    // Remove active classes from all tabs and tab contents
                    tabLinks.forEach(link => link.classList.remove('tab-active'));
                    tabPanes.forEach(pane => pane.classList.remove('tab-pane-active'));

                    // Add active class to the clicked tab
                    this.classList.add('tab-active');

                    // Apply animation out to the current pane or hide if no animation
                    if (currentPane) {
                        if (animationOut) {
                            currentPane.classList.add(animationOut);
                            setTimeout(() => {
                                currentPane.classList.add('hidden');
                                currentPane.classList.remove('tab-pane-active', animationOut);
                            }, 500);
                        } else {
                            currentPane.classList.add('hidden');
                            currentPane.classList.remove('tab-pane-active');
                        }
                    }

                    // Apply animation in to the target pane or show if no animation
                    if (animationIn) {
                        targetPane.classList.remove('hidden');
                        targetPane.classList.add('tab-pane-active', animationIn);
                        setTimeout(() => {
                            targetPane.classList.remove(animationIn);
                        }, 500);
                    } else {
                        targetPane.classList.remove('hidden');
                        targetPane.classList.add('tab-pane-active');
                    }
                }
            });
        });
    }

    function initializeTabs(tabsGroup) {
        const tabLinks = tabsGroup.querySelectorAll('.tab-link');
        const tabPanes = Array.from(tabsGroup.querySelectorAll('.tab-pane'));
        const tabContent = tabsGroup.querySelector('.tab-content');

        // Determine the animation type, default to empty strings if not specified
        const animationIn = tabContent.getAttribute('data-animation-in') || '';
        const animationOut = tabContent.getAttribute('data-animation-out') || '';

        handleTabChange(tabLinks, tabPanes, animationIn, animationOut);
    }

    // Initialize all tab components
    document.querySelectorAll('[data-tabs-group]').forEach(tabsGroup => {
        initializeTabs(tabsGroup);
    });


    /**
     * File uploader with image preview
     */
    const fileInputs = document.querySelectorAll('.file-input-container');

    fileInputs.forEach(container => {
        const fileInput = container.querySelector('.form-file-input');
        const fileLabel = container.querySelector('.file-label');
        const fileNameDisplay = container.querySelector('.file-name');
        const imagePreviewContainer = container.querySelector('.image-preview');
        const imageElement = imagePreviewContainer ? imagePreviewContainer.querySelector('img') : null;

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const fileName = file.name;
                fileNameDisplay.textContent = fileName;

                // If an image preview element is available and the file is an image
                if (imageElement && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        imageElement.src = e.target.result;
                        imageElement.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                } else if (imageElement) {
                    // Hide the image preview if the file is not an image
                    imageElement.src = '';
                    imageElement.classList.add('hidden');
                }
            } else {
                fileNameDisplay.textContent = 'No file chosen';
                if (imageElement) {
                    imageElement.src = '';
                    imageElement.classList.add('hidden');
                }
            }
        });

        // Add hover and focus states to the file input label
        fileLabel.addEventListener('mouseenter', function () {
            fileLabel.classList.add('hover:bg-primary-600');
        });

        fileLabel.addEventListener('mouseleave', function () {
            fileLabel.classList.remove('hover:bg-primary-600');
        });

        fileLabel.addEventListener('focus', function () {
            fileLabel.classList.add('focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-primary-500');
        });

        fileLabel.addEventListener('blur', function () {
            fileLabel.classList.remove('focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-primary-500');
        });
    });



});


document.addEventListener('DOMContentLoaded', function () {
    const toggleAccordion = (accordion) => {
        const body = accordion.querySelector('.accordion-body');
        const icon = accordion.querySelector('.toggle-icon i');
        const isExpanded = !body.classList.contains('hidden');

        if (isExpanded) {
            body.classList.add('hidden');
            icon.classList.remove('rotate-180');
        } else {
            body.classList.remove('hidden');
            icon.classList.add('rotate-180');
        }
    };

    document.querySelectorAll('.accordion-item').forEach(function (accordion) {
        const parentHeader = accordion.querySelector('.accordion-header');
        const toggleIcon = accordion.querySelector('.toggle-icon');

        // Toggle on click of parent header or icon
        parentHeader.addEventListener('click', function () {
            toggleAccordion(accordion);
        });
        toggleIcon.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent click event from bubbling up
            toggleAccordion(accordion);
        });

        // Expand if any child checkbox is checked
        const childCheckboxes = accordion.querySelectorAll('.child-checkbox');
        childCheckboxes.forEach(function (childCheckbox) {
            if (childCheckbox.checked) {
                accordion.querySelector('.accordion-body').classList.remove('hidden');
                accordion.querySelector('.toggle-icon i').classList.add('rotate-180');
            }
        });
    });
});




/*Delete item action modal open and url set*/

$(document).ready(function (){
    $('.delete_item').on('click', function (e){
        e.preventDefault();
        let deleteUrl = $(this).data('delete_url');
        console.log(deleteUrl)
        $('#deleteDataForm').attr('action', deleteUrl);
    });

})
