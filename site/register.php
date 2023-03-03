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
                            <div class="details">
                                <ul>
                                    <li>.jpg</li>
                                    <li>.png</li>
                                    <li>.webp</li>
                                    <li>.gif</li>
                                    <li>.bmp</li>
                                </ul>
                                <p>4 MB</p>
                            </div>
                        </div>
                        <div class="showcase">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
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
