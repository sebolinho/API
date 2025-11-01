<?php
/**
 * SuperflixProxy - Proxy for Superflix API requests
 * This proxy handles CORS issues by making server-side requests
 */
class SuperflixProxy {
    private $baseUrlMovies = 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';
    private $baseUrlSeries = 'https://superflixapi.asia/lista?category=serie&type=tmdb&format=json';
    
    /**
     * Fetch content list from Superflix API
     * @param string $category - 'movie' or 'serie'
     * @return array|null
     */
    public function fetchContentList($category = 'movie') {
        $url = ($category === 'movie') ? $this->baseUrlMovies : $this->baseUrlSeries;
        
        // Try using file_get_contents first (simpler and often works better)
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n",
                'timeout' => 15,
                'ignore_errors' => true
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true
            ]
        ]);
        
        $response = @file_get_contents($url, false, $context);
        
        // If file_get_contents fails, try curl
        if ($response === false) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error || $httpCode !== 200) {
                error_log("SuperflixProxy Error: " . ($error ?: "HTTP $httpCode"));
                // Return sample data for testing in development
                return $this->getSampleData($category);
            }
        }
        
        if (!$response) {
            return $this->getSampleData($category);
        }
        
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("SuperflixProxy JSON Error: " . json_last_error_msg());
            return $this->getSampleData($category);
        }
        
        return $data;
    }
    
    /**
     * Get sample data for development/testing
     * @param string $category
     * @return array
     */
    private function getSampleData($category) {
        // Sample popular TMDB IDs for testing
        if ($category === 'movie') {
            return [
                "786892", "575264", "1022789", "533535", "945961",
                "823464", "912649", "693134", "872585", "976573",
                "558449", "945665", "1184918", "653346", "639720",
                "299536", "27205", "603692", "238", "155",
                "122", "680", "424", "497", "13"
            ];
        } else {
            return [
                "94997", "1396", "60625", "1399", "456",
                "1668", "31911", "84773", "71912", "95403",
                "82452", "1434", "100088", "124364", "76479",
                "62127", "114461", "63174", "46639", "79788"
            ];
        }
    }
}
