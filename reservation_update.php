<?php

use App\Controllers\ReservationController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationController();
echo $controller->updateReservation();
?>

<p>Mise à jour d'une réservation</p>
<form method="post" action="reservation_update.php" name ="reservationUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="lieu_depart">Lieu de départ :</label>
    <input type="text" name="lieu_depart">
    <br />
    <label for="lieu_arrivee">Lieu de l'arrivée :</label>
    <input type="text" name="lieu_arrivee">
    <br />
    <label for="datereservation">Date de la réservation au format yyyy-mm-dd :</label>
    <input type="text" name="datereservation">
    <br />
    <input type="submit" value="Modifier la réservation">
</form>