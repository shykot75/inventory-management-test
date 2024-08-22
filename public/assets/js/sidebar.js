// sidebar.js

document.addEventListener('DOMContentLoaded', function() {

    // Initialize expanded menus for active items
    document.querySelectorAll('.dropdown-item.active').forEach(function (activeItem) {
        let dropdownMenu = activeItem.closest('.dropdown-menu');
        if (dropdownMenu) {
            dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + 'px';
            let parentItem = dropdownMenu.previousElementSibling;
            if (parentItem && parentItem.querySelector('.arrow-icon')) {
                parentItem.querySelector('.arrow-icon').classList.add('rotate-180');
            }
            // Make the parent item active
            if (parentItem) {
                parentItem.classList.add('active');
            }
        }
    });

    // Handle click event on parent item to toggle dropdown
    document.querySelectorAll('.parent-item').forEach(function(parentItem) {
        parentItem.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            const arrow = this.querySelector('.arrow-icon');
            const isExpanded = dropdown.style.maxHeight && dropdown.style.maxHeight !== '0px';

            // Collapse all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(function(otherDropdown) {
                if (otherDropdown !== dropdown) {
                    otherDropdown.style.maxHeight = '0';
                    const otherParentItem = otherDropdown.previousElementSibling;
                    if (otherParentItem && otherParentItem.querySelector('.arrow-icon')) {
                        otherParentItem.querySelector('.arrow-icon').classList.remove('rotate-180');
                    }
                    // Remove active class from other parent items
                    if (otherParentItem) {
                        otherParentItem.classList.remove('active');
                    }
                }
            });

            if (!isExpanded) {
                // Expand the clicked dropdown
                dropdown.style.maxHeight = (dropdown.scrollHeight + 30) + 'px';
                if (arrow) arrow.classList.add('rotate-180');
                // Make the parent item active
                this.classList.add('active');
            } else {
                // Collapse the clicked dropdown
                dropdown.style.maxHeight = '0';
                if (arrow) arrow.classList.remove('rotate-180');
                // Remove the active class from the parent item
                this.classList.remove('active');
            }
        });
    });


    if (document.getElementById('toggle-sidebar')){
        // Toggle sidebar on button click
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            // Check if the viewport width is 1024px or larger
            if (window.innerWidth >= 1024) {
                // For larger screens, toggle the minimized class
                sidebar.classList.toggle('minimized');
                document.querySelector('.app-menu').style.width = sidebar.classList.contains('minimized') ? '4rem' : '17rem';
            } else {
                // For smaller screens, toggle the open class to show/hide the sidebar
                if (sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                } else {
                    sidebar.classList.add('open');
                    overlay.classList.add('active');
                }
            }
        });
    }


    if (document.getElementById('overlay')){
        // Close sidebar when clicking outside
        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            this.classList.remove('active');
        });
    }


    // Adjust sidebar on window resize
    window.addEventListener('resize', function() {
        // Close the sidebar if the viewport width is larger than 1024px
        if (window.innerWidth >= 1024) {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('active');
        }
    });

    // Handle hover effects for minimized sidebar
    document.querySelectorAll('.menu-item').forEach(function(menuItem) {
        menuItem.addEventListener('mouseenter', function() {
            if (document.getElementById('sidebar').classList.contains('minimized')) {
                document.querySelector('.app-menu').style.width = '18rem';
                this.querySelector('.menu-title').classList.add('minimized-menu-title');
                this.querySelector('.dropdown-menu').classList.add('minimized-dropdown-menu');
                const dropdown = this.querySelector('.dropdown-menu');
                dropdown.style.maxHeight = (dropdown.scrollHeight + 30) + 'px';
            }
        });

        menuItem.addEventListener('mouseleave', function() {
            if (document.getElementById('sidebar').classList.contains('minimized')) {
                document.querySelector('.app-menu').style.width = '4rem';
                this.querySelector('.menu-title').classList.remove('minimized-menu-title');
                this.querySelector('.dropdown-menu').classList.remove('minimized-dropdown-menu').style.maxHeight=0;
            }
        });
    });

    // Hover effects for parent and dropdown items in minimized sidebar
    document.querySelectorAll('.parent-item, .dropdown-menu, .dropdown-item, .dropdown-item>a').forEach(function(item) {
        item.addEventListener('mouseover', function(event) {
            if (document.getElementById('sidebar').classList.contains('minimized')) {
                document.querySelector('.app-menu').style.width = '18rem';
                let menuItem = this.closest('.menu-item');
                const dropdown = menuItem.querySelector('.dropdown-menu');
                if (menuItem) {
                    menuItem.querySelector('.menu-title').classList.add('minimized-menu-title');
                    menuItem.querySelector('.dropdown-menu').classList.add('minimized-dropdown-menu');
                    dropdown.style.maxHeight = (dropdown.scrollHeight + 30) + 'px';
                }
            }
        });
    
        item.addEventListener('mouseout', function(event) {
            if (document.getElementById('sidebar').classList.contains('minimized')) {
                // Check if the mouse has moved to a different element inside the same dropdown menu
                if (!this.contains(event.relatedTarget)) {
                    document.querySelector('.app-menu').style.width = '4rem';
                    let menuItem = this.closest('.menu-item');
                    const dropdown = menuItem.querySelector('.dropdown-menu');
                    if (menuItem) {
                        menuItem.querySelector('.menu-title').classList.remove('minimized-menu-title');
                        menuItem.querySelector('.dropdown-menu').classList.remove('minimized-dropdown-menu');
                        dropdown.style.maxHeight = '0';
                    }
                }
            }
        });
    });
    
});
