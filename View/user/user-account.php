<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
$user = $_SESSION['user'];
$id = $user->getId();
?>

<h2>Information du compte</h2>

<a href="/index.php?c=connection&a=disconnect">Déconnexion</a>
<a href="/index.php?c=user&a=delete-user&id=<?= $id ?>">Supprimer votre compte</a>
<br>

<span>Email : <?= $user->getEmail() ?></span>


<form action="/index.php?c=user&a=update-email&id=<?= $id ?>" method="post">
    <input type="email" placeholder="nouvel email" name="email" maxlength="150" required>
    <input type="submit" name="submit">
</form>

<br>

<span>Nom d'utilisateur : <?= $user->getUsername() ?></span>

<form action="/index.php?c=user&a=update-username&id=<?= $id ?>" method="post">
    <input type="text" placeholder="nouveau nom d'utilisateur" name="username" class="username" maxlength="100" required>
    <input type="submit" name="submit">
</form>

<br>

<span>Changer de mot de passe</span>
<form action="/index.php?c=user&a=update-password&id=<?= $id ?>" method="post">
    <input type="password" placeholder="ancien mot de passe" name="oldPassword" required>
    <input type="password" placeholder="nouveau mot de passe" name="password" required>
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
    <a href="/index.php?c=comment&a=comment-list">liste des commentaire</a>
    <a href="/index.php?c=user&a=user-list">liste des utilisateur</a>
    <?php
}