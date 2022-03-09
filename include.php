<?php

require __DIR__ . '/Config.php';
require __DIR__ . "/Model/DB.php";

require __DIR__ . "/Model/Entity/AbstractEntity.php";
require __DIR__ . "/Model/Entity/User.php";
require __DIR__ . "/Model/Entity/Article.php";
require __DIR__ . "/Model/Entity/Comment.php";

require __DIR__ . "/Model/Manager/UserManager.php";
require __DIR__ . "/Model/Manager/ArticleManager.php";
require __DIR__ . "/Model/Manager/CommentManager.php";

require __DIR__ . '/Controller/AbstractController.php';
require __DIR__ . '/Controller/ErrorController.php';
require __DIR__ . '/Controller/BaseController.php';
require __DIR__ . '/Controller/UserController.php';
require __DIR__ . '/Controller/ConnectionController.php';
require __DIR__ . '/Controller/RegisterController.php';
require __DIR__ . '/Controller/HomeController.php';
require __DIR__ . '/Controller/ArticleController.php';
require __DIR__ . '/Controller/CommentController.php';

require __DIR__ . '/Routeur.php';