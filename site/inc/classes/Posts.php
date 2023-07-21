<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Posts
{
    private $sql_connection;

    public $posts;

    public function __construct()
    {
        $this->sql_connection = Database::getConnection();

        $posts = $this->sql_connection->query(
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
        // if posts exists
        if ($posts) {
            $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
            $this->posts = (array) $posts;
        } else {
            // no posts
            header("Location: /dashboard");
            exit();
        }
    }
}
?>
