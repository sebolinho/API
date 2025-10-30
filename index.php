<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VidLink - Biggest and Fastest Streaming API</title>
    <meta name="description" content="Biggest and Fastest Streaming API">
    <link rel="icon" href="complete/resources/image_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="complete/styles.css">
</head>
<body>
    <div id="app">
        <?php
        // Simple PHP SPA Router
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        
        // Include header
        include 'views/partials/header.php';
        
        // Route to appropriate view
        switch ($page) {
            case 'player':
                include 'views/player.php';
                break;
            case 'docs':
                include 'views/docs.php';
                break;
            case 'home':
            default:
                include 'views/home.php';
                break;
        }
        
        // Include footer
        include 'views/partials/footer.php';
        ?>
    </div>
</body>
</html>
