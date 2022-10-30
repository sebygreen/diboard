<?php

const __CONFIG__ = true;
require_once "inc/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="follow">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>diboard | Welcome</title>
    <base href="/" />

    <!-- CSS -->
    <link rel="stylesheet" href="styles.css" />
</head>

<body>

    <div class="content-container">
        <div id="landing">
            <img src="assets/images/logo-white.png" alt="Logo" />
            <h1>Welcome to <span>diboard</span></h1>
            <h3><?= date('jS') . ' of ' . date('F') . ' ' . date('Y') ?></h3>
            <div id="button-container">
                <a id="button-login" href="/login">Login</a>
                <a id="button-register" href="/register">Register</a>
            </div>
        </div>
    </div>

    <?php require_once "inc/footer.php"; ?>

</body>

</html>
