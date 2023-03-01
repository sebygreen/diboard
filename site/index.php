<?php
const __CONFIG__ = true;
require_once "inc/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Welcome</title>
</head>

<body>
    <div class="content-container">
        <section id="landing">
            <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            <h1>Welcome to <span>diboard</span></h1>
            <h3><?= date("jS") . " of " . date("F") . " " . date("Y") ?></h3>
            <div id="buttons">
                <a class="button" id="login" href="/login">Login</a>
                <a class="button" id="register" href="/register">Register</a>
            </div>
        </section>
    </div>
</body>

</html>
