/**
 * Simple SPA Router for dynamic content loading
 * Handles navigation without page reloads with smooth transitions
 */

class SPARouter {
    constructor() {
        this.currentPage = null;
        this.transitionDuration = 300; // ms
        this.init();
    }

    init() {
        // Handle initial page load
        const page = this.getPageFromURL();
        this.loadPage(page, false);

        // Handle browser back/forward buttons
        window.addEventListener('popstate', (e) => {
            const page = e.state?.page || 'home';
            this.loadPage(page, false);
        });

        // Intercept navigation clicks
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href^="?page="]');
            if (link) {
                e.preventDefault();
                const url = new URL(link.href);
                const page = url.searchParams.get('page') || 'home';
                this.navigate(page);
            }
        });
    }

    getPageFromURL() {
        const params = new URLSearchParams(window.location.search);
        return params.get('page') || 'home';
    }

    async navigate(page) {
        if (page === this.currentPage) return;

        // Update URL
        const url = new URL(window.location);
        url.searchParams.set('page', page);
        history.pushState({ page }, '', url);

        // Load page with transition
        await this.loadPage(page, true);
    }

    async loadPage(page, animate = true) {
        const contentDiv = document.getElementById('spa-content');
        if (!contentDiv) return;

        try {
            // Fade out
            if (animate) {
                contentDiv.style.opacity = '0';
                contentDiv.style.transform = 'translateY(20px)';
                await this.wait(this.transitionDuration);
            }

            // Fetch new content
            const response = await fetch(`?page=${page}&spa=1`);
            if (!response.ok) throw new Error('Failed to load page');
            
            const html = await response.text();
            contentDiv.innerHTML = html;

            // Update active nav link
            this.updateActiveNav(page);

            // Fade in
            if (animate) {
                contentDiv.style.opacity = '0';
                contentDiv.style.transform = 'translateY(20px)';
                
                // Force reflow
                contentDiv.offsetHeight;
                
                contentDiv.style.transition = `opacity ${this.transitionDuration}ms ease, transform ${this.transitionDuration}ms ease`;
                contentDiv.style.opacity = '1';
                contentDiv.style.transform = 'translateY(0)';
            } else {
                contentDiv.style.opacity = '1';
                contentDiv.style.transform = 'translateY(0)';
            }

            this.currentPage = page;

            // Re-run any page-specific scripts
            this.initPageScripts();

        } catch (error) {
            console.error('Error loading page:', error);
            contentDiv.innerHTML = '<div style="padding: 2rem; text-align: center; color: #dc3545;">Error loading page. Please refresh.</div>';
        }
    }

    updateActiveNav(page) {
        // Remove active class from all nav links
        document.querySelectorAll('nav a, .navbar a').forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.includes('?page=')) {
                const linkPage = new URL(href, window.location.origin).searchParams.get('page');
                
                // Update classes
                link.classList.remove('text-white');
                link.classList.add('text-gray-600', 'dark:text-gray-300');
                
                if (linkPage === page) {
                    link.classList.remove('text-gray-600', 'dark:text-gray-300');
                    link.classList.add('text-white');
                }
                
                // Update background gradient
                const bgDiv = link.querySelector('.absolute');
                if (bgDiv) {
                    bgDiv.style.opacity = linkPage === page ? '1' : '0';
                }
            }
        });
    }

    initPageScripts() {
        // Initialize scripts for dynamically loaded content
        // This can be extended for page-specific initializations
        
        // Example: Re-initialize player scripts
        if (typeof initializePlayer === 'function') {
            initializePlayer();
        }
    }

    wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

// Initialize router when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.spaRouter = new SPARouter();
    });
} else {
    window.spaRouter = new SPARouter();
}
