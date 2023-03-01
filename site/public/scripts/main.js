// handle image preview
$(document).on("change", "input.js-image", function () {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function (event) {
            $(".showcase").css("background-image", "url(" + event.target.result + ")"); // very simple image preview
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// edit post
$(document).on("submit", "form.js-edit-post", function (event) {
    event.preventDefault();

    const form = $(this);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("post_id", $("input[name='post_id']", form).val());
    data.append("thumbnail", $("input[name='thumbnail']")[0].files[0]);
    data.append("title", $("input[name='title']", form).val()); // title
    data.append("content", $("textarea[name='content']", form).val()); // content

    error.hide(); // clear error on re-submit

    $.ajax({
        // post the register form data to the api for saving
        type: "POST",
        url: "/ajax/edit-post.php",
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

// new post
$(document).on("submit", "form.js-new-post", function (event) {
    event.preventDefault();

    const form = $(this);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("thumbnail", $("input[name='thumbnail']")[0].files[0]); // thumbnail
    data.append("title", $("input[name='title']", form).val()); // title
    data.append("content", $("textarea[name='content']", form).val()); // content

    error.hide(); // clear errors on re-submit

    $.ajax({
        // post the register form data to the api for saving
        type: "POST",
        url: "/ajax/new-post.php",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        async: true,
    })
        .done(function (data) {
            console.log(data);

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

// login
$(document).on("submit", "form.js-login", function (event) {
    event.preventDefault();

    const form = $(this);
    const error = $(".js-error", form);

    const data = {
        email: $("input[name='email']", form).val(),
        password: $("input[name='password']", form).val(),
    };

    error.hide(); // clear errors on re-submit

    $.ajax({
        // post the login form data to the api for saving
        type: "POST",
        url: "/ajax/login.php",
        data: data,
        dataType: "json",
        async: true,
    })
        .done(function (data) {
            if (data.redirect !== undefined) {
                window.location = data.redirect;
            } else if (data.error !== undefined) {
                error.html(data.error).show();
            }
        })
        .fail(function (e) {
            console.log(e);
        });

    return false;
});

// register
$(document).on("submit", "form.js-register", function (event) {
    event.preventDefault();

    const form = $(this);
    const error = $(".js-error", form); // error class

    const data = new FormData();
    data.append("avatar", $("input[name='avatar']")[0].files[0]); // image
    data.append("username", $("input[name='username']", form).val()); // username
    data.append("email", $("input[name='email']", form).val()); // email
    data.append("password", $("input[name='password']", form).val()); // password

    error.hide(); // clear errors on re-submit

    $.ajax({
        // post the register form data to the api for saving
        type: "POST",
        url: "/ajax/register.php",
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

    return false;
});
