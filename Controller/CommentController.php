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
     * add a comment
     * @param int $id
     */
    public function addComment(int $id) {
        if (!isset($_POST['submit'])) {
            self::render('article/article');
            exit();
        }

        if (!isset($_POST['comment'])) {
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

        if (empty($newValue)) {
            self::default();
            exit();
        }

        $commentManager = new CommentManager();
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