<?php
require_once __DIR__ . '/../admin/Config.php';
$config = Config::load();
$config_modules = $config['modules'] ?? [];
$enabled_ids = array_column($config_modules, 'id');

// Default modules if not configured
$all_modules = [
    'movie' => 'Movie Player',
    'series' => 'Series Player',
    'tv' => 'TV Player'
];

// Use all if none configured, otherwise use only enabled
$display_modules = empty($config_modules) ? $all_modules : array_intersect_key($all_modules, array_flip($enabled_ids));
?>
<div class="flex flex-col items-center justify-center w-full" style="margin-top: 120px;">
    <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
        <main id="PlayerTester" class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 bg-gray-900 text-white">
            <div class="flex p-1 h-fit gap-2 items-center flex-nowrap overflow-x-scroll scrollbar-hide bg-black/20 rounded-full new">
                <?php 
                $first = true;
                foreach ($display_modules as $id => $name): 
                    $tab_id = ($id === 'series') ? 'tv' : ($id === 'tv' ? 'tvplayer' : $id);
                ?>
                <button id="tab-<?= $tab_id ?>" class="tab-button group"<?= $first ? ' data-selected="true"' : '' ?>>
                    <span class="cursor-pill"></span>
                    <span class="relative z-10"><?= htmlspecialchars($name) ?></span>
                </button>
                <?php 
                $first = false;
                endforeach; 
                ?>
            </div>

            <div class="w-full py-3 px-1">
                <div id="content-movie" class="tab-content">
                    <div class="input-container">
                        <input id="movie-tmdb" type="text" class="input-field" value="94997" placeholder=" ">
                        <label for="movie-tmdb" class="input-label">Tmdb</label>
                    </div>
                </div>

                <div id="content-tv" class="tab-content">
                    <div class="fields-wrapper">
                        <div class="input-container flex-grow">
                            <input id="tv-tmdb" type="text" class="input-field" value="94997" placeholder=" ">
                            <label for="tv-tmdb" class="input-label">Tmdb</label>
                        </div>
                        <div class="input-container small-input">
                            <input id="tv-season" type="number" class="input-field" value="1" placeholder=" ">
                            <label for="tv-season" class="input-label">S</label>
                        </div>
                        <div class="input-container small-input">
                            <input id="tv-episode" type="number" class="input-field" value="1" placeholder=" ">
                            <label for="tv-episode" class="input-label">E</label>
                        </div>
                    </div>
                </div>

                <div id="content-tvplayer" class="tab-content">
                    <div class="fields-wrapper">
                        <div class="input-container flex-grow">
                            <label for="tv-channel-select" class="input-label" style="position: relative; left: 0; top: 0; transform: none; margin-bottom: 0.5rem; display: block;">Select Channel</label>
                            <select id="tv-channel-select" class="input-field" style="padding: 0.75rem; background: #2a2a2a; border: 1px solid #444; color: white; border-radius: 8px; width: 100%; cursor: pointer;">
                                <?php
                                require_once __DIR__ . '/../admin/Config.php';
                                $config = Config::load();
                                $channels = $config['tv_channels'] ?? [];
                                if (empty($channels)) {
                                    echo '<option value="">No channels available</option>';
                                } else {
                                    foreach ($channels as $channel) {
                                        echo '<option value="' . htmlspecialchars($channel['slug']) . '">' . htmlspecialchars($channel['name']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="inline-flex justify-between h-fit gap-2 px-3 py-1.5 rounded-lg items-center w-full text-xs text-white/80 bg-white/10" style="margin-top: 20px;">
                    <pre id="video-url" class="font-mono w-full overflow-x-auto scrollbar-hide">https://vidlink.pro/movie/786892</pre>
                    <button id="copy-button" class="group relative w-8 h-8 flex items-center justify-center" aria-label="Copy this Link">
                        <svg aria-hidden="true" fill="none" height="1.2em" width="1.2em" role="presentation" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="absolute text-green-400 opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <svg aria-hidden="true" fill="none" height="1.2em" width="1.2em" role="presentation" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                            <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                            <path d="M22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16v-2.1c0-3.5-1.4-4.9-4.9-4.9H6.9V8h4.2C14.6 8 16 9.4 16 12.9v4.2h1.1c3.5 0 4.9-1.4 4.9-4.9V6.9C22 3.4 20.6 2 17.1 2h-4.2C9.4 2 8 3.4 8 6.9V8h2.1c3.5 0 4.9 1.4 4.9 4.9v2.1h1.1c3.5 0 4.9-1.4 4.9-4.9z"></path>
                        </svg>
                    </button>
                </div>

                <div class="w-full h-80 md:h-[40rem] mt-4">
                    <div class="w-full h-full overflow-hidden bg-black rounded-2xl border border-white/10">
                        <iframe id="video-iframe" allowfullscreen class="w-full h-full" src="https://vidlink.pro/movie/786892?autoplay=false"></iframe>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    /* Scope all player styles to the player page container */
    #page-player .scrollbar-hide::-webkit-scrollbar { display: none; }
    #page-player .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Tab styles - scoped to player page */
    #page-player .tab-button {
        position: relative; display: flex; justify-content: center; align-items: center;
        padding: 0.5rem 1rem; height: 2.25rem; border-radius: 9999px;
        cursor: pointer; outline: none; -webkit-tap-highlight-color: transparent;
        transition: color 0.2s ease-in-out; color: #a1a1aa; font-size: 0.875rem;
    }
    #page-player .tab-button:hover:not([data-selected="true"]) { color: #e4e4e7; }
    #page-player .tab-button[data-selected="true"] { color: #fafafa; }

    #page-player .cursor-pill {
        position: absolute; inset: 0; z-index: 0; border-radius: 9999px;
        background: <?= htmlspecialchars($navbar_selected_bg_dark) ?>;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        opacity: 0; transition: opacity 0.2s ease-in-out;
    }
    #page-player .tab-button[data-selected="true"] .cursor-pill { opacity: 1; }
    #page-player .tab-button:hover:not([data-selected="true"]) { color: <?= htmlspecialchars($navbar_hover) ?>; }

    #page-player .tab-content {
        width: 100%; display: none; align-items: center; flex-direction: column;
        gap: 1rem; padding: 0px; border-radius: 10px;
    }
    #page-player #content-tv, #page-player #content-anime {
        width: 540px; align-items: center; margin-left: auto; margin-right: auto;
    }
    
    #page-player .new {
        align-items: center; padding: 5px; background-color: #1c1c1c; border-radius: 100px;
    }

    #page-player .fields-wrapper {
        display: flex; justify-content: center; gap: 1rem; width: 100%;
    }
    #page-player .flex-grow { flex-grow: 1; }
    #page-player .small-input { width: 4.5rem; flex-shrink: 0; }
    
    #page-player .input-container {
        position: relative; background-color: #2a2a2a; border: 1px solid #444;
        border-radius: 8px; padding: 8px 12px; transition: background-color 0.15s ease;
    }
    #page-player .input-container:focus-within { border-color: #4f79a1; }
    
    #page-player .input-label {
        position: absolute; pointer-events: none; left: 12px; top: 50%;
        transform: translateY(-50%); color: #a1a1aa;
        transition: transform 0.2s, font-size 0.2s, color 0.2s;
    }
    
    #page-player .input-field {
        width: 100%; background-color: transparent; border: none; outline: none;
        color: #fff; font-size: 14px; padding-top: 12px;
    }
    #page-player .input-field:focus + .input-label,
    #page-player .input-field:not(:placeholder-shown) + .input-label {
        transform: translateY(-110%) scale(0.85); color: #e4e4e7;
    }
    
    #page-player .dub-button {
        background-color: #555; color: #fff; padding: 10px;
        border-radius: 5px; cursor: pointer; transition: background-color 0.2s;
        height: 54px;
    }
    #page-player .dub-button[data-active="true"] { background-color: #4f79a1; }

    #page-player .sr-only {
        position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
        overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border-width: 0;
    }
    #page-player .flex { display: flex; }
    #page-player .items-center { align-items: center; }
    #page-player .gap-4 { gap: 1rem; }
    #page-player .cursor-pointer { cursor: pointer; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const contentTabs = document.querySelectorAll('.tab-content');
    
    const movieTmdb = document.getElementById('movie-tmdb');
    const tvTmdb = document.getElementById('tv-tmdb');
    const tvSeason = document.getElementById('tv-season');
    const tvEpisode = document.getElementById('tv-episode');
    const tvChannelSelect = document.getElementById('tv-channel-select');
    
    const videoUrl = document.getElementById('video-url');
    const videoIframe = document.getElementById('video-iframe');
    const copyButton = document.getElementById('copy-button');

    function getActiveTab() {
        return document.querySelector('.tab-button[data-selected="true"]')?.id;
    }

    function switchTab(clickedButton) {
        const targetContentId = clickedButton.id.replace('tab-', 'content-');

        tabButtons.forEach(button => {
            button.dataset.selected = (button === clickedButton);
        });

        contentTabs.forEach(content => {
            if (content.id === targetContentId) {
                content.style.display = 'flex';
                updateUrl();
            } else {
                content.style.display = 'none';
            }
        });
    }

    function updateUrl() {
        const activeTab = getActiveTab();
        let url = '';

        if (activeTab === 'tab-movie') {
            const tmdbId = movieTmdb.value || '786892';
            url = `https://vidlink.pro/movie/${tmdbId}`;
        } else if (activeTab === 'tab-tv') {
            const tmdbId = tvTmdb.value || '94997';
            const season = tvSeason.value || '1';
            const episode = tvEpisode.value || '1';
            url = `https://vidlink.pro/tv/${tmdbId}/${season}/${episode}`;
        } else if (activeTab === 'tab-tvplayer') {
            const channelSlug = tvChannelSelect.value;
            if (channelSlug) {
                url = `https://meulink/tv/${channelSlug}`;
            } else {
                url = 'https://meulink/tv/no-channel-selected';
            }
        }

        videoUrl.textContent = url;
        videoIframe.src = `${url}?autoplay=false`;
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', () => switchTab(button));
    });

    [movieTmdb, tvTmdb, tvSeason, tvEpisode].forEach(input => {
        if (input) input.addEventListener('input', updateUrl);
    });
    
    if (tvChannelSelect) {
        tvChannelSelect.addEventListener('change', updateUrl);
    }

    copyButton.addEventListener('click', function() {
        navigator.clipboard.writeText(videoUrl.textContent.trim())
            .then(() => {
                copyButton.dataset.copied = true;
                setTimeout(() => {
                   copyButton.dataset.copied = false;
                }, 2000);
            });
    });

    switchTab(document.getElementById('tab-movie'));
});
</script>
