<?php
/**
 * SuperflixAPI Proxy Endpoint
 * Handles CORS-blocked requests to superflixapi.asia
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Validate parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'tmdb';
$format = isset($_GET['format']) ? $_GET['format'] : 'json';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Validate category
$allowedCategories = ['movie', 'serie', 'anime'];
if (!in_array($category, $allowedCategories)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid category. Must be: movie, serie, or anime']);
    exit;
}

// Validate type
$allowedTypes = ['tmdb', 'imdb'];
if (!in_array($type, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid type. Must be: tmdb or imdb']);
    exit;
}

// Build URL
$apiUrl = 'https://superflixapi.asia/lista?' . http_build_query([
    'category' => $category,
    'type' => $type,
    'format' => $format,
    'order' => $order
]);

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; ProxyBot/1.0)');

// Execute request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Handle errors
if ($error) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch data: ' . $error]);
    exit;
}

if ($httpCode !== 200) {
    http_response_code($httpCode);
    echo json_encode(['error' => 'API returned status code: ' . $httpCode]);
    exit;
}

// Return response
echo $response;
