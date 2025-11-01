/**
 * Simple SPA Router for VidLink
 * Handles client-side navigation without page reloads
 */

(function() {
    'use strict';
    
    // Get all page containers
    const pages = {
        'home': document.getElementById('home-page'),
        'player': document.getElementById('player-page'),
        'docs': document.getElementById('docs-page')
    };
    
    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav-link');
    
    /**
     * Show a specific page and hide others
     * @param {string} pageName - The page to show
     */
    function showPage(pageName) {
        // Hide all pages
        Object.keys(pages).forEach(key => {
            if (pages[key]) {
                pages[key].classList.remove('active');
            }
        });
        
        // Show the requested page
        if (pages[pageName]) {
            pages[pageName].classList.add('active');
        }
        
        // Update navigation active state
        updateNavigation(pageName);
        
        // Update URL hash
        window.location.hash = pageName === 'home' ? '' : pageName;
        
        // Scroll to top
        window.scrollTo(0, 0);
    }
    
    /**
     * Update navigation active states
     * @param {string} activePage - The currently active page
     */
    function updateNavigation(activePage) {
        navLinks.forEach(link => {
            const linkPage = link.getAttribute('data-page');
            const activeBackground = link.querySelector('.nav-active-bg');
            
            if (linkPage === activePage) {
                // Activate link
                link.classList.add('text-white');
                link.classList.remove('text-gray-600', 'dark:text-gray-300');
                if (activeBackground) {
                    activeBackground.style.opacity = '1';
                }
            } else {
                // Deactivate link
                link.classList.remove('text-white');
                link.classList.add('text-gray-600', 'dark:text-gray-300');
                if (activeBackground) {
                    activeBackground.style.opacity = '0';
                }
            }
        });
    }
    
    /**
     * Handle navigation click events
     * @param {Event} e - Click event
     */
    function handleNavigation(e) {
        e.preventDefault();
        const pageName = this.getAttribute('data-page');
        if (pageName) {
            showPage(pageName);
        }
    }
    
    /**
     * Initialize the router
     */
    function init() {
        // Add click event listeners to all navigation links
        navLinks.forEach(link => {
            link.addEventListener('click', handleNavigation);
        });
        
        // Handle browser back/forward buttons
        window.addEventListener('hashchange', function() {
            const hash = window.location.hash.substring(1);
            const pageName = hash || 'home';
            if (pages[pageName]) {
                showPage(pageName);
            }
        });
        
        // Load initial page based on URL hash
        const initialHash = window.location.hash.substring(1);
        const initialPage = initialHash && pages[initialHash] ? initialHash : 'home';
        showPage(initialPage);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
