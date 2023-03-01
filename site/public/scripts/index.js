const app = () => {
    // HACK: i don't like this method but not many choices
    // hidden file input
    const input = document.querySelector(".file");
    const dropzone = document.querySelector(".dropzone");
    const showcase = document.querySelector(".showcase");
    const info = document.querySelector(".allowed");
    const prevents = (e) => e.preventDefault();

    // onchange event
    input.addEventListener("change", (e) => {
        let files = e.target.files;
        // change info
        console.log(info.children);

        let size = document.createElement("p");
        info.appendChild(size);
        size.innerHTML = files[0].size;

        // change background image
        if (files && files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                showcase.style.backgroundImage = "url(" + e.target.result + ")";
            };
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
    ["dragenter", "dragleave", "dragover", "drop"].forEach((e) => {
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
    });
};

document.addEventListener("DOMContentLoaded", app);
