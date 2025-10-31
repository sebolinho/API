# VidLink API - PHP SPA with Admin Panel

A modern PHP Single Page Application with WordPress-style admin panel for the VidLink streaming API.

## 🚀 Features

- **Clean PHP SPA Architecture**: Modular structure with organized routing
- **Admin Panel** (`/admin/`): Complete content management system
  - Edit all site text without touching code
  - Customize colors (navbar, text, buttons)
  - Manage social links (Telegram, Discord)
  - Configure TMDB API integration
  - Multi-language support (8 languages)
  - Favicon and player URL settings
- **TMDB Integration**: Automatic fetching of trending movies, TV shows, and anime
- **Responsive Design**: Works on all devices
- **No HTML Files**: Pure PHP implementation

## 📁 Structure

```
/
├── index.php              # Main entry point with routing
├── .htaccess              # Apache rewrite rules
├── admin/                 # Admin panel
│   ├── index.php          # Admin interface
│   ├── Config.php         # Configuration management
│   └── TMDB.php           # TMDB API integration
├── data/
│   └── config.json        # Site configuration storage
├── views/                 # Page templates
│   ├── home.php           # Homepage with TMDB posters
│   ├── player.php         # Video player interface
│   ├── docs.php           # API documentation
│   └── partials/          # Reusable components
│       ├── header.php     # Navigation header
│       ├── footer.php     # Footer
│       └── inline-styles.php  # CSS styles
└── complete/              # Static assets
    ├── styles.css         # Global styles
    └── resources/         # Images and fonts
```

## 🎯 Quick Start

### Requirements
- PHP 7.0+ with cURL extension
- Apache with mod_rewrite enabled

### Installation
1. Clone the repository
2. Configure your web server to point to the repository root
3. Access the site in your browser
4. Access admin panel at `/admin/` (default password: `admin123`)

### Admin Panel Access
- **URL**: `/admin/`
- **Default Password**: `admin123` (⚠️ Change this immediately!)

## 🎨 Admin Panel Features

### Content Management
Edit all site text without touching code:
- Site title, logo, headlines
- Button labels and navigation text
- Statistics (Movies/Shows/Anime counts)
- Feature card descriptions
- Footer copyright

### Social Links
- Configure Telegram and Discord URLs
- Customize button text

### Color Customization
- Navbar colors (background, hover, selected states)
- Text colors (primary, secondary)
- Button backgrounds
- Supports RGBA, RGB, and gradient formats

### TMDB API Configuration
- Enable/disable TMDB integration
- Configure API key
- Select language (English, Português, Español, Français, Deutsch, Italiano, 日本語, 한국어)
- Automatic fetching of 36 trending movies/TV shows/anime

### Site Settings
- Configure custom favicon
- Set default player embed URL

## 🌐 Routes

- `?page=home` - Homepage (default)
- `?page=player` - Video player tester  
- `?page=docs` - API documentation
- `/admin/` - Admin panel

## 🔧 Configuration

All settings are stored in `data/config.json`. You can edit this file directly or use the admin panel (recommended).

## 📋 Future Enhancements

See `FEATURE_ROADMAP.md` for planned features:
- Visual color picker with real-time preview
- Secure authentication + user management
- TV Player module with channel management
- Modular content system with SPA navigation

## ⚠️ Security

**Important**: Change the default admin password before deploying to production!

Edit `admin/index.php`:
```php
$ADMIN_PASSWORD = 'admin123'; // Change this!
```
2. Add a new case in the switch statement in `index.php`
3. Update the navigation in `views/partials/header.php`

## License

© 2024 VidLink. All rights reserved.
