<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Post
{
    private $sql_connection;

    public $post_id;
    public $thumbnail;
    public $title;
    public $content;
    public $author;

    public function __construct($post_id)
    {
        $this->sql_connection = Database::getConnection();

        $post_id = Filter::Integer($post_id);

        $post = $this->sql_connection->prepare("SELECT posts.id, posts.thumbnail, posts.title, posts.content, posts.author FROM posts WHERE id = :id LIMIT 1");
        $post->bindParam(":id", $post_id, PDO::PARAM_INT);
        $post->execute();

        if ($post->rowCount() == 1) {
            // if user row exists
            $post = $post->fetch(PDO::FETCH_OBJ);

            $this->post_id = (int) $post->id;
            $this->thumbnail = (string) $post->thumbnail;
            $this->title = (string) $post->title;
            $this->content = (string) $post->content;
            $this->author = (string) $post->author;
        } else {
            // no post
            header("Location: /dashboard.php");
            exit();
        }
    }

    public function deletePost(int $post_id)
    {
        // delete a post if user id is author
        $post = $this->sql_connection->prepare("DELETE FROM posts WHERE id = :id LIMIT 1");
        $post->bindParam(":id", $post_id, PDO::PARAM_INT);
        $post->execute();
    }
}
