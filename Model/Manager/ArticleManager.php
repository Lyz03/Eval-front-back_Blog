<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use DateTime;

class ArticleManager
{
    public const TABLE = 'article';

    /**
     * return the last $nbOfArticle
     * @param int $nbOfArticle
     * @return array
     */
    public function getLastArticles(int $nbOfArticle): array {

        return $this->createArticles( DB::getConnection()
            ->query("SELECT * FROM " . self::TABLE . "  LIMIT $nbOfArticle"));
    }


    /**
     * Return all articles
     * @return array
     */
    public function getAll():array {

        return $this->createArticles(DB::getConnection()->query("SELECT * FROM " . self::TABLE));
    }


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
                    ->setContent($value['content'])
                    ->setDateAdd(DateTime::createFromFormat($format, $value['date_add']))
                ;
            }
        }

        return $articles;
    }
}