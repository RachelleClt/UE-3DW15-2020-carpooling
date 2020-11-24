<?php

use App\Controllers\ReservationController;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationController();
echo $controller->createReservation();

$usersService = new UsersService();
$users = $usersService->getUser();
?>

<p>Création d'une réservation</p>
<form method="post" action="reservation_create.php" name ="reservationCreateForm">
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
    <label for="users">Utilisateur(s) :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail() . ' ' . $user->getBirthday(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une réservation">
</form>