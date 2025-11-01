<?php
/**
 * TMDB API Proxy Endpoint
 * Returns movie/series details from TMDB API
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../admin/Config.php';

// Load config to get TMDB API key
$config = Config::load();
$apiKey = $config['tmdb']['api_key'] ?? '';
$language = $config['tmdb']['language'] ?? 'pt-BR';

if (empty($apiKey)) {
    http_response_code(500);
    echo json_encode([
        'error' => 'TMDB API key not configured',
        'success' => false
    ]);
    exit;
}

// Get parameters
$type = isset($_GET['type']) ? $_GET['type'] : 'movie';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Validate parameters
if (!in_array($type, ['movie', 'tv'])) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Invalid type. Must be "movie" or "tv".',
        'success' => false
    ]);
    exit;
}

if (empty($id)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'ID parameter is required',
        'success' => false
    ]);
    exit;
}

// Build TMDB API URL
$url = "https://api.themoviedb.org/3/{$type}/{$id}?api_key={$apiKey}&language={$language}";

// Fetch from TMDB
$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n",
        'timeout' => 10,
        'ignore_errors' => true
    ],
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false
    ]
]);

$response = @file_get_contents($url, false, $context);

if ($response === false) {
    // Fallback to mock data for development
    $data = getMockTMDBData($type, $id);
    echo json_encode([
        'success' => true,
        'data' => $data,
        'mock' => true
    ]);
    exit;
}

// Parse response and check for errors
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    // Fallback to mock data
    $data = getMockTMDBData($type, $id);
    echo json_encode([
        'success' => true,
        'data' => $data,
        'mock' => true
    ]);
    exit;
}

// Check if TMDB returned an error
if (isset($data['status_code']) && $data['status_code'] != 1) {
    // Fallback to mock data
    $data = getMockTMDBData($type, $id);
    echo json_encode([
        'success' => true,
        'data' => $data,
        'mock' => true
    ]);
    exit;
}

// Return successful response
echo json_encode([
    'success' => true,
    'data' => $data
]);

/**
 * Generate mock TMDB data for development/testing
 */
function getMockTMDBData($type, $id) {
    $titles = [
        'The Godfather', 'Inception', 'The Dark Knight', 'Pulp Fiction', 'Forrest Gump',
        'The Matrix', 'Fight Club', 'Goodfellas', 'The Shawshank Redemption', 'Interstellar',
        'Breaking Bad', 'Game of Thrones', 'Stranger Things', 'The Office', 'Friends',
        'The Crown', 'Black Mirror', 'Westworld', 'The Mandalorian', 'Succession'
    ];
    
    $title = $titles[array_rand($titles)];
    
    return [
        'id' => intval($id),
        'title' => $type === 'movie' ? $title : null,
        'name' => $type === 'tv' ? $title : null,
        'overview' => 'Esta é uma descrição de exemplo para o conteúdo. Em produção, isso virá da API do TMDB com informações reais sobre o filme ou série.',
        'poster_path' => '/sample-poster-' . $id . '.jpg',
        'backdrop_path' => '/sample-backdrop-' . $id . '.jpg',
        'vote_average' => rand(60, 95) / 10,
        'release_date' => $type === 'movie' ? date('Y-m-d', strtotime('-' . rand(1, 365) . ' days')) : null,
        'first_air_date' => $type === 'tv' ? date('Y-m-d', strtotime('-' . rand(1, 365) . ' days')) : null,
        'media_type' => $type
    ];
}
