<?php
require_once __DIR__ . '/../admin/Config.php';
$config = Config::load();

$tmdb_api_key = $config['tmdb']['api_key'] ?? '';
$tmdb_language = $config['tmdb']['language'] ?? 'pt-BR';

// Get category and page from URL
$category = isset($_GET['cat']) ? $_GET['cat'] : 'movie';
$current_page = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
$per_page = 20;

// Fetch IDs from SuperflixAPI
$api_url = $category === 'serie' 
    ? 'https://superflixapi.asia/lista?category=serie&type=tmdb&format=json'
    : 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';

$ids = [];
$items = [];

try {
    $json_data = @file_get_contents($api_url);
    if ($json_data) {
        $ids = json_decode($json_data, true);
        if (is_array($ids)) {
            // Get paginated subset of IDs
            $start_index = ($current_page - 1) * $per_page;
            $page_ids = array_slice($ids, $start_index, $per_page);
            
            // Fetch TMDB data for each ID
            if (!empty($tmdb_api_key)) {
                foreach ($page_ids as $tmdb_id) {
                    $tmdb_url = $category === 'serie'
                        ? "https://api.themoviedb.org/3/tv/{$tmdb_id}?api_key={$tmdb_api_key}&language={$tmdb_language}"
                        : "https://api.themoviedb.org/3/movie/{$tmdb_id}?api_key={$tmdb_api_key}&language={$tmdb_language}";
                    
                    $tmdb_data = @file_get_contents($tmdb_url);
                    if ($tmdb_data) {
                        $item = json_decode($tmdb_data, true);
                        if ($item && !isset($item['success']) || $item['success'] !== false) {
                            $items[] = [
                                'id' => $tmdb_id,
                                'title' => $item['title'] ?? $item['name'] ?? 'Unknown',
                                'poster' => !empty($item['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $item['poster_path'] : null,
                                'overview' => $item['overview'] ?? '',
                                'rating' => $item['vote_average'] ?? 0
                            ];
                        }
                    }
                }
            }
        }
    }
} catch (Exception $e) {
    // Silently fail
}

$total_items = count($ids);
$total_pages = ceil($total_items / $per_page);
?>

<div class="flex flex-col items-center justify-center w-full" style="margin-top: 120px;">
    <div class="flex max-w-[90rem] flex-col items-center w-full min-h-screen gap-6 p-4 sm:p-8">
        <!-- Category Selector -->
        <div class="flex gap-4 items-center bg-gray-900/50 backdrop-blur-sm rounded-full p-2 border border-purple-900/50">
            <a href="?page=content&cat=movie" class="px-6 py-2 rounded-full transition-all duration-200 <?= $category === 'movie' ? 'bg-gradient-to-r from-purple-600 to-purple-500 text-white' : 'text-gray-400 hover:text-white' ?>">
                🎬 Filmes
            </a>
            <a href="?page=content&cat=serie" class="px-6 py-2 rounded-full transition-all duration-200 <?= $category === 'serie' ? 'bg-gradient-to-r from-purple-600 to-purple-500 text-white' : 'text-gray-400 hover:text-white' ?>">
                📺 Séries
            </a>
        </div>

        <h2 class="text-3xl font-bold text-white"><?= $category === 'serie' ? 'Catálogo de Séries' : 'Catálogo de Filmes' ?></h2>

        <!-- Content Grid -->
        <?php if (empty($items)): ?>
            <div class="text-center text-gray-400 py-20">
                <p class="text-xl">Carregando conteúdo...</p>
                <p class="text-sm mt-2">Se nada aparecer, verifique sua chave TMDB API no admin.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-4 w-full">
                <?php foreach ($items as $item): ?>
                    <div class="content-card group relative rounded-xl overflow-hidden border border-gray-800 hover:border-purple-500 transition-all duration-300 bg-gray-900/50" data-tmdb="<?= htmlspecialchars($item['id']) ?>">
                        <?php if ($item['poster']): ?>
                            <img src="<?= htmlspecialchars($item['poster']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-auto object-cover aspect-[2/3]" loading="lazy">
                        <?php else: ?>
                            <div class="w-full aspect-[2/3] bg-gray-800 flex items-center justify-center">
                                <span class="text-gray-600 text-4xl">🎬</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-3 p-4">
                            <h3 class="text-white text-center text-sm font-semibold line-clamp-2"><?= htmlspecialchars($item['title']) ?></h3>
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ <?= number_format($item['rating'], 1) ?>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <button onclick="openEmbed(<?= $item['id'] ?>, '<?= $category ?>')" class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-medium transition-colors">
                                    🎬 Abrir Link
                                </button>
                                <button onclick="copyEmbed(<?= $item['id'] ?>, '<?= $category ?>')" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-medium transition-colors">
                                    📋 Copiar Link
                                </button>
                                <button onclick="copyTMDB(<?= $item['id'] ?>)" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-medium transition-colors">
                                    🔢 Copiar TMDB
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="flex items-center gap-2 mt-8">
                    <?php if ($current_page > 1): ?>
                        <a href="?page=content&cat=<?= $category ?>&p=<?= $current_page - 1 ?>" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            ← Anterior
                        </a>
                    <?php endif; ?>
                    
                    <span class="px-4 py-2 bg-gray-900 text-white rounded-lg border border-purple-500">
                        Página <?= $current_page ?> de <?= $total_pages ?>
                    </span>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="?page=content&cat=<?= $category ?>&p=<?= $current_page + 1 ?>" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            Próxima →
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function getEmbedURL(tmdbId, category) {
    // Get the base player URL from config (similar to docs)
    const baseURL = 'https://vidlink.pro';
    if (category === 'serie') {
        return `${baseURL}/tv/${tmdbId}/1/1`; // Default to S01E01
    } else {
        return `${baseURL}/movie/${tmdbId}`;
    }
}

function openEmbed(tmdbId, category) {
    const url = getEmbedURL(tmdbId, category);
    window.open(url, '_blank');
}

function copyEmbed(tmdbId, category) {
    const url = getEmbedURL(tmdbId, category);
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copiado: ' + url);
    });
}

function copyTMDB(tmdbId) {
    navigator.clipboard.writeText(tmdbId).then(() => {
        alert('TMDB ID copiado: ' + tmdbId);
    });
}
</script>

<style>
#page-content .content-card {
    cursor: pointer;
}
#page-content .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
