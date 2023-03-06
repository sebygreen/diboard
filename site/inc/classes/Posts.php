<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Posts
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

        $posts = $this->$sql_connection->query(
            'SELECT
                    BIN_TO_UUID(posts.uuid, 0) AS uuid,
                    posts.thumbnail,
                    posts.title,
                    posts.content,
                    posts.pub_time,
                    posts.edit_time,
                    posts.edited,
                    BIN_TO_UUID(posts.author, 0) AS author,
                    users.username,
                    users.avatar
                FROM posts
                INNER JOIN users ON posts.author = users.uuid
                ORDER BY pub_time DESC'
        );
        $posts->bindParam(":uuid", $uuid, PDO::PARAM_STR);
        $posts->execute();

        // if post exists
        if ($posts->rowCount() == 1) {
            $post = $posts->fetch(PDO::FETCH_OBJ);
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
}
