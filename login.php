<?php

const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToDashboard();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="robots" content="follow">

        <title>diboard | Login</title>

        <base href="/"/>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <div class="content-container">
            <form class="form js-login">
                <a class="back-button" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                </a>

                <div class="form-title">
                    <h2>Login</h2>
                    <img src="assets/images/logo-white.png" alt="diboard logo" />
                </div>

                <div class="form-controls">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email" placeholder="john@email.com" />
                </div>

                <div class="form-controls" style="margin-top: 15px">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" placeholder="secureallthethings123" />
                </div>

                <div class="js-error form-error" style="display: none"></div>

                <button class="form-button" type="submit">Login</button>
            </form>
        </div>

        <?php require_once "inc/footer.php"; ?>
    </body>
</html>
