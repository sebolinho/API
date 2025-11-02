<?php
session_start();
require_once 'Config.php';
require_once 'User.php';

// Handle login
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $user = User::authenticate($username, $password);
    if ($user) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
    } else {
        $error = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Handle user management actions
if (isset($_SESSION['admin_logged_in']) && isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'administrator') {
    // Create user
    if (isset($_POST['create_user'])) {
        $username = $_POST['new_username'] ?? '';
        $password = $_POST['new_password'] ?? '';
        $role = $_POST['new_role'] ?? 'editor';
        
        if (!empty($username) && !empty($password)) {
            if (User::create($username, $password, $role)) {
                $user_success = 'User created successfully!';
            } else {
                $user_error = 'User already exists!';
            }
        } else {
            $user_error = 'Username and password are required!';
        }
    }
    
    // Update user
    if (isset($_POST['update_user'])) {
        $username = $_POST['edit_username'] ?? '';
        $password = $_POST['edit_password'] ?? '';
        $role = $_POST['edit_role'] ?? '';
        
        $data = ['role' => $role];
        if (!empty($password)) {
            $data['password'] = $password;
        }
        
        if (User::update($username, $data)) {
            $user_success = 'User updated successfully!';
        } else {
            $user_error = 'Failed to update user!';
        }
    }
    
    // Delete user
    if (isset($_POST['delete_user'])) {
        $username = $_POST['delete_username'] ?? '';
        
        if (User::delete($username)) {
            $user_success = 'User deleted successfully!';
        } else {
            $user_error = 'Cannot delete user! (Last administrator or user not found)';
        }
    }
}

// Handle save
if (isset($_POST['save']) && isset($_SESSION['admin_logged_in'])) {
    $config = Config::load();
    
    // Update site settings
    $config['site'] = [
        'title' => $_POST['site_title'] ?? '',
        'logo_text' => $_POST['logo_text'] ?? '',
        'headline' => $_POST['headline'] ?? '',
        'subheadline' => $_POST['subheadline'] ?? '',
        'get_started_text' => $_POST['get_started_text'] ?? '',
        'test_player_text' => $_POST['test_player_text'] ?? '',
        'movies_count' => $_POST['movies_count'] ?? '',
        'shows_count' => $_POST['shows_count'] ?? '',
        'anime_count' => $_POST['anime_count'] ?? '',
        'estimate_text' => $_POST['estimate_text'] ?? '',
        'copyright' => $_POST['copyright'] ?? ''
    ];
    
    // Update navigation
    $config['navigation'] = [
        'welcome_text' => $_POST['welcome_text'] ?? '',
        'player_text' => $_POST['player_text'] ?? '',
        'docs_text' => $_POST['docs_text'] ?? ''
    ];
    
    // Update social links
    $config['social'] = [
        'telegram_url' => $_POST['telegram_url'] ?? '',
        'telegram_button_text' => $_POST['telegram_button_text'] ?? '',
        'discord_url' => $_POST['discord_url'] ?? ''
    ];
    
    // Update features
    $config['features'] = [
        'easy_title' => $_POST['easy_title'] ?? '',
        'easy_desc' => $_POST['easy_desc'] ?? '',
        'library_title' => $_POST['library_title'] ?? '',
        'library_desc' => $_POST['library_desc'] ?? '',
        'custom_title' => $_POST['custom_title'] ?? '',
        'custom_desc' => $_POST['custom_desc'] ?? '',
        'update_title' => $_POST['update_title'] ?? '',
        'update_desc' => $_POST['update_desc'] ?? '',
        'quality_title' => $_POST['quality_title'] ?? '',
        'quality_desc' => $_POST['quality_desc'] ?? ''
    ];
    
    // Update colors
    $config['colors'] = [
        'navbar_bg' => $_POST['navbar_bg'] ?? '',
        'navbar_bg_dark' => $_POST['navbar_bg_dark'] ?? '',
        'navbar_hover' => $_POST['navbar_hover'] ?? '',
        'navbar_selected_bg' => $_POST['navbar_selected_bg'] ?? '',
        'navbar_selected_bg_dark' => $_POST['navbar_selected_bg_dark'] ?? '',
        'text_primary' => $_POST['text_primary'] ?? '',
        'text_secondary' => $_POST['text_secondary'] ?? '',
        'button_telegram_bg' => $_POST['button_telegram_bg'] ?? '',
        'button_telegram2_bg' => $_POST['button_telegram2_bg'] ?? ''
    ];
    
    // Update TMDB
    $config['tmdb'] = [
        'api_key' => $_POST['tmdb_api_key'] ?? '',
        'enabled' => isset($_POST['tmdb_enabled']),
        'language' => $_POST['tmdb_language'] ?? 'en-US'
    ];
    
    // Update settings
    $config['settings'] = [
        'favicon' => $_POST['favicon_path'] ?? 'complete/resources/image_1.ico',
        'player_embed_base' => $_POST['player_embed_base'] ?? 'https://vidlink.pro/movie/94997'
    ];
    
    // Update catalog settings
    $grid_columns = intval($_POST['catalog_grid_columns'] ?? 8);
    $grid_rows = intval($_POST['catalog_grid_rows'] ?? 8);
    $config['catalog'] = [
        'grid_columns' => $grid_columns,
        'grid_rows' => $grid_rows,
        'items_per_page' => $grid_columns * $grid_rows
    ];
    
    // Preserve TV channels and modules (handled separately)
    if (!isset($config['tv_channels'])) {
        $config['tv_channels'] = [];
    }
    if (!isset($config['modules'])) {
        $config['modules'] = [];
    }
    
    Config::save($config);
    $success = 'Settings saved successfully!';
}

// Handle content tabs management
if (isset($_SESSION['admin_logged_in'])) {
    $config = Config::load();
    
    // Add content tab
    if (isset($_POST['add_content_tab'])) {
        $tab_name = $_POST['tab_name'] ?? '';
        $tab_type = $_POST['tab_type'] ?? 'api';
        $tab_source = $_POST['tab_source'] ?? '';
        $tab_category = $_POST['tab_category'] ?? '';
        $tab_default_poster = $_POST['tab_default_poster'] ?? '';
        
        if (!empty($tab_name) && !empty($tab_source)) {
            if (!isset($config['content_tabs'])) {
                $config['content_tabs'] = [];
            }
            
            $config['content_tabs'][] = [
                'id' => uniqid(),
                'name' => $tab_name,
                'type' => $tab_type,
                'source' => $tab_source,
                'category' => $tab_category,
                'default_poster' => $tab_default_poster,
                'enabled' => true,
                'order' => count($config['content_tabs']) + 1
            ];
            
            Config::save($config);
            $tab_success = 'Content tab added successfully!';
        } else {
            $tab_error = 'Tab name and source are required!';
        }
    }
    
    // Delete content tab
    if (isset($_POST['delete_content_tab'])) {
        $tab_id = $_POST['tab_id'] ?? '';
        
        if (!empty($tab_id) && isset($config['content_tabs'])) {
            $config['content_tabs'] = array_filter($config['content_tabs'], function($tab) use ($tab_id) {
                return $tab['id'] !== $tab_id;
            });
            $config['content_tabs'] = array_values($config['content_tabs']);
            
            Config::save($config);
            $tab_success = 'Content tab deleted successfully!';
        }
    }
    
    // Toggle content tab
    if (isset($_POST['toggle_content_tab'])) {
        $tab_id = $_POST['tab_id'] ?? '';
        
        if (!empty($tab_id) && isset($config['content_tabs'])) {
            foreach ($config['content_tabs'] as &$tab) {
                if ($tab['id'] === $tab_id) {
                    $tab['enabled'] = !($tab['enabled'] ?? true);
                    break;
                }
            }
            unset($tab);
            
            Config::save($config);
            header('Location: index.php?tab=contenttabs');
            exit;
        }
    }
}

// Handle TV channel management
if (isset($_SESSION['admin_logged_in'])) {
    $config = Config::load();
    
    // Add channel
    if (isset($_POST['add_channel'])) {
        $channel_name = $_POST['channel_name'] ?? '';
        $channel_slug = $_POST['channel_slug'] ?? '';
        $channel_url = $_POST['channel_url'] ?? '';
        
        if (!empty($channel_name) && !empty($channel_slug)) {
            if (!isset($config['tv_channels'])) {
                $config['tv_channels'] = [];
            }
            
            $config['tv_channels'][] = [
                'id' => uniqid(),
                'name' => $channel_name,
                'slug' => $channel_slug,
                'url' => $channel_url
            ];
            
            Config::save($config);
            $channel_success = 'Channel added successfully!';
        } else {
            $channel_error = 'Channel name and slug are required!';
        }
    }
    
    // Delete channel
    if (isset($_POST['delete_channel'])) {
        $channel_id = $_POST['channel_id'] ?? '';
        
        if (!empty($channel_id) && isset($config['tv_channels'])) {
            $config['tv_channels'] = array_filter($config['tv_channels'], function($ch) use ($channel_id) {
                return $ch['id'] !== $channel_id;
            });
            $config['tv_channels'] = array_values($config['tv_channels']); // Re-index array
            
            Config::save($config);
            $channel_success = 'Channel deleted successfully!';
        }
    }
    
    // Toggle module
    if (isset($_POST['toggle_module'])) {
        $module_id = $_POST['module_id'] ?? '';
        $module_name = $_POST['module_name'] ?? '';
        $enabled = $_POST['module_enabled'] === '1';
        
        if (!isset($config['modules'])) {
            $config['modules'] = [];
        }
        
        // Remove existing entry for this module
        $config['modules'] = array_filter($config['modules'], function($m) use ($module_id) {
            return $m['id'] !== $module_id;
        });
        
        // Add back if enabled
        if ($enabled) {
            $config['modules'][] = [
                'id' => $module_id,
                'name' => $module_name,
                'enabled' => true
            ];
        }
        
        $config['modules'] = array_values($config['modules']);
        Config::save($config);
        header('Location: index.php?tab=modules');
        exit;
    }
    
    // Add new module
    if (isset($_POST['add_module'])) {
        $module_id = $_POST['new_module_id'] ?? '';
        $module_name = $_POST['new_module_name'] ?? '';
        $module_type = $_POST['new_module_type'] ?? 'movie';
        $module_icon = $_POST['new_module_icon'] ?? '📄';
        
        if (!empty($module_id) && !empty($module_name)) {
            if (!isset($config['modules'])) {
                $config['modules'] = [];
            }
            
            // Check if ID already exists
            $exists = false;
            foreach ($config['modules'] as $m) {
                if ($m['id'] === $module_id) {
                    $exists = true;
                    break;
                }
            }
            
            if (!$exists) {
                $config['modules'][] = [
                    'id' => $module_id,
                    'name' => $module_name,
                    'enabled' => true,
                    'url_format' => $module_type,
                    'icon' => $module_icon,
                    'order' => count($config['modules']) + 1
                ];
                
                Config::save($config);
                header('Location: index.php?tab=modules');
                exit;
            }
        }
    }
    
    // Delete module
    if (isset($_POST['delete_module'])) {
        $module_id = $_POST['delete_module_id'] ?? '';
        
        if (!empty($module_id) && isset($config['modules'])) {
            $config['modules'] = array_filter($config['modules'], function($m) use ($module_id) {
                return $m['id'] !== $module_id;
            });
            $config['modules'] = array_values($config['modules']);
            
            Config::save($config);
            header('Location: index.php?tab=modules');
            exit;
        }
    }
}

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                width: 100%;
                max-width: 400px;
            }
            h1 { margin-bottom: 1.5rem; color: #333; text-align: center; }
            .form-group { margin-bottom: 1rem; }
            label { display: block; margin-bottom: 0.5rem; color: #555; font-weight: 500; }
            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 0.75rem;
                border: 2px solid #e1e8ed;
                border-radius: 5px;
                font-size: 1rem;
                transition: border-color 0.3s;
            }
            input[type="text"]:focus,
            input[type="password"]:focus {
                outline: none;
                border-color: #667eea;
            }
            button {
                width: 100%;
                padding: 0.75rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s;
            }
            button:hover { transform: translateY(-2px); }
            .error {
                background: #fee;
                color: #c33;
                padding: 0.75rem;
                border-radius: 5px;
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>🔐 Admin Panel</h1>
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Load current config
$config = Config::load();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - VidLink</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 1.5rem; }
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.3); }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
        }
        .tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .tab-btn {
            background: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .tab-btn:hover { background: #f0f0f0; }
        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .tab-content {
            display: none;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .tab-content.active { display: block; }
        .form-section {
            margin-bottom: 2rem;
        }
        .form-section h3 {
            color: #667eea;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        input[type="text"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e8ed;
            border-radius: 5px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="url"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        .color-input-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        input[type="color"] {
            width: 60px;
            height: 40px;
            border: 2px solid #e1e8ed;
            border-radius: 5px;
            cursor: pointer;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .save-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            position: sticky;
            bottom: 2rem;
            width: 100%;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }
        .preview-link {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 1rem;
        }
        .preview-link:hover { background: #218838; }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .color-picker-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
        }
        .color-picker-group input[type="color"] {
            width: 60px;
            height: 40px;
            border: 2px solid #e1e8ed;
            border-radius: 5px;
            cursor: pointer;
            flex-shrink: 0;
        }
        .color-picker-group input[type="range"] {
            flex: 1;
            min-width: 100px;
        }
        .color-picker-group input[type="text"] {
            flex: 2;
            min-width: 150px;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            #colors > div {
                grid-template-columns: 1fr !important;
            }
            #colors > div > div:last-child {
                position: relative !important;
                top: 0 !important;
            }
        }
        @media (max-width: 768px) {
            .container { padding: 0 1rem; }
            .tabs { gap: 0.25rem; }
            .tab-btn { padding: 0.5rem 1rem; font-size: 0.875rem; }
            .tab-content { padding: 1rem; }
            .grid-2 { grid-template-columns: 1fr; }
            .color-picker-group { flex-wrap: wrap; }
        }
        
        /* Add spacing above items */
        .form-section { margin-top: 20px; }
        .form-section:first-child { margin-top: 0; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>⚙️ Admin Panel</h1>
            <div>
                <a href="../" class="preview-link" target="_blank">👁️ Preview Site</a>
                <a href="?logout" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <?php if (isset($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <div class="tabs">
            <button class="tab-btn active" onclick="showTab('content')">📝 Content</button>
            <button class="tab-btn" onclick="showTab('navigation')">🧭 Navigation</button>
            <button class="tab-btn" onclick="showTab('social')">💬 Social Links</button>
            <button class="tab-btn" onclick="showTab('features')">⭐ Features</button>
            <button class="tab-btn" onclick="showTab('colors')">🎨 Colors</button>
            <button class="tab-btn" onclick="showTab('tmdb')">🎬 TMDB API</button>
            <button class="tab-btn" onclick="showTab('settings')">⚙️ Settings</button>
            <button class="tab-btn" onclick="showTab('catalog')">📚 Catalog</button>
            <button class="tab-btn" onclick="showTab('contenttabs')">📑 Content Tabs</button>
            <button class="tab-btn" onclick="showTab('modules')">🎛️ Modules</button>
            <button class="tab-btn" onclick="showTab('tvchannels')">📺 TV Channels</button>
            <?php if (isset($_SESSION['admin_role']) && isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'administrator'): ?>
            <button class="tab-btn" onclick="showTab('users')">👥 Users</button>
            <?php endif; ?>
        </div>
        
        <form method="POST">
            <!-- Content Tab -->
            <div id="content" class="tab-content active">
                <div class="form-section">
                    <h3>Site Information</h3>
                    <div class="form-group">
                        <label>Site Title</label>
                        <input type="text" name="site_title" value="<?= htmlspecialchars($config['site']['title'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Logo Text</label>
                        <input type="text" name="logo_text" value="<?= htmlspecialchars($config['site']['logo_text'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Main Headline</label>
                        <input type="text" name="headline" value="<?= htmlspecialchars($config['site']['headline'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Subheadline</label>
                        <input type="text" name="subheadline" value="<?= htmlspecialchars($config['site']['subheadline'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Buttons & Labels</h3>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Get Started Button</label>
                            <input type="text" name="get_started_text" value="<?= htmlspecialchars($config['site']['get_started_text'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Test Player Text</label>
                            <input type="text" name="test_player_text" value="<?= htmlspecialchars($config['site']['test_player_text'] ?? '') ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Statistics</h3>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Movies Count</label>
                            <input type="text" name="movies_count" value="<?= htmlspecialchars($config['site']['movies_count'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Shows Count</label>
                            <input type="text" name="shows_count" value="<?= htmlspecialchars($config['site']['shows_count'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Anime Count</label>
                            <input type="text" name="anime_count" value="<?= htmlspecialchars($config['site']['anime_count'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Estimate Text</label>
                        <textarea name="estimate_text"><?= htmlspecialchars($config['site']['estimate_text'] ?? '') ?></textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Footer</h3>
                    <div class="form-group">
                        <label>Copyright Text</label>
                        <input type="text" name="copyright" value="<?= htmlspecialchars($config['site']['copyright'] ?? '') ?>">
                    </div>
                </div>
            </div>
            
            <!-- Navigation Tab -->
            <div id="navigation" class="tab-content">
                <div class="form-section">
                    <h3>Navigation Menu</h3>
                    <div class="form-group">
                        <label>Welcome Text</label>
                        <input type="text" name="welcome_text" value="<?= htmlspecialchars($config['navigation']['welcome_text'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Player Text</label>
                        <input type="text" name="player_text" value="<?= htmlspecialchars($config['navigation']['player_text'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Docs Text</label>
                        <input type="text" name="docs_text" value="<?= htmlspecialchars($config['navigation']['docs_text'] ?? '') ?>">
                    </div>
                </div>
            </div>
            
            <!-- Social Tab -->
            <div id="social" class="tab-content">
                <div class="form-section">
                    <h3>Social Media Links</h3>
                    <div class="form-group">
                        <label>Telegram URL</label>
                        <input type="url" name="telegram_url" value="<?= htmlspecialchars($config['social']['telegram_url'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Telegram Button Text</label>
                        <input type="text" name="telegram_button_text" value="<?= htmlspecialchars($config['social']['telegram_button_text'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Discord URL</label>
                        <input type="url" name="discord_url" value="<?= htmlspecialchars($config['social']['discord_url'] ?? '') ?>">
                    </div>
                </div>
            </div>
            
            <!-- Features Tab -->
            <div id="features" class="tab-content">
                <div class="form-section">
                    <h3>Feature Cards</h3>
                    
                    <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Easy to Use</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="easy_title" value="<?= htmlspecialchars($config['features']['easy_title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="easy_desc"><?= htmlspecialchars($config['features']['easy_desc'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Huge Library</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="library_title" value="<?= htmlspecialchars($config['features']['library_title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="library_desc"><?= htmlspecialchars($config['features']['library_desc'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Customizable</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="custom_title" value="<?= htmlspecialchars($config['features']['custom_title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="custom_desc"><?= htmlspecialchars($config['features']['custom_desc'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Auto Update</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="update_title" value="<?= htmlspecialchars($config['features']['update_title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="update_desc"><?= htmlspecialchars($config['features']['update_desc'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Highest Quality</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="quality_title" value="<?= htmlspecialchars($config['features']['quality_title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="quality_desc"><?= htmlspecialchars($config['features']['quality_desc'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Colors Tab -->
            <div id="colors" class="tab-content">
                <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem; align-items: start;">
                    <!-- Color Controls (Left) -->
                    <div style="min-width: 0;">
                
                <div class="form-section">
                    <h3>Navigation Bar Colors</h3>
                    <div class="form-group">
                        <label>Navbar Background (Light Mode)</label>
                        <div class="color-picker-group">
                            <input type="color" id="navbar_bg_picker" value="#ffffff">
                            <input type="range" id="navbar_bg_alpha" min="0" max="100" value="50" style="flex: 1; margin: 0 10px;">
                            <span id="navbar_bg_alpha_val" style="min-width: 40px;">50%</span>
                            <input type="text" name="navbar_bg" id="navbar_bg" value="<?= htmlspecialchars($config['colors']['navbar_bg'] ?? '') ?>" placeholder="rgba(255, 255, 255, 0.5)" style="flex: 2;">
                        </div>
                        <small style="color: #888;">Pick a color and adjust transparency</small>
                    </div>
                    <div class="form-group">
                        <label>Navbar Background (Dark Mode)</label>
                        <div class="color-picker-group">
                            <input type="color" id="navbar_bg_dark_picker" value="#1f2937">
                            <input type="range" id="navbar_bg_dark_alpha" min="0" max="100" value="50" style="flex: 1; margin: 0 10px;">
                            <span id="navbar_bg_dark_alpha_val" style="min-width: 40px;">50%</span>
                            <input type="text" name="navbar_bg_dark" id="navbar_bg_dark" value="<?= htmlspecialchars($config['colors']['navbar_bg_dark'] ?? '') ?>" placeholder="rgba(31, 41, 55, 0.5)" style="flex: 2;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hover Color</label>
                        <div class="color-picker-group">
                            <input type="color" id="navbar_hover_picker" value="#9333ea">
                            <input type="text" name="navbar_hover" id="navbar_hover" value="<?= htmlspecialchars($config['colors']['navbar_hover'] ?? '') ?>" placeholder="rgb(147, 51, 234)" style="flex: 1; margin-left: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Selected Background (Gradient Start)</label>
                        <div class="color-picker-group">
                            <input type="color" id="navbar_selected_start_picker" value="#9333ea">
                            <input type="color" id="navbar_selected_end_picker" value="#7e22ce" style="margin-left: 10px;">
                            <input type="text" name="navbar_selected_bg" id="navbar_selected_bg" value="<?= htmlspecialchars($config['colors']['navbar_selected_bg'] ?? '') ?>" placeholder="linear-gradient(...)" style="flex: 1; margin-left: 10px;">
                        </div>
                        <small style="color: #888;">Select start and end colors for gradient</small>
                    </div>
                    <div class="form-group">
                        <label>Selected Background Dark (Gradient)</label>
                        <div class="color-picker-group">
                            <input type="color" id="navbar_selected_dark_start_picker" value="#a855f7">
                            <input type="color" id="navbar_selected_dark_end_picker" value="#9333ea" style="margin-left: 10px;">
                            <input type="text" name="navbar_selected_bg_dark" id="navbar_selected_bg_dark" value="<?= htmlspecialchars($config['colors']['navbar_selected_bg_dark'] ?? '') ?>" placeholder="linear-gradient(...)" style="flex: 1; margin-left: 10px;">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Text Colors</h3>
                    <div class="form-group">
                        <label>Primary Text Color</label>
                        <div class="color-picker-group">
                            <input type="color" id="text_primary_picker" value="#ffffff">
                            <input type="text" name="text_primary" id="text_primary" value="<?= htmlspecialchars($config['colors']['text_primary'] ?? '') ?>" placeholder="rgb(255, 255, 255)" style="flex: 1; margin-left: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Secondary Text Color</label>
                        <div class="color-picker-group">
                            <input type="color" id="text_secondary_picker" value="#ffffff">
                            <input type="range" id="text_secondary_alpha" min="0" max="100" value="80" style="flex: 1; margin: 0 10px;">
                            <span id="text_secondary_alpha_val" style="min-width: 40px;">80%</span>
                            <input type="text" name="text_secondary" id="text_secondary" value="<?= htmlspecialchars($config['colors']['text_secondary'] ?? '') ?>" placeholder="rgba(255, 255, 255, 0.8)" style="flex: 2;">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Button Colors</h3>
                    <div class="form-group">
                        <label>Telegram Button 1 Background</label>
                        <div class="color-picker-group">
                            <input type="color" id="button_telegram_bg_picker" value="#2563eb">
                            <input type="range" id="button_telegram_bg_alpha" min="0" max="100" value="50" style="flex: 1; margin: 0 10px;">
                            <span id="button_telegram_bg_alpha_val" style="min-width: 40px;">50%</span>
                            <input type="text" name="button_telegram_bg" id="button_telegram_bg" value="<?= htmlspecialchars($config['colors']['button_telegram_bg'] ?? '') ?>" placeholder="rgba(37, 99, 235, 0.5)" style="flex: 2;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Telegram Button 2 Background</label>
                        <div class="color-picker-group">
                            <input type="color" id="button_telegram2_bg_picker" value="#4f46e5">
                            <input type="range" id="button_telegram2_bg_alpha" min="0" max="100" value="20" style="flex: 1; margin: 0 10px;">
                            <span id="button_telegram2_bg_alpha_val" style="min-width: 40px;">20%</span>
                            <input type="text" name="button_telegram2_bg" id="button_telegram2_bg" value="<?= htmlspecialchars($config['colors']['button_telegram2_bg'] ?? '') ?>" placeholder="rgba(79, 70, 229, 0.2)" style="flex: 2;">
                        </div>
                    </div>
                </div>
                    </div>
                    
                    <!-- Live Preview (Right - Sticky) -->
                    <div style="position: sticky; top: 2rem; height: fit-content;">
                        <div class="form-section">
                            <h3>🎨 Live Preview</h3>
                            <p style="color: #888; margin-bottom: 1rem; font-size: 0.875rem;">Preview updates in real-time</p>
                            <div id="navbar-preview" style="background: #111; padding: 1.5rem; border-radius: 10px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                                    <div style="background: rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 999px;">
                                        <span style="color: white; font-weight: 700; font-size: 0.875rem;">LOGO</span>
                                    </div>
                                    <div id="preview-nav" style="display: flex; gap: 0.5rem; background: rgba(255,255,255,0.05); padding: 0.5rem; border-radius: 999px; flex-wrap: wrap;">
                                        <button id="preview-btn-1" style="padding: 0.5rem 1rem; border-radius: 999px; border: none; cursor: pointer; color: white; background: rgba(147, 51, 234, 1); transition: all 0.3s; font-size: 0.875rem;">Welcome</button>
                                        <button id="preview-btn-2" style="padding: 0.5rem 1rem; border-radius: 999px; border: none; cursor: pointer; color: rgba(255,255,255,0.7); background: transparent; transition: all 0.3s; font-size: 0.875rem;">Player</button>
                                        <button id="preview-btn-3" style="padding: 0.5rem 1rem; border-radius: 999px; border: none; cursor: pointer; color: rgba(255,255,255,0.7); background: transparent; transition: all 0.3s; font-size: 0.875rem;">Docs</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- TMDB Tab -->
            <div id="tmdb" class="tab-content">
                <div class="form-section">
                    <h3>TMDB API Integration</h3>
                    <p style="color: #666; margin-bottom: 1rem;">
                        Integrate with The Movie Database (TMDB) to automatically fetch trending movies, TV shows, and anime posters.
                    </p>
                    <div class="form-group">
                        <label>TMDB API Key</label>
                        <input type="text" name="tmdb_api_key" value="<?= htmlspecialchars($config['tmdb']['api_key'] ?? '') ?>" placeholder="Your TMDB API Key">
                        <small style="color: #888;">Get your API key from <a href="https://www.themoviedb.org/settings/api" target="_blank">TMDB</a></small>
                    </div>
                    <div class="form-group">
                        <label>Language / Idioma</label>
                        <select name="tmdb_language" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e8ed; border-radius: 5px; font-size: 1rem;">
                            <option value="en-US" <?= ($config['tmdb']['language'] ?? 'en-US') === 'en-US' ? 'selected' : '' ?>>English (en-US)</option>
                            <option value="pt-BR" <?= ($config['tmdb']['language'] ?? '') === 'pt-BR' ? 'selected' : '' ?>>Português Brasil (pt-BR)</option>
                            <option value="es-ES" <?= ($config['tmdb']['language'] ?? '') === 'es-ES' ? 'selected' : '' ?>>Español (es-ES)</option>
                            <option value="fr-FR" <?= ($config['tmdb']['language'] ?? '') === 'fr-FR' ? 'selected' : '' ?>>Français (fr-FR)</option>
                            <option value="de-DE" <?= ($config['tmdb']['language'] ?? '') === 'de-DE' ? 'selected' : '' ?>>Deutsch (de-DE)</option>
                            <option value="it-IT" <?= ($config['tmdb']['language'] ?? '') === 'it-IT' ? 'selected' : '' ?>>Italiano (it-IT)</option>
                            <option value="ja-JP" <?= ($config['tmdb']['language'] ?? '') === 'ja-JP' ? 'selected' : '' ?>>日本語 (ja-JP)</option>
                            <option value="ko-KR" <?= ($config['tmdb']['language'] ?? '') === 'ko-KR' ? 'selected' : '' ?>>한국어 (ko-KR)</option>
                        </select>
                        <small style="color: #888;">Select the language for movie/TV show titles and descriptions</small>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" name="tmdb_enabled" id="tmdb_enabled" <?= ($config['tmdb']['enabled'] ?? false) ? 'checked' : '' ?>>
                            <label for="tmdb_enabled" style="margin: 0;">Enable TMDB Integration</label>
                        </div>
                        <small style="color: #888;">When enabled, movie posters will be fetched from TMDB instead of using static images</small>
                    </div>
                </div>
            </div>
            
            <!-- Settings Tab -->
            <div id="settings" class="tab-content">
                <div class="form-section">
                    <h3>Site Settings</h3>
                    <div class="form-group">
                        <label>Favicon Path</label>
                        <input type="text" name="favicon_path" value="<?= htmlspecialchars($config['settings']['favicon'] ?? 'complete/resources/image_1.ico') ?>" placeholder="complete/resources/image_1.ico">
                        <small style="color: #888;">Path to your favicon file (relative to site root)</small>
                    </div>
                    <div class="form-group">
                        <label>Player Embed Base URL</label>
                        <input type="url" name="player_embed_base" value="<?= htmlspecialchars($config['settings']['player_embed_base'] ?? 'https://vidlink.pro/movie/94997') ?>" placeholder="https://vidlink.pro/movie/94997">
                        <small style="color: #888;">Default embed URL for the player page</small>
                    </div>
                </div>
            </div>
            
            <!-- Catalog Tab -->
            <div id="catalog" class="tab-content">
                <div class="form-section">
                    <h3>Catalog Display Settings</h3>
                    <p style="color: #666; margin-bottom: 1.5rem;">
                        Configure how movies and series are displayed in the Content catalog page.
                    </p>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Grid Columns</label>
                            <input type="number" name="catalog_grid_columns" id="catalog_grid_columns" value="<?= htmlspecialchars($config['catalog']['grid_columns'] ?? 8) ?>" min="1" max="12" placeholder="8" onchange="updateItemsPerPage()">
                            <small style="color: #888;">Number of columns in the grid (1-12). Default: 8</small>
                        </div>
                        <div class="form-group">
                            <label>Grid Rows</label>
                            <input type="number" name="catalog_grid_rows" id="catalog_grid_rows" value="<?= htmlspecialchars($config['catalog']['grid_rows'] ?? 8) ?>" min="1" max="20" placeholder="8" onchange="updateItemsPerPage()">
                            <small style="color: #888;">Number of rows per page (1-20). Default: 8</small>
                        </div>
                    </div>
                    <div style="margin-top: 1rem; padding: 1rem; background: #f0f0f0; border-radius: 5px;">
                        <p style="margin: 0; color: #555;"><strong>Calculated Items Per Page:</strong> <span id="items_per_page_display" style="color: #667eea; font-weight: 600;"><?= ($config['catalog']['grid_columns'] ?? 8) * ($config['catalog']['grid_rows'] ?? 8) ?></span></p>
                        <small style="color: #888;">Automatically calculated as Columns × Rows</small>
                    </div>
                    <div style="margin-top: 1.5rem; padding: 1rem; background: #e3f2fd; border-radius: 5px; border-left: 4px solid #2196f3;">
                        <p style="margin: 0; color: #1976d2;"><strong>💡 Example:</strong> 8 columns × 8 rows = 64 items per page</p>
                    </div>
                    <div style="margin-top: 1rem; padding: 1rem; background: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107;">
                        <p style="margin: 0; color: #856404;"><strong>⚠️ Note:</strong> Changes take effect immediately on the Content page. Larger values may affect loading performance.</p>
                    </div>
                </div>
            </div>
            
            <button type="submit" name="save" class="save-btn">💾 Save All Changes</button>
        </form>
        
        <!-- Content Tabs Tab (Separate) -->
        <div id="contenttabs" class="tab-content" style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: none;">
            <div class="form-section">
                <h3>Content Tabs Management</h3>
                <p style="color: #888; margin-bottom: 1.5rem;">Manage the tabs shown in the Content page. Tabs can pull data from external APIs or from config data like TV channels.</p>
                
                <?php if (isset($tab_success)): ?>
                    <div class="success"><?= htmlspecialchars($tab_success) ?></div>
                <?php endif; ?>
                <?php if (isset($tab_error)): ?>
                    <div class="error" style="background: #fee; color: #c33; padding: 0.75rem; border-radius: 5px; margin-bottom: 1rem;"><?= htmlspecialchars($tab_error) ?></div>
                <?php endif; ?>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Add New Content Tab</h4>
                <form method="POST" style="background: #f9f9f9; padding: 1.5rem; border-radius: 5px; margin-bottom: 2rem;">
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Tab Name</label>
                            <input type="text" name="tab_name" required placeholder="e.g., Canais de TV">
                        </div>
                        <div class="form-group">
                            <label>Tab Type</label>
                            <select name="tab_type" id="tab_type" onchange="updateTabSourcePlaceholder()" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e8ed; border-radius: 5px; font-size: 1rem;">
                                <option value="api">API Source (external JSON)</option>
                                <option value="config">Config Source (e.g., tv_channels)</option>
                            </select>
                            <small style="color: #888;">Choose the data source type</small>
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Source</label>
                            <input type="text" name="tab_source" id="tab_source" required placeholder="api/proxy.php?category=movie&type=tmdb&format=json&order=desc">
                            <small id="tab_source_help" style="color: #888;">For API: full URL or relative path. For Config: key name like "tv_channels"</small>
                        </div>
                        <div class="form-group">
                            <label>Category ID</label>
                            <input type="text" name="tab_category" placeholder="e.g., movie, serie, tv">
                            <small style="color: #888;">Used for generating embed URLs</small>
                        </div>
                        <div class="form-group">
                            <label>Default Poster URL (for config sources)</label>
                            <input type="url" name="tab_default_poster" placeholder="https://placehold.co/342x513/1F2937/FFFFFF?text=TV">
                            <small style="color: #888;">Used when items don't have poster images</small>
                        </div>
                    </div>
                    <button type="submit" name="add_content_tab" style="background: #28a745; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; margin-top: 1rem;">➕ Add Tab</button>
                </form>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Existing Content Tabs</h4>
                <div style="display: grid; gap: 1rem;">
                    <?php
                    $content_tabs_list = $config['content_tabs'] ?? [];
                    if (empty($content_tabs_list)):
                    ?>
                    <p style="color: #888; padding: 2rem; text-align: center; background: #f9f9f9; border-radius: 5px;">No content tabs configured yet.</p>
                    <?php else:
                    foreach ($content_tabs_list as $tab):
                        $is_enabled = $tab['enabled'] ?? true;
                    ?>
                    <div style="background: #f9f9f9; padding: 1.5rem; border-radius: 10px;">
                        <div style="display: flex; align-items: start; justify-content: space-between; gap: 1rem;">
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 0.5rem 0; color: #333;"><?= htmlspecialchars($tab['name']) ?></h4>
                                <p style="margin: 0.25rem 0; color: #666; font-size: 0.875rem;">
                                    <strong>Type:</strong> <?= htmlspecialchars($tab['type']) ?> | 
                                    <strong>Source:</strong> <code style="background: #e0e0e0; padding: 2px 6px; border-radius: 3px; font-size: 0.8rem;"><?= htmlspecialchars($tab['source']) ?></code>
                                </p>
                                <?php if (!empty($tab['category'])): ?>
                                <p style="margin: 0.25rem 0; color: #666; font-size: 0.875rem;">
                                    <strong>Category:</strong> <?= htmlspecialchars($tab['category']) ?>
                                </p>
                                <?php endif; ?>
                                <?php if (!empty($tab['default_poster'])): ?>
                                <p style="margin: 0.25rem 0; color: #666; font-size: 0.875rem;">
                                    <strong>Default Poster:</strong> <a href="<?= htmlspecialchars($tab['default_poster']) ?>" target="_blank" style="color: #667eea;">View</a>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div style="display: flex; gap: 0.5rem; align-items: start;">
                                <form method="POST" style="margin: 0;">
                                    <input type="hidden" name="tab_id" value="<?= htmlspecialchars($tab['id']) ?>">
                                    <button type="submit" name="toggle_content_tab" style="padding: 0.5rem 1.5rem; border-radius: 5px; border: none; cursor: pointer; font-weight: 600; transition: all 0.3s; <?= $is_enabled ? 'background: #28a745; color: white;' : 'background: #dc3545; color: white;' ?>">
                                        <?= $is_enabled ? '✓ Enabled' : '✗ Disabled' ?>
                                    </button>
                                </form>
                                <form method="POST" style="margin: 0;" onsubmit="return confirm('Delete this tab?');">
                                    <input type="hidden" name="tab_id" value="<?= htmlspecialchars($tab['id']) ?>">
                                    <button type="submit" name="delete_content_tab" style="padding: 0.5rem 1rem; border-radius: 5px; border: none; cursor: pointer; font-weight: 600; background: #dc3545; color: white;">🗑️</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                
                <div style="margin-top: 2rem; padding: 1rem; background: #e3f2fd; border-radius: 5px; border-left: 4px solid #2196f3;">
                    <p style="margin: 0; color: #1976d2;"><strong>💡 Examples:</strong></p>
                    <ul style="margin: 0.5rem 0 0 1.5rem; color: #1976d2;">
                        <li><strong>API Tab:</strong> Type: api, Source: api/proxy.php?category=movie...</li>
                        <li><strong>TV Channels Tab:</strong> Type: config, Source: tv_channels</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Modules Tab (Separate) -->
        <div id="modules" class="tab-content" style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: none;">
            <div class="form-section">
                <h3>Player Modules Management</h3>
                <p style="color: #888; margin-bottom: 1.5rem;">Enable or disable player modules. Disabled modules won't appear in the player page.</p>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Add New Module</h4>
                <form method="POST" style="background: #f9f9f9; padding: 1.5rem; border-radius: 5px; margin-bottom: 2rem;">
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Module Name</label>
                            <input type="text" name="new_module_name" required placeholder="e.g., Anime Player">
                        </div>
                        <div class="form-group">
                            <label>Module ID (slug)</label>
                            <input type="text" name="new_module_id" required placeholder="e.g., anime (lowercase, no spaces)">
                            <small style="color: #888;">Used internally, must be unique</small>
                        </div>
                        <div class="form-group">
                            <label>Link Format Type</label>
                            <select name="new_module_type" id="new_module_type" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e8ed; border-radius: 5px; font-size: 1rem;">
                                <option value="movie">Movie Format (e.g., /movie/123)</option>
                                <option value="series">Series Format (e.g., /tv/123/1/1)</option>
                                <option value="tv">TV Format (with channels dropdown)</option>
                            </select>
                            <small style="color: #888;">Choose how URLs will be structured</small>
                        </div>
                        <div class="form-group">
                            <label>Icon Emoji</label>
                            <input type="text" name="new_module_icon" maxlength="2" placeholder="🎭">
                            <small style="color: #888;">Optional emoji for display</small>
                        </div>
                    </div>
                    <button type="submit" name="add_module" style="background: #28a745; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; margin-top: 1rem;">➕ Add Module</button>
                </form>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Existing Modules</h4>
                <div style="display: grid; gap: 1rem;">
                    <?php
                    $config_modules = $config['modules'] ?? [];
                    if (empty($config_modules)):
                    ?>
                    <p style="color: #888; padding: 2rem; text-align: center; background: #f9f9f9; border-radius: 5px;">No modules configured. Add your first module above!</p>
                    <?php else:
                    foreach ($config_modules as $module):
                        $is_enabled = $module['enabled'] ?? true;
                    ?>
                    <div style="background: #f9f9f9; padding: 1.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <span style="font-size: 2rem;"><?= htmlspecialchars($module['icon'] ?? '📄') ?></span>
                            <div>
                                <h4 style="margin: 0; color: #333;"><?= htmlspecialchars($module['name']) ?></h4>
                                <p style="margin: 0.25rem 0 0; color: #888; font-size: 0.875rem;">
                                    ID: <?= htmlspecialchars($module['id']) ?> | 
                                    Type: <?= htmlspecialchars($module['url_format'] ?? 'movie') ?>
                                </p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <form method="POST" style="margin: 0;">
                                <input type="hidden" name="module_id" value="<?= htmlspecialchars($module['id']) ?>">
                                <input type="hidden" name="module_name" value="<?= htmlspecialchars($module['name']) ?>">
                                <input type="hidden" name="module_enabled" value="<?= $is_enabled ? '0' : '1' ?>">
                                <button type="submit" name="toggle_module" style="padding: 0.5rem 1.5rem; border-radius: 5px; border: none; cursor: pointer; font-weight: 600; transition: all 0.3s; <?= $is_enabled ? 'background: #28a745; color: white;' : 'background: #dc3545; color: white;' ?>">
                                    <?= $is_enabled ? '✓ Enabled' : '✗ Disabled' ?>
                                </button>
                            </form>
                            <form method="POST" style="margin: 0;" onsubmit="return confirm('Delete this module?');">
                                <input type="hidden" name="delete_module_id" value="<?= htmlspecialchars($module['id']) ?>">
                                <button type="submit" name="delete_module" style="padding: 0.5rem 1rem; border-radius: 5px; border: none; cursor: pointer; font-weight: 600; background: #dc3545; color: white;">🗑️</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                
                <div style="margin-top: 2rem; padding: 1rem; background: #e3f2fd; border-radius: 5px; border-left: 4px solid #2196f3;">
                    <p style="margin: 0; color: #1976d2;"><strong>Note:</strong> For TV-type modules, you'll need to add channels in the TV Channels tab. Changes take effect immediately on the player page (no reload needed with SPA!).</p>
                </div>
            </div>
        </div>
        
        <!-- TV Channels Tab (Separate form) -->
        <div id="tvchannels" class="tab-content" style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: none;">
            <div class="form-section">
                <h3>TV Channel Management</h3>
                <p style="color: #888; margin-bottom: 1.5rem;">Manage TV channels for the TV Player. Channel URLs will be in the format: https://meulink/tv/channel-slug</p>
                
                <?php if (isset($channel_success)): ?>
                    <div class="success"><?= htmlspecialchars($channel_success) ?></div>
                <?php endif; ?>
                <?php if (isset($channel_error)): ?>
                    <div class="error" style="background: #fee; color: #c33; padding: 0.75rem; border-radius: 5px; margin-bottom: 1rem;"><?= htmlspecialchars($channel_error) ?></div>
                <?php endif; ?>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Add New Channel</h4>
                <form method="POST" style="background: #f9f9f9; padding: 1.5rem; border-radius: 5px; margin-bottom: 2rem;">
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Channel Name</label>
                            <input type="text" name="channel_name" required placeholder="e.g., ESPN">
                        </div>
                        <div class="form-group">
                            <label>Channel Slug</label>
                            <input type="text" name="channel_slug" required placeholder="e.g., espn (lowercase, no spaces)">
                            <small style="color: #888;">This will be used in the URL</small>
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Channel URL (Optional)</label>
                            <input type="url" name="channel_url" placeholder="https://example.com/stream/espn">
                            <small style="color: #888;">The actual streaming URL for this channel</small>
                        </div>
                    </div>
                    <button type="submit" name="add_channel" style="background: #28a745; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; margin-top: 1rem;">➕ Add Channel</button>
                </form>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Existing Channels</h4>
                <?php 
                $channels = $config['tv_channels'] ?? [];
                if (empty($channels)): ?>
                    <p style="color: #888; padding: 2rem; text-align: center; background: #f9f9f9; border-radius: 5px;">No channels added yet. Add your first channel above!</p>
                <?php else: ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f0f0f0; text-align: left;">
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Channel Name</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Slug</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Preview URL</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($channels as $channel): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 1rem; font-weight: 500;"><?= htmlspecialchars($channel['name']) ?></td>
                            <td style="padding: 1rem; font-family: monospace; color: #667eea;"><?= htmlspecialchars($channel['slug']) ?></td>
                            <td style="padding: 1rem; font-size: 0.875rem; color: #888;">https://meulink/tv/<?= htmlspecialchars($channel['slug']) ?></td>
                            <td style="padding: 1rem;">
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this channel?');">
                                    <input type="hidden" name="channel_id" value="<?= htmlspecialchars($channel['id']) ?>">
                                    <button type="submit" name="delete_channel" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Users Tab (Separate form) -->
        <?php if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'administrator'): ?>
        <div id="users" class="tab-content" style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: none;">
            <div class="form-section">
                <h3>User Management</h3>
                <?php if (isset($user_success)): ?>
                    <div class="success"><?= htmlspecialchars($user_success) ?></div>
                <?php endif; ?>
                <?php if (isset($user_error)): ?>
                    <div class="error" style="background: #fee; color: #c33; padding: 0.75rem; border-radius: 5px; margin-bottom: 1rem;"><?= htmlspecialchars($user_error) ?></div>
                <?php endif; ?>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Create New User</h4>
                <form method="POST" style="background: #f9f9f9; padding: 1.5rem; border-radius: 5px; margin-bottom: 2rem;">
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="new_username" required placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="new_password" required placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="new_role" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e8ed; border-radius: 5px; font-size: 1rem;">
                                <option value="editor">Editor</option>
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="create_user" style="background: #28a745; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; margin-top: 1rem;">➕ Create User</button>
                </form>
                
                <h4 style="margin: 1.5rem 0 1rem; color: #764ba2;">Existing Users</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f0f0f0; text-align: left;">
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Username</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Role</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Created</th>
                            <th style="padding: 1rem; border-bottom: 2px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = User::getAll();
                        foreach ($users as $username => $user):
                        ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 1rem;"><?= htmlspecialchars($user['username']) ?></td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.875rem; <?= $user['role'] === 'administrator' ? 'background: #667eea; color: white;' : 'background: #e1e8ed; color: #555;' ?>">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td style="padding: 1rem; color: #888; font-size: 0.875rem;"><?= htmlspecialchars($user['created_at']) ?></td>
                            <td style="padding: 1rem;">
                                <button onclick="editUser('<?= htmlspecialchars($user['username']) ?>', '<?= htmlspecialchars($user['role']) ?>')" style="background: #667eea; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer; margin-right: 0.5rem;">✏️ Edit</button>
                                <?php if ($user['username'] !== $_SESSION['admin_username']): ?>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="delete_username" value="<?= htmlspecialchars($user['username']) ?>">
                                    <button type="submit" name="delete_user" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">🗑️ Delete</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Edit User Modal -->
            <div id="editUserModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
                <div style="background: white; padding: 2rem; border-radius: 10px; max-width: 500px; width: 90%;">
                    <h3 style="margin-bottom: 1.5rem;">Edit User</h3>
                    <form method="POST">
                        <input type="hidden" name="edit_username" id="edit_username">
                        <div class="form-group">
                            <label>New Password (leave blank to keep current)</label>
                            <input type="password" name="edit_password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="edit_role" id="edit_role" style="width: 100%; padding: 0.75rem; border: 2px solid #e1e8ed; border-radius: 5px; font-size: 1rem;">
                                <option value="editor">Editor</option>
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                            <button type="submit" name="update_user" style="flex: 1; background: #28a745; color: white; padding: 0.75rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer;">💾 Save Changes</button>
                            <button type="button" onclick="closeEditModal()" style="flex: 1; background: #6c757d; color: white; padding: 0.75rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script>
        function updateItemsPerPage() {
            const columns = parseInt(document.getElementById('catalog_grid_columns').value) || 8;
            const rows = parseInt(document.getElementById('catalog_grid_rows').value) || 8;
            const total = columns * rows;
            document.getElementById('items_per_page_display').textContent = total;
        }
        
        function updateTabSourcePlaceholder() {
            const typeSelect = document.getElementById('tab_type');
            const sourceInput = document.getElementById('tab_source');
            const sourceHelp = document.getElementById('tab_source_help');
            
            if (typeSelect && sourceInput && sourceHelp) {
                if (typeSelect.value === 'config') {
                    sourceInput.placeholder = 'tv_channels';
                    sourceHelp.textContent = 'Enter the config key name (e.g., tv_channels)';
                } else {
                    sourceInput.placeholder = 'api/proxy.php?category=movie&type=tmdb&format=json&order=desc';
                    sourceHelp.textContent = 'Enter the full URL or relative path to the API endpoint';
                }
            }
        }
        
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
                tab.style.display = 'none';
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            const selectedTab = document.getElementById(tabName);
            if (selectedTab) {
                selectedTab.classList.add('active');
                selectedTab.style.display = 'block';
            }
            event.target.classList.add('active');
        }
        
        // User management functions
        function editUser(username, role) {
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_role').value = role;
            document.getElementById('editUserModal').style.display = 'flex';
        }
        
        function closeEditModal() {
            document.getElementById('editUserModal').style.display = 'none';
        }
        
        // Color picker functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Helper function to convert hex to rgb
            function hexToRgb(hex) {
                const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            }
            
            // Helper function to parse rgba/rgb string
            function parseColor(colorStr) {
                const rgba = colorStr.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)/);
                if (rgba) {
                    return {
                        r: parseInt(rgba[1]),
                        g: parseInt(rgba[2]),
                        b: parseInt(rgba[3]),
                        a: rgba[4] ? parseFloat(rgba[4]) : 1
                    };
                }
                return null;
            }
            
            // Helper function to update preview
            function updatePreview() {
                const selectedBg = document.getElementById('navbar_selected_bg_dark').value;
                const hoverColor = document.getElementById('navbar_hover').value;
                const textPrimary = document.getElementById('text_primary').value;
                
                // Update selected button
                const btn1 = document.getElementById('preview-btn-1');
                btn1.style.background = selectedBg;
                btn1.style.color = textPrimary;
                
                // Update hover buttons
                const btn2 = document.getElementById('preview-btn-2');
                const btn3 = document.getElementById('preview-btn-3');
                btn2.onmouseover = () => btn2.style.color = hoverColor;
                btn2.onmouseout = () => btn2.style.color = 'rgba(255,255,255,0.7)';
                btn3.onmouseover = () => btn3.style.color = hoverColor;
                btn3.onmouseout = () => btn3.style.color = 'rgba(255,255,255,0.7)';
            }
            
            // Setup color pickers with alpha
            function setupColorWithAlpha(pickerId, alphaId, alphaValId, textId) {
                const picker = document.getElementById(pickerId);
                const alpha = document.getElementById(alphaId);
                const alphaVal = document.getElementById(alphaValId);
                const text = document.getElementById(textId);
                
                // Initialize from current value
                const currentColor = parseColor(text.value);
                if (currentColor) {
                    const hex = '#' + [currentColor.r, currentColor.g, currentColor.b].map(x => {
                        const hex = x.toString(16);
                        return hex.length === 1 ? '0' + hex : hex;
                    }).join('');
                    picker.value = hex;
                    if (currentColor.a !== undefined) {
                        alpha.value = Math.round(currentColor.a * 100);
                        alphaVal.textContent = alpha.value + '%';
                    }
                }
                
                function updateTextValue() {
                    const rgb = hexToRgb(picker.value);
                    const alphaValue = alpha.value / 100;
                    text.value = `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${alphaValue})`;
                    updatePreview();
                }
                
                picker.addEventListener('input', updateTextValue);
                alpha.addEventListener('input', function() {
                    alphaVal.textContent = this.value + '%';
                    updateTextValue();
                });
            }
            
            // Setup color pickers without alpha
            function setupColor(pickerId, textId) {
                const picker = document.getElementById(pickerId);
                const text = document.getElementById(textId);
                
                // Initialize from current value
                const currentColor = parseColor(text.value);
                if (currentColor) {
                    const hex = '#' + [currentColor.r, currentColor.g, currentColor.b].map(x => {
                        const hex = x.toString(16);
                        return hex.length === 1 ? '0' + hex : hex;
                    }).join('');
                    picker.value = hex;
                }
                
                function updateTextValue() {
                    const rgb = hexToRgb(picker.value);
                    text.value = `rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`;
                    updatePreview();
                }
                
                picker.addEventListener('input', updateTextValue);
            }
            
            // Setup gradient pickers
            function setupGradient(startPickerId, endPickerId, textId) {
                const startPicker = document.getElementById(startPickerId);
                const endPicker = document.getElementById(endPickerId);
                const text = document.getElementById(textId);
                
                // Try to parse existing gradient
                const gradientMatch = text.value.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\).*rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
                if (gradientMatch) {
                    const startHex = '#' + [
                        parseInt(gradientMatch[1]),
                        parseInt(gradientMatch[2]),
                        parseInt(gradientMatch[3])
                    ].map(x => {
                        const hex = x.toString(16);
                        return hex.length === 1 ? '0' + hex : hex;
                    }).join('');
                    const endHex = '#' + [
                        parseInt(gradientMatch[4]),
                        parseInt(gradientMatch[5]),
                        parseInt(gradientMatch[6])
                    ].map(x => {
                        const hex = x.toString(16);
                        return hex.length === 1 ? '0' + hex : hex;
                    }).join('');
                    startPicker.value = startHex;
                    endPicker.value = endHex;
                }
                
                function updateTextValue() {
                    const startRgb = hexToRgb(startPicker.value);
                    const endRgb = hexToRgb(endPicker.value);
                    text.value = `linear-gradient(to right, rgb(${startRgb.r}, ${startRgb.g}, ${startRgb.b}), rgb(${endRgb.r}, ${endRgb.g}, ${endRgb.b}))`;
                    updatePreview();
                }
                
                startPicker.addEventListener('input', updateTextValue);
                endPicker.addEventListener('input', updateTextValue);
            }
            
            // Initialize all color pickers
            setupColorWithAlpha('navbar_bg_picker', 'navbar_bg_alpha', 'navbar_bg_alpha_val', 'navbar_bg');
            setupColorWithAlpha('navbar_bg_dark_picker', 'navbar_bg_dark_alpha', 'navbar_bg_dark_alpha_val', 'navbar_bg_dark');
            setupColor('navbar_hover_picker', 'navbar_hover');
            setupGradient('navbar_selected_start_picker', 'navbar_selected_end_picker', 'navbar_selected_bg');
            setupGradient('navbar_selected_dark_start_picker', 'navbar_selected_dark_end_picker', 'navbar_selected_bg_dark');
            setupColor('text_primary_picker', 'text_primary');
            setupColorWithAlpha('text_secondary_picker', 'text_secondary_alpha', 'text_secondary_alpha_val', 'text_secondary');
            setupColorWithAlpha('button_telegram_bg_picker', 'button_telegram_bg_alpha', 'button_telegram_bg_alpha_val', 'button_telegram_bg');
            setupColorWithAlpha('button_telegram2_bg_picker', 'button_telegram2_bg_alpha', 'button_telegram2_bg_alpha_val', 'button_telegram2_bg');
            
            // Initial preview update
            updatePreview();
        });
    </script>
</body>
</html>
