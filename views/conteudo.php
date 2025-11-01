<?php
require_once __DIR__ . '/../admin/Config.php';
$config = Config::load();
$config_colors = $config['colors'] ?? [];
$navbar_hover = $config_colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $config_colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$tmdb_api_key = $config['tmdb']['api_key'] ?? '';
?>
<div class="flex flex-col items-center justify-center w-full" style="margin-top: 120px;">
    <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
        <main id="ConteudoCatalog" class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 bg-gray-900 text-white">
            <!-- Sub-tabs for Movies/Series -->
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
                <div id="catalog-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                    <!-- Poster cards will be inserted here by JavaScript -->
                </div>
            </div>

            <!-- Pagination Controls -->
            <div id="pagination-controls" class="hidden flex justify-center items-center mt-8 gap-4">
                <button id="prev-page" class="page-button">Anterior</button>
                <span id="page-info" class="page-info">Página 1 de 10</span>
                <button id="next-page" class="page-button">Próxima</button>
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

    /* Pagination styles */
    .page-button {
        background-color: #374151;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
        border: none;
        font-weight: 500;
    }
    .page-button:hover:not(:disabled) {
        background-color: #4B5563;
    }
    .page-button:disabled {
        background-color: #1F2937;
        color: #4B5563;
        cursor: not-allowed;
    }
    .page-info {
        color: white;
        font-size: 14px;
        margin: 0 16px;
    }

    /* Poster card styles */
    .poster-card {
        background-color: #1F2937;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #374151;
    }
    .poster-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
    }
    .poster-card img {
        width: 100%;
        height: auto;
        aspect-ratio: 2 / 3;
        object-fit: cover;
    }
    .poster-card-content {
        padding: 12px;
    }
    .poster-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 8px;
    }
    .poster-card-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 12px;
    }
    .poster-card-button {
        width: 100%;
        background-color: #4B5563;
        color: white;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
        transition: background-color 0.2s;
        cursor: pointer;
        border: none;
    }
    .poster-card-button:hover {
        background-color: #6B7280;
    }
    .poster-card-button.primary {
        background: <?= htmlspecialchars($navbar_selected_bg_dark) ?>;
    }
    .poster-card-button.primary:hover {
        opacity: 0.9;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration
    const TMDB_API_KEY = '<?= $tmdb_api_key ?>';
    const API_BASE_URL_FILMES = 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';
    const API_BASE_URL_SERIES = 'https://superflixapi.asia/lista?category=serie&type=tmdb&format=json';
    const TMDB_API_BASE = 'https://api.themoviedb.org/3';
    const TMDB_IMAGE_BASE = 'https://image.tmdb.org/t/p/w500';
    const ITEMS_PER_PAGE = 20;
    const EMBED_BASE_URL = window.location.origin;

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
    const pageInfo = document.getElementById('page-info');

    // Tab handling
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

    // UI state functions
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

    // API functions
    async function loadAllItemIds() {
        showLoading(true);
        allItemIds = [];
        const url = (currentCategory === 'movie') ? API_BASE_URL_FILMES : API_BASE_URL_SERIES;

        if (!TMDB_API_KEY) {
            showError('Chave de API do TMDB não configurada.');
            return;
        }

        try {
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`Erro na API Superflix: ${response.statusText}`);
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
            showError(`Não foi possível buscar a lista de IDs. (${error.message})`);
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

    // UI rendering
    function createPosterCard(item) {
        const card = document.createElement('div');
        card.className = 'poster-card';

        const title = item.title || item.name;
        const posterPath = item.poster_path 
            ? `${TMDB_IMAGE_BASE}${item.poster_path}` 
            : 'https://placehold.co/500x750/1F2937/FFFFFF?text=Sem+Imagem';
        
        card.innerHTML = `
            <img src="${posterPath}" alt="Pôster de ${title}" onerror="this.src='https://placehold.co/500x750/1F2937/FFFFFF?text=Erro+Img'">
            <div class="poster-card-content">
                <h3 class="poster-card-title" title="${title}">${title}</h3>
                <div class="poster-card-actions">
                    <button class="poster-card-button primary" data-action="open" data-id="${item.id}" data-type="${currentCategory}">
                        Abrir Link
                    </button>
                    <button class="poster-card-button" data-action="copy-link" data-id="${item.id}" data-type="${currentCategory}">
                        Copiar Link
                    </button>
                    <button class="poster-card-button" data-action="copy-tmdb" data-id="${item.id}">
                        Copiar TMDB
                    </button>
                </div>
            </div>
        `;

        // Add event listeners
        const buttons = card.querySelectorAll('.poster-card-button');
        buttons.forEach(button => {
            button.addEventListener('click', handleCardAction);
        });

        return card;
    }

    function handleCardAction(e) {
        const action = e.currentTarget.dataset.action;
        const id = e.currentTarget.dataset.id;
        const type = e.currentTarget.dataset.type;

        let embedUrl = '';
        if (type === 'movie') {
            embedUrl = `${EMBED_BASE_URL}/movie/${id}`;
        } else if (type === 'serie') {
            embedUrl = `${EMBED_BASE_URL}/tv/${id}/1/1`;
        }

        switch (action) {
            case 'open':
                window.open(embedUrl, '_blank');
                break;
            case 'copy-link':
                copyToClipboard(embedUrl, e.currentTarget);
                break;
            case 'copy-tmdb':
                copyToClipboard(id, e.currentTarget);
                break;
        }
    }

    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = button.textContent;
            button.textContent = 'Copiado!';
            button.style.backgroundColor = '#10B981';
            setTimeout(() => {
                button.textContent = originalText;
                button.style.backgroundColor = '';
            }, 2000);
        }).catch(err => {
            console.error('Erro ao copiar:', err);
            alert('Não foi possível copiar para a área de transferência.');
        });
    }

    function updatePaginationControls() {
        pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
        prevPageBtn.disabled = (currentPage === 1);
        nextPageBtn.disabled = (currentPage === totalPages);
    }

    // Pagination
    function goToPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            loadCatalogPage();
            window.scrollTo(0, 0);
        }
    }

    function goToNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            loadCatalogPage();
            window.scrollTo(0, 0);
        }
    }

    // Event listeners
    tabFilmes.addEventListener('click', handleTabClick);
    tabSeries.addEventListener('click', handleTabClick);
    prevPageBtn.addEventListener('click', goToPrevPage);
    nextPageBtn.addEventListener('click', goToNextPage);

    // Initial load
    loadAllItemIds();
});
</script>
