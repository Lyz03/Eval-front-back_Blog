<?php

use App\Model\Manager\ArticleManager;

class BaseController
{

    public array $articles;

    public function __construct() {
        $articleManager = new ArticleManager();
        $this->articles = $articleManager->getLastArticles(4);
    }

}