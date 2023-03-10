import anime from "./lib/anime.es.js";
import { getPosts } from "./fetch.js";

const Post = (post) => {
    this.post = () => {
        $(document.createElement("article")).addClass("post");
    };

    let img_thumbnail = $(document.createElement("img")).attr("src", thumbnail);
    this.img = $(document.createElement("div")).addClass("thumbnail").append(img_thumbnail);

    let author_avatar = $(document.createElement("img")).attr("src", avatar);
    let author_username = $(document.createElement("p")).text(username);
    this.author = $(document.createElement("div")).addClass("author").append(author_avatar, author_username);

    let text_title = $(document.createElement("p")).text(title);
    let text_content = $(document.createElement("p")).text(content);
    this.text = $(document.createElement("div")).addClass("text").append(text_title, text_content);

    let controls_timestamps = $(document.createElement("div")).addClass("timestamps");

    let timestamps_timestamp = $(document.createElement("time")).addClass("timestamp").text(pub_time);

    let timestamps_edited = $(document.createElement("div")).addClass("edited");
    let edited_timestamp = $(document.createElement("time")).text(edit_time);
    let svg_path = $(document.createElement("path")).attr("d", "M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z");
    let edited_svg = $(document.createElement("svg")).addClass("controls").attr({ xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 20 20", fill: "currentColor" }).append(svg_path);

    let buttons_delete = $(document.createElement("button")).addClass("icon edit");
    let buttons_edit = $(document.createElement("button")).addClass("icon edit");
    let controls_buttons = $(document.createElement("div")).addClass("buttons").append(buttons_delete, buttons_edit);

    this.controls = $(document.createElement("div")).addClass("controls");
};

$("article.post").show();
anime({
    targets: ".post",
    duration: 200,
    opacity: {
        value: 1,
        easing: "linear",
    },
    translateY: {
        value: 0,
        easing: "cubicBezier(0.83, 0, 0.17, 1)",
    },
    delay: anime.stagger(50),
});

const refreshPost = () => {
    const grid = $("section#grid");
    const loader = $("section#grid .loader");

    getPosts((data) => callback(data));

    const callback = (data) => {
        console.log(data);
    };
};
