<?php

namespace App\Services;

use App\Entities\Annonce;

use DateTime;

class AnnonceService
{
    /**
     * Create or update an ad.
     */
    public function setAnnonce(?string $id, string $titre, string $lastname, string $jour, string $depart, string $arrive): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $jourDateTime = new DateTime($jour);
        if (empty($id)) {
            $annonceId = $dataBaseService->createAnnonce($titre, $lastname, $jourDateTime, $depart, $arrive);
        } else {
            $isOk = $dataBaseService->updateAnnonce($id, $titre, $lastname, $jourDateTime, $depart, $arrive);
            $annonceId = $id;
        }

        return $annonceId;
    }

    /**
     * Return all users.
     */
    public function getAnnonce(): array
    {
        $annonces = [];

        $dataBaseService = new DataBaseService();
        $annoncesDTO = $dataBaseService->getAnnonce();
        if (!empty($annoncesDTO)) {
            foreach ($annoncesDTO as $annonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($annonceDTO['id']);
                $annonce->setTitre($annonceDTO['titre']);
                $annonce->setLastname($annonceDTO['lastname']);
                $jour = new DateTime($annonceDTO['jour']);
                $annonce->setDepart($annonceDTO['depart']);
                $annonce->setArrive($annonceDTO['arrive']);
                if ($jour !== false) {
                    $annonce->setJour($jour);
                }

                // Get user of this ad :
                $users = $this->getAnnonceUser($annonceDTO['id']);
                $annonce->setUser($users);

                $annonces[] = $annonce;
            }
        }

        return $annonces;
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

    /**
     * Create relation bewteen an ad and his user.
     */
    public function setAnnonceUser(string $annonceId, string $userId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceUser($annonceId, $userId);

        return $isOk;
    }

    /**
     * Get ad of given user id.
     */
    public function getAnnonceUser(string $annonceId): array
    {
        $annonceUsers = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and annonces :
        $annoncesUsersDTO = $dataBaseService->getAnnonceUser($annonceId);
        if (!empty($annoncesUsersDTO)) {
            foreach ($annoncesUsersDTO as $annoncesUserDTO) {
                $annonce = new Annonce();
                $annonce->setId($annoncesUserDTO['id']);
                $annonce->setTitre($annoncesUserDTO['titre']);
                $annonce->setLastname($annoncesUserDTO['lastname']);
                $jour = new DateTime($annoncesUserDTO['jour']);
                $annonce->setDepart($annoncesUserDTO['depart']);
                $annonce->setArrive($annoncesUserDTO['arrive']);
                if ($jour !== false) {
                    $annonce->setJour($jour);
                }
                $annonceUsers[] = $annonce;
            }
        }

        return $annonceUsers;
    }
}


