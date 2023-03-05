// get single post
const getPost = (uuid) => {
    const url = "/edit-post?uuid=" + uuid;
    const form = $("form#edit-post");
    const overlay = $("#overlays");
    const edit = $("#edit");

    overlay.css("display", "flex");
    edit.show();
    overlay.toggleClass("active");
    edit.toggleClass("active");

    $.ajax({
        type: "GET",
        url: "/edit-post?uuid=" + uuid,
        dataType: "json",
        async: true,
    })
        .done(function (data) {
            console.log(data);
        })
        .fail(function (e) {
            console.log(e);
        });
};

// edit post submit
$("form#edit-post").on("submit", (e) => {
    e.preventDefault();

    const form = $(this);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("uuid", $("input[name='uuid']", form).val());
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
