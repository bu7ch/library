<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\LivreController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$segments = explode('/', $uri);

try {
    if ($segments[0] === 'livres') {
        $controller = new LivreController();

        if (!isset($segments[1])) {
            $controller->index();                       // /livres
        } elseif (is_numeric($segments[1])) {
            $controller->show((int)$segments[1]);       // /livres/5
        } else {
            throw new Exception("Route inconnue");
        }
    } else {
        throw new Exception("Route inconnue");
    }
} catch (Throwable $e) {
    http_response_code(404);
    echo "❌ 404 – " . htmlspecialchars($e->getMessage());
}