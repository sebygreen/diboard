<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToLogin();
$post_id = $_GET['id'];
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
        <form class="form js-edit-post">
            <a class="back-button" href="/dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </a>
            <div class="form-title">
                <h2>Edit a post</h2>
                <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            </div>
            <!-- using a get method doesn't allow use of the id in the back end, so i'm using a hidden input instead -->
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <div class="form-preview" style="margin-top: 15px">
                <div class="form-controls">
                    <label for="thumbnail">Thumbnail</label>
                    <input class="js-image" name="thumbnail" id="thumbnail" type="file" value="<?= $Post->thumbnail ?>" />
                </div>
                <div class="showcase"></div>
            </div>
            <p class="form-tooltip">Uploading a thumbnail is optional</p>
            <div class="form-controls" style="margin-top: 15px">
                <label for="title">Title</label>
                <input name="title" id="title" type="text" placeholder="new phone who dis" value="<?= $Post->title ?>" />
            </div>
            <div class="form-controls" style="margin-top: 15px">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="8" placeholder="Your message..."><?= Filter::br2nl($Post->content) ?></textarea>
            </div>
            <p class="form-tooltip">Links are supported! e.g. https://google.com</p>
            <div class="js-error form-error" style="display: none"></div>
            <button class="form-button" type="submit">Update</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>
