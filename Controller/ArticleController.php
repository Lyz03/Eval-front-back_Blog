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
            self::render('article/new-article');
            exit();
        }

        if (!isset($_POST['content']) || !isset($_POST['title'])) {
            self::render('article/new-article');
            exit();
        }

        $article = strip_tags($_POST['content'], Config::ALLOWED_TAGS);
        $title = strip_tags($_POST['title']);
        $error = [];

        if (strlen($title) < 5 || strlen($title) >= 255) {
            $error[] = 'Le titre doit faire entre 5 et 255 caractères';
        }

        if (strlen($article) < 10) {
            $error[] = "l'article doit faire au moins 100 caractères";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::render('article/new-article');
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

    /**
     * Edit an article
     * @param int $id
     */
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
        $error = [];

        if (strlen($newTitle) < 5 || strlen($newTitle) >= 255) {
            $error[] = 'Le titre doit faire entre 5 et 255 caractères';
        }

        if (strlen($newContent) < 100) {
            $error[] = "l'article doit faire au moins 100 caractères";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::default();
            exit();
        }

        $articleManager = new ArticleManager();
        if ($_SESSION['user']->getId() !== $articleManager->getArticleById($id)->getUser()->getId()) {
            self::default();
            exit();
        }
        $articleManager->editArticle($newTitle, $newContent, $id);

        self::showArticle($id);
    }

    /**
     * delete an article
     * @param int $id
     */
    public function deleteArticle(int $id) {
        $articleManager = new ArticleManager();
        $articleManager->deleteArticle($id);

        self::default();
    }
}