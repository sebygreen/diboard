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
    <div class="wrapper">
        <form class="js-login">
            <div class="titlebar">
                <a class="icon" id="back" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2>Login</h2>
                <svg class="logo" viewBox="0 0 181 183" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33.6 27.2C11.6 27.2 0 42.2 0 66.8V93C0 117.8 11.6 132.6 31.8 132.6C42.8 132.6 51.6 129.2 58.4 122.2H58.8L59.8 130.8H84.2V0H56.8V35H56.4C50.2 29.6 42.2 27.2 33.6 27.2ZM56.8 103.4C53.6 107.6 48.2 111 41 111C32 111 27.6 105.4 27.6 93.2V67.6C27.6 54.6 32.4 49.4 41.8 49.4C48.6 49.4 53.4 52.2 56.8 56.6V103.4Z"/>
                    <path d="M146.553 182.2C168.553 182.2 180.153 167.2 180.153 142.8V116.6C180.153 91.6 168.753 76.8 148.553 76.8C138.353 76.8 129.953 79.8 123.753 85.8H123.353V50H95.9531V180.8H120.153L121.153 172.8H121.553C128.153 179.4 136.753 182.2 146.553 182.2ZM123.553 107C126.553 102.8 131.953 99.4 139.153 99.4C148.153 99.4 152.753 104.6 152.753 117.2V142.8C152.753 155.6 147.953 160.8 138.553 160.8C131.553 160.8 126.953 158.2 123.553 153.6V107Z"/>
                </svg>
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
            <div class="js-error error" style="display: none"></div>
            <button class="button" id="submit" type="submit">Login</button>
        </form>
    </div>
</body>

</html>
