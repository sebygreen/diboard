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

    const controls_timestamps = 
    const controls = $(document.createElement("div")).addClass("controls");
}
