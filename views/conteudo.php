<?php
require_once __DIR__ . '/../admin/Config.php';
$config = Config::load();
$colors = $config['colors'] ?? [];
$navbar_hover = $colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$tmdb_api_key = $config['tmdb']['api_key'] ?? '';
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

                <!-- Catalog Grid (7 columns x 5 rows = 35 items per page) -->
                <div id="catalog-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 gap-3 md:gap-4">
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

<!-- Action Modal -->
<div id="action-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 rounded-xl border border-white/10 p-6 max-w-md w-full shadow-2xl">
        <h3 id="modal-title" class="text-xl font-bold text-white mb-4"></h3>
        <div class="space-y-3">
            <button id="modal-open-link" class="w-full px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-all font-medium">
                Abrir Link
            </button>
            <button id="modal-copy-link" class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all font-medium">
                Copiar Link
            </button>
            <button id="modal-copy-tmdb" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all font-medium">
                Copiar TMDB ID
            </button>
            <button id="modal-close" class="w-full px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all font-medium">
                Fechar
            </button>
        </div>
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

    /* Poster card styles */
    .poster-card {
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
    .poster-card-content {
        padding: 12px;
    }
    .poster-card-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 8px;
    }
    .poster-card-button {
        width: 100%;
        background-color: #4B5563;
        color: white;
        font-weight: 500;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
        transition: background-color 0.2s;
        font-size: 0.875rem;
    }
    .poster-card-button:hover {
        background-color: #6B7280;
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
    const API_BASE_URL_FILMES = 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';
    const API_BASE_URL_SERIES = 'https://superflixapi.asia/lista?category=serie&type=tmdb&format=json';
    const TMDB_API_BASE = 'https://api.themoviedb.org/3';
    const TMDB_IMAGE_BASE = 'https://image.tmdb.org/t/p/w342';
    const ITEMS_PER_PAGE = 35; // 7 columns x 5 rows
    const MAX_PAGE_BUTTONS = 6;

    // State
    let allItemIds = [];
    let currentCategory = 'movie';
    let currentPage = 1;
    let totalPages = 1;
    let isLoading = false;
    let currentModalData = null;

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
    const actionModal = document.getElementById('action-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalOpenLink = document.getElementById('modal-open-link');
    const modalCopyLink = document.getElementById('modal-copy-link');
    const modalCopyTmdb = document.getElementById('modal-copy-tmdb');
    const modalClose = document.getElementById('modal-close');

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

        card.innerHTML = `
            <img src="${posterPath}" alt="Pôster de ${title}" loading="lazy" onerror="this.src='https://placehold.co/342x513/1F2937/FFFFFF?text=Erro'">
            <div class="poster-card-content">
                <h3 class="poster-card-title" title="${title}">${title}</h3>
                <button class="poster-card-button" data-id="${item.id}" data-type="${currentCategory}" data-title="${title}">
                    Ações
                </button>
            </div>
        `;

        card.querySelector('.poster-card-button').addEventListener('click', (e) => {
            e.stopPropagation();
            const btn = e.currentTarget;
            openActionModal(btn.dataset.id, btn.dataset.type, btn.dataset.title);
        });

        return card;
    }

    function openActionModal(id, type, title) {
        currentModalData = { id, type, title };
        modalTitle.textContent = title;
        actionModal.classList.remove('hidden');
    }

    function closeActionModal() {
        actionModal.classList.add('hidden');
        currentModalData = null;
    }

    function getEmbedUrl(id, type) {
        return type === 'movie' 
            ? `https://vidlink.pro/movie/${id}`
            : `https://vidlink.pro/tv/${id}/1/1`;
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
    
    modalOpenLink.addEventListener('click', () => {
        if (currentModalData) {
            const url = getEmbedUrl(currentModalData.id, currentModalData.type);
            window.open(url, '_blank');
            closeActionModal();
        }
    });

    modalCopyLink.addEventListener('click', async () => {
        if (currentModalData) {
            const url = getEmbedUrl(currentModalData.id, currentModalData.type);
            try {
                await navigator.clipboard.writeText(url);
                modalCopyLink.textContent = 'Link Copiado!';
                setTimeout(() => {
                    modalCopyLink.textContent = 'Copiar Link';
                }, 2000);
            } catch (err) {
                console.error('Erro ao copiar:', err);
            }
        }
    });

    modalCopyTmdb.addEventListener('click', async () => {
        if (currentModalData) {
            try {
                await navigator.clipboard.writeText(currentModalData.id);
                modalCopyTmdb.textContent = 'TMDB ID Copiado!';
                setTimeout(() => {
                    modalCopyTmdb.textContent = 'Copiar TMDB ID';
                }, 2000);
            } catch (err) {
                console.error('Erro ao copiar:', err);
            }
        }
    });

    modalClose.addEventListener('click', closeActionModal);
    actionModal.addEventListener('click', (e) => {
        if (e.target === actionModal) {
            closeActionModal();
        }
    });

    // Initial load
    loadAllItemIds();
});
</script>
