<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VidLink - Biggest and Fastest Streaming API</title>
    <meta name="description" content="Biggest and Fastest Streaming API">
    <meta name="referrer" content="no-referrer">
    <link rel="icon" href="resources/image_1.ico" type="image/x-icon" sizes="102x110">
    <link rel="canonical" href="https://vidlink.pro/" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <div id="app">
        <!-- Header/Navigation -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Main Content Area -->
        <div id="content">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'welcome';
            
            switch($page) {
                case 'player':
                    include 'pages/player.php';
                    break;
                case 'docs':
                    include 'pages/docs.php';
                    break;
                case 'welcome':
                default:
                    include 'pages/welcome.php';
                    break;
            }
            ?>
        </div>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="app.js"></script>
</body>
</html>
