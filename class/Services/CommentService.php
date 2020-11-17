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
            $isOk = $dataBaseService->createComment($firstname, $titre, $commentaire);
        } else {
            $isOk = $dataBaseService->updateComment($id, $firstname, $titre, $commentaire);
        }

        return $isOk;
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
}
