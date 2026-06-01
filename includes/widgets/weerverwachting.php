<?php

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
<?php include "includes/footers/fynn.php" ?>