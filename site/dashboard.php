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
    <div id="overlays">
        <div class="overlay" id="edit">
            <form id="edit-post" method="POST" enctype="multipart/form-data">
                <div class="titlebar">
                    <a class="icon" id="back" href="/dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <h2>Edit</h2>
                    <img src="public/assets/images/logo-white.png" alt="diboard logo" />
                </div>
                <div class="inputs">
                    <div class="left">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="tooltip">Changing your image is optional</p>
                        </div>
                        <div class="js-error error" style="display: none"></div>
                        <button class="button" id="submit" type="submit">Update</button>
                    </div>
                    <div class="right">
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
                </div>
            </form>
        </div>
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
                                    <circle cx="24" cy="10" r="6" fill="black" />
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
                <?php foreach (
                    $sql_connection->query(
                        'SELECT
                            BIN_TO_UUID(posts.uuid, 0) AS uuid,
                            posts.thumbnail,
                            posts.title,
                            posts.content,
                            posts.pub_time,
                            posts.edit_time,
                            posts.edited,
                            BIN_TO_UUID(posts.author, 0) AS author,
                            users.username,
                            users.avatar
                        FROM posts
                        INNER JOIN users ON posts.author = users.uuid
                        ORDER BY pub_time DESC'
                    )
                    as $row
                ) { ?>
                    <article class="post">
                        <?php if ($row["thumbnail"] !== null) { ?>
                            <div class="thumbnail">
                                <img src="<?= $row["thumbnail"] ?>" alt="Post image">
                            </div>
                        <?php } ?>
                        <div class="author">
                            <img src="<?= $row["avatar"] ?>" alt="Authors avatar">
                            <p class="username"><?= $row["username"] ?></p>
                        </div>
                        <div class="text">
                            <h2><?= $row["title"] ?></h2>
                            <p><?= nl2br(Filter::Link($row["content"])) ?></p>
                        </div>
                        <div class="controls">
                            <div class="timestamps">
                                <time class="timestamp"><?= Carbon::parse($row["pub_time"])->diffForHumans() ?></time>
                                <?php if ($row["edited"] == 1) { ?>
                                    <div class="edited">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                        </svg>
                                        <time><?= Carbon::parse($row["edit_time"])->diffForHumans() ?></time>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if ($row["author"] == $User->uuid) { ?>
                                <div class="buttons">
                                    <a class="icon delete" href="/delete-post?uuid=<?= $row["uuid"] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                    <button class="icon edit" onclick="getPost('<?= $row["uuid"] ?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </article>
                <?php } ?>
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
                <?php foreach (
                    $sql_connection->query(
                        'SELECT
                            username,
                            avatar
                        FROM users
                        ORDER BY username'
                    )
                    as $row
                ) { ?>
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
