<?php // clear everything on logout
session_start();
session_regenerate_id(true);
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');

header("Location: /");
