<?php
// Load config for dynamic colors
require_once __DIR__ . '/../../admin/Config.php';
$config = Config::load();
$colors = $config['colors'] ?? [];
$navbar_hover = $colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$text_primary = $colors['text_primary'] ?? 'rgb(255, 255, 255)';
$text_secondary = $colors['text_secondary'] ?? 'rgba(255, 255, 255, 0.8)';
$nav_welcome = $config['navigation']['welcome_text'] ?? 'Welcome';
$nav_player = $config['navigation']['player_text'] ?? 'Player';
$nav_docs = $config['navigation']['docs_text'] ?? 'Docs';
$nav_content = $config['navigation']['content_text'] ?? 'Conteúdo';
$logo_text = $config['site']['logo_text'] ?? 'MEGAEMBED';
$nav_order = $config['navigation_order'] ?? ['home', 'player', 'docs', 'conteudo'];

// Map page IDs to display data
$nav_items = [
    'home' => ['text' => $nav_welcome, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>'],
    'player' => ['text' => $nav_player, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'],
    'docs' => ['text' => $nav_docs, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>'],
    'conteudo' => ['text' => $nav_content, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>']
];
?>
<div class="w-full max-w-[70rem] mx-auto transition-all duration-200 p-4 bg-transparent border border-transparent rounded-xl justify-between items-center" style="position: fixed; top: 0; left: 50%; transform: translateX(-50%); z-index: 10;">
    <div class="flex items-center justify-between h-14 sm:h-16 gap-2 px-2">
        <div class="flex light-sweep items-center bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full px-3 py-1.5 border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20 min-w-[90px] sm:min-w-[120px]">
            <a class="relative group w-full" href="?page=home">
                <div class="relative flex flex-col items-center" style="opacity:1;transform:none">
                    <span class="text-base sm:text-xl font-black tracking-wider bg-gradient-to-r from-white to-gray-500 bg-clip-text text-transparent relative"><?= htmlspecialchars($logo_text) ?></span>
                    <div class="h-[2px] w-full bg-gradient-to-r from-purple-600/0 via-purple-500/50 to-purple-400/0 dark:from-purple-400/0 dark:via-purple-300/50 dark:to-purple-200/0 rounded-full mt-0.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-purple-500/0 via-purple-400/5 to-purple-300/0 dark:from-purple-400/0 dark:via-purple-300/5 dark:to-purple-200/0 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </a>
        </div>
        <nav class="flex-1 flex justify-center px-2">
            <div class="flex items-center bg-white/98 dark:bg-gray-800/50 backdrop-blur-sm rounded-full p-1.5 border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20" style="width: fit-content;">
                <?php foreach ($nav_order as $nav_page): 
                    if (!isset($nav_items[$nav_page])) continue;
                    $item = $nav_items[$nav_page];
                    $is_active = ($page === $nav_page);
                ?>
                <a class="flex-1 px-2.5 sm:px-4 py-1.5 rounded-full transition-all duration-200 relative flex items-center justify-center gap-1.5 sm:gap-2 <?php echo $is_active ? '' : 'hover-nav-link'; ?>" href="?page=<?= $nav_page ?>" style="<?php echo $is_active ? 'color: ' . $text_primary : 'color: rgba(100, 116, 139, 1)'; ?>; flex-shrink: 0;">
                    <?php if ($is_active): ?>
                    <div class="absolute inset-0 rounded-full" style="opacity:1; background: <?= htmlspecialchars($navbar_selected_bg_dark) ?>"></div>
                    <?php endif; ?>
                    <span class="relative z-10">
                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <?= $item['icon'] ?>
                        </svg>
                    </span>
                    <span class="relative z-10 tracking-wide hidden lg:block text-sm font-medium"><?= htmlspecialchars($item['text']) ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </nav>
<style>
.hover-nav-link:hover {
    color: <?= $navbar_hover ?> !important;
}
</style>
        <div class="flex items-center min-w-[90px] sm:min-w-[120px] justify-end">
            <div class="flex items-center bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20 w-full h-[34px] sm:h-[38px]">
                <div class="flex items-center justify-between w-full px-3 h-full">
                    <a href="https://bitcine.app/" target="_blank" rel="noopener noreferrer" class="flex items-center hover:opacity-80 transition-all duration-200 h-full" tabindex="0">
                        <img src="complete/resources/image_17.png" alt="Bitcine" class="h-5 sm:h-6 w-auto">
                    </a>
                    <div class="h-4 w-px bg-purple-200 dark:bg-purple-800/50"></div>
                    <a href="https://cineby.app/" target="_blank" rel="noopener noreferrer" class="flex items-center hover:opacity-80 transition-all duration-200 h-full" tabindex="0">
                        <img src="complete/resources/image_18.png" alt="Cineby" class="h-5 sm:h-6 w-auto">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
