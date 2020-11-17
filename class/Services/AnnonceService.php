<?php

namespace App\Services;

use App\Entities\Annonce;
use DateTime;

class AnnonceService
{
    /**
     * Create or update an user.
     */
    public function setAnnonce(?string $id, string $titre, string $lastname, string $jour, string $depart, string $arrive): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $jourDateTime = new DateTime($jour);
        if (empty($id)) {
            $isOk = $dataBaseService->createAnnonce($titre, $lastname, $jourDateTime, $depart, $arrive);
        } else {
            $isOk = $dataBaseService->updateAnnonce($id, $titre, $lastname, $jourDateTime, $depart, $arrive);
        }

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getAnnonce(): array
    {
        $annonce = [];

        $dataBaseService = new DataBaseService();
        $annonceDTO = $dataBaseService->getAnnonce();
        if (!empty($annonceDTO)) {
            foreach ($annonceDTO as $annoncesDTO) {
                $annonces = new Annonce();
                $annonces->setId($annoncesDTO['id']);
                $annonces->setTitre($annoncesDTO['titre']);
                $annonces->setLastname($annoncesDTO['lastname']);
                $jour = new DateTime($annoncesDTO['jour']);
                $annonces->setDepart($annoncesDTO['depart']);
                $annonces->setArrive($annoncesDTO['arrive']);
                if ($jour !== false) {
                    $annonces->setJour($jour);
                }
                $annonce[] = $annonces;
            }
        }

        return $annonce;
    }

    /**
     * Delete an user.
     */
    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnonce($id);

        return $isOk;
    }
}

