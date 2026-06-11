<?php

$opkomstdatum = null;
$ondergangdatum = null;
$api2Url = "https://api.sunrise-sunset.org/json?lat=52.22408&lng=-4.9041&date=today";
$ch2 = curl_init($api2Url);
curl_setopt_array($ch2, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 10,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
]);
$response2 = curl_exec($ch2);
curl_close($ch2);
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

<div class="fadeIn">
    <h1 class="zonh1">Zonopkomst en zonsondergang</h1>
    <p class="zon-opkomst">
        <?php echo $opkomstdatum !== null ? htmlspecialchars($opkomstdatum) : "Niet beschikbaar"; ?>
    </p>
    <p class="zon-ondergang">
        <?php echo $ondergangdatum !== null ? htmlspecialchars($ondergangdatum) : "Niet beschikbaar"; ?>
    </p>
</div>
<?php include "includes/footers/fynn.php" ?>
