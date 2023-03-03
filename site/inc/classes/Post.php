<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Post
{
    private $sql_connection;

    public $uuid;
    public $thumbnail;
    public $title;
    public $content;
    public $author;

    public function __construct($uuid)
    {
        $this->sql_connection = Database::getConnection();
        $uuid = Filter::String($uuid);

        $post = $this->sql_connection->prepare(
            "SELECT
                BIN_TO_UUID(uuid, 0) AS uuid,
                thumbnail,
                title,
                content,
                BIN_TO_UUID(author, 0) AS author
            FROM posts WHERE uuid = UUID_TO_BIN(:uuid, 0) LIMIT 1"
        );
        $post->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $post->execute();

        // if post exists
        if ($post->rowCount() == 1) {
            $post = $post->fetch(PDO::FETCH_OBJ);
            $this->uuid = (string) $post->uuid;
            $this->thumbnail = (string) $post->thumbnail;
            $this->title = (string) $post->title;
            $this->content = (string) $post->content;
            $this->author = (string) $post->author;
        } else {
            // no post
            header("Location: /dashboard");
            exit();
        }
    }

    public function deletePost($uuid)
    {
        // delete a post if user id is author
        $post = $this->sql_connection->prepare(
            "DELETE FROM posts WHERE uuid = UUID_TO_BIN(:uuid, 0) LIMIT 1"
        );
        $post->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $post->execute();
    }
}
