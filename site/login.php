<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToDashboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Login</title>
</head>

<body>
    <div class="content-container">
        <form class="js-login">
            <div class="titlebar">
                <a class="icon" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </a>
                <h2>Login</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <div class="inputs">
                <div class="input">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email" placeholder="john@email.com" />
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" placeholder="secureallthethings123" />
                </div>
            </div>
            <div class="js-error form-error" style="display: none"></div>
            <button class="button" id="submit" type="submit">Login</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>
