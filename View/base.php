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
            <li><a href="/index.php?c=home">Accueil</a></li>
            <li><a href="/index.php?c=article">Les Articles</a></li>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<li><a href="/index.php?c=user">compte</a></li>';
            } else {
                echo '<li><a href="/index.php?c=connection">Connexion</a></li>';
            }
            ?>

        </ul>
    </div>
</nav>

<div class="flex">
    <main>
        <?= $html ?>
    </main>

    <aside>
        <?php
        $articles = new BaseController();

        foreach ($articles as $value) {
            foreach ($value as $item) {
                ?>

                <div>
                    <h2><?= $item->getTitle() ?></h2>
                    <p><?= substr($item->getContent(), 0, 200)?>...</p>
                    <a href="/index.php?c=article&a=show-article&id=<?= $item->getId() ?>">Voir plus</a>
                </div>

                <?php
            }
        }
        ?>
    </aside>
</div>

<footer>
    <div>Infos de contact</div>
    <div>Horaires</div>
</footer>

<script src="https://kit.fontawesome.com/25d98733ec.js" crossorigin="anonymous"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
