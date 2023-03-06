// get single post
const openEdit = (uuid) => {
    const url = "/edit-post?uuid=" + uuid;

    const wrapper = $("#overlays");
    const edit = $("#overlays section.edit");
    const form = $("#overlays section.edit form.edit");
    const loader = $("#overlays .loader");
    const placeholder = $(".showcase svg");

    const getPost = () => {
        wrapper.css("pointer-events", "all");
        $.ajax({
            type: "GET",
            url: "/edit-post?uuid=" + uuid,
            dataType: "json",
            async: true,
        })
            .done(function (data) {
                loadingComplete(data);
            })
            .fail(function (e) {
                console.log(e);
                return e;
            });
    };

    const loadingComplete = (data) => {
        // if thumbnail exists
        if (data.thumbnail) {
            $(".showcase").css("background-image", "url(" + data.thumbnail + ")");
        }
        $("input[name='title']", form).val(data.title);
        $("textarea[name='content']", form).val(data.content);
        // animate loader
        let loadingComplete = anime
            .timeline({
                duration: 200,
            })
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

    var open = anime
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
            complete: () => getPost(),
        });
};

const closeEdit = () => {
    const wrapper = $("#overlays");
    const edit = $("#overlays section.edit");
    const form = $("#overlays section.edit form.edit");
    const loader = $("#overlays .loader");
    const placeholder = $(".showcase svg");
    const showcase = $(".showcase");

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

// edit post submit
$("form.edit").on("submit", (e) => {
    console.log("submitted");
    e.preventDefault();
    const form = $(e.target);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("thumbnail", $("input[name='thumbnail']")[0].files[0]);
    data.append("title", $("input[name='title']", form).val()); // title
    data.append("content", $("textarea[name='content']", form).val()); // content

    error.hide(); // clear error on re-submit

    $.ajax({
        // post the register form data to the api for saving
        type: "POST",
        url: "/api/edit-post",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        async: true,
    })
        .done(function (data) {
            if (data.error) {
                error.text(data.error).show();
            } else {
                closeEdit();
            }
        })
        .fail(function (e) {
            console.log(e);
        });

    return false; // always return false
});
