<?php

use App\Controller\AbstractController;
use App\Model\Manager\UserManager;

class ConnectionController extends AbstractController
{

    public function default()
    {
        $this->render('user/connection-register');
    }

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
        $error = [];
        if (strlen($mail) < 8 || strlen($mail) >= 150) {
            $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
        }

        if (strlen($_POST['password']) < 8 || strlen($_POST['password']) >= 255) {
            $error[] = "le mot de passe doit faire entre 8 caractères";
        }

        $userManager  = new UserManager();
        $user = $userManager->connectUser($mail);

        if ($user === null) {
            $error[] = "L'utilisateur demandé n'est pas enregistré";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::default();
            exit();
        }

        if (password_verify($_POST['password'], $user->getPassword())) {

            $user->setPassword('');
            $_SESSION['user'] = $user;

            self::render('user/user-account');

        } else {

            $_SESSION['error'] = ['Adresse mail ou mot de passe incorrect'];
            self::default();
            exit();
        }
    }

    function disconnect() {
        $_SESSION = [];
        session_destroy();
        // TODO faire expirer le cookie de session
        self::render('user/connection-register');
    }
}