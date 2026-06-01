<?php // Amsterdam temperatuur ophalen met api
$temperatuur = null;
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=52.3676&longitude=4.9041&current=temperature_2m&timezone=Europe/Amsterdam";
$response = @file_get_contents($apiUrl);
if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['current']['temperature_2m'])) {
        $temperatuur = $data['current']['temperature_2m'];
    }
}

// Zonopkomst en zonsondergang ophalen met api
$opkomstdatum = null;
$ondergangdatum = null;
$api2Url = "https://api.sunrise-sunset.org/json?lat=52.22408&lng=-4.9041&date=today";
$response2 = @file_get_contents($api2Url);
if ($response2 !== false) {
    $data2 = json_decode($response2, true);
    if (isset($data2['results']['sunrise'])) {
        $opkomstdatum = $data2['results']['sunrise'];
    }
    if (isset($data2['results']['sunset'])) {
        $ondergangdatum = $data2['results']['sunset'];
    }
}

// Uurverwachting (09:00 - 23:00) ophalen met api
$uurverwachting = [];
$api3Url = "https://api.open-meteo.com/v1/forecast?latitude=52.3676&longitude=4.9041&hourly=weathercode,precipitation_probability&timezone=Europe/Amsterdam&forecast_days=1";
$response3 = @file_get_contents($api3Url);
if ($response3 !== false) {
    $data3 = json_decode($response3, true);
    if (isset($data3['hourly']['time'], $data3['hourly']['weathercode'], $data3['hourly']['precipitation_probability'])) {
        foreach ($data3['hourly']['time'] as $i => $tijdstip) {
            $uur = (int) substr($tijdstip, 11, 2);
            if ($uur >= 9 && $uur <= 23) {
                $uurverwachting[] = [
                    'uur' => $uur,
                    'code' => $data3['hourly']['weathercode'][$i],
                    'kans' => $data3['hourly']['precipitation_probability'][$i],
                ];
            }
        }
    }
}

function weercode_naar_omschrijving($code)
{
    if ($code === 0) return "Zonnig";
    if (in_array($code, [1, 2], true)) return "Gedeeltelijk bewolkt";
    if ($code === 3) return "Bewolkt";
    if (in_array($code, [45, 48], true)) return "Mist";
    if (in_array($code, [51, 53, 55, 56, 57], true)) return "Motregen";
    if (in_array($code, [61, 63, 65, 66, 67, 80, 81, 82], true)) return "Regen";
    if (in_array($code, [71, 73, 75, 77, 85, 86], true)) return "Sneeuw";
    if (in_array($code, [95, 96, 99], true)) return "Onweer";
    return "Onbekend";
}
?>

<?php $datumtijd = date('d-m-Y H:i:s'); ?>


<main class="main-page">
    <section class="dashboard">
        <div class="block-row">
            <article class="dashboard-block weerverwachting-block">
                <h1>Weerverwachting in Amsterdam</h1>
                <?php if (!empty($uurverwachting)): ?>
                    <ul class="uurverwachting">
                        <?php foreach ($uurverwachting as $u): ?>
                            <li>
                                <span class="uur"><?php echo sprintf('%02d:00', $u['uur']); ?></span>
                                <span class="weer"><?php echo htmlspecialchars(weercode_naar_omschrijving($u['code'])); ?></span>
                                <span class="kans"><?php echo htmlspecialchars($u['kans']); ?>%</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="weerverwachting">Niet beschikbaar</p>
                <?php endif; ?>
                <?php include "includes/fynn.php" ?>
            </article>
            <article class="dashboard-block">
                <?php include "includes/gas.php"; ?>
            </article>
        </div>
        <div class="block-row">
            <div class="block-grid">
                <article class="dashboard-grid-block">
                    <h1>Actuele temperatuur Amsterdam</h1>
                    <p class="temperatuur">
                        <?php echo $temperatuur !== null ? htmlspecialchars($temperatuur) . " &deg;C" : "Niet beschikbaar"; ?>
                    </p>
                    <?php include "includes/fynn.php" ?>

                </article>
                <article class="dashboard-grid-block">
                    <h1 class="zonh1">Zonopkomst en zonsondergang</h1>
                    <p class="zon-opkomst">
                        <?php echo $opkomstdatum !== null ? htmlspecialchars($opkomstdatum) : "Niet beschikbaar"; ?>
                    </p>
                    <p class="zon-ondergang">
                        <?php echo $ondergangdatum !== null ? htmlspecialchars($ondergangdatum) : "Niet beschikbaar"; ?>
                    </p>
                    <?php include "includes/fynn.php" ?>
                </article>
                <article class="dashboard-grid-block">
                    <h1>Huidige datum en tijd</h1>
                    <p class="datum-tijd" id="datumtijd"><?php echo htmlspecialchars($datumtijd); ?></p>
                    <?php include "includes/fynn.php" ?>

                </article>
                <article class="dashboard-grid-block">
                    <?php include "includes/dark-mode.php"; ?>
                </article>
            </div>
            <div class="block-grid">
                <article class="dashboard-grid-block">

                </article>
                <article class="dashboard-grid-block">

                </article>
                <article class="dashboard-grid-block">

                </article>
                <article class="dashboard-grid-block">

                </article>
            </div>
        </div>
        <div class="block-row">
            <article class="dashboard-block">

            </article>
            <article class="dashboard-block">

            </article>
        </div>
    </section>
</main>

<script>
    (function() {
        const target = document.getElementById('datumtijd');
        if (!target) {
            return;
        }

        const pad = (value) => String(value).padStart(2, '0');
        const updateDatumTijd = () => {
            const now = new Date();
            target.textContent = `${pad(now.getDate())}-${pad(now.getMonth() + 1)}-${now.getFullYear()} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
        };

        updateDatumTijd();
        setInterval(updateDatumTijd, 1000);
    })();
</script>