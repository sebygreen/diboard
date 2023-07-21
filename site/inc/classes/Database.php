<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Database
{
    protected static $sql_connection; // protect the database variable
    private function __construct()
    {
        // called when new $database is executed
        try {
            self::$sql_connection = new PDO("mysql:charset=utf8mb4;host=mariadb;port=3306;dbname=diboard_db", "root", "root");
            self::$sql_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$sql_connection->setAttribute(PDO::ATTR_PERSISTENT, false);
        } catch (PDOException $e) {
            echo "Could not connect to database.";
            exit();
        }
    }

    public static function getConnection(): PDO
    {
        // connect to the database
        if (!self::$sql_connection) {
            new Database();
        }
        return self::$sql_connection;
    }
}
