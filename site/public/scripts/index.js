const app = () => {
    // HACK: i don't like this method but not many choices
    // hidden file input
    const input = document.querySelector(".file");
    const dropzone = document.querySelector(".dropzone");
    const showcase = document.querySelector(".showcase");
    const prevents = (e) => e.preventDefault();

    // onchange event
    input.addEventListener("change", (e) => {
        // change background image
        if (e.target.files && e.target.files[0]) {
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
};

document.addEventListener("DOMContentLoaded", app);
