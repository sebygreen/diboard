<?php
const __CONFIG__ = true;
require_once "inc/config.php";

Page::redirectToLogin();
$User = new User($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "inc/head.php"; ?>
    <title>diboard | Dashboard</title>
</head>

<body>
    <div id="dashboard-container">
        <!-- sidebar -->
        <div id="side-bar">
            <img src="public/assets/images/logo-white.png" alt="diboard logo" />
            <a id="logout" class="icon" href="/logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                    <path d="M7.5 1v7h1V1h-1z" />
                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                </svg>
            </a>
        </div>
        <!-- main content -->
        <div id="main">
            <div id="posts-container">
                <div id="title-bar">
                    <h2>Dashboard</h2>
                    <a href="/new-post" class="icon" id="new-post">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </a>
                </div>
                <div id="posts-grid">
                    <?php foreach (
                        $sql_connection->query(
                            'SELECT
                            posts.id,
                            posts.thumbnail,
                            posts.title,
                            posts.content,
                            DATE_FORMAT(posts.pub_time, "%b %d, %Y") AS formatted_pub_time,
                            posts.edited,
                            posts.user_id,
                            users.username
                        FROM
                            posts
                        INNER JOIN users ON posts.user_id = users.id
                        ORDER BY
                            pub_time'
                        )
                        as $row
                    ) { ?>
                        <div class="post">
                            <?php if ($row["thumbnail"] !== null) { ?>
                                <div class="thumbnail">
                                    <img src="<?= $row["thumbnail"] ?>" alt="Post image">
                                </div>
                            <?php } ?>
                            <div class="text">
                                <h2><?= $row["title"] ?></h2>
                                <p><?= nl2br(Filter::Link($row["content"])) ?></p>
                            </div>

                            <div class="controls-signature-container">
                                <div class="signature">
                                    <p class="timestamp"><?= $row["formatted_pub_time"] ?></p>
                                    <span>&bull;</span>
                                    <p class="author"><?= $row["username"] ?></p>
                                    <?php if ($row["edited"] == 1) { ?>
                                        <p class="edited">Edited</p>
                                    <?php } ?>
                                </div>

                                <?php if ($row["user_id"] == $User->user_id) { ?>
                                    <!-- edit and delete buttons only show on the logged in user's posts -->
                                    <div class="controls">
                                        <a class="delete" href="/delete-post?id=<?= $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                        <a class="edit" href="/edit-post?id=<?= $row["id"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- friends -->
        <div id="activity-bar">
            <h2>Participants</h2>
            <div id="participant-list">
                <?php foreach (
                    $sql_connection->query(
                        'SELECT
                        username,
                        avatar
                    FROM
                        users
                    ORDER BY
                        username'
                    )
                    as $row
                ) { ?>
                    <div class="participant">
                        <div class="avatar" style="background-image: url('<?= $row["avatar"] ?>')"></div>
                        <div class="text">
                            <?php if ($row["username"] === $User->username) { ?>
                                <p>This is you</p>
                            <?php } ?>
                            <h5><?= $row["username"] ?></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php require_once "inc/footer.php"; ?>
</body>

</html>
