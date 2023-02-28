<?php
const __CONFIG__ = true;
require_once "inc/config.php";
Page::redirectToLogin();
$post_id = $_GET["id"];
$Post = new Post($post_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Edit</title>
</head>

<body>
    <div class="content-container">
        <form class="js-edit-post" enctype="multipart/form-data">
            <div class="titlebar">
                <a class="icon" id="back" href="/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2>Edit</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <!-- using a get method doesn't allow use of the id in the back end, so i'm using a hidden input instead -->
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <div class="inputs">
                <div class="preview">
                    <div class="wrapper">
                        <label for="thumbnail">Thumbnail</label>
                        <input class="js-image" name="thumbnail" id="thumbnail" type="file" value="<?= $Post->thumbnail ?>" />
                        <p class="tooltip">Uploading a thumbnail is optional</p>
                    </div>
                    <div class="showcase"></div>
                </div>
                <div class="input">
                    <label for="title">Title</label>
                    <input name="title" id="title" type="text" placeholder="new phone who dis" value="<?= $Post->title ?>" />
                </div>
                <div class="input">
                    <label for="content">Content</label>
                    <!-- HACK: both textarea tags have to be on a single line as whitespaces are counted -->
                    <textarea name="content" id="content" rows="8" placeholder="Your message..."><?= Filter::br2nl($Post->content) ?></textarea>
                    <p class="tooltip">Links are supported! e.g. https://google.com</p>
                </div>
            </div>
            <div class="js-error form-error" style="display: none"></div>
            <button class="button" id="submit" type="submit">Update</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>