<?php

use App\Model\Manager\ArticleManager;

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

?>
<h1>Modifier un article</h1>

<form action="/index.php?c=article&a=edit-article&id=<?= $data['article']->getId() ?>" method="post">
    <input type="text" name="title" value="<?= $data['article']->getTitle() ?>" class="title" maxlength="255" required>

    <label for="article_content">Votre Article</label>
    <textarea name="content" id="article_content" cols="100" rows="30"
              class="article" required><?= $data['article']->getContent() ?></textarea>

    <input type="submit" name="submit">
</form>