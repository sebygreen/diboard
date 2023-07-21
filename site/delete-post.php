<?php
const __CONFIG__ = true;
require_once "inc/config.php";

$User = new User($_SESSION["user"]);

$uuid = $_GET["uuid"];

if (isset($uuid)) {
    $Post = new Post($uuid);

    if ($Post->thumbnail) {
        unlink($Post->thumbnail);
    }

    $Post->deletePost($uuid);
    header("Location: /dashboard");
}
?>
