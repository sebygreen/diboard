const app = () => {
    // dropzone
    const dropzone = document.querySelector(".dropzone");
    const active = () => {
        console.log("active");
        dropzone.classList.add("active");
    };
    const inactive = () => {
        console.log("inactive");
        dropzone.classList.remove("active");
    };
    const prevents = (e) => e.preventDefault();
    // drag events
    ["dragenter", "dragleave", "drop"].forEach((e) => {
        dropzone.addEventListener(e, prevents);
    });
    dropzone.addEventListener("dragenter", active);
    ["dragleave", "drop"].forEach((e) => {
        dropzone.addEventListener(e, inactive);
    });
    dropzone.addEventListener("drop", handleDrop);
};

document.addEventListener("DOMContentLoaded", app);

const handleDrop = (e) => {
    const dt = e.dataTransfer;
    const files = dt.files;
    const fileArray = [...files];

    console.log(fileArray);
};
