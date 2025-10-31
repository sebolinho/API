<?php
class Config {
    private static $configFile = __DIR__ . '/../data/config.json';
    private static $config = null;
    
    public static function load() {
        if (self::$config === null) {
            if (file_exists(self::$configFile)) {
                $content = file_get_contents(self::$configFile);
                self::$config = json_decode($content, true);
            } else {
                self::$config = self::getDefaults();
            }
        }
        return self::$config;
    }
    
    public static function save($config) {
        $json = json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::$configFile, $json);
        self::$config = $config;
        return true;
    }
    
    public static function get($key, $default = '') {
        $config = self::load();
        $keys = explode('.', $key);
        $value = $config;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
    
    public static function set($key, $value) {
        $config = self::load();
        $keys = explode('.', $key);
        $current = &$config;
        
        foreach ($keys as $k) {
            if (!isset($current[$k])) {
                $current[$k] = [];
            }
            $current = &$current[$k];
        }
        
        $current = $value;
        return self::save($config);
    }
    
    private static function getDefaults() {
        return [
            'site' => [
                'title' => 'VidLink - Biggest and Fastest Streaming API',
                'logo_text' => 'MEGAEMBED',
                'headline' => 'MEGAEMBED',
                'subheadline' => 'Biggest and Fastest Streaming API'
            ],
            'colors' => [
                'navbar_bg' => 'rgba(255, 255, 255, 0.5)',
                'navbar_bg_dark' => 'rgba(31, 41, 55, 0.5)'
            ],
            'tmdb' => [
                'api_key' => '',
                'enabled' => false
            ]
        ];
    }
}
