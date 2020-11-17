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
            $isOk = $dataBaseService->createReservation($firstname, $lastname, $email, $lieu_depart, $lieu_arrivee, $reservationDate);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $firstname, $lastname, $email, $lieu_depart, $lieu_arrivee, $reservationDate);
        }

        return $isOk;
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
}
