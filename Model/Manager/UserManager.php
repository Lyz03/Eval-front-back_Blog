<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    public const TABLE = 'user';

    /**
     * Return a user based on a given id.
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): ?User {

        $user = null;
        $query = DB::getConnection()->query("SELECT * FROM " . self::TABLE . "  WHERE id = $id");

        if ($query && $data = $query->fetch()) {
            $user = (new User())
                ->setId($data['id'])
                ->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setPassword($data['password'])
                ->setRole($data['role'])
            ;
        }
        return $user;
    }
}