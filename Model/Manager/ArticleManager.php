<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use DateTime;

class ArticleManager
{
    public const TABLE = 'article';

    /**
     * Create Articles based on the given query
     * @param $query
     * @return array
     */
    private function createArticles($query): array {
        $articles = [];

        if($query) {
            $userManager = (new UserManager());
            $format = "Y-m-d H:i:s";

            foreach ($query->fetchAll() as $value) {
                $articles[] = (new Article())
                    ->setId($value['id'])
                    ->setTitle($value['title'])
                    ->setUser(($userManager->getUserById($value['user_id'])))
                    ->setContent(html_entity_decode($value['content']))
                    ->setDateAdd(DateTime::createFromFormat($format, $value['date_add']))
                ;
            }
        }

        return $articles;
    }


    /**
     * Select an article by its id
     * @param int $id
     * @return array|null
     */
    public function getArticleById(int $id): ?Article {

        return self::createArticles(
            DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE id = $id")
        )[0];

    }


    /**
     * return the last $nbOfArticle
     * @param int $nbOfArticle
     * @return array
     */
    public function getLastArticles(int $nbOfArticle): array {

        return $this->createArticles( DB::getConnection()
            ->query("SELECT * FROM " . self::TABLE . " ORDER BY id DESC LIMIT $nbOfArticle"));
    }


    /**
     * Return all articles
     * @return array
     */
    public function getAll():array {
        return $this->createArticles(DB::getConnection()->query("SELECT * FROM " . self::TABLE));
    }


    /**
     * Insert a new article
     * @param string $title
     * @param string $content
     * @param int $userId
     * @return int
     */
    public function addArticle(string $title, string $content, int $userId): int {
        $db = DB::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE . " (title, content, user_id)
            VALUES (:title, :content, :userId)");

        $stmt->bindParam('title', $title);
        $stmt->bindParam('content', $content);
        $stmt->bindParam('userId', $userId);

        $stmt->execute();

        return $db->lastInsertId();
    }

    /**
     * Select an article by a user id
     * @param int $id
     * @return array
     */
    public function getArticleByUserId(int $id): array {
        return $this->createArticles(DB::getConnection()->query("SELECT * FROM " . self::TABLE .
            " WHERE user_id = $id"));
    }

    /**
     * Update article
     * @param $newTitle
     * @param $newContent
     * @param $id
     */
    public function editArticle($newTitle, $newContent, $id) {
        $stmt = DB::getConnection()->prepare("UPDATE " . self::TABLE .
            " SET content = :newContent, title = :newTitle WHERE id = :id");

        $stmt->bindParam('newTitle', $newTitle);
        $stmt->bindParam('newContent', $newContent);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }
}