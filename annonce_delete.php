<?php

use App\Controllers\AnnonceController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnonceController();
echo $controller->deleteAnnonce();
?>

<p>Supression d'une annonce</p>
<form method="post" action="annonce_delete.php" name ="annonceDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>
