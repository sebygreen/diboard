const handle = {
    register: async (e) => {
        e.preventDefault();
        const data = new FormData(e.target);
        const error = document.querySelector("#register .error");
        if (error.classList.contains("shown")) {
            error.classList.toggle("shown");
        }
        await fetch("/api/register", {
            method: "POST",
            body: data,
        })
            .then(async response => {
                if (!response.ok && response.status === 413) {
                    throw new Error('Image is too large to send.');
                } else if (!response.ok) {
                    throw new Error("Form failed to send.");
                } else if (response.ok) {
                    let json = await response.json();
                    if (json.error) {
                        throw new Error(json.error);
                    } else if (json.redirect) {
                        window.location = json.redirect;
                    }
                }
            })
            .catch(e => {
                //console.error(e);
                error.innerHTML = e;
                error.style.display = "block";
                error.classList.toggle("shown");
            })
    },
    login: async (e) => {
        e.preventDefault();
        console.log(e.target);
        const data = new FormData(e.target);
        const error = document.querySelector("#login .error");
        await fetch("/api/login", {
            method: "POST",
            body: data,
        })
            .then(async response => {
                if (!response.ok) {
                    throw new Error("Form failed to send.")
                } else if (response.ok) {
                    let json = await response.json();
                    if (json.error) {
                        throw new Error(json.error);
                    } else if (json.redirect) {
                        window.location = json.redirect;
                    }
                }
            })
            .catch(e => {
                //console.error(e);
                error.innerHTML = e;
                error.style.display = "block";
                error.classList.toggle("shown");
            })
    },
    "new-post": async (e) => {
        e.preventDefault();
        const data = new FormData(e.target);
        const error = document.querySelector("#new-post .error");
        if (error.classList.contains("shown")) {
            error.classList.toggle("shown");
        }
        await fetch("/api/new-post", {
            method: "POST",
            body: data,
        })
            .then(async response => {
                if (!response.ok && response.status === 413) {
                    throw new Error('Image is too large to send.');
                } else if (!response.ok) {
                    throw new Error("Form failed to send.");
                } else if (response.ok) {
                    let json = await response.json();
                    if (json.error) {
                        throw new Error(json.error);
                    } else if (json.redirect) {
                        window.location = json.redirect;
                    }
                }
            })
            .catch(e => {
                //console.error(e);
                error.innerHTML = e;
                error.style.display = "block";
                error.classList.toggle("shown");
            })
    },
    "edit-post": async (e) => {
        e.preventDefault();
        const data = new FormData(e.target);
        const error = document.querySelector("#edit-post .error");
        if (error.classList.contains("shown")) {
            error.classList.toggle("shown");
        }
        await fetch("/api/edit-post", {
            method: "POST",
            body: data,
        })
            .then(async response => {
                if (!response.ok && response.status === 413) {
                    throw new Error('Image is too large to send.');
                } else if (!response.ok) {
                    throw new Error("Form failed to send.");
                } else if (response.ok) {
                    let json = await response.json();
                    if (json.error) {
                        throw new Error(json.error);
                    } else if (json.redirect) {
                        window.location = json.redirect;
                    }
                }
            })
            .catch(e => {
                //console.error(e);
                error.innerHTML = e;
                error.style.display = "block";
                error.classList.toggle("shown");
            })
    }
}
const forms = ["login", "register", "new-post", "edit-post"];
forms.forEach(i => {
    let form = document.querySelector(`#${i} form`);
    form && form.addEventListener("submit", handle[i]);
});

if (document.getElementById("grid")) {
    new MiniMasonry({
        baseWidth: 280,
        container: '#grid',
        gutter: 20,
        ultimateGutter: 20,
        direction: "ltr",
        wedge: true,
    });
}


