<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToLogin(); // page for logged in members only

// composer autoload
require_once "vendor/autoload.php";
// nesbot/carbon
use Carbon\Carbon;

$User = new User($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Dashboard</title>
    <script defer src="public/scripts/theme.js"></script>
</head>

<body>
    <div id="overlays" style="pointer-events: none; opacity: 0">
        <section class="overlay edit" style="display: none; opacity: 0; transform: translateY(-10px);">
            <div class="loader" style="display: flex; opacity: 1">
                <span class="ball"></span>
                <span class="ball"></span>
                <span class="ball"></span>
            </div>
            <form class="edit disabled" method="POST" enctype="multipart/form-data">
                <div class="titlebar">
                    <button class="icon" id="back" onclick="closeEdit(); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </button>
                    <h2>Edit</h2>
                    <img src="public/assets/images/logo-white.png" alt="diboard logo" />
                </div>
                <div class="inputs">
                    <div class="left">
                        <div class="input">
                            <label for="title">Title</label>
                            <input name="title" id="title" type="text" placeholder="new phone who dis" />
                        </div>
                        <div class="input">
                            <label for="content">Content</label>
                            <!-- HACK: both textarea tags have to be on a single line as whitespaces are counted otherwise -->
                            <textarea name="content" id="content" rows="8" placeholder="Your message..."></textarea>
                            <p class="tooltip">Links are supported! e.g. https://google.com</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="input">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail" class="file">
                            <div class="grid">
                                <button class="dropzone">
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
                                </button>
                                <div class="showcase">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="tooltip">Changing your image is optional</p>
                        </div>
                        <div class="js-error error" style="display: none"></div>
                        <button class="button" id="submit" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <div id="dashboard">
        <!-- sidebar -->
        <aside id="sidebar">
            <img src="public/assets/images/logo-white.png" alt="diboard logo" />
        </aside>
        <!-- main content -->
        <main id="main">
            <header id="titlebar">
                <h2>Dashboard</h2>
                <a tabindex="0" href="/new-post" class="icon" id="new-post">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
                <div class="theme">
                    <button class="toggle" id="toggle-theme">
                        <div class="slider">
                            <svg aria-hidden="true" viewBox="0 0 24 24">
                                <mask class="moon" id="moon">
                                    <rect x="0" y="0" width="100%" height="100%" fill="white" />
                                    <circle cx="22" cy="2" r="6" fill="black" />
                                </mask>
                                <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon)" fill="currentColor" />
                                <g class="beams" stroke="currentColor">
                                    <line x1="12" y1="1" x2="12" y2="3" />
                                    <line x1="12" y1="21" x2="12" y2="23" />
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                                    <line x1="1" y1="12" x2="3" y2="12" />
                                    <line x1="21" y1="12" x2="23" y2="12" />
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                                </g>
                            </svg>
                        </div>
                    </button>
                </div>
            </header>
            <section id="grid">
                <div class="loader" style="display: flex; opacity: 1">
                    <span class="ball"></span>
                    <span class="ball"></span>
                    <span class="ball"></span>
                </div>
            </section>
        </main>
        <!-- friends -->
        <aside id="activity">
            <section class="titlebar">
                <h2>Members</h2>
                <a tabindex="0" id="logout" class="icon" href="/logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                    </svg>
                </a>
            </section>
            <section id="members">
                <?php foreach ($sql_connection->query(
                    'SELECT
                            username,
                            avatar
                        FROM users
                        ORDER BY username'
                )
                    as $row) { ?>
                    <article class="user">
                        <div class="avatar" style="background-image: url('<?= $row["avatar"] ?>')"></div>
                        <div class="text">
                            <?php if ($row["username"] === $User->username) { ?>
                                <p>This is you</p>
                            <?php } ?>
                            <h5><?= $row["username"] ?></h5>
                        </div>
                    </article>
                <?php } ?>
            </section>
        </aside>
    </div>
</body>

</html>
