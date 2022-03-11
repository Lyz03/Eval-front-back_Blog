<h1>Connexion / Inscription</h1>

<form id="connection" action="/index.php?c=connection&a=connect" method="post">
    <h2>Connexion</h2>
    <input type="email" placeholder="Votre email" name="email">
    <input type="password" placeholder="Votre mot de passe" name="password">

    <input type="submit" name="submitConnection">
</form>

<?php
if (!isset($_SESSION['user'])) {
    echo '<p class="createAccount">Vous ne possédez pas de compte créer en un <span class="createAccount">ici</span></p>';
}
?>


<form id="register" action="/index.php?c=register&a=new-user" method="post">
    <h2>Inscription</h2>
    <input type="email" placeholder="Votre email" name="email">
    <input type="text" placeholder="Votre pseudo" name="username" class="username">

    <input type="password" placeholder="Votre mot de passe" name="password" id="p1">
    <input type="password" placeholder="Répéter votre mot de passe" name="passwordRepeat" id="p2">

    <input type="submit" name="submitRegister">
</form>