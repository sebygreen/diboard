<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class User
{
    private $sql_connection;

    public $uuid;
    public $username;
    public $email;
    public $reg_time;

    public function __construct($uuid)
    {
        $this->sql_connection = Database::getConnection();

        // TODO: see if binary data type needs filter
        $uuid = Filter::String($uuid);

        $user = $this->sql_connection->prepare("SELECT id, BIN_TO_UUID(uuid, 0), username, email, reg_time FROM users WHERE uuid = :uuid LIMIT 1");
        $user->bindParam(":uuid", $uuid, PDO::PARAM_INT);
        $user->execute();

        if ($user->rowCount() == 1) {
            // if user row exists
            $user = $user->fetch(PDO::FETCH_OBJ);
            $this->uuid = (string) $uuid;
            $this->username = (string) $user->username;
            $this->email = (string) $user->email;
            $this->reg_time = (string) $user->reg_time;
        } else {
            // no user
            header("Location: /logout.php");
            exit();
        }
    }

    public static function findEmail($email, $return_assoc = false)
    {
        $sql_connection = Database::getConnection();

        // make sure the user does not exist.
        $email = (string) Filter::String($email);
        $findEmail = $sql_connection->prepare("SELECT BIN_TO_UUID(uuid, 0), password FROM users WHERE email = LOWER(:email) LIMIT 1");
        $findEmail->bindParam(":email", $email, PDO::PARAM_STR);
        $findEmail->execute();

        if ($return_assoc) {
            return $findEmail->fetch(PDO::FETCH_ASSOC);
        }

        return (bool) $findEmail->rowCount();
    }

    public static function findUsername($username, $return_assoc = false)
    {
        $sql_connection = Database::getConnection();

        // make sure the user does not exist.
        $username = (string) Filter::String($username);
        $findUsername = $sql_connection->prepare("SELECT BIN_TO_UUID(uuid, 0), password FROM users WHERE username = :username LIMIT 1");
        $findUsername->bindParam(":username", $username, PDO::PARAM_STR);
        $findUsername->execute();

        if ($return_assoc) {
            return $findUsername->fetch(PDO::FETCH_ASSOC);
        }

        return (bool) $findUsername->rowCount();
    }
}
