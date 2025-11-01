<?php
require_once 'admin/Config.php';
$config = Config::load();
$favicon = $config['settings']['favicon'] ?? 'complete/resources/image_1.ico';
$siteTitle = $config['site']['title'] ?? 'VidLink - Biggest and Fastest Streaming API';
?>
<link rel="stylesheet" href="complete/styles.css">
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteTitle) ?></title>
    <meta name="description" content="Biggest and Fastest Streaming API">
    <meta name="referrer" content="no-referrer">
    <link rel="icon" href="<?= htmlspecialchars($favicon) ?>" type="image/x-icon">
    <link rel="canonical" href="https://vidlink.pro/">
    <?php include 'views/partials/inline-styles.php'; ?>
</head>
<body>
    <?php
    // Get initial page
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    ?>
    
    <!-- SPA Container -->
    <div id="spa-container">
        <!-- Home Page -->
        <div id="page-home" class="spa-page" style="display: <?= $page === 'home' ? 'block' : 'none' ?>">
            <?php include 'views/home.php'; ?>
        </div>
        
        <!-- Player Page -->
        <div id="page-player" class="spa-page" style="display: <?= $page === 'player' ? 'block' : 'none' ?>">
            <?php 
            $page = 'player';
            include 'views/partials/header.php';
            include 'views/player.php';
            include 'views/partials/footer.php';
            ?>
        </div>
        
        <!-- Content Page -->
        <div id="page-content" class="spa-page" style="display: <?= $page === 'content' ? 'block' : 'none' ?>">
            <?php
            $page = 'content';
            include 'views/partials/header.php';
            include 'views/content.php';
            include 'views/partials/footer.php';
            ?>
        </div>
        
        <!-- Docs Page -->
        <div id="page-docs" class="spa-page" style="display: <?= $page === 'docs' ? 'block' : 'none' ?>">
            <?php
            $page = 'docs';
            include 'views/partials/header.php';
            include 'views/docs.php';
            include 'views/partials/footer.php';
            ?>
        </div>
    </div>
    
    <style>
    .spa-page {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    </style>
    
    <script>
    // Simple SPA navigation with smooth transitions
    document.addEventListener('DOMContentLoaded', function() {
        const pages = document.querySelectorAll('.spa-page');
        let isNavigating = false;
        
        // Handle all navigation links
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href^="?page="]');
            if (link && !isNavigating) {
                e.preventDefault();
                const url = new URL(link.href);
                const pageName = url.searchParams.get('page') || 'home';
                navigateToPage(pageName);
            }
        });
        
        // Navigate to a specific page with smooth transition
        function navigateToPage(pageName) {
            if (isNavigating) return;
            isNavigating = true;
            
            // Get current and target pages
            const currentPage = document.querySelector('.spa-page[style*="display: block"]');
            const targetPage = document.getElementById('page-' + pageName);
            
            if (!targetPage || currentPage === targetPage) {
                isNavigating = false;
                return;
            }
            
            // Fade out current page
            if (currentPage) {
                currentPage.style.opacity = '0';
                currentPage.style.transform = 'translateY(-10px)';
                currentPage.style.transition = 'opacity 0.2s ease-in-out, transform 0.2s ease-in-out';
                
                setTimeout(() => {
                    currentPage.style.display = 'none';
                    currentPage.style.opacity = '1';
                    currentPage.style.transform = 'translateY(0)';
                    currentPage.style.transition = '';
                }, 200);
            }
            
            // Show and fade in target page
            setTimeout(() => {
                targetPage.style.display = 'block';
                targetPage.style.opacity = '0';
                targetPage.style.transform = 'translateY(10px)';
                
                // Force reflow
                targetPage.offsetHeight;
                
                targetPage.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';
                targetPage.style.opacity = '1';
                targetPage.style.transform = 'translateY(0)';
                
                // Update URL without reload
                const newUrl = pageName === 'home' ? '/' : '?page=' + pageName;
                history.pushState({page: pageName}, '', newUrl);
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                setTimeout(() => {
                    targetPage.style.transition = '';
                    isNavigating = false;
                }, 300);
            }, currentPage ? 200 : 0);
        }
        
        // Handle browser back/forward
        window.addEventListener('popstate', function(e) {
            const pageName = e.state?.page || 'home';
            navigateToPage(pageName);
        });
        
        // Set initial state
        const initialPage = new URLSearchParams(window.location.search).get('page') || 'home';
        history.replaceState({page: initialPage}, '', window.location.href);
    });
    </script>
</body>
</html>
