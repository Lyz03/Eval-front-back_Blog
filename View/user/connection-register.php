<h1>Connexion / Inscription</h1>

<form id="connection" action="/?c=connection&a=connect" method="post">
    <h2>Connexion</h2>
    <input type="email" placeholder="Votre email" name="email">
    <input type="password" placeholder="Votre mot de passe" name="password">

    <input type="submit" name="submitConnection">
</form>

<p class="createAccount">Vous ne  possédez pas de compte créer en un <span class="createAccount">ici</span></p>

<form id="register" action="/?c=register&a=new-user" method="post">
    <h2>Inscription</h2>
    <input type="email" placeholder="Votre email" name="email">
    <input type="text" placeholder="Votre pseudo" name="username">

    <input type="password" placeholder="Votre mot de passe" name="password">
    <input type="password" placeholder="Répéter votre mot de passe" name="passwordRepeat">

    <input type="submit" name="submitRegister">
</form>