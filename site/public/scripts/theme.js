const storageKey = "theme-preference";

const onClick = () => {
    theme.value = theme.value === "light" ? "dark" : "light";
    setPreference();
};

const getColorPreference = () => {
    if (localStorage.getItem(storageKey)) {
        return localStorage.getItem(storageKey);
    } else {
        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
    }
};

const setPreference = () => {
    localStorage.setItem(storageKey, theme.value);
    reflectPreference();
};

const reflectPreference = () => {
    document.firstElementChild.setAttribute("data-theme", theme.value);
    document
        .querySelector("#toggle-theme")
        ?.setAttribute("aria-label", theme.value);
};

const theme = {
    value: getColorPreference(),
};

// set early so no page flashes / CSS is made aware
reflectPreference();

window.onload = () => {
    // set on load so screen readers can get the latest value on the button
    reflectPreference();

    // now this script can find and listen for clicks on the control
    const toggle = document.querySelector("#toggle-theme");
    const slider = document.querySelector("#toggle-theme .slider");

    toggle.addEventListener("click", () => {
        onClick();

        if (!slider.classList.contains("toggled")) {
            slider.classList.add("toggled");
        } else {
            slider.classList.remove("toggled");
        }
    });
};

window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", ({ matches: isDark }) => {
        theme.value = isDark ? "dark" : "light";
        setPreference();
    });
