<?php

namespace App\Services;

use App\Entities\Reservation;
use DateTime;

class ReservationService
{
    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $id, string $firstname, string $lastname, string $email, string $lieu_depart, string $lieu_arrivee, string $datereservation): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $reservationDate = new DateTime($datereservation);
        if (empty($id)) {
            $reservationId = $dataBaseService->createReservation($firstname, $lastname, $email, $lieu_depart, $lieu_arrivee, $reservationDate);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $firstname, $lastname, $email, $lieu_depart, $lieu_arrivee, $reservationDate);
            $reservationId = $id;
        }

        return $reservationId;
    }

    /**
     * Return all reservations.
     */
    public function getReservation(): array
    {
        $reservation = [];

        $dataBaseService = new DataBaseService();
        $reservationDTO = $dataBaseService->getReservation();
        if (!empty($reservationDTO)) {
            foreach ($reservationDTO as $reservationsDTO) {
                $reservations = new Reservation();
                $reservations->setId($reservationsDTO['id']);
                $reservations->setFirstname($reservationsDTO['firstname']);
                $reservations->setLastname($reservationsDTO['lastname']);
                $reservations->setEmail($reservationsDTO['email']);
                $reservations->setLieu_depart($reservationsDTO['lieu_depart']);
                $reservations->setLieu_arrivee($reservationsDTO['lieu_arrivee']);
                $datereservation = new DateTime($reservationsDTO['datereservation']);
                if ($datereservation !== false) {
                    $reservations->setDatereservation($datereservation);
                }

                // Get cars of this user :
                $users = $this->getReservationUser($reservationsDTO['id']);
                $reservations->setUser($users);

                $reservation[] = $reservations;
            }
        }

        return $reservation;
    }

    /**
     * Delete an reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
    /**
     * Create relation bewteen an reservation and his user.
     */
    public function setReservationUser(string $reservationId, string $userId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setReservationUser($reservationId, $userId);

        return $isOk;
    }

    /**
     * Get reservation of given user id.
     */
    public function getReservationUser(string $reservationId): array
    {
        $reservationUsers = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and annonces :
        $reservationsUsersDTO = $dataBaseService->getReservationUser($reservationId);
        if (!empty($reservationDTO)) {
            foreach ($reservationDTO as $reservationsDTO) {
                $reservations = new Reservation();
                $reservations->setId($reservationsUsersDTO['id']);
                $reservations->setFirstname($reservationsUsersDTO['firstname']);
                $reservations->setLastname($reservationsUsersDTO['lastname']);
                $reservations->setEmail($reservationsUsersDTO['email']);
                $reservations->setLieu_depart($reservationsUsersDTO['lieu_depart']);
                $reservations->setLieu_arrivee($reservationsUsersDTO['lieu_arrivee']);
                $datereservation = new DateTime($reservationsUsersDTO['datereservation']);
                if ($datereservation !== false) {
                    $reservations->setDatereservation($datereservation);
                }

                $reservationUsers[] = $reservation;
            }
        }

        return $reservationUsers;
    }
}



