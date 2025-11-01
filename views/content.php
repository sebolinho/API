<?php
require_once __DIR__ . '/../admin/Config.php';
require_once __DIR__ . '/../admin/TMDB.php';

$config = Config::load();
$colors = $config['colors'] ?? [];
$navbar_hover = $colors['navbar_hover'] ?? 'rgb(147, 51, 234)';
$navbar_selected_bg_dark = $colors['navbar_selected_bg_dark'] ?? 'linear-gradient(to right, rgb(168, 85, 247), rgb(147, 51, 234))';
$tmdb_api_key = $config['tmdb']['api_key'] ?? '';
$tmdb_language = $config['tmdb']['language'] ?? 'pt-BR';
?>

<div class="flex flex-col items-center justify-center w-full" style="margin-top: 120px;">
    <div class="flex max-w-[90rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
        <main id="ContentCatalog" class="flex max-w-[90rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 bg-gray-900 text-white">
            
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
            <div id="catalog-container" class="container mx-auto max-w-[90rem] mt-8">
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
                <div id="catalog-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-4 md:gap-6">
                    <!-- Posters will be inserted here by JavaScript -->
                </div>
            </div>

            <!-- Pagination Controls -->
            <div id="pagination-controls" class="hidden flex justify-center items-center mt-8 gap-2 flex-wrap">
                <button id="prev-page" class="page-button px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white disabled:bg-gray-800 disabled:text-gray-600 disabled:cursor-not-allowed transition-colors">
                    Anterior
                </button>
                <div id="page-numbers" class="flex gap-2">
                    <!-- Page numbers will be inserted here -->
                </div>
                <button id="next-page" class="page-button px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white disabled:bg-gray-800 disabled:text-gray-600 disabled:cursor-not-allowed transition-colors">
                    Próxima
                </button>
            </div>

        </main>
    </div>
</div>

<!-- Action Modal -->
<div id="action-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center" style="display: none;">
    <div class="bg-gray-800 rounded-xl p-6 max-w-md w-full mx-4 border border-gray-700 shadow-2xl">
        <h3 id="modal-title" class="text-xl font-bold text-white mb-4">Ações</h3>
        <div class="space-y-3">
            <button id="modal-open-link" class="w-full px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors font-medium">
                Abrir Link
            </button>
            <button id="modal-copy-link" class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                Copiar Link
            </button>
            <button id="modal-copy-tmdb" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-medium">
                Copiar TMDB ID
            </button>
            <button id="modal-close" class="w-full px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors font-medium">
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

    /* Poster Card Styles */
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
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 8px;
    }

    /* Page button styles */
    .page-button {
        transition: background-color 0.2s;
    }
    .page-number {
        padding: 8px 12px;
        border-radius: 8px;
        background-color: #374151;
        color: white;
        cursor: pointer;
        transition: background-color 0.2s;
        font-size: 14px;
        min-width: 40px;
        text-align: center;
    }
    .page-number:hover {
        background-color: #4B5563;
    }
    .page-number.active {
        background-color: rgb(147, 51, 234);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Configuration
    const TMDB_API_KEY = '<?= $tmdb_api_key ?>';
    const TMDB_LANGUAGE = '<?= $tmdb_language ?>';
    const API_BASE_URL_FILMES = 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';
    const API_BASE_URL_SERIES = 'https://superflixapi.asia/lista?category=serie&type=tmdb&format=json';
    const TMDB_API_BASE = 'https://api.themoviedb.org/3';
    const TMDB_IMAGE_BASE = 'https://image.tmdb.org/t/p/w500';
    const ITEMS_PER_PAGE = 35; // 7 columns x 5 rows

    // Application state
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
    
    // Modal elements
    const actionModal = document.getElementById('action-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalOpenLink = document.getElementById('modal-open-link');
    const modalCopyLink = document.getElementById('modal-copy-link');
    const modalCopyTmdb = document.getElementById('modal-copy-tmdb');
    const modalClose = document.getElementById('modal-close');

    // Tab switching
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

    // Show/hide loading
    function showLoading(show) {
        isLoading = show;
        loadingIndicator.style.display = show ? 'block' : 'none';
        if (show) {
            catalogGrid.classList.add('hidden');
            paginationControls.classList.add('hidden');
            errorMessage.classList.add('hidden');
        }
    }

    // Show error
    function showError(message) {
        errorText.textContent = message;
        errorMessage.classList.remove('hidden');
        loadingIndicator.style.display = 'none';
        catalogGrid.classList.add('hidden');
        paginationControls.classList.add('hidden');
    }

    // Load all item IDs from SuperflixAPI
    async function loadAllItemIds() {
        showLoading(true);
        allItemIds = [];
        const url = (currentCategory === 'movie') ? API_BASE_URL_FILMES : API_BASE_URL_SERIES;

        if (!TMDB_API_KEY) {
            showError('API Key do TMDB não configurada.');
            return;
        }

        try {
            const response = await fetch(`api/proxy.php?url=${encodeURIComponent(url)}`);
            
            if (!response.ok) {
                throw new Error(`Erro na API Superflix: ${response.statusText}`);
            }
            
            const data = await response.json();
            
            // Check if error response
            if (data.error) {
                throw new Error(data.error);
            }
            
            if (Array.isArray(data) && data.length > 0) {
                allItemIds = data.map(id => String(id).trim());
                totalPages = Math.ceil(allItemIds.length / ITEMS_PER_PAGE);
                await loadCatalogPage();
            } else {
                // Fallback to demo data if API fails
                console.warn('API não disponível, usando dados de demonstração');
                loadDemoData();
            }

        } catch (error) {
            console.error('Erro ao buscar IDs:', error);
            // Fallback to demo data
            console.warn('API não disponível, usando dados de demonstração');
            loadDemoData();
        }
    }

    // Load demo data as fallback
    function loadDemoData() {
        // Sample TMDB IDs for demonstration
        if (currentCategory === 'movie') {
            allItemIds = [
                '786892', '693134', '753342', '603', '155', '278', '238', '424', '389',
                '680', '13', '769', '19995', '497', '299536', '361743', '299534', '207703',
                '293660', '122', '129', '597', '198', '157336', '27205', '49026', '49051',
                '62', '11', '120', '122917', '274', '346', '38', '98', '496243', '671',
                '49047', '49529', '807', '268', '641', '745', '818', '194', '77', '329',
                '550', '1891', '1892', '1893', '1894', '76341', '315635', '475557'
            ];
        } else {
            allItemIds = [
                '1396', '1399', '60735', '94997', '1402', '66732', '63174', '85271',
                '2316', '1418', '60059', '84958', '1398', '31586', '456', '111110',
                '71446', '75219', '88329', '95396', '46639', '79788', '79785', '79460',
                '81499', '79622', '99573', '68603', '46786', '76479', '85552', '93405',
                '119051', '120168', '100088', '135157', '136315', '153312'
            ];
        }
        
        totalPages = Math.ceil(allItemIds.length / ITEMS_PER_PAGE);
        loadCatalogPage();
    }

    // Load catalog page
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

    // Fetch item details from TMDB
    async function fetchItemDetails(id) {
        const type = (currentCategory === 'movie') ? 'movie' : 'tv';
        const url = `${TMDB_API_BASE}/${type}/${id}?api_key=${TMDB_API_KEY}&language=${TMDB_LANGUAGE}`;

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

    // Create poster card
    function createPosterCard(item) {
        const card = document.createElement('div');
        card.className = 'poster-card';

        const title = item.title || item.name;
        const posterPath = item.poster_path ? `${TMDB_IMAGE_BASE}${item.poster_path}` : 'https://placehold.co/500x750/1F2937/FFFFFF?text=Sem+Imagem';
        
        card.innerHTML = `
            <img src="${posterPath}" alt="Pôster de ${title}" onerror="this.src='https://placehold.co/500x750/1F2937/FFFFFF?text=Erro+Img'">
            <div class="poster-card-content">
                <h3 class="poster-card-title" title="${title}">${title}</h3>
            </div>
        `;

        card.addEventListener('click', () => {
            openActionModal(item.id, currentCategory, title);
        });

        return card;
    }

    // Open action modal
    function openActionModal(id, type, title) {
        currentModalData = { id, type, title };
        modalTitle.textContent = title;
        actionModal.style.display = 'flex';
    }

    // Close action modal
    function closeActionModal() {
        actionModal.style.display = 'none';
        currentModalData = null;
    }

    // Modal actions
    modalOpenLink.addEventListener('click', () => {
        if (!currentModalData) return;
        const { id, type } = currentModalData;
        let url = '';
        if (type === 'movie') {
            url = `https://vidlink.pro/movie/${id}`;
        } else {
            url = `https://vidlink.pro/tv/${id}/1/1`;
        }
        window.open(url, '_blank');
        closeActionModal();
    });

    modalCopyLink.addEventListener('click', async () => {
        if (!currentModalData) return;
        const { id, type } = currentModalData;
        let url = '';
        if (type === 'movie') {
            url = `https://vidlink.pro/movie/${id}`;
        } else {
            url = `https://vidlink.pro/tv/${id}/1/1`;
        }
        try {
            await navigator.clipboard.writeText(url);
            alert('Link copiado!');
        } catch (err) {
            console.error('Erro ao copiar:', err);
        }
        closeActionModal();
    });

    modalCopyTmdb.addEventListener('click', async () => {
        if (!currentModalData) return;
        const { id } = currentModalData;
        try {
            await navigator.clipboard.writeText(id);
            alert('TMDB ID copiado!');
        } catch (err) {
            console.error('Erro ao copiar:', err);
        }
        closeActionModal();
    });

    modalClose.addEventListener('click', closeActionModal);
    actionModal.addEventListener('click', (e) => {
        if (e.target === actionModal) {
            closeActionModal();
        }
    });

    // Update pagination controls
    function updatePaginationControls() {
        prevPageBtn.disabled = (currentPage === 1);
        nextPageBtn.disabled = (currentPage === totalPages);

        // Generate page numbers
        pageNumbers.innerHTML = '';
        const maxPageButtons = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxPageButtons - 1);

        if (endPage - startPage < maxPageButtons - 1) {
            startPage = Math.max(1, endPage - maxPageButtons + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = 'page-number';
            pageBtn.textContent = i;
            if (i === currentPage) {
                pageBtn.classList.add('active');
            }
            pageBtn.addEventListener('click', () => goToPage(i));
            pageNumbers.appendChild(pageBtn);
        }
    }

    // Pagination functions
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

    function goToPage(page) {
        if (page !== currentPage && page >= 1 && page <= totalPages) {
            currentPage = page;
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
