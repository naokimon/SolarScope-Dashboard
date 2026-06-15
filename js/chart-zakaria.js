const stroomFiles = {
    maand: "data/stroom.json",
    week:  "data/stroom-week.json",
    dag:   "data/stroom-dag.json",
};

const stroomTitels = {
    maand: "Stroom opwekking per maand",
    week:  "Stroom opwekking per week",
    dag:   "Stroom opwekking per dag",
};

let stroomPeriode = "maand";

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(() => drawStroomChart(stroomPeriode));

document.addEventListener("tijdspanne-change", (e) => {
    stroomPeriode = e.detail.periode;
    drawStroomChart(stroomPeriode);
});

window.addEventListener("resize", () => drawStroomChart(stroomPeriode));

async function drawStroomChart(periode) {
    const chartData = await fetch(stroomFiles[periode]).then(r => r.json());

    const darkMode = localStorage.getItem("darkmode");
    const title  = darkMode === "active" ? "#EFF0E3" : "#000000";
    const colors = darkMode === "active" ? ["#FF8C35"] : ["#FF6F06"];

    const container = document.getElementById("stroom-chart");
    const data  = google.visualization.arrayToDataTable(chartData);
    const chart = new google.visualization.LineChart(container);
    chart.draw(data, {
        title: stroomTitels[periode],
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
