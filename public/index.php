<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\LivreController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

try {
    if ($uri === 'livres') {
        (new LivreController())->index();
    } else {
        throw new Exception("Route inconnue");
    }
} catch (Throwable $e) {
    http_response_code(404);
    echo "❌ 404 – " . htmlspecialchars($e->getMessage());
}