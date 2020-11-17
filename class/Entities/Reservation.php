<?php

namespace App\Entities;

use DateTime;

    class Reservation
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $datereservation;
    private $lieu_depart;
    private $lieu_arrivee;

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

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getLieu_depart(): string
    {
        return $this->lieu_depart;
    }

    public function setLieu_depart($lieu_depart): void
    {
        $this->lieu_depart = $lieu_depart;
    }


    public function getlieu_arrivee(): string
    {
        return $this->lieu_arrivee;
    }

    public function setLieu_arrivee($lieu_arrivee): void
    {
        $this->lieu_arrivee = $lieu_arrivee;
    }

    public function getDatereservation(): DateTime
    {
        return $this->datereservation;
    }

    public function setDatereservation(DateTime $datereservation): void
    {
        $this->datereservation = $datereservation;
    }

}

