// get single post
const getPost = (e, uuid) => {
    e.preventDefault();
    const url = "/edit-post?uuid=" + uuid;
    const form = $("form#edit-post");
    const wrapper = $("#overlays");
    const edit = $("#edit");

    edit.toggleClass("active");
    wrapper.css("pointer-events", "all");

    var open = anime
        .timeline({
            duration: 200,
        })
        .add({
            targets: "#overlays",
            opacity: 1,
            easing: "linear",
            complete: () => {
                edit.css("display", "flex");
            },
        })
        .add({
            targets: "#edit",
            translateY: {
                value: 0,
                easing: "cubicBezier(0.83, 0, 0.17, 1)",
            },
            opacity: {
                value: 1,
                easing: "linear",
            },
        })
        .add({
            targets: ".loader",
            opacity: 1,
            easing: "linear",
            complete: () => {
                $.ajax({
                    type: "GET",
                    url: "/edit-post?uuid=" + uuid,
                    dataType: "json",
                    async: true,
                })
                    .done(function (data) {
                        $(".loader").hide();
                        anime({
                            targets: "form#edit-post",
                            duration: 100,
                            opacity: 1,
                            easing: "linear",
                            complete: () => {
                                form.toggleClass("disabled");
                            },
                        });
                        if (data.thumbnail) {
                            $(".showcase").css("background-image", "url(" + data.thumbnail + ")");
                        }
                        $("input[name='title']", form).val(data.title);
                        $("textarea[name='content']", form).val(data.content);
                    })
                    .fail(function (e) {
                        console.log(e);
                    });
            },
        });
};

// edit post submit
$("form#edit-post").on("submit", (e) => {
    e.preventDefault();

    const form = $(this);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("thumbnail", $("input[name='thumbnail']")[0].files[0]);
    data.append("title", $("input[name='title']", form).val()); // title
    data.append("content", $("textarea[name='content']", form).val()); // content

    error.hide(); // clear error on re-submit

    $.ajax({
        // post the register form data to the api for saving
        type: "POST",
        url: "/ajax/edit-post",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        async: true,
    })
        .done(function (data) {
            if (data.redirect !== undefined) {
                window.location = data.redirect;
            } else if (data.error !== undefined) {
                error.text(data.error).show();
            }
        })
        .fail(function (e) {
            console.log(e);
        });

    return false; // always return false
});
