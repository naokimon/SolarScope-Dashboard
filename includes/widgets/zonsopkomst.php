<?php

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

?>

<h1 class="zonh1">Zonopkomst en zonsondergang</h1>
<p class="zon-opkomst">
    <?php echo $opkomstdatum !== null ? htmlspecialchars($opkomstdatum) : "Niet beschikbaar"; ?>
</p>
<p class="zon-ondergang">
    <?php echo $ondergangdatum !== null ? htmlspecialchars($ondergangdatum) : "Niet beschikbaar"; ?>
</p>
<?php include "includes/footers/fynn.php" ?>
