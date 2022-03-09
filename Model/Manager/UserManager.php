<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    public const TABLE = 'user';

    /**
     * Create a new User Entity
     * @param array $data
     * @return User
     */
    private static function createUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ->setRole($data['role'])
        ;
    }


    /**
     * Return a user based on a given id.
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): ?User {
        $user = null;
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE id = $id");

        if ($query && $data = $query->fetch()) {
            $user = self::createUser($data);
        }
        return $user;
    }


    /**
     * Register new user
     * @param string $mail
     * @param string $username
     * @param string $password
     */
    public function registerUser(string $mail, string $username, string $password) {

        $stmt = DB::getConnection()->prepare("INSERT INTO " . self::TABLE . " (email, username, password)
            VALUES (:email, :username, :password)");

        $stmt->bindParam('email', $mail);
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);


        $stmt->execute();
    }


    /**
     * Check if a user exist
     * @param string $mail
     * @return User|null
     */
    public function connectUser(string $mail): ?User {
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . " WHERE email = '$mail'");

        if ($query && $data = $query->fetch()) {

            return self::createUser($data);
        }

        return null;
    }

    public function update($field, $newValue, $userId) {
        $stmt = DB::getConnection()->prepare("UPDATE " . self::TABLE . " SET $field = :newValue WHERE id = :userId");

        $stmt->bindParam('newValue', $newValue);
        $stmt->bindParam('userId', $userId);

        $stmt->execute();
    }
}