<link rel="stylesheet" href="complete/styles.css">
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VidLink - Biggest and Fastest Streaming API</title>
    <meta name="description" content="Biggest and Fastest Streaming API">
    <meta name="referrer" content="no-referrer">
    <link rel="icon" href="complete/resources/image_1.ico" type="image/x-icon">
    <link rel="canonical" href="https://vidlink.pro/">
    <?php include 'views/partials/inline-styles.php'; ?>
</head>
<body>
    <?php
    // Simple PHP SPA Router
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    
    // Route to appropriate view
    switch ($page) {
        case 'player':
            // Include header for non-home pages
            include 'views/partials/header.php';
            include 'views/player.php';
            include 'views/partials/footer.php';
            break;
        case 'docs':
            // Include header for non-home pages
            include 'views/partials/header.php';
            include 'views/docs.php';
            include 'views/partials/footer.php';
            break;
        case 'home':
        default:
            // Home page has header/footer embedded in the content
            include 'views/home.php';
            break;
    }
    ?>
</body>
</html>
