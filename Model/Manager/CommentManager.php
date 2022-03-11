<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Comment;

class CommentManager
{
    public const TABLE = 'comment';

    /**
     * create a comment
     * @param $data
     * @param ArticleManager $articleManager
     * @param UserManager $userManager
     * @return Comment
     */
    private function createComment($data, ArticleManager $articleManager, UserManager $userManager): Comment {
        return (new Comment())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setArticle($articleManager->getArticleById($data['article_id']))
            ->setUser($userManager->getUserById($data['user_id']))
            ;
    }

    /**
     * Return all comments
     * @return array
     */
    public function getAll():array {
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE);
        $comments = [];

        if ($query) {
            $articleManager = new ArticleManager();
            $userManager = new UserManager();
            foreach ($query->fetchAll() as $value) {
                $comments[] = (new Comment())
                    ->setId($value['id'])
                    ->setContent($value['content'])
                    ->setArticle($articleManager->getArticleById($value['article_id']))
                    ->setUser($userManager->getUserById($value['user_id']))
                ;
            }
        }

        return $comments;
    }

    /**
     * Select all comment by $column and its id
     * @param string $column
     * @param int $id
     * @return array
     */
    public function getCommentByAnId(string $column, int $id): ?array {
        $comments = null;
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE $column = $id");

        if ($query && $data = $query->fetchAll()) {
            $userManager = new UserManager();
            $articleManager = new ArticleManager();

            foreach ($data as $value) {
                $comments[] = self::createComment($value, $articleManager, $userManager);
            }
        }
        return $comments;
    }

    /**
     * Add a new comment in the database
     * @param $content
     * @param $articleId
     * @param $userId
     */
    public function addNewComment($content, $articleId, $userId) {
        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (content, article_id,user_id )
            VALUES (:content, :articleId, :userId)");

        $stmt->bindParam('content', $content);
        $stmt->bindParam('articleId', $articleId);
        $stmt->bindParam('userId', $userId);


        $stmt->execute();
    }

    /**
     * Update comment
     * @param $newValue
     * @param $id
     */
    public function editComment($newValue, $id) {
        $stmt = DB::getConnection()->prepare("UPDATE " . self::TABLE . " SET content = :newValue WHERE id = :id");

        $stmt->bindParam('newValue', $newValue);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

    public function deleteComment(int $id) {
        $stmt = DB::getConnection()->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");

        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

}