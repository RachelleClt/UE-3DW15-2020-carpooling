<?php

namespace App\Controllers;

use App\Services\AnnonceService;

class AnnonceController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['titre']) &&
            isset($_POST['lastname']) &&
            isset($_POST['jour']) &&
            isset($_POST['depart']) &&
            isset($_POST['arrive']) &&
            isset($_POST['users'])) {
            // Create the user :
            $annonceService = new AnnonceService();
            $annonceId = $annonceService->setAnnonce(
                null,
                $_POST['titre'],
                $_POST['lastname'],
                $_POST['jour'],
                $_POST['depart'],
                $_POST['arrive']
            );
            // Create the user ad relations :
            $isOk = true;
            if (!empty($_POST['users'])) {
                foreach ($_POST['users'] as $userId) {
                    $isOk = $annonceService->setAnnonceUser($annonceId, $userId);
                }
            }
            if ($annonceId && $isOk) {
                $html = 'Annonce créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnonce(): string
    {
        $html = '';

        // Get all users :
        $annonceService = new AnnonceService();
        $annonces = $annonceService->getAnnonce();

        // Get html :
        foreach ($annonces as $annonce) {
            $usersHtml = '';
            if (!empty($annonce->getUser())) {
                foreach ($annonce->getUser() as $user) {
                    $usersHtml .= $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail() . ' ' . $user->getBirthday();
                }
            }
            $html .=
                '#' . $annonce->getId() . ' ' .
                $annonce->getTitre() . ' ' .
                $annonce->getLastname() . ' ' .
                $annonce->getJour()->format('d-m-Y') . ' ' .
                $annonce->getDepart() . ' ' .
                $annonce->getArrive() . '<br />';
        }

        return $html;
    }

    /**
     * Update the ad.
     */
    public function updateAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['titre']) &&
            isset($_POST['lastname']) &&
            isset($_POST['jour']) &&
            isset($_POST['depart']) &&
            isset($_POST['arrive'])) {
            // Update the user :
            $annonceService = new AnnonceService();
            $isOk = $annonceService->setAnnonce(
                $_POST['id'],
                $_POST['titre'],
                $_POST['lastname'],
                $_POST['jour'],
                $_POST['depart'],
                $_POST['arrive']
            );
            if ($isOk) {
                $html = 'Annonce mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an ad.
     */
    public function deleteAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $annonceService = new AnnonceService();
            $isOk = $annonceService->deleteAnnonce($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}


