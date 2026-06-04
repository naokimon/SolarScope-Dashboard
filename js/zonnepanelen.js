async function getData() {
    const data = await fetch("../data/zonnepanelen.json")
        .then(res => res.json());

    return data;
}

async function randomGenerateInfo(key) {
    const data = await getData();
    const array = data[key];
    return array[Math.floor(Math.random() * array.length)];
}

(async () => {
    document.getElementById("panelen").textContent = "Totaal panelen: " + await randomGenerateInfo("total_panels");
    document.getElementById("kwhvandaag").textContent = "kWh vandaag: " + await randomGenerateInfo("kwh_today");
    document.getElementById("kwhweek").textContent = "kWh week: " + await randomGenerateInfo("kwh_this_week");
})();