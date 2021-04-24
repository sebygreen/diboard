<?php

const __CONFIG__ = true;
require_once "inc/config.php";

$User = new User($_SESSION['user_id']);

if (isset($_GET['id']) and is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];
    $Post = new Post($post_id);

    unlink($Post -> thumbnail);

    $Post -> deletePost($post_id);
    header('Location: /dashboard');
}