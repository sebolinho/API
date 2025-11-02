<?php
require_once __DIR__ . '/../admin/Config.php';
require_once __DIR__ . '/../admin/TMDB.php';

$config = Config::load();

// Load colors from config
$colors = $config['colors'] ?? [];
$navbar_hover = $colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$text_primary = $colors['text_primary'] ?? 'rgb(255, 255, 255)';
$text_secondary = $colors['text_secondary'] ?? 'rgba(255, 255, 255, 0.8)';

// Get TMDB posters if enabled
$posterImages = [];
if ($config['tmdb']['enabled'] && !empty($config['tmdb']['api_key'])) {
    $language = $config['tmdb']['language'] ?? 'en-US';
    $tmdb = new TMDB($config['tmdb']['api_key'], $language);
    $posterImages = $tmdb->getMixedTrending(36);
}

// Helper function to render posters
function renderPosterColumns($posters, $startIndex, $count) {
    $result = '';
    for ($i = 0; $i < $count && ($startIndex + $i) < count($posters); $i++) {
        $poster = $posters[$startIndex + $i];
        $result .= '<figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">';
        $result .= '<div class="flex flex-row items-center gap-2">';
        if ($poster['poster']) {
            $result .= '<img loading="lazy" decoding="async" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;" src="' . htmlspecialchars($poster['poster']) . '" alt="' . htmlspecialchars($poster['title']) . '">';
        }
        $result .= '</div></figure>';
    }
    return $result;
}
?>
   
  <div data-channel-name="in_page_channel_IVUj-h" id="in-page-channel-node-id">
  </div>
<div class="w-full max-w-[70rem] mx-auto transition-all duration-200 p-4 bg-transparent border border-transparent rounded-xl justify-between items-center" style="position: fixed; top: 0; left: 50%; transform: translateX(-50%); z-index: 10;">


   <div class="flex items-center justify-between h-14 sm:h-16 gap-2 px-2">
        <div class="flex light-sweep items-center bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full px-3 py-1.5 border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20 min-w-[90px] sm:min-w-[120px]"><a class="relative group w-full" href="?page=home">
            <div class="relative flex flex-col items-center" style="opacity:1;transform:none"><span class="text-base sm:text-xl font-black tracking-wider bg-gradient-to-r from-white to-gray-500 bg-clip-text text-transparent relative"><?= htmlspecialchars($config['site']['logo_text']) ?></span>
                <div
                class="h-[2px] w-full bg-gradient-to-r from-purple-600/0 via-purple-500/50 to-purple-400/0 dark:from-purple-400/0 dark:via-purple-300/50 dark:to-purple-200/0 rounded-full mt-0.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute -inset-2 bg-gradient-to-r from-purple-500/0 via-purple-400/5 to-purple-300/0 dark:from-purple-400/0 dark:via-purple-300/5 dark:to-purple-200/0 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        </a>
    </div>
    <nav class="flex-1 flex justify-center px-2">
        <div class="flex items-center bg-white/98 dark:bg-gray-800/50 backdrop-blur-sm rounded-full p-1.5 border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20" style="width: fit-content;">
            <a class="flex-1 px-2.5 sm:px-4 py-1.5 rounded-full transition-all duration-200 relative flex items-center justify-center gap-1.5 sm:gap-2 home-nav-link" href="?page=home" style="color: <?= $text_primary ?>">
                <div class="absolute inset-0 rounded-full" style="opacity:1; background: <?= htmlspecialchars($navbar_selected_bg_dark) ?>"></div>
                <span class="relative z-10">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </span>
                <span class="relative z-10 tracking-wide hidden lg:block text-sm font-medium"><?= htmlspecialchars($config['navigation']['welcome_text']) ?></span>
            </a>
            <a class="flex-1 px-2.5 sm:px-4 py-1.5 rounded-full transition-all duration-200 relative flex items-center justify-center gap-1.5 sm:gap-2 home-hover-link" href="?page=player" style="color: rgba(100, 116, 139, 1)">
                <span class="relative z-10">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
                <span class="relative z-10 tracking-wide hidden lg:block text-sm font-medium"><?= htmlspecialchars($config['navigation']['player_text']) ?></span>
            </a>
            <a class="flex-1 px-2.5 sm:px-4 py-1.5 rounded-full transition-all duration-200 relative flex items-center justify-center gap-1.5 sm:gap-2 home-hover-link" href="?page=docs" style="color: rgba(100, 116, 139, 1)">
                <span class="relative z-10">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </span>
                <span class="relative z-10 tracking-wide hidden lg:block text-sm font-medium"><?= htmlspecialchars($config['navigation']['docs_text']) ?></span>
            </a>
            <a class="flex-1 px-2.5 sm:px-4 py-1.5 rounded-full transition-all duration-200 relative flex items-center justify-center gap-1.5 sm:gap-2 home-hover-link" href="?page=conteudo" style="color: rgba(100, 116, 139, 1)">
                <span class="relative z-10">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </span>
                <span class="relative z-10 tracking-wide hidden lg:block text-sm font-medium"><?= htmlspecialchars($config['navigation']['content_text'] ?? 'Conteúdo') ?></span>
            </a>
        </div>
    </nav>
<style>
.home-hover-link:hover {
    color: <?= $navbar_hover ?> !important;
}
</style>
    <div class="flex items-center min-w-[90px] sm:min-w-[120px] justify-end">
        <div class="flex items-center bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full border border-purple-100 dark:border-purple-900/50 shadow-lg shadow-purple-100/20 dark:shadow-purple-900/20 w-full h-[34px] sm:h-[38px]">
            <div class="flex items-center justify-between w-full px-3 h-full">
                <a href="https://bitcine.app/" target="_blank" rel="noopener noreferrer" class="flex items-center hover:opacity-80 transition-all duration-200 h-full" tabindex="0"><img src="complete/resources/image_17.png"
                    alt="Bitcine" class="h-5 sm:h-6 w-auto"></a>
                <div class="h-4 w-px bg-purple-200 dark:bg-purple-800/50"></div>
                <a href="https://cineby.app/" target="_blank" rel="noopener noreferrer" class="flex items-center hover:opacity-80 transition-all duration-200 h-full" tabindex="0"><img src="complete/resources/image_18.png"
                    alt="Cineby" class="h-5 sm:h-6 w-auto"></a>
            </div>
        </div>
    </div>
    </div></div>
  
    
    <div data-overlay-container="true">
      <div class="flex flex-col items-center justify-center w-full">
      
        <div class="relative flex z-0 flex-col items-center justify-center w-full overflow-hidden rounded-lg bg-background md:shadow-xl">
          <div class="flex flex-col gap-4 mt-20 lg:flex-row">
            <div class="flex flex-col items-center justify-center gap-2 text-center lg:text-left lg:items-start">
              <h1 class="text-6xl  font-semibold text-transparent bg-gradient-to-br from-white to-gray-500 bg-clip-text"><?= htmlspecialchars($config['site']['headline']) ?></h1>
              <h2 class="text-4xl md:text-6xl min-h-[5rem] max-w-[25rem] md:max-w-[35rem] h-full md:w-[50rem] md:h-32 text-center lg:text-left bg-gradient-to-br from-white to-indigo-400 bg-clip-text text-transparent"><?= htmlspecialchars($config['site']['subheadline']) ?></h2>
              <div class="flex flex-col items-center gap-2 lg:gap-4 lg:flex-row">
                <button class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-white/5" tabindex="0" style="--x:-97.93492%;will-change:auto;transform:none">
                  <span class="relative  items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))"><?= htmlspecialchars($config['site']['get_started_text']) ?></span>
                  <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
                </button>
                <span class="text-xs text-white/80">or</span>
                <button radius="full" variant="shadow" class="text-sm underline capitalize transition-all text-white/80 hover:text-white hover:scale-105 active:scale-95"><?= htmlspecialchars($config['site']['test_player_text']) ?></button>
              </div>
              <div class="flex gap-4 mt-2 cursor-pointer">
                <div class="p-4 gap-2  transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                  <span class="text-2xl font-bold text-gray-300">
                    <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider"><?= htmlspecialchars($config['site']['movies_count']) ?></span></span>
                  <span class="text-xs text-gray-400 ">Movies</span>
                </div>
                <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                  <span class="text-2xl font-bold text-gray-300">
                    <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider"><?= htmlspecialchars($config['site']['shows_count']) ?></span></span>
                  <span class="text-xs text-gray-400">Shows</span>
                </div>
                <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                  <span class="text-2xl font-bold text-gray-300">
                    <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider"><?= htmlspecialchars($config['site']['anime_count']) ?></span></span>
                  <span class="text-xs text-gray-400">Anime</span>
                </div>
              </div>
              <span class="text-xs text-white/30"><?= htmlspecialchars($config['site']['estimate_text']) ?></span>
            </div>
            <div class="relative flex h-[500px] md:h-screen w-full flex-row items-center justify-center overflow-hidden rounded-lg bg-background md:shadow-xl z-10">
              <div class="group flex overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s]">
                <?php if (!empty($posterImages)): ?>
                  <!-- Column 1 -->
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 0, 4) ?>
                  </div>
                  <!-- Column 1 duplicate for seamless loop -->
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 0, 4) ?>
                  </div>
                  <!-- Column 1 triplicate -->
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 0, 4) ?>
                  </div>
                  <!-- Column 1 quadruple -->
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 0, 4) ?>
                  </div>
                <?php else: ?>
                  <!-- Fallback: Static placeholder images -->
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
                      <div class="flex flex-row items-center gap-2">
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                          <span class="text-white/50">🎬</span>
                        </div>
                      </div>
                    </figure>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Column 2 (reversed) -->
              <div class="group flex overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s]">
                <?php if (!empty($posterImages)): ?>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused] [animation-direction:reverse]">
                    <?= renderPosterColumns($posterImages, 12, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused] [animation-direction:reverse]">
                    <?= renderPosterColumns($posterImages, 12, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused] [animation-direction:reverse]">
                    <?= renderPosterColumns($posterImages, 12, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused] [animation-direction:reverse]">
                    <?= renderPosterColumns($posterImages, 12, 4) ?>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Column 3 -->
              <div class="group flex overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s]">
                <?php if (!empty($posterImages)): ?>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 24, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 24, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 24, 4) ?>
                  </div>
                  <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
                    <?= renderPosterColumns($posterImages, 24, 4) ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="w-full bg-black py-20 px-4 flex justify-center"></div>
          <div class="flex flex-col gap-4 my-10" style="width: 95%; max-width: 1100px; margin: 0 auto; position: relative; z-index: 20;">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-2.5">
              <div class="p-4 space-y-3 transition-all hover:-translate-y-1 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                <div class="p-1.5 w-fit rounded-lg bg-indigo-500/10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rocket w-5 h-5 text-indigo-500">
                    <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                    <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                    <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                    <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                  </svg>
                </div>
                <p class="text-lg font-medium"><?= htmlspecialchars($config['features']['easy_title']) ?></p>
                <p class="text-sm text-gray-400"><?= htmlspecialchars($config['features']['easy_desc']) ?></p>
              </div>
              <div class="p-4 space-y-3 transition-all hover:-translate-y-1 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                <div class="p-1.5 w-fit rounded-lg bg-blue-500/10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library w-5 h-5 text-blue-500">
                    <path d="m16 6 4 14"></path>
                    <path d="M12 6v14"></path>
                    <path d="M8 8v12"></path>
                    <path d="M4 4v16"></path>
                  </svg>
                </div>
                <p class="text-lg font-medium"><?= htmlspecialchars($config['features']['library_title']) ?></p>
                <p class="text-sm text-gray-400"><?= htmlspecialchars($config['features']['library_desc']) ?></p>
              </div>
              <div class="p-4 space-y-3 transition-all hover:-translate-y-1 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                <div class="p-1.5 w-fit rounded-lg bg-pink-500/10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wand-sparkles w-5 h-5 text-pink-500">
                    <path d="m21.64 3.64-1.28-1.28a1.21 1.21 0 0 0-1.72 0L2.36 18.64a1.21 1.21 0 0 0 0 1.72l1.28 1.28a1.2 1.2 0 0 0 1.72 0L21.64 5.36a1.2 1.2 0 0 0 0-1.72"></path>
                    <path d="m14 7 3 3"></path>
                    <path d="M5 6v4"></path>
                    <path d="M19 14v4"></path>
                    <path d="M10 2v2"></path>
                    <path d="M7 8H3"></path>
                    <path d="M21 16h-4"></path>
                    <path d="M11 3H9"></path>
                  </svg>
                </div>
                <p class="text-lg font-medium"><?= htmlspecialchars($config['features']['custom_title']) ?></p>
                <p class="text-sm text-gray-400"><?= htmlspecialchars($config['features']['custom_desc']) ?></p>
              </div>
              <div class="p-4 space-y-3 transition-all hover:-translate-y-1 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                <div class="p-1.5 w-fit rounded-lg bg-purple-500/10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-arrow-up w-5 h-5 text-purple-500">
                    <path d="M12 2a10 10 0 0 1 7.38 16.75"></path>
                    <path d="m16 12-4-4-4 4"></path>
                    <path d="M12 16V8"></path>
                    <path d="M2.5 8.875a10 10 0 0 0-.5 3"></path>
                    <path d="M2.83 16a10 10 0 0 0 2.43 3.4"></path>
                    <path d="M4.636 5.235a10 10 0 0 1 .891-.857"></path>
                    <path d="M8.644 21.42a10 10 0 0 0 7.631-.38"></path>
                  </svg>
                </div>
                <p class="text-lg font-medium"><?= htmlspecialchars($config['features']['update_title']) ?></p>
                <p class="text-sm text-gray-400"><?= htmlspecialchars($config['features']['update_desc']) ?></p>
              </div>
              <div class="p-4 space-y-3 transition-all hover:-translate-y-1 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                <div class="p-1.5 w-fit rounded-lg bg-green-500/10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clapperboard w-5 h-5 text-green-500">
                    <path d="M20.2 6 3 11l-.9-2.4c-.3-1.1.3-2.2 1.3-2.5l13.5-4c1.1-.3 2.2.3 2.5 1.3Z"></path>
                    <path d="m6.2 5.3 3.1 3.9"></path>
                    <path d="m12.4 3.4 3.1 4"></path>
                    <path d="M3 11h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"></path>
                  </svg>
                </div>
                <p class="text-lg font-medium"><?= htmlspecialchars($config['features']['quality_title']) ?></p>
                <p class="text-sm text-gray-400"><?= htmlspecialchars($config['features']['quality_desc']) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="fixed flex items-center justify-center w-full gap-2 bottom-4">
          <button class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-blue-600/50" tabindex="0" style="--x:-100%;will-change:auto;transform:none">
            <span class="relative  items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))">
              <a href="<?= htmlspecialchars($config['social']['telegram_url']) ?>" target="_blank" rel="noreferrer">
                <img src="complete/resources/image_12.webp" width="25" height="25" alt="telegram icon">
              </a>
            </span>
            <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
          </button>
          <button class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-indigo-600/20" tabindex="0" style="--x:-100%;will-change:auto;transform:none">
            <span class="relative items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))"><?= htmlspecialchars($config['social']['telegram_button_text']) ?> <a href="<?= htmlspecialchars($config['social']['telegram_url']) ?>" target="_blank" rel="noreferrer">
                <img src="complete/resources/image_11.png" width="25" height="25" alt="telegram icon">
              </a>
            </span>
            <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
          </button>
        </div>
        <div class="w-full p-4 pb-20 text-center">
          <hr class="shrink-0 bg-divider border-none w-full h-divider my-4" role="separator">
          <span class="text-sm text-white/80"><?= htmlspecialchars($config['site']['copyright']) ?></span>
        </div>
      </div>
    </div>

<script>
// Light sweep animation effect for telegram buttons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.light-sweep');
    
    buttons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
            const rect = button.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            button.style.setProperty('--x', `${x}%`);
        });
        
        button.addEventListener('mouseleave', function() {
            button.style.setProperty('--x', '-100%');
        });
    });
});
</script>
