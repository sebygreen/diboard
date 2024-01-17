<?php
class User
{
    public static function Single($uuid)
    {
        $uuid = Filter::String($uuid);
        $sql = "
            SELECT
                uuid,
                username,
                email,
                reg_time
            FROM users
            WHERE uuid = :uuid
            LIMIT 1
        ";
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $data->execute();

        if ($data->rowCount() > 0) {
            return $data->fetch(PDO::FETCH_OBJ);
        } else {
            // no post
            header("Location: /logout");
            exit();
        }
    }

    public static function All(): array
    {
        $sql = '
            SELECT
                username,
                avatar
            FROM users
            ORDER BY username
        ';
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->execute();

        if ($data->rowCount() > 0) {
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public static function Email($email, $associative = false)
    {
        $db = Database::getInstance();
        $email = Filter::String($email);

        $sql = "
            SELECT
                uuid,
                password
            FROM users
            WHERE email = LOWER(:email)
            LIMIT 1
        ";

        $findEmail = $db->handle->prepare($sql);
        $findEmail->bindParam(":email", $email, PDO::PARAM_STR);
        $findEmail->execute();

        if ($associative) {
            return $findEmail->fetch(PDO::FETCH_ASSOC);
        } else {
            return $findEmail->rowCount();
        }
    }

    public static function Username($username, $associative = false)
    {
        $db = Database::getInstance();
        $username = Filter::String($username);

        $sql = "
            SELECT
                uuid,
                password
            FROM users
            WHERE username = :username
            LIMIT 1
        ";

        $findUsername = $db->handle->prepare($sql);
        $findUsername->bindParam(":username", $username, PDO::PARAM_STR);
        $findUsername->execute();

        if ($associative) {
            return $findUsername->fetch(PDO::FETCH_ASSOC);
        } else {
            return $findUsername->rowCount();
        }
    }
}
