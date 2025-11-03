# VidLink API - PHP SPA

This is a Single Page Application (SPA) built with PHP that provides documentation and a player tester for the VidLink streaming API.

## Structure

```
complete/
├── index.php           # Main entry point with routing
├── app.css            # Application-specific styles
├── app.js             # JavaScript for player functionality
├── styles.css         # Base Tailwind CSS styles
├── includes/          # Reusable components
│   ├── header.php
│   ├── footer.php
│   ├── movie-marquee.php
│   └── feature-cards.php
├── pages/             # Page content
│   ├── welcome.php    # Home page with features
│   ├── player.php     # Player testing interface
│   └── docs.php       # API documentation
└── resources/         # Images and fonts
```

## Features

- **Clean PHP Architecture**: Organized with includes and pages for maintainability
- **SPA Navigation**: Single entry point with URL-based routing
- **Identical Design**: Maintains the exact look and feel of the original HTML
- **Movie Poster Animations**: Vertical marquee animations on welcome page
- **Interactive Player**: Test movies, TV shows, and anime with live preview
- **Comprehensive Documentation**: Complete API reference with examples

## Usage

### Development Server

```bash
cd complete
php -S localhost:8080
```

Then visit: `http://localhost:8080/index.php`

### Pages

- **Welcome**: `?page=welcome` - Home page with features and movie poster showcase
- **Player**: `?page=player` - Interactive player testing interface
- **Docs**: `?page=docs` - API documentation and examples

### Production Deployment

For production, configure your web server (Apache/Nginx) to:
1. Set `index.php` as the directory index
2. Route all requests through `index.php`
3. Enable PHP processing

#### Apache (.htaccess)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?page=$1 [QSA,L]
```

#### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## Code Organization

### Separation of Concerns

- **PHP**: Handles routing, includes, and page structure
- **CSS**: Separated into `styles.css` (base) and `app.css` (app-specific)
- **JavaScript**: `app.js` handles player interactions
- **Images**: All images stored as regular files in `resources/`

### Benefits

1. **Maintainability**: Easy to update individual components
2. **Reusability**: Header, footer, and components shared across pages
3. **Scalability**: Simple to add new pages or features
4. **Clean Code**: No inline styles or embedded images
5. **Performance**: Optimized asset loading

## Original Features Preserved

✅ Movie poster display with marquee animations  
✅ Background gradients and styling  
✅ Interactive navigation  
✅ Player functionality with tabs  
✅ Feature cards with icons  
✅ Responsive design  
✅ Dark theme  
✅ All visual elements and animations
