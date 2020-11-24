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
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format('Y-m-d H:i:s'),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUser(): array
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
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }


    /**
     * Create relation bewteen an user and his ad.
     */
    public function setAnnonceUser(string $annonceId, string $userId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'userId' => $userId,
        ];
        $sql = 'INSERT INTO annonce_user (annonce_id, user_id) VALUES (:annonceId, :userId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get user of given user ad.
     */
    public function getAnnonceUser(string $annonceId): array
    {
        $AnnonceUser = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT u.*
            FROM users as u
            LEFT JOIN annonce_user as au ON au.user_id = u.id
            WHERE au.annonce_id = :annonceId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $AnnonceUser = $results;
        }

        return $AnnonceUser;
    }

    /**
     * Create an annonce.
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
     * Return all announces.
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
     * Mise a jour des announces.
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
     * Delete an announce.
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
     * Create a reservation.
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
     * Return all reservations.
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
     * Update a reservation.
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
     * Delete a reservation.
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
     * Create relation bewteen an user and his reservation.
     */
    public function setReservationUser(string $reservationId, string $userId): bool
    {
        $isOk = false;

        $data = [
            'reservationId' => $reservationId,
            'userId' => $userId,
        ];
        $sql = 'INSERT INTO reservation_user (reservation_id, user_id) VALUES (:reservationId, :userId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getReservationUser(string $reservationId): array
    {
        $ReservationUser = [];

        $data = [
            'reservationId' => $reservationId,
        ];
        $sql = '
            SELECT u.*
            FROM users as u
            LEFT JOIN reservation_user as ru ON ru.user_id = u.id
            WHERE ru.reservation_id = :reservationId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $ReservationUser = $results;
        }

        return $ReservationUser;
    }

    /**
     * Create a comment.
     */
    public function createComment(string $firstname, string $titre, string $commentaire): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'titre' => $titre,
            'commentaire' => $commentaire,
        ];
        $sql = 'INSERT INTO comment (firstname, titre, commentaire) VALUES (:firstname, :titre, :commentaire)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all comments.
     */
    public function getComment(): array
    {
        $users = [];

        $sql = 'SELECT * FROM comment';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update a comment.
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
        $sql = 'UPDATE comment SET firstname = :firstname, titre = :titre, commentaire = :commentaire WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a comment.
     */
    public function deleteComment(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM comment WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create relation bewteen a comment and his user.
     */
    public function setCommentUser(string $commentId, string $userId): bool
    {
        $isOk = false;

        $data = [
            'commentId' => $commentId,
            'userId' => $userId,
        ];
        $sql = 'INSERT INTO comment_user (comment_id, user_id) VALUES (:commentId, :userId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get user of given user comment.
     */
    public function getCommentUser(string $commentId): array
    {
        $CommentUser = [];

        $data = [
            'commentId' => $commentId,
        ];
        $sql = '
            SELECT u.*
            FROM users as u
            LEFT JOIN comment_user as cu ON cu.user_id = u.id
            WHERE cu.comment_id = :commentId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $CommentUser = $results;
        }

        return $CommentUser;
    }

/**
     * Create relation bewteen an (annonce) and his (comment).
     */
    public function setAnnonceComment(string $annonceId, string $commentId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'commentId' => $commentId,
        ];
        $sql = 'INSERT INTO annonce_comment (annonce_id, comment_id) VALUES (:annonceId, :commentId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get comment of given announce id.
     */
    public function getAnnonceComment(string $annonceId): array
    {
        $annonceComment = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT c.*
            FROM comment as c
            LEFT JOIN annonce_comment as ac ON ac.comment_id = c.id
            WHERE ac.annonce_id = :commentId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceComment = $results;
        }

        return $annonceComment;
    }


    
        /**
     * Create relation bewteen an (annonce) and their car.
     */
    public function setAnnonceVoiture(string $annonceId, string $voitureId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'voitureId' => $voitureId,
        ];
        $sql = 'INSERT INTO annonce_voitures (annonce_id, voitures_id) VALUES (:annonceId, :voituresId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get comment of given announce id.
     */
    public function getAnnonceVoiture(string $annonceId): array
    {
        $annonceVoiture = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT v.*
            FROM voitures as v
            LEFT JOIN annonce_voitures as av ON av.voitures_id = v.id
            WHERE av.annonce_id = :voitureId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceVoiture = $results;
        }

        return $annonceVoiture;
    }


        /**
     * Create relation bewteen an (annonce) and their reservations.
     */
    public function setAnnonceReservation(string $annonceId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO annonce_reservation (annonce_id, reservation_id) VALUES (:annonceId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get reservation of given announce id.
     */
    public function getAnnonceReservation(string $annonceId): array
    {
        $annonceReservation = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT r.*
            FROM reservation as r
            LEFT JOIN annonce_reservation as ar ON ar.reservation_id = r.id
            WHERE ar.annonce_id = :reservationId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceReservation = $results;
        }

        return $annonceReservation;
    }



}
