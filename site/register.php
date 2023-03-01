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
    <script defer src="public/scripts/index.js"></script>
</head>

<body>
    <div class="content-container">
        <form class="js-register">
            <div class="titlebar">
                <a tabindex="1" class="icon" id="back" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2>Register</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <div class="inputs">
                <div class="input">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class="file">
                    <div class="grid">
                        <div tabindex="2" class="dropzone">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <div class="allowed">
                                <ul>
                                    <li>.jpg</li>
                                    <li>.png</li>
                                    <li>.webp</li>
                                    <li>.gif</li>
                                    <li>.bmp</li>
                                </ul>
                                <p>4mb maximum</p>
                            </div>
                        </div>
                        <div class="showcase"></div>
                    </div>
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
</body>

</html>
