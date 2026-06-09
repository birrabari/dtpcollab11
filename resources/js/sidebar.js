// resources/js/sidebar.js

document.addEventListener('DOMContentLoaded', () => {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const body = document.body;
    
    if (!sidebarToggle) return;

    // Initial state on desktop is open, on mobile is closed. We'll start open for large screens.
    if (window.innerWidth <= 1024) {
        body.classList.add('sidebar-closed');
    }

    sidebarToggle.addEventListener('click', () => {
        if(window.innerWidth <= 1024) {
            // Mobile behavior
            if(body.classList.contains('sidebar-open')) {
                body.classList.remove('sidebar-open');
                body.classList.add('sidebar-closed');
            } else {
                body.classList.add('sidebar-open');
                body.classList.remove('sidebar-closed');
            }
        } else {
            // Desktop behavior
            body.classList.toggle('sidebar-closed');
        }
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024 && body.classList.contains('sidebar-open')) {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                body.classList.remove('sidebar-open');
                body.classList.add('sidebar-closed');
            }
        }
    });
});
