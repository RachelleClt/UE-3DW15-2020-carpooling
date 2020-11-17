<?php

namespace App\Entities;

use DateTime;

class Annonce
{
    private $id;
    private $titre;
    private $lastname;
    private $jour;
    private $depart;
    private $arrive;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getJour(): DateTime
    {
        return $this->jour;
    }

    public function setJour(DateTime $jour): void
    {
        $this->jour = $jour;
    }

    public function getDepart(): string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): void
    {
        $this->depart = $depart;
    }

    public function getArrive(): string
    {
        return $this->arrive;
    }

    public function setArrive(string $arrive): void
    {
        $this->arrive = $arrive;
    }
}
