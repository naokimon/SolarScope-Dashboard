<?php

$temperatuur = null;
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=52.3676&longitude=4.9041&current=temperature_2m&timezone=Europe/Amsterdam";
$response = @file_get_contents($apiUrl);
if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['current']['temperature_2m'])) {
        $temperatuur = $data['current']['temperature_2m'];
        $temperatuur += 1.5;
    }
}

?>

<h1 class="temperatuur-header">Actuele binnen temperatuur</h1>
<div class="temperatuur-container fadeIn">
    <p class="temperatuur">
        <?php echo $temperatuur !== null ? htmlspecialchars($temperatuur) . " &deg;C" : "Niet beschikbaar"; ?>
    </p>
</div>
<?php include "includes/footers/nathan.php"; ?>
