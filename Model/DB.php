<?php

namespace App\Model;

use App\Config;
use PDO;
use PDOException;

class DB
{
    private static ?PDO $connection = null;

    /**
     * Connection to the database (specified in Config)
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if(self::$connection  === null) {
            try {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=' . Config::DB_CHARSET;
                self::$connection  = new PDO($dsn, Config::DB_USERNAME, Config::DB_PASSWORD);
                self::$connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch (PDOException $err) {
                die();
            }
        }

        return self::$connection ;
    }
}
