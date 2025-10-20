<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VidLink - Biggest and Fastest Streaming API</title>
    <meta name="description" content="Biggest and Fastest Streaming API">
    <meta name="referrer" content="no-referrer">
    <link rel="icon" href="resources/image_1.ico" type="image/x-icon" sizes="102x110">
    <link rel="stylesheet" href="styles.css">
    <style>
        .page-content {
            display: none;
        }
        .page-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div data-channel-name="in_page_channel_IVUj-h" id="in-page-channel-node-id"></div>
    
    <?php include 'includes/header.php'; ?>
    
    <div id="app">
        <div id="home-page" class="page-content active">
            <?php include 'pages/home.php'; ?>
        </div>
        
        <div id="player-page" class="page-content">
            <?php include 'pages/player.php'; ?>
        </div>
        
        <div id="docs-page" class="page-content">
            <?php include 'pages/docs.php'; ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/spa-router.js"></script>
</body>
</html>
