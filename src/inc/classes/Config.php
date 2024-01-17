<?php
class Config
{
    static array $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value): void
    {
        self::$confArray[$name] = $value;
    }

}

// db
Config::write('db.host', 'mariadb');
Config::write('db.port', '3306');
Config::write('db.basename', 'diboard_db');
Config::write('db.user', 'diboard');
Config::write('db.password', 'admin');