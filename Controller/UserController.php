<?php

use App\Controller\AbstractController;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function default()
    {
        $this->render('user/user-account');
    }

    /**
     * If not set or empty exit
     * @param string $postIndex
     */
    private function isSet(string $postIndex) {
        if (!isset($_POST['submit'])) {
            echo 'test';
            exit();
        }

        if (!isset($_POST[$postIndex])) {
            self::default();
            exit();
        }

    }

    /**
     * Update user's email
     * @param int $id
     */
    public function updateEmail(int $id) {
        self::isSet('email');

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

        if (empty($mail)) {
            self::default();
            exit();
        }

        $userManager = new UserManager();
        $userManager->update('email', $mail, $id);

        $_SESSION['user']->setEmail($mail);

        self::default();

    }

    /**
     * Update user's username
     * @param int $id
     */
    public function updateUsername(int $id) {
        self::isSet('username');

        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

        if (empty($username)) {
            self::default();
            exit();
        }

        $userManager = new UserManager();
        $userManager->update('username', $username, $id);

        $_SESSION['user']->setUsername($username);

        self::default();
    }

    /**
     * Update user's password
     * @param int $id
     */
    public function updatePassword(int $id) {
        self::isSet('oldPassword');
        self::isSet('password');

        if (empty($_POST['password']) || empty($_POST['oldPassword'])) {
            self::default();
            exit();
        }

        if (password_verify($_POST['oldPassword'], $_SESSION['user']->getPassword())) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userManager = new UserManager();
            $userManager->update('password', $password, $id);

            $_SESSION['user']->setPassword($password);

        }

        self::default();
    }

}