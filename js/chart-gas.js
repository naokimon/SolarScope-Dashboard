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

async function drawChart(periode) {
    const chartData = await fetch(dataFiles[periode]).then(r => r.json());

    const darkMode = localStorage.getItem("darkmode");
    const title  = darkMode === "active" ? "#EFF0E3" : "#000000";
    const colors = darkMode === "active" ? ["#FF8C35"] : ["#FF6F06"];

    const data  = google.visualization.arrayToDataTable(chartData);
    const chart = new google.visualization.LineChart(document.getElementById("gas-chart"));
    chart.draw(data, {
        title: titels[periode],
        titleTextStyle: { color: title },
        backgroundColor: "transparent",
        colors: colors,
        legend: { position: "bottom", textStyle: { color: title } },
        hAxis: { textStyle: { color: title }, gridlines: { color: "transparent" } },
        vAxis: { textStyle: { color: title } },
        width: 450,
        height: 250,
    });
}
