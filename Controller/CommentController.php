<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;

class CommentController extends AbstractController
{

    public function default()
    {
        //$this->render('');
    }

    public function addComment(int $id) {
        if (!$_POST['submit']) {
            self::render('article/article');
            exit();
        }

        if (!$_POST['comment']) {
            self::render('article/article');
            exit();
        }

        $comment = strip_tags($_POST['comment']);

        if (empty($comment)) {
            self::render('article/article');
            exit();
        }

        $commentManager = new CommentManager();
        $commentManager->addNewComment($comment, $id, $_SESSION['user']->getId());

        $articleManager = new ArticleManager();

        $this->render('article/article', [
            'article' => $articleManager->getArticleById($id)
        ]);
    }

}