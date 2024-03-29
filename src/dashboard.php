<?php
require_once "inc/config.php";
Page::redirectToLogin();
// composer autoload
require_once "vendor/autoload.php";
// nesbot/carbon
use Carbon\Carbon;
$user = User::Single($_SESSION["user"]);
$users = User::All();
$posts = Post::All();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Dashboard</title>
</head>

<body>
<div id="dashboard">
    <aside id="sidebar">
        <svg class="logo" viewBox="0 0 181 183" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M33.6 27.2C11.6 27.2 0 42.2 0 66.8V93C0 117.8 11.6 132.6 31.8 132.6C42.8 132.6 51.6 129.2 58.4 122.2H58.8L59.8 130.8H84.2V0H56.8V35H56.4C50.2 29.6 42.2 27.2 33.6 27.2ZM56.8 103.4C53.6 107.6 48.2 111 41 111C32 111 27.6 105.4 27.6 93.2V67.6C27.6 54.6 32.4 49.4 41.8 49.4C48.6 49.4 53.4 52.2 56.8 56.6V103.4Z"/>
            <path d="M146.553 182.2C168.553 182.2 180.153 167.2 180.153 142.8V116.6C180.153 91.6 168.753 76.8 148.553 76.8C138.353 76.8 129.953 79.8 123.753 85.8H123.353V50H95.9531V180.8H120.153L121.153 172.8H121.553C128.153 179.4 136.753 182.2 146.553 182.2ZM123.553 107C126.553 102.8 131.953 99.4 139.153 99.4C148.153 99.4 152.753 104.6 152.753 117.2V142.8C152.753 155.6 147.953 160.8 138.553 160.8C131.553 160.8 126.953 158.2 123.553 153.6V107Z"/>
        </svg>
    </aside>
    <main id="main">
        <header id="titlebar">
            <h2>Dashboard</h2>
            <a tabindex="0" href="/new-post" class="icon" id="new-post">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
            </a>
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
        </header>
        <section id="grid">
            <?php foreach ($posts as $i) { ?>
                <article class="post">
                    <div class="author">
                        <img src="<?= $i["avatar"] ?>" alt="Authors avatar">
                        <p class="username"><?= $i["username"] ?></p>
                    </div>
                    <?php if ($i["thumbnail"]) { ?>
                        <figure class="thumbnail">
                            <img src="<?= $i["thumbnail"] ?>" alt="Post image">
                        </figure>
                    <?php } ?>
                    <div class="text">
                        <h2><?= $i["title"] ?></h2>
                        <p><?= nl2br(Filter::Link($i["content"])) ?></p>
                    </div>
                    <div class="controls">
                        <div class="timestamps">
                            <time class="timestamp"><?= Carbon::parse($i["pub_time"])->diffForHumans() ?></time>
                            <?php if ($i["edited"] == 1) { ?>
                                <div class="edited">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z"/>
                                    </svg>
                                    <time><?= Carbon::parse($i["edit_time"])->diffForHumans() ?></time>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if ($i["author"] == $user->uuid) { ?>
                            <div class="buttons">
                                <a class="icon delete" href="/delete-post?uuid=<?= $i["uuid"] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </a>
                                <a class="icon edit" href="/edit-post?uuid=<?= $i["uuid"] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                    </svg>
                                </a>
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9"/>
                </svg>
            </a>
        </section>
        <section id="members">
            <?php foreach ($users as $i) { ?>
                <article class="user">
                    <div class="avatar" style="background-image: url('<?= $i["avatar"] ?>')"></div>
                    <div class="text">
                        <?php if ($i["username"] === $user->username) { ?>
                            <p>This is you</p>
                        <?php } ?>
                        <h5><?= $i["username"] ?></h5>
                    </div>
                </article>
            <?php } ?>
        </section>
    </aside>
</div>
</body>

</html>
