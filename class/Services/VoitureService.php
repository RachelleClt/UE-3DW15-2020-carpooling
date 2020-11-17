<?php

namespace App\Services;

use App\Entities\Voiture;


class VoitureService
{
    /**
     * Créer ou mettre à jour une voiture.
     */
    public function setVoiture(?string $id, string $marque, string $modele, string $couleur, string $proprietaire): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createVoiture($marque, $modele, $couleur, $proprietaire);
        } else {
            $isOk = $dataBaseService->updateVoiture($id, $marque, $modele, $couleur, $proprietaire);
        }

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getVoiture(): array
    {
        $voiture = [];

        $dataBaseService = new DataBaseService();
        $voitureDTO = $dataBaseService->getVoiture();
        if (!empty($voitureDTO)) {
            foreach ($voitureDTO as $voituresDTO) {
                $voitures = new Voiture();
                $voitures->setId($voituresDTO['id']);
                $voitures->setMarque($voituresDTO['marque']);
                $voitures->setModele($voituresDTO['modele']);
                $voitures->setCouleur($voituresDTO['couleur']);
                $voitures->setProprietaire($voituresDTO['proprietaire']);

                $voiture[] = $voitures;
            }
        }

        return $voiture;
    }

    /**
     * Supprimer une voiture.
     */
    public function deleteVoiture(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteVoiture($id);

        return $isOk;
    }
}


