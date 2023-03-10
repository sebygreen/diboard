import { getPost } from "./fetch.js";

const wrapper = $("#overlays");
const edit = $("#overlays section.edit");
const form = $("#overlays section.edit form.edit");
const loader = $("#overlays .loader");
const placeholder = $(".showcase svg");

export function openEdit() {
    // open edit overlay
    var openEdit = anime
        .timeline({
            duration: 200,
        })
        .add({
            targets: wrapper.get(),
            opacity: 1,
            easing: "linear",
            complete: () => edit.css("display", "flex"),
        })
        .add({
            targets: edit.get(),
            translateY: {
                value: 0,
                easing: "cubicBezier(0.83, 0, 0.17, 1)",
            },
            opacity: {
                value: 1,
                easing: "linear",
            },
            complete: () => getPost(loadingComplete(data), uuid), // fetch post when edit overlay has finished animating
        });
    // once fetched, populate form fields with data
    const loadingComplete = (data) => {
        // if thumbnail exists
        if (data.thumbnail) {
            $(".showcase").css("background-image", "url(" + data.thumbnail + ")");
        }
        $("input[name='title']", form).val(data.title);
        $("textarea[name='content']", form).val(data.content);
        // animate loader
        openEdit
            .add({
                targets: loader.get(),
                opacity: 0,
                easing: "linear",
                complete: () => loader.hide(),
            })
            .add(
                {
                    targets: form.get(),
                    opacity: 1,
                    easing: "linear",
                    complete: () => form.toggleClass("disabled"),
                },
                0
            );
    };
}

const closeEdit = () => {
    const closeComplete = () => {
        showcase.css("background-image", "");
        $("input[name='title']", form).val("");
        $("textarea[name='content']", form).val("");
        placeholder.show();
    };

    wrapper.css("pointer-events", "none");
    var close = anime
        .timeline({
            duration: 200,
        })
        .add({
            targets: edit.get(),
            translateY: {
                value: -10,
                easing: "cubicBezier(0.83, 0, 0.17, 1)",
            },
            opacity: {
                value: 0,
                easing: "linear",
            },
            complete: () => {
                edit.hide();
                form.toggleClass("disabled");
                form.css("opacity", 0.4);
            },
        })
        .add({
            targets: wrapper.get(),
            opacity: 0,
            easing: "linear",
            complete: () => closeComplete(),
        });

    return false;
};
