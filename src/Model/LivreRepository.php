<?php
namespace App\Model;

use PDO;
use App\Model\Database;   

class LivreRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->pdo; 
    }

    /** @return Livre[] */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM livres ORDER BY id DESC');
        return $stmt->fetchAll(\PDO::FETCH_FUNC, [$this, 'hydrate']);
    }

    public function find(int $id): ?Livre
    {
        $stmt = $this->pdo->prepare('SELECT * FROM livres WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->hydrateRow($row) : null;
    }

    public function insert(Livre $l): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO livres (titre, auteur, annee) VALUES (?, ?, ?)'
        );
        $stmt->execute([$l->getTitre(), $l->getAuteur(), $l->getAnnee()]);
    }

    public function update(Livre $l): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE livres SET titre = ?, auteur = ?, annee = ? WHERE id = ?'
        );
        $stmt->execute([$l->getTitre(), $l->getAuteur(), $l->getAnnee(), $l->getId()]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM livres WHERE id = ?');
        $stmt->execute([$id]);
    }

    private function hydrateRow(array $row): Livre
    {
        return new Livre(
            (int)$row['id'],
            $row['titre'],
            $row['auteur'],
            $row['annee'] ? (int)$row['annee'] : null
        );
    }

    private function hydrate(int $id, string $titre, string $auteur, ?int $annee): Livre
    {
        return new Livre($id, $titre, $auteur, $annee);
    }
}