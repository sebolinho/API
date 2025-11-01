<?php
// Simple proxy to avoid CORS issues and protect API keys
// Disable HTML error output to prevent JSON parsing errors
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Check if debug mode is enabled
$debugMode = isset($_GET['debug']) && $_GET['debug'] === '1';

// Set JSON content type first
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Debug info array
$debugInfo = [];

if ($debugMode) {
    $debugInfo['timestamp'] = date('Y-m-d H:i:s');
    $debugInfo['php_version'] = phpversion();
    $debugInfo['request_method'] = $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN';
}

// Try to load config, handle errors gracefully
try {
    require_once __DIR__ . '/../admin/Config.php';
    if ($debugMode) {
        $debugInfo['config_loaded'] = true;
    }
} catch (Exception $e) {
    http_response_code(500);
    $error = ['error' => 'Configuration error: ' . $e->getMessage()];
    if ($debugMode) {
        $error['debug'] = $debugInfo;
    }
    echo json_encode($error);
    exit;
}

$url = $_GET['url'] ?? '';

if ($debugMode) {
    $debugInfo['requested_url'] = $url;
}

if (empty($url)) {
    http_response_code(400);
    $error = ['error' => 'URL parameter is required'];
    if ($debugMode) {
        $error['debug'] = $debugInfo;
        $error['usage'] = 'proxy.php?url=<encoded_url>&debug=1';
    }
    echo json_encode($error);
    exit;
}

// Validate URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    $error = ['error' => 'Invalid URL'];
    if ($debugMode) {
        $error['debug'] = $debugInfo;
    }
    echo json_encode($error);
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

if ($debugMode) {
    $debugInfo['allowed_domains'] = $allowedDomains;
    $debugInfo['url_allowed'] = $allowed;
    $debugInfo['is_tmdb_request'] = $isTmdbRequest;
}

if (!$allowed) {
    http_response_code(403);
    $error = ['error' => 'Forbidden URL'];
    if ($debugMode) {
        $error['debug'] = $debugInfo;
        $error['allowed_domains'] = $allowedDomains;
    }
    echo json_encode($error);
    exit;
}

// Inject TMDB API key if this is a TMDB request
if ($isTmdbRequest) {
    try {
        $config = Config::load();
        $apiKey = $config['tmdb']['api_key'] ?? '';
        
        if (empty($apiKey)) {
            http_response_code(500);
            $error = ['error' => 'TMDB API key not configured'];
            if ($debugMode) {
                $error['debug'] = $debugInfo;
            }
            echo json_encode($error);
            exit;
        }
        
        // Add or replace api_key parameter
        $urlParts = parse_url($url);
        parse_str($urlParts['query'] ?? '', $queryParams);
        $queryParams['api_key'] = $apiKey;
        
        $url = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'] . '?' . http_build_query($queryParams);
        
        if ($debugMode) {
            $debugInfo['api_key_injected'] = true;
            $debugInfo['final_url'] = preg_replace('/api_key=[^&]+/', 'api_key=***HIDDEN***', $url);
        }
    } catch (Exception $e) {
        http_response_code(500);
        $error = ['error' => 'Failed to load configuration: ' . $e->getMessage()];
        if ($debugMode) {
            $error['debug'] = $debugInfo;
        }
        echo json_encode($error);
        exit;
    }
}

// Fetch the data
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);

if ($debugMode) {
    $debugInfo['curl_options'] = [
        'CURLOPT_TIMEOUT' => 30,
        'CURLOPT_CONNECTTIMEOUT' => 10,
        'CURLOPT_SSL_VERIFYPEER' => true,
    ];
}

$startTime = microtime(true);
$response = curl_exec($ch);
$endTime = microtime(true);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
$curlErrno = curl_errno($ch);
$info = curl_getinfo($ch);
curl_close($ch);

if ($debugMode) {
    $debugInfo['execution_time'] = round(($endTime - $startTime) * 1000, 2) . 'ms';
    $debugInfo['http_code'] = $httpCode;
    $debugInfo['curl_errno'] = $curlErrno;
    $debugInfo['curl_error'] = $curlError;
    $debugInfo['response_size'] = strlen($response);
    $debugInfo['content_type'] = $info['content_type'] ?? 'unknown';
}

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
    
    $error = [
        'error' => "Failed to connect to {$source}",
        'details' => $curlError,
        'error_code' => $curlErrno,
        'help' => $helpMessage,
        'http_code' => $httpCode
    ];
    
    if ($debugMode) {
        $error['debug'] = $debugInfo;
    }
    
    echo json_encode($error);
} elseif ($httpCode == 200 && $response) {
    if ($debugMode) {
        // Wrap response with debug info
        $responseData = json_decode($response, true);
        if ($responseData !== null) {
            $output = [
                'success' => true,
                'data' => $responseData,
                'debug' => $debugInfo
            ];
            echo json_encode($output);
        } else {
            // Not JSON, return as-is with debug header
            header('X-Debug-Info: ' . base64_encode(json_encode($debugInfo)));
            echo $response;
        }
    } else {
        echo $response;
    }
} else {
    http_response_code($httpCode ?: 500);
    $source = $isTmdbRequest ? 'TMDB API' : 'external API';
    $error = [
        'error' => "Failed to fetch data from {$source}",
        'http_code' => $httpCode,
        'response_preview' => substr($response, 0, 200)
    ];
    
    if ($debugMode) {
        $error['debug'] = $debugInfo;
    }
    
    echo json_encode($error);
}
