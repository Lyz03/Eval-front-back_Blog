<?php
use App\Model\Manager\CommentManager;
?>

<h1><?= $data['article']->getTitle() ?></h1>
<div class="article_container">
    <?= $data['article']->getContent() ?>
</div>

<div>
    <?php
    if (isset($_SESSION['user'])) {
        ?>

        <form action="/?c=comment&a=add-comment&id=<?= $data['article']->getId() ?>" method="post">
            <label for="addComment">Ajouter un commentaire : </label>
            <textarea name="comment" id="addComment" cols="30" rows="10"></textarea>
            <input type="submit" name="submit">
        </form>

        <?php
    }
    ?>
</div>

<div class="comment_container">
    <?php
    $commentManager = new CommentManager();
    $comments = $commentManager->getCommentByAnId('article_id', $data['article']->getId());

    if($comments === null) {
        echo '<span>Pas encore de commentaire</span>';
    } else {
        foreach ($comments as $value) {
        ?>
            <span class="gray"><?= $value->getUser()->getUsername() ?></span>
            <p><?= $value->getContent() ?></p>
            <br>
        <?php
        }
    }
    ?>
</div>