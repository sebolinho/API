<?php
// Simple proxy to avoid CORS issues and protect API keys
// Disable HTML error output to prevent JSON parsing errors
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Set JSON content type first
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Try to load config, handle errors gracefully
try {
    require_once __DIR__ . '/../admin/Config.php';
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Configuration error: ' . $e->getMessage()]);
    exit;
}

$url = $_GET['url'] ?? '';

if (empty($url)) {
    http_response_code(400);
    echo json_encode(['error' => 'URL parameter is required']);
    exit;
}

// Validate URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid URL']);
    exit;
}

// Only allow SuperflixAPI and TMDB API
$allowedDomains = ['superflixapi.asia', 'api.themoviedb.org'];
$allowed = false;
$isTmdbRequest = false;

foreach ($allowedDomains as $domain) {
    if (strpos($url, $domain) !== false) {
        $allowed = true;
        if ($domain === 'api.themoviedb.org') {
            $isTmdbRequest = true;
        }
        break;
    }
}

if (!$allowed) {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden URL']);
    exit;
}

// Inject TMDB API key if this is a TMDB request
if ($isTmdbRequest) {
    try {
        $config = Config::load();
        $apiKey = $config['tmdb']['api_key'] ?? '';
        
        if (empty($apiKey)) {
            http_response_code(500);
            echo json_encode(['error' => 'TMDB API key not configured']);
            exit;
        }
        
        // Add or replace api_key parameter
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $queryParams);
        $queryParams['api_key'] = $apiKey;
        
        $url = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'] . '?' . http_build_query($queryParams);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to load configuration: ' . $e->getMessage()]);
        exit;
    }
}

// Fetch the data
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// Check if we should verify SSL (can be disabled for testing)
$verifySSL = true;
if (isset($_GET['disable_ssl_verify']) && $_GET['disable_ssl_verify'] === '1') {
    $verifySSL = false;
}
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySSL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $verifySSL ? 2 : 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
// Add DNS timeout
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
$curlErrno = curl_errno($ch);
$info = curl_getinfo($ch);
curl_close($ch);

if ($response === false) {
    http_response_code(500);
    $source = $isTmdbRequest ? 'TMDB API' : 'external API';
    
    // Provide helpful error messages based on error type
    $helpMessage = '';
    if ($curlErrno === 6) { // CURLE_COULDNT_RESOLVE_HOST
        $helpMessage = 'DNS resolution failed. Check server DNS configuration.';
    } elseif ($curlErrno === 7) { // CURLE_COULDNT_CONNECT
        $helpMessage = 'Connection failed. Check firewall and network settings.';
    } elseif ($curlErrno === 28) { // CURLE_OPERATION_TIMEDOUT
        $helpMessage = 'Request timed out. The API may be slow or unreachable.';
    } elseif ($curlErrno === 60 || $curlErrno === 77) { // SSL errors
        $helpMessage = 'SSL certificate verification failed. Try updating CA certificates.';
    }
    
    echo json_encode([
        'error' => "Failed to connect to {$source}",
        'details' => $curlError,
        'error_code' => $curlErrno,
        'help' => $helpMessage,
        'http_code' => $httpCode
    ]);
} elseif ($httpCode == 200 && $response) {
    echo $response;
} else {
    http_response_code($httpCode ?: 500);
    $source = $isTmdbRequest ? 'TMDB API' : 'external API';
    echo json_encode([
        'error' => "Failed to fetch data from {$source}",
        'http_code' => $httpCode,
        'response_preview' => substr($response, 0, 200)  // First 200 chars for debugging
    ]);
}
