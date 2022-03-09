<?php
use App\Model\Entity\Article;
?>

<h1><?= $data['article']->getTitle() ?></h1>
<div>
    <?= $data['article']->getContent() ?>
</div>