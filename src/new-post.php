<?php
require_once "inc/config.php";
Page::redirectToLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | New post</title>
    <script defer src="public/scripts/dropzone.js"></script>
</head>

<body>
<main class="constrain" id="new-post">
    <p class="error"></p>
    <section class="header">
        <a class="icon" id="back" href="/dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <h1>New Post</h1>
        <button class="theme" id="toggle-theme">
            <span class="slider">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <mask class="moon" id="moon">
                        <rect x="0" y="0" width="100%" height="100%" fill="white"/>
                        <circle cx="22" cy="2" r="6" fill="black"/>
                    </mask>
                    <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon)" fill="currentColor"/>
                    <g class="beams" stroke="currentColor">
                        <line x1="12" y1="1" x2="12" y2="3"/>
                        <line x1="12" y1="21" x2="12" y2="23"/>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                        <line x1="1" y1="12" x2="3" y2="12"/>
                        <line x1="21" y1="12" x2="23" y2="12"/>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </g>
                </svg>
            </span>
        </button>
        <svg class="logo" viewBox="0 0 181 183" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M33.6 27.2C11.6 27.2 0 42.2 0 66.8V93C0 117.8 11.6 132.6 31.8 132.6C42.8 132.6 51.6 129.2 58.4 122.2H58.8L59.8 130.8H84.2V0H56.8V35H56.4C50.2 29.6 42.2 27.2 33.6 27.2ZM56.8 103.4C53.6 107.6 48.2 111 41 111C32 111 27.6 105.4 27.6 93.2V67.6C27.6 54.6 32.4 49.4 41.8 49.4C48.6 49.4 53.4 52.2 56.8 56.6V103.4Z"/>
            <path d="M146.553 182.2C168.553 182.2 180.153 167.2 180.153 142.8V116.6C180.153 91.6 168.753 76.8 148.553 76.8C138.353 76.8 129.953 79.8 123.753 85.8H123.353V50H95.9531V180.8H120.153L121.153 172.8H121.553C128.153 179.4 136.753 182.2 146.553 182.2ZM123.553 107C126.553 102.8 131.953 99.4 139.153 99.4C148.153 99.4 152.753 104.6 152.753 117.2V142.8C152.753 155.6 147.953 160.8 138.553 160.8C131.553 160.8 126.953 158.2 123.553 153.6V107Z"/>
        </svg>
    </section>
    <form class="file" method="POST" enctype="multipart/form-data">
        <div class="responsive">
            <div class="input">
                <label for="title">Title</label>
                <input name="title" id="title" type="text" placeholder="new phone who dis"/>
            </div>
            <div class="input">
                <label for="content">Content</label>
                <textarea name="content" id="content" placeholder="Your message..."></textarea>
                <p class="tooltip">Links are supported! e.g. https://google.com.</p>
            </div>
        </div>
        <div class="input">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" class="file"/>
            <div class="dropzone">
                <figure class="showcase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                    </svg>
                </figure>
                <div class="details">
                    <ul>
                        <li>.jpg</li>
                        <li>.png</li>
                        <li>.webp</li>
                        <li>.gif</li>
                        <li>.bmp</li>
                    </ul>
                    <p>4 MB max.</p>
                </div>
            </div>
            <p class="tooltip">Adding an image is optional.</p>
        </div>
        <button class="button" id="submit" type="submit">Publish</button>
    </form>
</main>
</body>

</html>
