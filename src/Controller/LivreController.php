<?php
namespace App\Controller;

use App\Model\LivreRepository;

class LivreController
{
    public function index(): void
    {
        $repo = new LivreRepository();
        $livres = $repo->findAll();

        echo '<h1>📚 Liste des livres</h1>';
        echo '<table border="1" cellpadding="6">';
        echo '<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Année</th></tr>';
        foreach ($livres as $l) {
            echo '<tr>';
            echo '<td>' . $l->getId() . '</td>';
            echo '<td>' . htmlspecialchars($l->getTitre()) . '</td>';
            echo '<td>' . htmlspecialchars($l->getAuteur()) . '</td>';
            echo '<td>' . $l->getAnnee() . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}