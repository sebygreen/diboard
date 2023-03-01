<?php
const __CONFIG__ = true;
require_once "inc/config.php";
Page::redirectToLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | New post</title>
    <script defer src="public/scripts/index.js"></script>
</head>

<body>
    <div class="content-container">
        <form class="js-new-post" enctype="multipart/form-data">
            <div class="titlebar">
                <a tabindex="1" class="icon" id="back" href="/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2>New</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <div class="inputs">
                <div class="input">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="file">
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
                    <p class="tooltip">Uploading a thumbnail is optional</p>
                </div>
                <div class="input">
                    <label for="title">Title</label>
                    <input name="title" id="title" type="text" placeholder="new phone who dis" />
                </div>
                <div class="input">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="8" placeholder="Your message..."></textarea>
                    <p class="tooltip">Links are supported! e.g. https://google.com</p>
                </div>
            </div>
            <div class="js-error error" style="display: none"></div>
            <button class="button" id="submit" type="submit">Publish</button>
        </form>
    </div>
</body>

</html>
