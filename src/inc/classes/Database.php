<?php
class Database
{
    private static Database $instance; // handle of the db connexion
    public PDO $handle;
    private function __construct()
    {
        $dsn = "mysql:charset=utf8mb4" .
            ";host=" . Config::read("db.host") .
            ";port=" . Config::read("db.port") .
            ";dbname=" . Config::read('db.basename') .
            ';connect_timeout=15';
        $user = Config::read("db.user");
        $password = Config::read("db.password");
        try {
            $this->handle = new PDO($dsn, $user, $password);
        } catch (PDOException) {
            exit("Error: Could not connect to the database.");
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}
