<?php

$temperatuur = null;
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=52.3676&longitude=4.9041&current=temperature_2m&timezone=Europe/Amsterdam";
$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 10,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
]);
$response = curl_exec($ch);
curl_close($ch);
if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['current']['temperature_2m'])) {
        $temperatuur = $data['current']['temperature_2m'];
    }
}

?>

<h1 class="temperatuur-header">Actuele temperatuur Amsterdam</h1>
<div class="temperatuur-container fadeIn">
    <p class="temperatuur">
        <?php echo $temperatuur !== null ? htmlspecialchars($temperatuur) . " &deg;C" : "Niet beschikbaar"; ?>
    </p>
</div>
<?php include "includes/footers/fynn.php" ?>
