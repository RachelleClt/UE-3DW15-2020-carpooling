<?php

namespace App\Controllers;

use App\Services\ReservationService;

class ReservationController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['lieu_arrivee']) &&
            isset($_POST['lieu_depart']) &&
            isset($_POST['datereservation'])) {
            // Create the reservation :
            $reservationService = new ReservationService();
            $reservationId = $reservationService->setReservation(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['lieu_depart'],
                $_POST['lieu_arrivee'],
                $_POST['datereservation']
            );
            // Create the user reservation relations :
            $isOk = true;
            if (!empty($_POST['users'])) {
                foreach ($_POST['users'] as $userId) {
                    $isOk = $reservationService->setReservationUser($reservationId, $userId);
                }
            }
            if ($reservationId && $isOk) {
                $html = 'Réservation sauvegardée avec succès.';
            } else {
                $html = 'Erreur lors de la création de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getReservation(): string
    {
        $html = '';

        // Get all reservations :
        $reservationService = new ReservationService();
        $reservation = $reservationService->getReservation();

        // Get html :
        foreach ($reservation as $reservations) {
            $usersHtml = '';
            if (!empty($reservations->getUser())) {
                foreach ($reservations->getUser() as $user) {
                    $usersHtml .= $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail() . ' ' . $user->getBirthday();
                }
            }
            $html .=
                '#' . $reservations->getId() . ' ' .
                $reservations->getFirstname() . ' ' .
                $reservations->getLastname() . ' ' .
                $reservations->getEmail() . ' ' .
                $reservations->getLieu_depart() . ' ' .
                $reservations->getLieu_arrivee() . ' ' .
                $reservations->getDatereservation()->format('d-m-Y') . '<br />';
        }

        return $html;
    }

    /**
     * Update the reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['lieu_arrivee']) &&
            isset($_POST['lieu_depart']) &&
            isset($_POST['datereservation'])) {
            // Update the user :
            $reservationService = new ReservationService();
            $isOk = $reservationService->setReservation(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['lieu_depart'],
                $_POST['lieu_arrivee'],
                $_POST['datereservation']
            );
            if ($isOk) {
                $html = 'Réservation mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the reservation :
            $reservationService = new ReservationService();
            $isOk = $reservationService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'Réservation supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}
