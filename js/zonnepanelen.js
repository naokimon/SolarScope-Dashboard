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
    const panelen   = document.getElementById("panelen");
    const vandaag   = document.getElementById("kwhvandaag");
    const week      = document.getElementById("kwhweek");

    const totalPanels = await randomGenerateInfo("total_panels");
    const kwhToday    = await randomGenerateInfo("kwh_today");
    const kwhWeek     = await randomGenerateInfo("kwh_this_week");

    // Insert value as a text node before the unit <span> so the unit stays rendered
    panelen.childNodes[0]
        ? panelen.insertBefore(document.createTextNode(totalPanels), panelen.firstChild)
        : panelen.textContent = totalPanels;

    if (vandaag.firstChild && vandaag.firstChild.nodeType === Node.TEXT_NODE) {
        vandaag.firstChild.textContent = kwhToday;
    } else {
        vandaag.insertBefore(document.createTextNode(kwhToday), vandaag.firstChild);
    }

    if (week.firstChild && week.firstChild.nodeType === Node.TEXT_NODE) {
        week.firstChild.textContent = kwhWeek;
    } else {
        week.insertBefore(document.createTextNode(kwhWeek), week.firstChild);
    }
})();
