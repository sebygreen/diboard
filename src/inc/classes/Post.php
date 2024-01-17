<?php
class Post
{
    public static function Single($uuid): object
    {
        $uuid = Filter::String($uuid);
        $sql = "
                SELECT
                    uuid,
                    thumbnail,
                    title,
                    content,
                    author
                FROM posts
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
            header("Location: /dashboard");
            exit();
        }
    }

    public static function All(): array
    {
        $sql = "
            SELECT
                posts.uuid,
                posts.thumbnail,
                posts.title,
                posts.content,
                posts.pub_time,
                posts.edit_time,
                posts.edited,
                posts.author,
                users.username,
                users.avatar
            FROM posts
            INNER JOIN users ON posts.author = users.uuid
            ORDER BY pub_time DESC
        ";
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->execute();

        if ($data->rowCount() > 0) {
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public static function Create($uuid, $thumbnail, $title, $content, $author):void
    {
        $sql = "
            INSERT
            INTO posts(uuid, thumbnail, title, content, author)
            VALUES(:uuid, :thumbnail, :title, :content, :author)
        ";
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $data->bindParam(":thumbnail", $thumbnail, PDO::PARAM_STR);
        $data->bindParam(":title", $title, PDO::PARAM_STR);
        $data->bindParam(":content", $content, PDO::PARAM_STR);
        $data->bindParam(":author", $author, PDO::PARAM_STR);
        $data->execute();
    }

    public static function Update($uuid, $thumbnail, $title, $content, $edited):void
    {
        $sql = "
            UPDATE posts
            SET thumbnail = :thumbnail,
                title = :title,
                content = :content,
                edited = :edited
            WHERE uuid = :uuid
        ";
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $data->bindParam(":thumbnail", $thumbnail, PDO::PARAM_STR);
        $data->bindParam(":title", $title, PDO::PARAM_STR);
        $data->bindParam(":content", $content, PDO::PARAM_STR);
        $data->bindParam(":edited", $edited, PDO::PARAM_STR);
        $data->execute();
    }

    public static function Delete($uuid): void
    {
        $uuid = Filter::String($uuid);
        $sql = "
            DELETE
            FROM posts
            WHERE uuid = :uuid
            LIMIT 1
        ";
        $db = Database::getInstance();
        $data = $db->handle->prepare($sql);
        $data->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $data->execute();
    }
}
