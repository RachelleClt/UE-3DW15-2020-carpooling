<?php

namespace App\Entities;



class Voiture
{
    private $id;
    private $marque;
    private $modele;
    private $couleur;
    private $proprietaire;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getMarque(): string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): void
    {
        $this->marque = $marque;
    }

    public function getModele(): string
    {
        return $this->modele;
    }

    public function setModele(string $modele): void
    {
        $this->modele = $modele;
    }

    public function getCouleur(): string
    {
        return $this->couleur;
    }

    public function setCouleur($couleur): void
    {
        $this->couleur = $couleur;
    }

    public function getProprietaire(): string
    {
        return $this->proprietaire;
    }

    public function setProprietaire($proprietaire): void
    {
        $this->proprietaire = $proprietaire;
    }


}

