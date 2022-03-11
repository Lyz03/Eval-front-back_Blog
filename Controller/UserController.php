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
     * Check if the session user id is the same as $id
     * @param int $id
     */
    private function isSameId(int $id) {
        if ($_SESSION['user']->getId() !== $id) {
            self::default();
            exit();
        }
    }

    /**
     * If not set or empty exit
     * @param string $postIndex
     */
    private function isSet(string $postIndex) {
        if (!isset($_POST['submit'])) {
            self::default();
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

        if (strlen($mail) < 8 || strlen($mail) >= 150) {
            $_SESSION['error'] = ["l'adresse email doit faire entre 8 et 150 caractères"];
            self::default();
            exit();
        }

        self::isSameId($id);

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

        if (strlen($_POST['username']) < 8 || strlen($_POST['username']) >= 100) {
            $_SESSION['error'] = ["le pseudo doit faire entre 8 et 100 caractères"];
            self::default();
            exit();
        }

        self::isSameId($id);

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

        $password = $_POST['password'];
        $oldPassword = $_POST['oldPassword'];

        if (strlen($password) < 8 || strlen($password) >= 255 ||
            strlen($oldPassword) < 8 || strlen($oldPassword) >= 255) {

            $_SESSION['error'] = ["le mot de passe doit faire au moins 8 caractères"];
            self::default();
            exit();
        }

        self::isSameId($id);

        $userManager = new UserManager();
        if (password_verify($oldPassword, $userManager->getUserById($_SESSION['user']->getId())->getPassword())) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userManager->update('password', $password, $id);

        }

        self::default();
    }

    /**
     * Comment list page
     */
    public function UserList() {
        $userManager = new UserManager();

        self::render('user/user-list', $data = [
            'users' => $userManager->getAll()
        ]);
    }

    /**
     * delete a user
     * @param int $id
     */
    public function deleteUser(int $id) {
        $userManager = new UserManager();

        $userManager->deleteUser($id);

        $connectionController = new ConnectionController();
        $connectionController->disconnect();
    }

    /**
     * Update a user role
     * @param int $id
     */
    public function userRole(int $id) {
        self::isSet('role');
        $role = $_POST['role'];
        $userManager = new UserManager();

        if (!in_array($role, ['user', 'admin', 'writer'])) {

            self::render('user/user-list', $data = [
                'users' => $userManager->getAll()
            ]);
            exit();
        }

        $userManager->update('role', $role, $id);

        self::render('user/user-list', $data = [
            'users' => $userManager->getAll()
        ]);
    }
}