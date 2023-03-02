const app = () => {
    // HACK: i don't like this method but not many choices
    // hidden file input
    const input = document.querySelector(".file");
    const dropzone = document.querySelector(".dropzone");
    const showcase = document.querySelector(".showcase");
    const placeholder = document.querySelector(".showcase svg");
    const details = document.querySelector(".details");
    const prevents = (e) => e.preventDefault();

    input.addEventListener("change", prevents);

    // onchange event
    input.addEventListener("change", (e) => {
        let files = e.target.files;
        // if file exsists
        if (files && files[0]) {
            // convert current info children to non-live array
            let children = Array.prototype.slice.call(details.children);
            // remove children
            for (var child of children) {
                child.remove();
            }

            // create p tag with filename
            let name = document.createElement("p");
            details.appendChild(name);
            name.innerHTML = files[0].name;
            // create p tag with readable size
            let list = document.createElement("ul");
            let size = document.createElement("li");
            list.appendChild(size);
            details.appendChild(list);
            size.innerHTML = formatBytes(files[0].size, 0);

            // send to background
            const reader = new FileReader();
            // change background once file is loaded
            reader.onload = function (e) {
                // remove placeholder svg
                placeholder.remove();
                // change background of showcase
                showcase.style.backgroundImage = "url(" + e.target.result + ")";
            };
            // read file
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // dropzone switches
    const active = () => {
        dropzone.classList.add("active");
    };
    const inactive = () => {
        dropzone.classList.remove("active");
    };

    // dropzone drag events
    ["dragenter", "dragleave", "dragover", "drop", "click"].forEach((e) => {
        dropzone.addEventListener(e, prevents);
    });
    dropzone.addEventListener("dragenter", active);
    ["dragleave", "drop"].forEach((e) => {
        dropzone.addEventListener(e, inactive);
    });

    // drop event
    dropzone.addEventListener("drop", (e) => {
        input.files = e.dataTransfer.files;
        input.dispatchEvent(new Event("change"));
    });

    // click event
    dropzone.addEventListener("click", () => {
        input.click();
        dropzone.blur();
    });
};

document.addEventListener("DOMContentLoaded", app);

// NOTE: https://stackoverflow.com/a/18650828/11476286
function formatBytes(bytes, decimals) {
    if (!+bytes) return "0 Bytes";

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
}
