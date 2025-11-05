<?php
namespace App\Model;
 class Livre 
 {
    public function __construct(
        private int $id = 0,
        private string $titre = '',
        private string $auteur='',
        private ?int $annee = null
    ){}

    public function getId(): int{return $this->id;}
    public function getTitre(): string{return $this->tittre;}
    public function getAuteur(): string{return $this->auteur;}
    public function getAnnee(): ?int{return $this->id;}

    public function setTitre(string $titre): void {$this->titre = $titre;}
    public function setAuteur(string $auteur): void {$this->auteur = $auteur;}
    public function setAnnee(string $annee): void {$this->annee = $annee;}
 }