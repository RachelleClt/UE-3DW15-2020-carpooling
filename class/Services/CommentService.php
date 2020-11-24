<?php

namespace App\Services;

use App\Entities\Comment;
use DateTime;

class CommentService
{
    /**
     * Create or update a comment.
     */
    public function setComment(?string $id, string $firstname, string $titre, string $commentaire): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $commentId = $dataBaseService->createComment($firstname, $titre, $commentaire);
        } else {
            $isOk = $dataBaseService->updateComment($id, $firstname, $titre, $commentaire);
            $commentId = $id;
        }

        return $commentId;
    }

    /**
     * Return all comment.
     */
    public function getComment(): array
    {
        $comment = [];

        $dataBaseService = new DataBaseService();
        $commentDTO = $dataBaseService->getComment();
        if (!empty($commentDTO)) {
            foreach ($commentDTO as $commentsDTO) {
                $comments = new Comment();
                $comments->setId($commentsDTO['id']);
                $comments->setFirstname($commentsDTO['firstname']);
                $comments->setTitre($commentsDTO['titre']);
                $comments->setCommentaire($commentsDTO['commentaire']);

                // Get user of this comment :
                $users = $this->getAnnonceUser($commentsDTO['id']);
                $comments->setUser($users);

                $comment[] = $comments;
            }
        }

        return $comment;
    }

    /**
     * Delete an comment.
     */
    public function deleteComment(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteComment($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setCommentUser(string $userId, string $commentId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setCommentUser($userId, $commentId);

        return $isOk;
    }


    /**
     * Get comment of given user id.
     */
    public function getCommentUser(string $commentId): array
    {
        $commentUsers = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and annonces :
        $commentsUserDTO = $dataBaseService->getCommentUser($commentId);
        if (!empty($commentsUserDTO)) {
            foreach ($commentsUserDTO as $commentsUsersDTO) {
                $comments = new Comment();
                $comments->setId($commentsUsersDTO['id']);
                $comments->setFirstname($commentsUsersDTO['firstname']);
                $comments->setTitre($commentsUsersDTO['titre']);
                $comments->setCommentaire($commentsUsersDTO['commentaire']);

                $commentUsers[] = $comments;
            }
        }

        return $commentUsers;
    }


}
