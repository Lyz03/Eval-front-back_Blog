<?php

use App\Model\Entity\Article;

$id = null;

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']->getId();
}

foreach ($data['article-list'] as $value) {
?>
    <div>
    <h2><?= $value->getTitle() ?></h2>
    <p><?= substr($value->getContent(), 0, 300) ?>...</p>
    <a href="/index.php?c=article&a=show-article&id=<?= $value->getId() ?>">Voir plus</a>
    <?php

    if ($id !== null) {
        if ($value->getUser()->getId() === $id) {
            ?>
            <a href="/index.php?c=article&a=edit-article-page&id=<?= $value->getId() ?>">Modifier</a>
            <?php
        }
    }
    ?>

    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->getRole() === 'admin') {
            ?>
            <a href="/index.php?c=article&a=delete-article&id=<?= $value->getId() ?>">Supprimer</a>
            <?php
        }
    }
    ?>
    </div>
<?php
}

