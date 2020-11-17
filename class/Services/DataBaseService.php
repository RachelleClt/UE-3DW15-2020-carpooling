<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format('Y-m-d H:i:s'),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format('Y-m-d H:i:s'),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Créer une annonce.
     */
    public function createAnnonce(string $titre, string $lastname, DateTime $jour, string $depart, string $arrive): bool
    {
        $isOk = false;

        $data = [
            'titre' => $titre,
            'lastname' => $lastname,
            'jour' => $jour->format('Y-m-d H:i:s'),
            'depart' => $depart,
            'arrive' => $arrive,
        ];
        $sql = 'INSERT INTO annonces (titre, lastname, jour, depart, arrive) VALUES (:titre, :lastname, :jour, :depart, :arrive)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return les annonces.
     */
    public function getAnnonce(): array
    {
        $annonce = [];

        $sql = 'SELECT * FROM annonces';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonce = $results;
        }

        return $annonce;
    }

    /**
     * Mise a jour des annonces.
     */
    public function updateAnnonce(string $id, string $titre, string $lastname, DateTime $jour, string $depart, string $arrive): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'titre' => $titre,
            'lastname' => $lastname,
            'jour' => $jour->format('Y-m-d H:i:s'),
            'depart' => $depart,
            'arrive' => $arrive,
        ];
        $sql = 'UPDATE annonces SET titre = :titre, lastname = :lastname, jour = :jour, depart = :depart, arrive = :arrive WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an annonce.
     */
    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM annonces WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /**
     * Create an voiture.
     */
    public function createVoiture(string $marque, string $modele, string $couleur, string $proprietaire): bool
    {
        $isOk = false;

        $data = [
            'marque' => $marque,
            'modele' => $modele,
            'couleur' => $couleur,
            'proprietaire' => $proprietaire,
        ];
        $sql = 'INSERT INTO voitures (marque, modele, couleur, proprietaire) VALUES (:marque, :modele, :couleur, :proprietaire)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getVoiture(): array
    {
        $voiture = [];

        $sql = 'SELECT * FROM voitures';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $voiture = $results;
        }

        return $voiture;
    }

    /**
     * Update an user.
     */
    public function updateVoiture(string $id, string $marque, string $modele, string $couleur, string $proprietaire): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'marque' => $marque,
            'modele' => $modele,
            'couleur' => $couleur,
            'proprietaire' => $proprietaire,
        ];
        $sql = 'UPDATE voitures SET marque = :marque, modele = :modele, couleur = :couleur, proprietaire = :proprietaire WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteVoiture(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM voitures WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create an user.
     */
    public function createReservation(string $firstname, string $lastname, string $email, string $lieu_depart, string $lieu_arrivee, DateTime $datereservation): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'lieu_depart' => $lieu_depart,
            'lieu_arrivee' => $lieu_arrivee,
            'datereservation' => $datereservation->format('Y-m-d H:i:s'),
        ];
        $sql = 'INSERT INTO reservation (firstname, lastname, email, lieu_depart, lieu_arrivee, datereservation) VALUES (:firstname, :lastname, :email, :lieu_depart, :lieu_arrivee, :datereservation)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getReservation(): array
    {
        $users = [];

        $sql = 'SELECT * FROM reservation';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateReservation(string $id, string $firstname, string $lastname, string $email, string $lieu_depart, string $lieu_arrivee, DateTime $datereservation): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'lieu_depart' => $lieu_depart,
            'lieu_arrivee' => $lieu_arrivee,
            'datereservation' => $datereservation->format('Y-m-d H:i:s'),
        ];
        $sql = 'UPDATE reservation SET firstname = :firstname, lastname = :lastname, email = :email, lieu_depart = :lieu_depart, lieu_arrivee = :lieu_arrivee, datereservation = :datereservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create an commentaire.
     */
    public function createComment(string $firstname, string $titre, string $commentaire): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'titre' => $titre,
            'commentaire' => $commentaire,
        ];
        $sql = 'INSERT INTO commentaire (firstname, titre, commentaire) VALUES (:firstname, :titre, :commentaire)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getComment(): array
    {
        $users = [];

        $sql = 'SELECT * FROM commentaire';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an commentaire.
     */
    public function updateComment(string $id, string $firstname, string $titre, string $commentaire): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'titre' => $titre,
            'commentaire' => $commentaire,
        ];
        $sql = 'UPDATE commentaire SET firstname = :firstname, titre = :titre, commentaire = :commentaire WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteComment(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM commentaire WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



}
