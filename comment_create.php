<?php

use App\Controllers\CommentController;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CommentController();
echo $controller->createComment();

$usersService = new UsersService();
$users = $usersService->getUser();
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
    <label for="users">Utilisateur(s) :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Envoyer votre commentaire">
</form>