<?php
/**
 * Superflix API Proxy Endpoint
 * Returns content lists from Superflix API
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../admin/SuperflixProxy.php';

// Get category parameter
$category = isset($_GET['category']) ? $_GET['category'] : 'movie';

// Validate category
if (!in_array($category, ['movie', 'serie'])) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Invalid category. Must be "movie" or "serie".',
        'success' => false
    ]);
    exit;
}

// Fetch data
$proxy = new SuperflixProxy();
$data = $proxy->fetchContentList($category);

if ($data === null) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Failed to fetch data from Superflix API',
        'success' => false
    ]);
    exit;
}

// Return successful response
echo json_encode([
    'success' => true,
    'data' => $data,
    'category' => $category
]);
