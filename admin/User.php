<?php
class User {
    private static $usersFile = __DIR__ . '/../data/users.json';
    private static $users = null;
    
    public static function load() {
        if (self::$users === null) {
            if (file_exists(self::$usersFile)) {
                $content = file_get_contents(self::$usersFile);
                self::$users = json_decode($content, true);
            } else {
                // Create default admin user
                self::$users = [
                    'admin' => [
                        'username' => 'admin',
                        'password' => password_hash('admin123', PASSWORD_BCRYPT),
                        'role' => 'administrator',
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                ];
                self::save();
            }
        }
        return self::$users;
    }
    
    public static function save() {
        $json = json_encode(self::$users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::$usersFile, $json);
        return true;
    }
    
    public static function authenticate($username, $password) {
        $users = self::load();
        if (isset($users[$username])) {
            if (password_verify($password, $users[$username]['password'])) {
                return $users[$username];
            }
        }
        return false;
    }
    
    public static function getAll() {
        $users = self::load();
        // Remove passwords before returning
        $result = [];
        foreach ($users as $username => $user) {
            $result[$username] = [
                'username' => $user['username'],
                'role' => $user['role'],
                'created_at' => $user['created_at']
            ];
        }
        return $result;
    }
    
    public static function get($username) {
        $users = self::load();
        if (isset($users[$username])) {
            $user = $users[$username];
            unset($user['password']);
            return $user;
        }
        return null;
    }
    
    public static function create($username, $password, $role = 'editor') {
        $users = self::load();
        if (isset($users[$username])) {
            return false; // User already exists
        }
        
        $users[$username] = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        self::$users = $users;
        return self::save();
    }
    
    public static function update($username, $data) {
        $users = self::load();
        if (!isset($users[$username])) {
            return false;
        }
        
        // Update only allowed fields
        if (isset($data['password']) && !empty($data['password'])) {
            $users[$username]['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        if (isset($data['role'])) {
            $users[$username]['role'] = $data['role'];
        }
        
        self::$users = $users;
        return self::save();
    }
    
    public static function delete($username) {
        $users = self::load();
        if (!isset($users[$username])) {
            return false;
        }
        
        // Don't allow deleting the last admin
        $adminCount = 0;
        foreach ($users as $user) {
            if ($user['role'] === 'administrator') {
                $adminCount++;
            }
        }
        
        if ($adminCount <= 1 && $users[$username]['role'] === 'administrator') {
            return false; // Cannot delete the last administrator
        }
        
        unset($users[$username]);
        self::$users = $users;
        return self::save();
    }
}
