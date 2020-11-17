<?php


use App\Controllers\VoitureController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoitureController();
echo $controller->createVoiture();
?>

<p>Création d'une voiture</p>
<form method="post" action="voiture_create.php" name="voitureCreateForm">
    <label for="marque">Marque :</label>
    <input type="text" name="marque">
    <br/>
    <label for="modele">Modele :</label>
    <input type="text" name="modele">
    <br/>
    <label for="couleur">Couleur :</label>
    <input type="text" name="couleur">
    <br/>
    <label for="proprietaire">Propriétaire :</label>
    <input type="text" name="proprietaire">
    <br/>
    <input type="submit" value="Créer une voiture">
</form>
