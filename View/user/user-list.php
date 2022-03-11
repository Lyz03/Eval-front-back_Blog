<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SESSION['user']->getRole() !== 'admin') {
    header('Location: index.php');
}

foreach ($data['users'] as $value) {
    ?>
    <div>
        <span><?= $value->getUsername() ?></span>
        <p><?= $value->getRole() ?></p>
        <a href="/index.php?c=user&a=delete-user&id=<?= $value->getId() ?>">Supprimer</a>
    </div>
    <?php
}
