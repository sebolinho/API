<?php
require_once __DIR__ . '/../admin/Config.php';
$config = Config::load();
$colors = $config['colors'] ?? [];
$navbar_hover = $colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$tmdb_api_key = $config['tmdb']['api_key'] ?? '';
// Get base URL from config or use default
$embed_base = isset($config['settings']['player_embed_base']) 
    ? parse_url($config['settings']['player_embed_base'], PHP_URL_SCHEME) . '://' . parse_url($config['settings']['player_embed_base'], PHP_URL_HOST)
    : 'https://vidlink.pro';
// Get catalog configuration
$grid_columns = $config['catalog']['grid_columns'] ?? 8;
$items_per_page = $config['catalog']['items_per_page'] ?? 64;
?>
<div class="flex flex-col items-center justify-center w-full" style="margin-top: 120px;">
    <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
        <main id="ContentCatalog" class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 bg-gray-900 text-white">
            <!-- Sub-tabs for Movies and Series -->
            <div class="flex p-1 h-fit gap-2 items-center flex-nowrap overflow-x-scroll scrollbar-hide bg-black/20 rounded-full new">
                <button id="tab-filmes" class="tab-button group" data-selected="true" data-category="movie">
                    <span class="cursor-pill"></span>
                    <span class="relative z-10">Filmes</span>
                </button>
                <button id="tab-series" class="tab-button group" data-selected="false" data-category="serie">
                    <span class="cursor-pill"></span>
                    <span class="relative z-10">Séries</span>
                </button>
            </div>

            <!-- Catalog Container -->
            <div id="catalog-container" class="container mx-auto max-w-7xl mt-8 w-full">
                <!-- Loading Indicator -->
                <div id="loading-indicator" class="text-center p-10 text-xl font-medium text-gray-400">
                    Carregando catálogo...
                </div>

                <!-- Error Message -->
                <div id="error-message" class="hidden text-center p-10 bg-red-900/50 border border-red-700 rounded-lg">
                    <h3 class="text-xl font-bold text-red-300 mb-2">Erro ao carregar</h3>
                    <p id="error-text" class="text-red-400">Não foi possível buscar os dados.</p>
                </div>

                <!-- Catalog Grid -->
                <div id="catalog-grid" class="hidden grid gap-3 md:gap-4 catalog-grid-layout">
                    <!-- Posters will be inserted here by JavaScript -->
                </div>
            </div>

            <!-- Pagination Controls -->
            <div id="pagination-controls" class="hidden flex justify-center items-center mt-8 gap-2 flex-wrap">
                <button id="prev-page" class="page-button px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 disabled:bg-gray-800 disabled:text-gray-600 disabled:cursor-not-allowed transition-all">
                    Anterior
                </button>
                <div id="page-numbers" class="flex gap-1">
                    <!-- Page numbers will be inserted here -->
                </div>
                <button id="next-page" class="page-button px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 disabled:bg-gray-800 disabled:text-gray-600 disabled:cursor-not-allowed transition-all">
                    Próxima
                </button>
            </div>

        </main>
    </div>
</div>

<style>
    /* Hide scrollbars */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Tab styles */
    .tab-button {
        position: relative; display: flex; justify-content: center; align-items: center;
        padding: 0.5rem 1rem; height: 2.25rem; border-radius: 9999px;
        cursor: pointer; outline: none; -webkit-tap-highlight-color: transparent;
        transition: color 0.2s ease-in-out; color: #a1a1aa; font-size: 0.875rem;
    }
    .tab-button:hover:not([data-selected="true"]) { color: #e4e4e7; }
    .tab-button[data-selected="true"] { color: #fafafa; }

    .cursor-pill {
        position: absolute; inset: 0; z-index: 0; border-radius: 9999px;
        background: <?= htmlspecialchars($navbar_selected_bg_dark) ?>;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        opacity: 0; transition: opacity 0.2s ease-in-out;
    }
    .tab-button[data-selected="true"] .cursor-pill { opacity: 1; }
    .tab-button:hover:not([data-selected="true"]) { color: <?= htmlspecialchars($navbar_hover) ?>; }

    .new {
        align-items: center; padding: 5px; background-color: #1c1c1c; border-radius: 100px;
    }

    /* Catalog grid responsive layout */
    .catalog-grid-layout {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    @media (min-width: 640px) {
        .catalog-grid-layout {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
    @media (min-width: 768px) {
        .catalog-grid-layout {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }
    }
    @media (min-width: 1024px) {
        .catalog-grid-layout {
            grid-template-columns: repeat(<?= $grid_columns ?>, minmax(0, 1fr));
        }
    }

    /* Poster card styles */
    .poster-card {
        position: relative;
        background-color: #1F2937;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #374151;
        cursor: pointer;
    }
    .poster-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
    }
    .poster-card img {
        width: 100%;
        height: auto;
        aspect-ratio: 2 / 3;
        object-fit: cover;
    }
    .poster-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.9) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .poster-card:hover .poster-card-overlay {
        opacity: 1;
        pointer-events: auto;
    }
    .poster-card-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        margin-bottom: 8px;
        line-height: 1.2;
        display: none;
    }
    .poster-card-actions {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .poster-card-action-btn {
        width: 100%;
        background-color: rgba(75, 85, 99, 0.95);
        color: white;
        font-weight: 500;
        padding: 6px 8px;
        border-radius: 4px;
        text-align: center;
        transition: background-color 0.2s;
        font-size: 0.7rem;
        border: none;
        cursor: pointer;
    }
    .poster-card-action-btn:hover {
        background-color: rgba(107, 114, 128, 1);
    }

    /* Page number button styles */
    .page-number-button {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: #374151;
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
    }
    .page-number-button:hover {
        background-color: #4B5563;
    }
    .page-number-button.active {
        background-color: #7C3AED;
        box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.3);
    }
    .page-number-button:disabled {
        background-color: #1F2937;
        color: #4B5563;
        cursor: not-allowed;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration
    const TMDB_API_KEY = '<?= htmlspecialchars($tmdb_api_key) ?>';
    const EMBED_BASE_URL = '<?= htmlspecialchars($embed_base) ?>';
    const API_BASE_URL_FILMES = 'api/proxy.php?category=movie&type=tmdb&format=json&order=desc';
    const API_BASE_URL_SERIES = 'api/proxy.php?category=serie&type=tmdb&format=json&order=desc';
    const TMDB_API_BASE = 'https://api.themoviedb.org/3';
    const TMDB_IMAGE_BASE = 'https://image.tmdb.org/t/p/w342';
    const ITEMS_PER_PAGE = <?= $items_per_page ?>;
    const MAX_PAGE_BUTTONS = 6;

    // State
    let allItemIds = [];
    let currentCategory = 'movie';
    let currentPage = 1;
    let totalPages = 1;
    let isLoading = false;

    // DOM Elements
    const tabFilmes = document.getElementById('tab-filmes');
    const tabSeries = document.getElementById('tab-series');
    const loadingIndicator = document.getElementById('loading-indicator');
    const errorMessage = document.getElementById('error-message');
    const errorText = document.getElementById('error-text');
    const catalogGrid = document.getElementById('catalog-grid');
    const paginationControls = document.getElementById('pagination-controls');
    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const pageNumbers = document.getElementById('page-numbers');

    // Functions
    function showLoading(show) {
        isLoading = show;
        loadingIndicator.style.display = show ? 'block' : 'none';
        if (show) {
            catalogGrid.classList.add('hidden');
            paginationControls.classList.add('hidden');
            errorMessage.classList.add('hidden');
        }
    }

    function showError(message) {
        errorText.textContent = message;
        errorMessage.classList.remove('hidden');
        loadingIndicator.style.display = 'none';
        catalogGrid.classList.add('hidden');
        paginationControls.classList.add('hidden');
    }

    function handleTabClick(event) {
        const selectedTab = event.currentTarget;
        const category = selectedTab.dataset.category;
        if (category === currentCategory || isLoading) return;

        currentCategory = category;
        currentPage = 1;

        tabFilmes.setAttribute('data-selected', category === 'movie');
        tabSeries.setAttribute('data-selected', category === 'serie');

        loadAllItemIds();
    }

    async function loadAllItemIds() {
        showLoading(true);
        allItemIds = [];

        const url = (currentCategory === 'movie') ? API_BASE_URL_FILMES : API_BASE_URL_SERIES;

        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Erro na API: ${response.statusText}`);
            }

            const data = await response.json();
            if (Array.isArray(data) && data.length > 0) {
                allItemIds = data;
                totalPages = Math.ceil(allItemIds.length / ITEMS_PER_PAGE);
                await loadCatalogPage();
            } else {
                showError('A API retornou uma lista vazia.');
            }
        } catch (error) {
            console.error('Erro ao buscar IDs:', error);
            showError(`Não foi possível buscar a lista de IDs. (Erro: ${error.message})`);
        }
    }

    async function loadCatalogPage() {
        showLoading(true);
        catalogGrid.innerHTML = '';

        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const pageItemIds = allItemIds.slice(startIndex, endIndex);

        if (pageItemIds.length === 0) {
            showError('Não há mais itens para exibir.');
            return;
        }

        const fetchPromises = pageItemIds.map(id => fetchItemDetails(id));

        try {
            const items = await Promise.all(fetchPromises);
            catalogGrid.innerHTML = '';

            items.forEach(item => {
                if (item) {
                    const card = createPosterCard(item);
                    catalogGrid.appendChild(card);
                }
            });

            catalogGrid.classList.remove('hidden');
            updatePaginationControls();
            paginationControls.classList.remove('hidden');
        } catch (error) {
            console.error('Erro ao buscar detalhes no TMDB:', error);
            showError('Erro ao buscar detalhes dos itens no TMDB.');
        } finally {
            showLoading(false);
        }
    }

    async function fetchItemDetails(id) {
        const type = (currentCategory === 'movie') ? 'movie' : 'tv';
        const url = `${TMDB_API_BASE}/${type}/${id}?api_key=${TMDB_API_KEY}&language=pt-BR`;

        try {
            const response = await fetch(url);
            if (!response.ok) {
                console.warn(`Não foi possível buscar o item ${type}/${id}. Status: ${response.status}`);
                return null;
            }
            return await response.json();
        } catch (error) {
            console.error(`Erro no fetch para ${type}/${id}:`, error);
            return null;
        }
    }

    function createPosterCard(item) {
        const card = document.createElement('div');
        card.className = 'poster-card';

        const title = item.title || item.name;
        const posterPath = item.poster_path 
            ? `${TMDB_IMAGE_BASE}${item.poster_path}` 
            : 'https://placehold.co/342x513/1F2937/FFFFFF?text=Sem+Imagem';

        // Create elements safely to prevent XSS
        const img = document.createElement('img');
        img.src = posterPath;
        img.alt = `Pôster de ${title}`;
        img.loading = 'lazy';
        img.onerror = function() { this.src = 'https://placehold.co/342x513/1F2937/FFFFFF?text=Erro'; };

        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'poster-card-overlay';

        const titleEl = document.createElement('h3');
        titleEl.className = 'poster-card-title';
        titleEl.textContent = title;

        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'poster-card-actions';

        // Open Link button
        const openBtn = document.createElement('button');
        openBtn.className = 'poster-card-action-btn';
        openBtn.textContent = 'Abrir Link';
        openBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const url = getEmbedUrl(item.id, currentCategory);
            window.open(url, '_blank');
        });

        // Copy Link button
        const copyLinkBtn = document.createElement('button');
        copyLinkBtn.className = 'poster-card-action-btn';
        copyLinkBtn.textContent = 'Copiar Link';
        copyLinkBtn.addEventListener('click', async (e) => {
            e.stopPropagation();
            const url = getEmbedUrl(item.id, currentCategory);
            try {
                await navigator.clipboard.writeText(url);
                copyLinkBtn.textContent = 'Link Copiado!';
                setTimeout(() => {
                    copyLinkBtn.textContent = 'Copiar Link';
                }, 2000);
            } catch (err) {
                console.error('Erro ao copiar:', err);
            }
        });

        // Copy TMDB ID button
        const copyTmdbBtn = document.createElement('button');
        copyTmdbBtn.className = 'poster-card-action-btn';
        copyTmdbBtn.textContent = 'Copiar TMDB';
        copyTmdbBtn.addEventListener('click', async (e) => {
            e.stopPropagation();
            try {
                await navigator.clipboard.writeText(item.id.toString());
                copyTmdbBtn.textContent = 'ID Copiado!';
                setTimeout(() => {
                    copyTmdbBtn.textContent = 'Copiar TMDB';
                }, 2000);
            } catch (err) {
                console.error('Erro ao copiar:', err);
            }
        });

        actionsDiv.appendChild(openBtn);
        actionsDiv.appendChild(copyLinkBtn);
        actionsDiv.appendChild(copyTmdbBtn);

        overlay.appendChild(titleEl);
        overlay.appendChild(actionsDiv);

        card.appendChild(img);
        card.appendChild(overlay);

        return card;
    }

    function getEmbedUrl(id, type) {
        return type === 'movie' 
            ? `${EMBED_BASE_URL}/movie/${id}`
            : `${EMBED_BASE_URL}/tv/${id}/1/1`;
    }

    function updatePaginationControls() {
        prevPageBtn.disabled = (currentPage === 1);
        nextPageBtn.disabled = (currentPage === totalPages);

        // Generate page numbers
        pageNumbers.innerHTML = '';
        
        let startPage = Math.max(1, currentPage - Math.floor(MAX_PAGE_BUTTONS / 2));
        let endPage = Math.min(totalPages, startPage + MAX_PAGE_BUTTONS - 1);
        
        if (endPage - startPage < MAX_PAGE_BUTTONS - 1) {
            startPage = Math.max(1, endPage - MAX_PAGE_BUTTONS + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = 'page-number-button' + (i === currentPage ? ' active' : '');
            pageBtn.textContent = i;
            pageBtn.addEventListener('click', () => goToPage(i));
            pageNumbers.appendChild(pageBtn);
        }
    }

    function goToPage(page) {
        if (page === currentPage || page < 1 || page > totalPages) return;
        currentPage = page;
        loadCatalogPage();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function goToPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            loadCatalogPage();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    function goToNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            loadCatalogPage();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    // Event Listeners
    tabFilmes.addEventListener('click', handleTabClick);
    tabSeries.addEventListener('click', handleTabClick);
    prevPageBtn.addEventListener('click', goToPrevPage);
    nextPageBtn.addEventListener('click', goToNextPage);

    // Initial load
    loadAllItemIds();
});
</script>
