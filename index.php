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
    
    <script>
    // Simple SPA navigation
    document.addEventListener('DOMContentLoaded', function() {
        const pages = document.querySelectorAll('.spa-page');
        
        // Handle all navigation links
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href^="?page="]');
            if (link) {
                e.preventDefault();
                const url = new URL(link.href);
                const pageName = url.searchParams.get('page') || 'home';
                navigateToPage(pageName);
            }
        });
        
        // Navigate to a specific page
        function navigateToPage(pageName) {
            // Hide all pages
            pages.forEach(page => page.style.display = 'none');
            
            // Show target page
            const targetPage = document.getElementById('page-' + pageName);
            if (targetPage) {
                targetPage.style.display = 'block';
                
                // Update URL without reload
                const newUrl = pageName === 'home' ? '/' : '?page=' + pageName;
                history.pushState({page: pageName}, '', newUrl);
            }
        }
        
        // Handle browser back/forward
        window.addEventListener('popstate', function(e) {
            const pageName = e.state?.page || 'home';
            pages.forEach(page => page.style.display = 'none');
            const targetPage = document.getElementById('page-' + pageName);
            if (targetPage) targetPage.style.display = 'block';
        });
        
        // Set initial state
        const initialPage = new URLSearchParams(window.location.search).get('page') || 'home';
        history.replaceState({page: initialPage}, '', window.location.href);
    });
    </script>
</body>
</html>
