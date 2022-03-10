<?php

use App\Model\Manager\ArticleManager;

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

?>
<h1>Modifier un article</h1>

<form action="/index.php?c=article&a=edit-article" method="post">
    <input type="text" name="title" placeholder="Titre">

    <label for="article_content">Votre Article</label>
    <textarea name="content" id="article_content" cols="30" rows="10"></textarea>

    <input type="submit" name="submit">
</form>