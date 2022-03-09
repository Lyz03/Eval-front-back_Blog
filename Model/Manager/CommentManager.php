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
     * get all comment for an article
     * @param int $id
     * @return array
     */
    public function getCommentByArticleId(int $id): ?array {
        $comments = null;
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE article_id = $id");

        if ($query && $data = $query->fetchAll()) {
            $userManager = new UserManager();
            $articleManager = new ArticleManager();

            foreach ($data as $value) {
                $comments[] = self::createComment($value, $articleManager, $userManager);
            }
        }
        return $comments;
    }

    public function addNewComment($content, $articleId, $userId) {
        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (content, article_id,user_id )
            VALUES (:content, :articleId, :userId)");

        $stmt->bindParam('content', $content);
        $stmt->bindParam('articleId', $articleId);
        $stmt->bindParam('userId', $userId);


        $stmt->execute();
    }

}