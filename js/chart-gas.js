let chartData;

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(async () => {
    chartData = await fetch("data/gas.json").then(r => r.json());
    drawChart();
});

function drawChart() {
    if (!chartData) return;
    const darkMode = localStorage.getItem("darkmode")
    const title = darkMode === "active" ? "#EFF0E3" : "#000000";
    const bg = darkMode === "active" ? "#1d1d1d" : "#EFF0E3";
    const colors = darkMode === "active" ? ["#FF8C35"] : ["#FF6F06"];

    const data = google.visualization.arrayToDataTable(chartData);
    const chart = new google.visualization.LineChart(document.getElementById("gas-chart"));
    chart.draw(data, {
        title: "Gas verbruik",
        titleTextStyle: { color: title },
        backgroundColor: bg,
        colors: colors,
        legend: { position: "bottom", textStyle: { color: title } },
        hAxis: { textStyle: { color: title }, gridlines: { color: "transparent" } },
        vAxis: { textStyle: { color: title } },
        width: 450,
        height: 250,
    });
}