<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Model\Livre;
use App\Model\LivreRepository;
use PHPUnit\Framework\TestCase;

class LivreRepositoryTest extends TestCase
{
    private LivreRepository $repo;

    protected function setUp(): void
    {
        $this->repo = new LivreRepository();
    }

    public function testInsertAndFind(): void
    {
        $livre = new Livre(0, 'Test Titre', 'Test Auteur', 2000);
        $this->repo->insert($livre);

        $found = $this->repo->find($livre->getId());
        self::assertNotNull($found);
        self::assertSame('Test Titre', $found->getTitre());
        self::assertSame(2000, $found->getAnnee());

        $this->repo->delete($livre->getId());
    }

    public function testUpdate(): void
    {
        $livre = new Livre(0, 'Original', 'Auteur', 1990);
        $this->repo->insert($livre);

        $livre->setTitre('Modifié');
        $this->repo->update($livre);

        $updated = $this->repo->find($livre->getId());
        self::assertSame('Modifié', $updated->getTitre());

        $this->repo->delete($livre->getId());
    }

    public function testDelete(): void
    {
        $livre = new Livre(0, 'À suppr', 'Auteur', 2000);
        $this->repo->insert($livre);
        $id = $livre->getId();

        $this->repo->delete($id);
        self::assertNull($this->repo->find($id));
    }
}