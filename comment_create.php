<?php

use App\Controllers\CommentController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
echo $controller->createComment();
?>

<p>Création d'un commentaire</p>
<form method="post" action="comment_create.php" name ="commentCreateForm">
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="email">Titre :</label>
    <input type="text" name="titre">
    <br />
    <label for="email">Commentaire :</label>
    <input type="text" name="commentaire">
    <br />

    <input type="submit" value="Envoyer votre commentaire">
</form>