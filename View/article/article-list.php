<?php
    use App\Model\Entity\Article;

foreach ($data['article-list'] as $value) {
?>
    <div>
        <h2><?= $value->getTitle() ?></h2>
        <p><?= substr($value->getContent(), 0, 300)?>...</p>
        <a href="/?c=article&a=show-article&id=<?= $value->getId() ?>">Voir plus</a>
    </div>
<?php
}

