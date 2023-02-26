<?php

if (!defined('__CONFIG__')) {
    exit('You do not have a config file');
}

class User {
    private $sql_connection;

    public $user_id;
    public $username;
    public $email;
    public $reg_time;

    public function __construct(int $user_id) {
        $this -> sql_connection = DB::getConnection();

        $user_id = Filter::Integer($user_id);

        $user = $this -> sql_connection -> prepare("SELECT id, username, email, reg_time FROM users WHERE id = :id LIMIT 1");
        $user -> bindParam(':id', $user_id, PDO::PARAM_INT);
        $user -> execute();

        if ($user -> rowCount() == 1) { // if user row exists
            $user = $user -> fetch(PDO::FETCH_OBJ);

            $this -> user_id = (int)$user -> id;
            $this -> username = (string)$user -> username;
            $this -> email = (string)$user -> email;
            $this -> reg_time = (string)$user -> reg_time;
        } else { // no user
            header("Location: /logout.php");
            exit;
        }
    }

    public static function findEmail($email, $return_assoc = false) {
        $sql_connection = DB::getConnection();

        // make sure the user does not exist.
        $email = (string)Filter::String($email);

        $findEmail = $sql_connection -> prepare("SELECT id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
        $findEmail -> bindParam(':email', $email, PDO::PARAM_STR);
        $findEmail -> execute();

        if ($return_assoc) {
            return $findEmail -> fetch(PDO::FETCH_ASSOC);
        }

        return (boolean)$findEmail -> rowCount();
    }

    public static function findUsername($username, $return_assoc = false) {
        $sql_connection = DB::getConnection();

        // make sure the user does not exist.
        $username = (string)Filter::String($username);

        $findUsername = $sql_connection -> prepare("SELECT id, password FROM users WHERE username = :username LIMIT 1");
        $findUsername -> bindParam(':username', $username, PDO::PARAM_STR);
        $findUsername -> execute();

        if ($return_assoc) {
            return $findUsername -> fetch(PDO::FETCH_ASSOC);
        }

        return (boolean)$findUsername -> rowCount();
    }
}
