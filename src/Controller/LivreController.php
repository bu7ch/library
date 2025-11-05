<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Livre;
use App\Model\LivreRepository;

class LivreController
{
    private LivreRepository $repo;

    public function __construct()
    {
        $this->repo = new LivreRepository();
    }

    public function index(): void
    {
        $livres = $this->repo->findAll();
        $this->render('livre/index', ['livres' => $livres]);
    }

    public function show(int $id): void
    {
        $livre = $this->repo->find($id);
        if (!$livre) {
            throw new \Exception("Livre introuvable");
        }
        $this->render('livre/show', ['livre' => $livre]);
    }

    public function create(): void
    {
        $ol = new \App\Service\OpenLibrary();
        $results = [];
    
        if (!empty($_GET['ol'])) {
            $results = $ol->search($_GET['ol']); // on reuse le champ « ol »
        }
    
        $this->render('livre/create', ['results' => $results]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Méthode non autorisée');
        }

        $errors = $this->validate($_POST);
        if ($errors) {
            $this->render('livre/create', ['errors' => $errors]);
            return;
        }

        $livre = new Livre();
        $livre->setTitre(trim($_POST['titre']));
        $livre->setAuteur(trim($_POST['auteur']));
        $livre->setAnnee($_POST['annee'] ? (int)$_POST['annee'] : null);

        $this->repo->insert($livre);
        header('Location: /livres');
        exit;
    }

    public function edit(int $id): void
    {
        $livre = $this->repo->find($id);
        if (!$livre) {
            throw new \Exception("Livre introuvable");
        }
        $this->render('livre/edit', ['livre' => $livre]);
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Méthode non autorisée');
        }

        $livre = $this->repo->find($id);
        if (!$livre) {
            throw new \Exception("Livre introuvable");
        }

        $errors = $this->validate($_POST);
        if ($errors) {
            $this->render('livre/edit', ['livre' => $livre, 'errors' => $errors]);
            return;
        }

        $livre->setTitre(trim($_POST['titre']));
        $livre->setAuteur(trim($_POST['auteur']));
        $livre->setAnnee($_POST['annee'] ? (int)$_POST['annee'] : null);

        $this->repo->update($livre);
        header('Location: /livres');
        exit;
    }

    public function delete(int $id): void
    {
        $this->repo->delete($id);
        header('Location: /livres');
        exit;
    }

    /* ---------- OUTILS ---------- */
    private function validate(array $post): array
    {
        $errors = [];
        if (empty(trim($post['titre']))) {
            $errors[] = 'Le titre est obligatoire.';
        }
        if (empty(trim($post['auteur']))) {
            $errors[] = 'L’auteur est obligatoire.';
        }
        if (!empty($post['annee']) && (!is_numeric($post['annee']) || $post['annee'] < 0 || $post['annee'] > 2100)) {
            $errors[] = 'L’année doit être entre 0 et 2100.';
        }
        return $errors;
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../View/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../View/layout.php';
    }
}