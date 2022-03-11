<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SESSION['user']->getRole !== 'admin') {
    header('Location: index.php');
}

foreach ($data['comment-list'] as $value) {
    ?>
    <div>
        <h2><?= $value->getUser()->getUsername ?></h2>
        <p><?= $value->getContent() ?></p>
        <a href="/index.php?c=comment&a=delete-comment">Supprimer</a>
    </div>
    <?php
}
