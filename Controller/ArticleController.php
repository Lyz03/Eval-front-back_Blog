<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;

class ArticleController extends AbstractController
{

    public function default()
    {
        $articleManager = new ArticleManager();

        $this->render('article/article-list', [
            'article-list' => $articleManager->getAll()
        ]);
    }

    /**
     * Article full page
     * @param int $id
     */
    public function showArticle(int $id) {
        $articleManager = new ArticleManager();

        $this->render('article/article', [
            'article' => $articleManager->getArticleById($id)[0]
        ]);
    }

}