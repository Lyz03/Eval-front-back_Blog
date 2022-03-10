<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
$user = $_SESSION['user'];
$id = $user->getId();
?>

<h2>Information du compte</h2>

<a href="/index.php?c=connection&a=disconnect">Déconnexion</a>
<br>

<span>Email : <?= $user->getEmail() ?></span>


<form action="/index.php?c=user&a=update-email&id=<?= $id ?>" method="post">
    <input type="email" placeholder="nouvel email" name="email">
    <input type="submit" name="submit">
</form>

<br>

<span>Nom d'utilisateur : <?= $user->getUsername() ?></span>

<form action="/index.php?c=user&a=update-username&id=<?= $id ?>" method="post">
    <input type="text" placeholder="nouveau nom d'utilisateur" name="username">
    <input type="submit" name="submit">
</form>

<br>

<span>Changer de mot de passe</span>
<form action="/index.php?c=user&a=update-password&id=<?= $id ?>" method="post">
    <input type="password" placeholder="ancien mot de passe" name="oldPassword">
    <input type="password" placeholder="nouveau mot de passe" name="password">
    <input type="submit" name="submit">
</form>

<br>

<a href="/index.php?c=comment">Voir vos commentaire</a>

<br>
<?php
if ($user->getRole() === 'writer' || $user->getRole() === 'admin') {
?>
    <a href="/index.php?c=article&a=new-article">écrire un article</a>
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