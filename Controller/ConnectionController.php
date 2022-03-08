<?php

use App\Controller\AbstractController;
use App\Model\Manager\UserManager;

class ConnectionController extends AbstractController
{

    public function default()
    {
        $this->render('user/connection-register');
    }

    // TODO TESTER LES TAILLES !!!
    public function connect() {
        if (!isset($_POST['submitConnection'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['email'], $_POST['password'])) {
            self::default();
            exit();
        }

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (empty($mail) || empty($_POST['password'])) {
            self::default();
            exit();
        }

        $userManager  = new UserManager();
        $user = $userManager->connectUser($mail);

        if ($user === null) {
            echo 'existe pas';
            exit();
        }

        if (password_verify($_POST['password'], $user->getPassword())) {

            $_SESSION['user'] = $user;
            self::render('user/user-account');

        } else {

            echo 'mauvais password';
        }
    }
}