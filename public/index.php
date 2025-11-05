<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\LivreController;

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($uri, '/');
$segments = array_values(array_filter(explode('/', $path)));

try {
    if (($segments[0] ?? '') !== 'livres') {
        throw new RuntimeException('Page non trouvée');
    }

    $controller = new LivreController();
    $id         = (int) ($segments[1] ?? 0);
    $action     = $segments[2] ?? null;

    if (!$id) {
        match ($segments[1] ?? '') {
            'create' => $controller->create(),
            'store'  => $controller->store(),
            default  => $controller->index(),
        };
        return;
    }
    elseif ($segments[0] === 'api' && $segments[1] === 'ol-search') {
        header('Content-Type: application/json');
        $q = $_GET['q'] ?? '';
        $ol = new \App\Service\OpenLibrary();
        echo json_encode($ol->search($q));
        return;
    }

    match ($action) {
        'edit'   => $controller->edit($id),
        'update' => $controller->update($id),
        'delete' => $controller->delete($id),
        default  => $controller->show($id),
    };
} catch (Throwable $e) {
    http_response_code(404);
    echo '❌ 404 – ' . htmlspecialchars($e->getMessage());
}