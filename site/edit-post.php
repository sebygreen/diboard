<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToLogin(); // page for logged in members only

$uuid = $_GET["uuid"];
$Post = new Post($uuid);
$_SESSION["post"] = $uuid;

header("Content-Type: application/json");
echo json_encode($Post);
exit();
