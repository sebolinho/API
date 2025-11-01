<?php
/**
 * Debug Tool for API Proxy
 * 
 * This tool helps diagnose connectivity issues with external APIs
 * Access: /debug.php
 */

// Enable all error reporting for debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load configuration
try {
    require_once __DIR__ . '/admin/Config.php';
    $config = Config::load();
    $tmdbApiKey = $config['tmdb']['api_key'] ?? '';
    $configLoaded = true;
} catch (Exception $e) {
    $configLoaded = false;
    $configError = $e->getMessage();
}

// HTML Header
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Tool - API Proxy</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .header h1 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .status.success {
            background: #10b981;
            color: white;
        }
        .status.error {
            background: #ef4444;
            color: white;
        }
        .status.warning {
            background: #f59e0b;
            color: white;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
            font-family: 'Courier New', monospace;
        }
        .test-button {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            margin-right: 10px;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .test-button:hover {
            background: #5568d3;
        }
        .test-result {
            margin-top: 15px;
            padding: 15px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .test-result.success {
            background: #d1fae5;
            color: #065f46;
        }
        .test-result.error {
            background: #fee2e2;
            color: #991b1b;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Debug Tool - API Proxy</h1>
            <p>Ferramenta de diagnóstico para testar conectividade e configuração das APIs</p>
        </div>

        <!-- System Info -->
        <div class="card">
            <h2>📊 Informações do Sistema</h2>
            <div class="info-row">
                <span class="info-label">PHP Version:</span>
                <span class="info-value"><?= phpversion() ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Server Software:</span>
                <span class="info-value"><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Document Root:</span>
                <span class="info-value"><?= $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown' ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Current Time:</span>
                <span class="info-value"><?= date('Y-m-d H:i:s') ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">cURL Available:</span>
                <span class="info-value">
                    <?php if (function_exists('curl_version')): ?>
                        <span class="status success">✓ Yes</span> (<?= curl_version()['version'] ?>)
                    <?php else: ?>
                        <span class="status error">✗ No</span>
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <!-- Configuration Status -->
        <div class="card">
            <h2>⚙️ Status da Configuração</h2>
            <div class="info-row">
                <span class="info-label">Config File:</span>
                <span class="info-value">
                    <?php if ($configLoaded): ?>
                        <span class="status success">✓ Loaded</span>
                    <?php else: ?>
                        <span class="status error">✗ Error</span>
                        <?php if (isset($configError)): ?>
                            <br><small style="color: #ef4444;"><?= htmlspecialchars($configError) ?></small>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
            </div>
            <?php if ($configLoaded): ?>
            <div class="info-row">
                <span class="info-label">TMDB API Key:</span>
                <span class="info-value">
                    <?php if (!empty($tmdbApiKey)): ?>
                        <span class="status success">✓ Configured</span>
                        (<?= substr($tmdbApiKey, 0, 8) ?>...<?= substr($tmdbApiKey, -4) ?>)
                    <?php else: ?>
                        <span class="status error">✗ Not Set</span>
                    <?php endif; ?>
                </span>
            </div>
            <?php endif; ?>
        </div>

        <!-- API Tests -->
        <div class="card">
            <h2>🧪 Testes de API</h2>
            <p style="margin-bottom: 15px; color: #666;">Clique nos botões abaixo para testar a conectividade com as APIs externas:</p>
            
            <button class="test-button" onclick="testAPI('superflix')">Testar SuperflixAPI</button>
            <button class="test-button" onclick="testAPI('tmdb')">Testar TMDB API</button>
            <button class="test-button" onclick="testProxy()">Testar Proxy</button>
            
            <div id="test-result"></div>
        </div>

        <!-- Network Diagnostics -->
        <div class="card">
            <h2>🌐 Diagnóstico de Rede</h2>
            <button class="test-button" onclick="testDNS()">Testar DNS</button>
            <button class="test-button" onclick="testSSL()">Testar SSL</button>
            
            <div id="network-result"></div>
        </div>

        <!-- Proxy Info -->
        <div class="card">
            <h2>📝 Informações do Proxy</h2>
            <p><strong>Arquivo:</strong> <code>/api/proxy.php</code></p>
            <p><strong>Uso:</strong> <code>/api/proxy.php?url=ENCODED_URL</code></p>
            <p><strong>Debug Mode:</strong> <code>/api/proxy.php?url=ENCODED_URL&debug=1</code></p>
            <p style="margin-top: 10px;"><strong>Domínios Permitidos:</strong></p>
            <ul style="margin-left: 20px; margin-top: 5px;">
                <li><code>superflixapi.asia</code></li>
                <li><code>api.themoviedb.org</code></li>
            </ul>
        </div>
    </div>

    <script>
        function displayResult(elementId, html, isError = false) {
            const element = document.getElementById(elementId);
            element.innerHTML = html;
            element.className = 'test-result ' + (isError ? 'error' : 'success');
        }

        async function testAPI(type) {
            const resultDiv = document.getElementById('test-result');
            resultDiv.innerHTML = '<div class="test-result">⏳ Testando...</div>';

            let url;
            if (type === 'superflix') {
                url = 'https://superflixapi.asia/lista?category=movie&type=tmdb&format=json';
            } else if (type === 'tmdb') {
                url = 'https://api.themoviedb.org/3/movie/550?api_key=<?= $tmdbApiKey ?>&language=pt-BR';
            }

            try {
                const startTime = performance.now();
                const response = await fetch(url);
                const endTime = performance.now();
                const data = await response.json();
                
                const time = (endTime - startTime).toFixed(2);
                
                if (response.ok) {
                    let result = `✓ Sucesso!\n\n`;
                    result += `Status: ${response.status} ${response.statusText}\n`;
                    result += `Tempo: ${time}ms\n`;
                    result += `Content-Type: ${response.headers.get('content-type')}\n\n`;
                    
                    if (type === 'superflix') {
                        result += `IDs encontrados: ${Array.isArray(data) ? data.length : 0}\n`;
                        if (Array.isArray(data) && data.length > 0) {
                            result += `Primeiros 5: ${data.slice(0, 5).join(', ')}`;
                        }
                    } else {
                        result += `Título: ${data.title || data.name || 'N/A'}`;
                    }
                    
                    displayResult('test-result', result, false);
                } else {
                    displayResult('test-result', `✗ Erro HTTP ${response.status}\n\n${JSON.stringify(data, null, 2)}`, true);
                }
            } catch (error) {
                displayResult('test-result', `✗ Erro: ${error.message}\n\nPossíveis causas:\n- CORS bloqueado\n- DNS não resolve\n- Firewall bloqueando\n- SSL inválido`, true);
            }
        }

        async function testProxy() {
            const resultDiv = document.getElementById('test-result');
            resultDiv.innerHTML = '<div class="test-result">⏳ Testando proxy...</div>';

            const testUrl = 'https://api.themoviedb.org/3/movie/550?language=pt-BR';
            const proxyUrl = '/api/proxy.php?url=' + encodeURIComponent(testUrl) + '&debug=1';

            try {
                const startTime = performance.now();
                const response = await fetch(proxyUrl);
                const endTime = performance.now();
                const data = await response.json();
                
                const time = (endTime - startTime).toFixed(2);
                
                if (response.ok && data.success !== false) {
                    let result = `✓ Proxy funcionando!\n\n`;
                    result += `Tempo total: ${time}ms\n`;
                    
                    if (data.debug) {
                        result += `\nDebug Info:\n`;
                        result += `- PHP Version: ${data.debug.php_version}\n`;
                        result += `- Execution Time: ${data.debug.execution_time}\n`;
                        result += `- HTTP Code: ${data.debug.http_code}\n`;
                        result += `- Response Size: ${data.debug.response_size} bytes\n`;
                        result += `- cURL Error: ${data.debug.curl_errno} (${data.debug.curl_error || 'none'})\n`;
                    }
                    
                    displayResult('test-result', result, false);
                } else {
                    let errorMsg = `✗ Erro no proxy\n\n`;
                    errorMsg += JSON.stringify(data, null, 2);
                    displayResult('test-result', errorMsg, true);
                }
            } catch (error) {
                displayResult('test-result', `✗ Erro ao acessar proxy: ${error.message}`, true);
            }
        }

        async function testDNS() {
            const resultDiv = document.getElementById('network-result');
            resultDiv.innerHTML = '<div class="test-result">⏳ Testando DNS...</div>';

            const domains = ['api.themoviedb.org', 'superflixapi.asia'];
            let result = 'Teste de DNS (via fetch):\n\n';

            for (const domain of domains) {
                try {
                    const startTime = performance.now();
                    const response = await fetch(`https://${domain}`, { method: 'HEAD', mode: 'no-cors' });
                    const endTime = performance.now();
                    result += `✓ ${domain}: OK (${(endTime - startTime).toFixed(0)}ms)\n`;
                } catch (error) {
                    result += `✗ ${domain}: ${error.message}\n`;
                }
            }

            displayResult('network-result', result, false);
        }

        async function testSSL() {
            const resultDiv = document.getElementById('network-result');
            resultDiv.innerHTML = '<div class="test-result">⏳ Testando SSL...</div>';

            const testUrl = 'https://api.themoviedb.org';
            
            try {
                const response = await fetch(testUrl, { method: 'HEAD' });
                let result = `✓ SSL OK\n\n`;
                result += `URL: ${testUrl}\n`;
                result += `Status: ${response.status}\n`;
                result += `Protocolo: ${response.type}\n`;
                displayResult('network-result', result, false);
            } catch (error) {
                displayResult('network-result', `✗ Erro SSL: ${error.message}\n\nVerifique os certificados do servidor.`, true);
            }
        }
    </script>
</body>
</html>
