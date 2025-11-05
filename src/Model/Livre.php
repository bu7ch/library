<?php
namespace App\Model;

class Livre
{
    public function __construct(
        private int $id = 0,
        private string $titre = '',
        private string $auteur = '',
        private ?int $annee = null
    ) {}

    public function getId(): int { return $this->id; }
    public function getTitre(): string { return $this->titre; }
    public function getAuteur(): string { return $this->auteur; }
    public function getAnnee(): ?int { return $this->annee; }

    public function setTitre(string $titre): void { $this->titre = $titre; }
    public function setAuteur(string $auteur): void { $this->auteur = $auteur; }
    public function setAnnee(?int $annee): void { $this->annee = $annee; }
}