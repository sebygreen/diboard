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

    // main construct for User
    public function __construct($uuid)
    {
        //database
        $this->sql_connection = Database::getConnection();
        // $uuid through string filter
        $uuid = Filter::String($uuid);

        // query users using uuid as key
        $user = $this->sql_connection->prepare(
            "SELECT
                BIN_TO_UUID(uuid, 0) AS uuid,
                username,
                email,
                reg_time
            FROM users WHERE uuid = UUID_TO_BIN(:uuid, 0) LIMIT 1"
        );
        $user->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $user->execute();

        // check if query exists, if so, respond with user information for login
        // else logout
        if ($user->rowCount() == 1) {
            $user = $user->fetch(PDO::FETCH_OBJ);
            $this->uuid = (string) $user->uuid;
            $this->username = (string) $user->username;
            $this->email = (string) $user->email;
            $this->reg_time = (string) $user->reg_time;
        } else {
            header("Location: /logout");
            exit();
        }
    }

    // function to check if an email exists
    public static function findEmail($email, $return_assoc = false)
    {
        $sql_connection = Database::getConnection();
        $email = (string) Filter::String($email);
        // select all users using email as key
        $findEmail = $sql_connection->prepare(
            "SELECT
                BIN_TO_UUID(uuid, 0) AS converted_uuid,
                password
            FROM users WHERE email = LOWER(:email) LIMIT 1"
        );
        $findEmail->bindParam(":email", $email, PDO::PARAM_STR);
        $findEmail->execute();

        if ($return_assoc) {
            return $findEmail->fetch(PDO::FETCH_ASSOC);
        }
        return (bool) $findEmail->rowCount();
    }

    // checks if username is taken
    public static function findUsername($username, $return_assoc = false)
    {
        $sql_connection = Database::getConnection();
        // make sure the username does not exist.
        $username = (string) Filter::String($username);
        $findUsername = $sql_connection->prepare(
            "SELECT
                BIN_TO_UUID(uuid, 0) AS converted_uuid,
                password
            FROM users WHERE username = :username LIMIT 1"
        );
        $findUsername->bindParam(":username", $username, PDO::PARAM_STR);
        $findUsername->execute();

        if ($return_assoc) {
            return $findUsername->fetch(PDO::FETCH_ASSOC);
        }
        return (bool) $findUsername->rowCount();
    }
}
?>
