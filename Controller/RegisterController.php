<?php

use App\Controller\AbstractController;
use App\Model\Manager\UserManager;

class RegisterController extends AbstractController
{

    public function default()
    {
        $this->render('user/connection-register');
    }


    /**
     * sanitize POST content to create a new user
     */
    public function newUser() {
        if (!isset($_POST['submitRegister'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['email'], $_POST['username'], $_POST['password'])) {
            self::default();
            exit();
        }

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

        if (empty($mail) || empty($username) || empty($_POST['password'])) {
            self::default();
            exit();
        }

        $userManager = new UserManager();

        if ($userManager->connectUser($mail) !== null) {
            echo 'adresse mail déjà enregistré';
            exit();
        }

        if ($_POST['password'] === $_POST['passwordRepeat']) {

            $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


            $userManager->registerUser($mail, $username, $password);


            $_SESSION['user'] = $userManager->connectUser($mail);
            $_SESSION['user']->setPassword('');
            self::render('user/user-account');

        } else {
            self::default();
        }
    }
}