<?php


use App\Controllers\AnnonceController;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnonceController();
echo $controller->createAnnonce();

$usersService = new UsersService();
$users = $usersService->getUser();
?>

<p>Création d'une annonce</p>
<form method="post" action="annonce_create.php" name="annonceCreateForm">
    <label for="titre">Titre de l'annonce :</label>
    <input type="text" name="titre">
    <br/>
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br/>
    <label for="jour">Date (yyyy-mm-dd):</label>
    <input type="text" name="jour">
    <br/>
    <label for="depart">Lieu de départ :</label>
    <input type="text" name="depart">
    <br/>
    <label for="arrive">Lieu d'arrivée :</label>
    <input type="text" name="arrive">
    <br/>
    <label for="users">Utilisateur(s) :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce">
</form>