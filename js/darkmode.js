document.addEventListener("DOMContentLoaded", () => {
    let darkMode = localStorage.getItem("darkmode");
    const button = document.getElementById("dark-mode");

    const enableDarkmode = () => {
        document.body.classList.add("dark-mode");
        localStorage.setItem("darkmode", "active");
        drawChart();
    }

    const disableDarkmode = () => {
        document.body.classList.remove("dark-mode");
        localStorage.setItem("darkmode", null);
        drawChart();
    }

    if (darkMode === "active") enableDarkmode();

    button.addEventListener("click", () => {
        darkMode = localStorage.getItem("darkmode");
        darkMode !== "active" ? enableDarkmode() : disableDarkmode();
    });
});