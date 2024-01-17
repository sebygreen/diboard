<?php
require_once "inc/config.php";

$User = new User($_SESSION["user"]);
$uuid = $_GET["uuid"];

if (isset($uuid)) {
    $Post = Post::Single($uuid);
    if ($Post->thumbnail) {
        unlink($Post->thumbnail);
    }
    $Post->Delete($uuid);
    header("Location: /dashboard");
}
