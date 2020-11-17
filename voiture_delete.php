<?php

use App\Controllers\VoitureController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoitureController();
echo $controller->deleteVoiture();
?>

<p>Supression d'une voiture</p>
<form method="post" action="voiture_delete.php" name ="voitureDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une voiture">
</form>
