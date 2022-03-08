<?php

use App\Controller\AbstractController;

class ArticleController extends AbstractController
{

    public function default()
    {
        $this->render('article/article-list');
    }

    public function test(string $b) {
        echo $b;
    }

}