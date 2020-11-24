<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController
{
    /**
     * Return the html for the create action.
     */
    public function createComment(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['titre']) &&
            isset($_POST['commentaire'])) {
            // Create the comment :
            $commentService = new CommentService();
            $commentId = $commentService->setComment(
                null,
                $_POST['firstname'],
                $_POST['titre'],
                $_POST['commentaire']
            );
            // Create the user comment relations :
            $isOk = true;
            if (!empty($_POST['users'])) {
                foreach ($_POST['users'] as $userId) {
                    $isOk = $commentService->setCommentUser($commentId, $userId);
                }
            }
            if ($isOk) {
                $html = 'commentaire créé avec succès.';
            } else {
                $html = 'Erreur lors de la création du commentaire.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getComment(): string
    {
        $html = '';

        // Get all comment :
        $commentService = new CommentService();
        $comment = $commentService->getComment();

        // Get html :
        foreach ($comment as $comments) {
            $usersHtml = '';
            if (!empty($comments->getUser())) {
                foreach ($comments->getUser() as $user) {
                    $usersHtml .= $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail() . ' ' . $user->getBirthday();
                }
            }
            $html .=
                '#' . $comments->getId() . ' ' .
                $comments->getFirstname() . ' ' .
                $comments->getTitre() . ' ' .
                $comments->getCommentaire() . '<br />' ;
                 
        }

        return $html;
    }

    /**
     * Update the comment.
     */
    public function updateComment(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['titre']) &&
            isset($_POST['commentaire'])) {
            // Update the comment :
            $commentService = new CommentService();
            $isOk = $commentService->setComment(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['titre'],
                $_POST['commentaire']
            );
            if ($isOk) {
                $html = 'Commentaire mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour du commentaire.';
            }
        }

        return $html;
    }

    /**
     * Delete a comment.
     */
    public function deleteComment(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the comment :
            $commentService = new CommentService();
            $isOk = $commentService->deleteComment($_POST['id']);
            if ($isOk) {
                $html = 'Commentaire supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression du commentaire.';
            }
        }

        return $html;
    }
}
