<?php
const __CONFIG__ = true;
require_once "inc/config.php";
Page::redirectToDashboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Register</title>
</head>

<body>
    <div class="content-container">
        <form class="js-register">
            <div class="titlebar">
                <a class="icon" id="back" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2>Register</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <div class="inputs">
                <div class="preview">
                    <div class="wrapper">
                        <label for="avatar">Avatar</label>
                        <input class="js-image" name="avatar" id="avatar" type="file" />
                    </div>
                    <div class="showcase"></div>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" placeholder="robert123" />
                </div>
                <div class="input">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" placeholder="john@email.com" />
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" placeholder="secureallthethings123" />
                </div>
                <div class="js-error form-error" style="display: none"></div>
            </div>
            <button class="button" id="submit" type="submit">Sign Up</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>
