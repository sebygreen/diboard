<?php
const __CONFIG__ = true;
require_once "../inc/config.php";

// composer autoload
require_once "../vendor/autoload.php";
// nesbot/carbon
use Carbon\Carbon;

$User = new User($_SESSION["user"]);
$Posts = new Posts();

echo json_encode($Posts->posts);
exit();
?>