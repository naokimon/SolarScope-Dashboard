document.addEventListener("DOMContentLoaded", () => {
    let darkMode = localStorage.getItem("darkmode");
    const button = document.getElementById("dark-mode");

    const enableDarkmode = () => {
        document.body.classList.add("dark-mode");
        localStorage.setItem("darkmode", "active");
        if (typeof drawChart === "function") drawChart(typeof huidigePeriode !== "undefined" ? huidigePeriode : "maand");
    }

    const disableDarkmode = () => {
        document.body.classList.remove("dark-mode");
        localStorage.setItem("darkmode", null);
        if (typeof drawChart === "function") drawChart(typeof huidigePeriode !== "undefined" ? huidigePeriode : "maand");
    }

    if (darkMode === "active") enableDarkmode();

    button.addEventListener("click", () => {
        darkMode = localStorage.getItem("darkmode");
        darkMode !== "active" ? enableDarkmode() : disableDarkmode();
    });
});