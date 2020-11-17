<?php

namespace App\Entities;

use DateTime;

class Comment
{
    private $id;
    private $firstname;
    private $titre;
    private $commentaire;
    

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    
}

