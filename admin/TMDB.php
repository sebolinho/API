<?php
class TMDB {
    private $apiKey;
    private $baseUrl = 'https://api.themoviedb.org/3';
    private $imageBaseUrl = 'https://image.tmdb.org/t/p/w500';
    private $language;
    
    public function __construct($apiKey, $language = 'en-US') {
        $this->apiKey = $apiKey;
        $this->language = $language;
    }
    
    public function getTrending($mediaType = 'all', $timeWindow = 'week', $limit = 12) {
        $url = "{$this->baseUrl}/trending/{$mediaType}/{$timeWindow}?api_key={$this->apiKey}&language={$this->language}";
        $data = $this->makeRequest($url);
        
        if ($data && isset($data['results'])) {
            $results = array_slice($data['results'], 0, $limit);
            return array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'title' => $item['title'] ?? $item['name'] ?? 'Unknown',
                    'poster' => $item['poster_path'] ? $this->imageBaseUrl . $item['poster_path'] : null,
                    'backdrop' => $item['backdrop_path'] ? $this->imageBaseUrl . $item['backdrop_path'] : null,
                    'type' => $item['media_type'] ?? 'unknown'
                ];
            }, $results);
        }
        
        return [];
    }
    
    public function getTrendingMovies($limit = 12) {
        return $this->getTrending('movie', 'week', $limit);
    }
    
    public function getTrendingTV($limit = 12) {
        return $this->getTrending('tv', 'week', $limit);
    }
    
    public function getPopularAnime($limit = 12) {
        // Using TV endpoint with anime genre filter
        $url = "{$this->baseUrl}/discover/tv?api_key={$this->apiKey}&with_genres=16&sort_by=popularity.desc&language={$this->language}";
        $data = $this->makeRequest($url);
        
        if ($data && isset($data['results'])) {
            $results = array_slice($data['results'], 0, $limit);
            return array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'title' => $item['name'] ?? 'Unknown',
                    'poster' => $item['poster_path'] ? $this->imageBaseUrl . $item['poster_path'] : null,
                    'backdrop' => $item['backdrop_path'] ? $this->imageBaseUrl . $item['backdrop_path'] : null,
                    'type' => 'anime'
                ];
            }, $results);
        }
        
        return [];
    }
    
    public function getMixedTrending($limit = 36) {
        $movies = $this->getTrendingMovies(12);
        $tv = $this->getTrendingTV(12);
        $anime = $this->getPopularAnime(12);
        
        // Mix them together
        $mixed = array_merge($movies, $tv, $anime);
        shuffle($mixed);
        
        return array_slice($mixed, 0, $limit);
    }
    
    private function makeRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200 && $response) {
            return json_decode($response, true);
        }
        
        return null;
    }
}
