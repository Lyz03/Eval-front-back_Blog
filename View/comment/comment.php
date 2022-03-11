<?php

use App\Model\Manager\CommentManager;

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$user = $_SESSION['user'];
$id = $user->getId();
?>

<h1>Vos commentaire</h1>

<div class="comment_container">
    <?php
    $commentManager = new CommentManager();
    $comments = $commentManager->getCommentByAnId('user_id', $id);

    if($comments === null) {
        echo '<span>Pas encore de commentaire</span>';
    } else {
        foreach ($comments as $value) {
            ?>
            <span class="gray"><?= $value->getArticle()->getTitle() ?></span>
            <p><?= $value->getContent() ?></p>

            <form action="/index.php?c=comment&a=edit-comment&id=<?= $value->getId() ?>" method="post">
                <label for="newComment">Nouveau commentaire</label>
                <textarea name="newComment" id="newComment" cols="30" rows="10" class="comment" maxlength="255"
                          required></textarea>
                <input type="submit" name="submit">
            </form>
            <br>
            <br>
            <?php
        }
    }
    ?>
</div>