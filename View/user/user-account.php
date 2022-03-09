<?php
$user = $_SESSION['user'];
$id = $user->getId();
?>

<h2>Information du compte</h2>

<span>Email : <?= $user->getEmail() ?></span>


<form action="/?c=user&a=update-email&id=<?= $id ?>" method="post">
    <input type="email" placeholder="nouvel email" name="email">
    <input type="submit" name="submit">
</form>

<br>

<span>Nom d'utilisateur : <?= $user->getUsername() ?></span>

<form action="/?c=user&a=update-username&id=<?= $id ?>" method="post">
    <input type="text" placeholder="nouveau nom d'utilisateur" name="username">
    <input type="submit" name="submit">
</form>

<br>

<form action="/?c=user&a=update-password&id=<?= $id ?>" method="post">
    <input type="password" placeholder="ancien mot de passe" name="oldPassword">
    <input type="password" placeholder="nouveau mot de passe" name="password">
    <input type="submit" name="submit">
</form>

<br>

<a href="">Voir vos commentaire</a>

<br>
<?php
if ($user->getRole() === 'writer' || $user->getRole() === 'admin') {
?>
    <a href="">voir / éditer / écrire un article</a>
    <br>
<?php
}

if ($user->getRole() === 'admin') {
    ?>
    <a href="">lister des articles</a>
    <a href="">lister des commentaire</a>
    <a href="">lister des utilisateur</a>
    <?php
}