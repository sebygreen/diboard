<?php
const __CONFIG__ = true;
require_once "inc/config.php";

$uuid = $_GET["uuid"];
$_SESSION["post"] = $uuid;

$Post = new Post($uuid);

header("Content-Type: application/json");
echo json_encode($Post);
exit();
?>