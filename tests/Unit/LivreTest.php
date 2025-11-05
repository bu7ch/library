<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Model\Livre;
use PHPUnit\Framework\TestCase;

class LivreTest extends TestCase
{
    public function testGetSet(): void
    {
        $l = new Livre();
        $l->setTitre('Dune');
        $l->setAuteur('Frank Herbert');
        $l->setAnnee(1965);

        self::assertSame('Dune', $l->getTitre());
        self::assertSame('Frank Herbert', $l->getAuteur());
        self::assertSame(1965, $l->getAnnee());
    }

    public function testConstructor(): void
    {
        $l = new Livre(5, '1984', 'Orwell', 1949);
        self::assertSame(5, $l->getId());
        self::assertSame('1984', $l->getTitre());
    }
}