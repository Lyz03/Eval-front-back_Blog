<?php

use App\Config;
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
            'article' => $articleManager->getArticleById($id)
        ]);
    }

    /**
     * new article page
     */
    public function newArticle() {
        $this->render('article/new-article');
    }

    /**
     * Add an article
     */
    public function addArticle() {

        if (!isset($_POST['submit'])) {
            self::render('article/article');
            exit();
        }

        if (!isset($_POST['content']) || !isset($_POST['title'])) {
            self::render('user/user-account');
            exit();
        }

        $article = strip_tags($_POST['content'], Config::ALLOWED_TAGS);
        $title = strip_tags($_POST['title']);

        if (empty($article) || empty($title)) {
            self::render('user/user-account');
            exit();
        }

        $article = htmlentities($article);
        $articleManager = new ArticleManager();
        $id = $articleManager->addArticle($title, $article, $_SESSION['user']->getId());

        $this->render('article/article', $data = [
            'article' => $articleManager->getArticleById($id)
        ]);
    }

    /**
     * Edit an article
     * @param int $id
     */
    public function editArticlePage(int $id) {
        $articleManager = new ArticleManager();

        $this->render('article/edit-article', $data = [
            'article' => $articleManager->getArticleById($id)
        ]);
    }

    public function editArticle(int $id) {
        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['title']) || !isset($_POST['content'])) {
            self::default();
            exit();
        }

        $newTitle = strip_tags($_POST['title']);
        $newContent = strip_tags($_POST['content'], Config::ALLOWED_TAGS);

        if (empty($newTitle) || empty($newContent)) {
            self::default();
            exit();
        }

        $articleManager = new ArticleManager();
        $articleManager->editArticle($newTitle, $newContent, $id);

        self::showArticle($id);
    }
}