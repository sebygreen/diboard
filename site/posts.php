<?php
const __CONFIG__ = true;
require_once "inc/config.php";

$Posts = new Posts();

header("Content-Type: application/json");
echo json_encode($Posts);
exit();
?>