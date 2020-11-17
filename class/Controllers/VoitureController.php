<?php

namespace App\Controllers;

use App\Services\VoitureService;

class VoitureController
{
    /**
     * Return the html for the create action.
     */
    public function createVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['marque']) &&
            isset($_POST['modele']) &&
            isset($_POST['couleur']) &&
            isset($_POST['proprietaire'])) {
            // Create the voiture :
            $voitureService = new VoitureService();
            $isOk = $voitureService->setVoiture(
                null,
                $_POST['marque'],
                $_POST['modele'],
                $_POST['couleur'],
                $_POST['proprietaire']
            );
            if ($isOk) {
                $html = 'Voiture créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getVoiture(): string
    {
        $html = '';

        // Get all voitures :
        $voitureService = new VoitureService();
        $voiture = $voitureService->getVoiture();

        // Get html :
        foreach ($voiture as $voitures) {
            $html .=
                '#' . $voitures->getId() . ' ' .
                $voitures->getMarque() . ' ' .
                $voitures->getModele() . ' ' .
                $voitures->getCouleur() . ' ' .
                $voitures->getProprietaire() . '<br />';
        }

        return $html;
    }

    /**
     * Update the voiture.
     */
    public function updateVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['marque']) &&
            isset($_POST['modele']) &&
            isset($_POST['couleur']) &&
            isset($_POST['proprietaire'])) {
            // Update the voiture :
            $voitureService = new VoitureService();
            $isOk = $voitureService->setVoiture(
                $_POST['id'],
                $_POST['marque'],
                $_POST['modele'],
                $_POST['couleur'],
                $_POST['proprietaire']
            );
            if ($isOk) {
                $html = 'Voiture mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete an voiture.
     */
    public function deleteVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the voiture :
            $voitureService = new VoitureService();
            $isOk = $voitureService->deleteVoiture($_POST['id']);
            if ($isOk) {
                $html = 'Voiture supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
}

