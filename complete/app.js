document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the player page
    const playerTester = document.getElementById('PlayerTester');
    if (!playerTester) return;

    // Elementos das abas
    const tabButtons = document.querySelectorAll('.tab-button');
    const contentTabs = document.querySelectorAll('.tab-content');

    // Campos de entrada
    const movieTmdb = document.getElementById('movie-tmdb');
    const tvTmdb = document.getElementById('tv-tmdb');
    const tvSeason = document.getElementById('tv-season');
    const tvEpisode = document.getElementById('tv-episode');
    const animeId = document.getElementById('anime-id');
    const animeEpisode = document.getElementById('anime-episode');
    const animeDub = document.getElementById('anime-dub');
    const animeFallback = document.getElementById('anime-fallback');

    // Elementos de exibição
    const videoUrl = document.getElementById('video-url');
    const videoIframe = document.getElementById('video-iframe');
    const copyButton = document.getElementById('copy-button');

    // Função para obter a aba ativa
    function getActiveTab() {
        return document.querySelector('.tab-button[data-selected="true"]')?.id;
    }

    // Função para alternar entre as abas
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

    // Função única para atualizar a URL
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
        } else if (activeTab === 'tab-anime') {
            const id = animeId.value || '40748';
            const episode = animeEpisode.value || '1';
            const dubParam = animeDub.dataset.active === 'true' ? '/dub' : '/sub';
            const fallbackParam = animeFallback.checked ? '?fallback=true' : '';
            url = `https://vidlink.pro/anime/${id}/${episode}${dubParam}${fallbackParam}`;
        }

        videoUrl.textContent = url;
        videoIframe.src = `${url}?autoplay=false`;
    }

    // Adicionar event listeners para as abas
    tabButtons.forEach(button => {
        button.addEventListener('click', () => switchTab(button));
    });

    // Adicionar event listeners para os campos de entrada
    [movieTmdb, tvTmdb, tvSeason, tvEpisode, animeId, animeEpisode, animeFallback].forEach(input => {
        if (input) {
            input.addEventListener('input', updateUrl);
        }
    });
    
    // Event listener para o botão de dublagem
    if (animeDub) {
        animeDub.addEventListener('click', function() {
            const isActive = animeDub.dataset.active === 'true';
            animeDub.dataset.active = !isActive;
            updateUrl();
        });
    }

    // Função para copiar a URL
    if (copyButton) {
        copyButton.addEventListener('click', function() {
            navigator.clipboard.writeText(videoUrl.textContent.trim())
                .then(() => {
                    copyButton.dataset.copied = true;
                    setTimeout(() => {
                        copyButton.dataset.copied = false;
                    }, 2000);
                });
        });
    }

    // Inicialização
    const defaultTab = document.getElementById('tab-movie');
    if (defaultTab) {
        switchTab(defaultTab);
    }
});
