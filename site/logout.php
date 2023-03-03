<?php // clear everything on logout
const __CONFIG__ = true;
require_once "inc/config.php";

session_regenerate_id(true);
session_destroy();
session_write_close();
setcookie(session_name(), "", 0, "/");

header("Location: /");
?>
