<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CommentManager;

class CommentController extends AbstractController
{

    public function default()
    {
        $this->render('comment/comment');
    }

    /**
     * add a comment with the article id
     * @param int $id
     */
    public function addComment(int $id) {
        $articleManager = new ArticleManager();
        if (!isset($_POST['submit'])) {
            $this->render('article/article', [
                'article' => $articleManager->getArticleById($id)
            ]);
            exit();
        }

        if (!isset($_POST['comment'])) {
            $this->render('article/article', [
                'article' => $articleManager->getArticleById($id)
            ]);
            exit();
        }

        $comment = strip_tags($_POST['comment']);

        if (strlen($comment) < 5) {
            $_SESSION['error'] = ['Votre commentaire doit faire au moins 5 caractères'];
            $this->render('article/article', [
                'article' => $articleManager->getArticleById($id)
            ]);
            exit();
        }

        $commentManager = new CommentManager();
        $commentManager->addNewComment($comment, $id, $_SESSION['user']->getId());

        $this->render('article/article', [
            'article' => $articleManager->getArticleById($id)
        ]);
    }

    /**
     * Edit comment
     * @param int $id
     */
    public function editComment(int $id) {

        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['newComment'])) {
            self::default();
            exit();
        }

        $newValue = strip_tags($_POST['newComment']);

        if (strlen($newValue) < 5) {
            $_SESSION['error'] = ['Votre commentaire doit faire au moins 5 caractères'];
            self::default();
            exit();
        }

        $commentManager = new CommentManager();
        if ($_SESSION['user']->getId() !== $commentManager->getCommentByAnId('id', $id)[0]->getUser()->getId()) {
            self::default();
            exit();
        }

        $commentManager->editComment($newValue, $id);

        self::default();
    }

    /**
     * Comment list page
     */
    public function commentList() {
        $commentManager = new CommentManager();

        self::render('comment/comment-list', $data = [
            'comments' => $commentManager->getAll()
        ]);
    }

    /**
     * delete a comment
     * @param int $id
     */
    public function deleteComment(int $id) {
        $commentManager = new CommentManager();

        $commentManager->deleteComment($id);

        self::commentList();
    }

}