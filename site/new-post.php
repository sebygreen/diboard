<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Login</title>
</head>

<body>
    <div class="content-container">
        <form class="form js-new-post">
            <a class="back-button" href="/dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </a>
            <div class="form-title">
                <h2>Create a post</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <div class="form-preview" style="margin-top: 15px">
                <div class="form-controls">
                    <label for="thumbnail">Thumbnail</label>
                    <input class="js-image" name="thumbnail" id="thumbnail" type="file" />
                </div>
                <div class="showcase"></div>
            </div>
            <p class="form-tooltip">Uploading a thumbnail is optional</p>
            <div class="form-controls" style="margin-top: 15px">
                <label for="title">Title</label>
                <input name="title" id="title" type="text" placeholder="new phone who dis" />
            </div>
            <div class="form-controls" style="margin-top: 15px">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="8" placeholder="Your message..."></textarea>
            </div>
            <p class="form-tooltip">Links are supported! e.g. https://google.com</p>
            <div class="js-error form-error" style="display: none"></div>
            <button class="form-button" type="submit">Publish</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>