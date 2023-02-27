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
        <form class="form js-edit-post">
            <a class="back-button" href="/dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
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
                <textarea name="content" id="content" rows="8" placeholder="Your message..."><?= Filter::br2nl(
                    $Post->content
                ) ?></textarea>
            </div>
            <p class="form-tooltip">Links are supported! e.g. https://google.com</p>
            <div class="js-error form-error" style="display: none"></div>
            <button class="form-button" type="submit">Update</button>
        </form>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>
