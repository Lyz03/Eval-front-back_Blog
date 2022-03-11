<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SESSION['user']->getRole() !== 'admin') {
    header('Location: index.php');
}

foreach ($data['comments'] as $value) {
    ?>
    <div>
        <span><?= $value->getUser()->getUsername() ?></span>
        <p><?= $value->getContent() ?></p>
        <a href="/index.php?c=comment&a=delete-comment&id=<?= $value->getId() ?>">Supprimer</a>
    </div>
    <?php
}
