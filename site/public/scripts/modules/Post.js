export default function Post(thumbnail, title, content, pub_time, edit_time, username, avatar) {
    const post = $(document.createElement("article")).addClass("post");

    const img_thumbnail = $(document.createElement("img")).attr("src", thumbnail);
    const img = $(document.createElement("div")).addClass("thumbnail").append(img_thumbnail);

    const author_avatar = $(document.createElement("img")).attr("src", avatar);
    const author_username = $(document.createElement("p")).text(username);
    const author = $(document.createElement("div")).addClass("author").append(author_avatar, author_username);

    const text_title = $(document.createElement("p")).text(title);
    const text_content = $(document.createElement("p")).text(content);
    const text = $(document.createElement("div")).addClass("text").append(text_title, text_content);

    const 
    const controls = $(document.createElement("div")).addClass("controls");
}

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
                <button class="icon edit" onclick="openEdit('<?= $row["uuid"] ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </button>
            </div>
        <?php } ?>
    </div>
</article>
