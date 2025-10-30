# VidLink API - PHP SPA

A clean and organized PHP Single Page Application for the VidLink streaming API.

## Structure

```
/
├── index.php              # Main entry point with routing logic
├── .htaccess             # Apache rewrite rules for clean URLs
├── views/                # PHP view files
│   ├── home.php          # Homepage
│   ├── player.php        # Video player interface
│   ├── docs.php          # API documentation
│   └── partials/         # Reusable components
│       ├── header.php    # Navigation header
│       └── footer.php    # Footer with social links
└── complete/             # Static assets
    ├── styles.css        # Global styles
    └── resources/        # Images and fonts
```

## Features

- **Clean PHP SPA Architecture**: Single entry point with clean routing
- **Organized Code**: Separated views and reusable components
- **No HTML Files**: Pure PHP implementation
- **Responsive Design**: Works on all devices
- **Interactive Player**: Test movies, TV shows, and anime
- **Complete Documentation**: API usage guides

## Routes

- `?page=home` - Homepage (default)
- `?page=player` - Video player tester
- `?page=docs` - API documentation

## Requirements

- PHP 7.0 or higher
- Apache with mod_rewrite enabled (for clean URLs)

## Installation

1. Clone the repository
2. Point your web server to the repository root
3. Access via browser (e.g., `http://localhost/`)

## Usage

Simply navigate to the application in your browser. The PHP router will handle all page requests automatically.

### Player

Test the video player with:
- Movies (using TMDB ID)
- TV Shows (using TMDB ID, season, and episode)
- Anime (using MyAnimeList ID)

### API Documentation

Visit the docs page to learn how to embed videos in your website using the VidLink API.

## Development

The application uses a simple routing system in `index.php`. To add a new page:

1. Create a new PHP file in `views/`
2. Add a new case in the switch statement in `index.php`
3. Update the navigation in `views/partials/header.php`

## License

© 2024 VidLink. All rights reserved.
