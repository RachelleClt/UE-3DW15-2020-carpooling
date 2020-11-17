<?php

use App\Controllers\CommentController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
echo $controller->updateComment();
?>

<p>Mise à jour d'un commentaire</p>
<form method="post" action="comment_update.php" name ="commentUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Titre :</label>
    <input type="text" name="titre">
    <br />
    <label for="email">Commentaire :</label>
    <input type="text" name="commentaire">
    <br />

    <input type="submit" value="Modifier le commentaire">
</form>