<?php

use App\Controllers\ReservationController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationController();
echo $controller->deleteReservation();
?>

<p>Supression d'une réservation</p>
<form method="post" action="reservation_delete.php" name ="reservationDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une réservation">
</form>