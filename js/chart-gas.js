const dataFiles = {
    maand: "data/gas.json",
    week:  "data/gas-week.json",
    dag:   "data/gas-dag.json",
};

const titels = {
    maand: "Gas verbruik per maand",
    week:  "Gas verbruik per week",
    dag:   "Gas verbruik per dag",
};

let huidigePeriode = "maand";

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(() => drawChart(huidigePeriode));

document.addEventListener("tijdspanne-change", (e) => {
    huidigePeriode = e.detail.periode;
    drawChart(huidigePeriode);
});

let resizeTimer;
window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => drawChart(huidigePeriode), 150);
});

async function drawChart(periode) {
    const chartData = await fetch(dataFiles[periode]).then(r => r.json());

    const darkMode = localStorage.getItem("darkmode");
    const title  = darkMode === "active" ? "#EFF0E3" : "#000000";
    const colors = darkMode === "active" ? ["#FF8C35"] : ["#FF6F06"];

    const container = document.getElementById("gas-chart");
    const data  = google.visualization.arrayToDataTable(chartData);
    const chart = new google.visualization.LineChart(container);
    chart.draw(data, {
        title: titels[periode],
        titleTextStyle: { color: title },
        backgroundColor: "transparent",
        colors: colors,
        legend: { position: "bottom", textStyle: { color: title } },
        hAxis: { textStyle: { color: title }, gridlines: { color: "transparent" } },
        vAxis: { textStyle: { color: title } },
        width: container.offsetWidth  || 450,
        height: container.offsetHeight || 250,
    });
}
