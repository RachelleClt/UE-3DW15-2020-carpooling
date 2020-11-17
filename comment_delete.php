<?php

use App\Controllers\CommentController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
echo $controller->deleteComment();
?>

<p>Supression d'un commentaire</p>
<form method="post" action="comment_delete.php" name ="commentDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer un commentaire">
</form>