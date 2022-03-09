<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<nav>
    <span class="menu"><i class="fas fa-bars"></i></span>

    <p class="logo">Nom du blog</p>

    <div class="menu">
        <ul>
            <li><a href="/?c=home">Accueil</a></li>
            <li><a href="/?c=article">Les Articles</a></li>
            <li><a href="/?c=connection">Connexion</a></li>
        </ul>
    </div>
</nav>

<main>
    <?= $html ?>
</main>

<aside>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque culpa delectus deserunt
        dolor dolore dolores eligendi exercitationem facere illum incidunt modi officia optio praesentium
        quasi quidem repellendus similique tempore, veniam?</p>
</aside>

<footer>
    <div>Infos de contact</div>
    <div>Horaires</div>
</footer>

<script src="https://kit.fontawesome.com/25d98733ec.js" crossorigin="anonymous"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
