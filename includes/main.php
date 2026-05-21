<?php
$temperatuur = null;
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=52.3676&longitude=4.9041&current=temperature_2m&timezone=Europe/Amsterdam";
$response = @file_get_contents($apiUrl);
if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['current']['temperature_2m'])) {
        $temperatuur = $data['current']['temperature_2m'];
    }
}
?>
<main class="main-page">
    <section class="dashboard">
        <div class="block-row">
            <article class="dashboard-block">
            </article>
            <article class="dashboard-block">

            </article>
        </div>
        <div class="block-row">
            <div class="block-grid">
                <article class="dashboard-grid-block">
                <h1>Actuele temperatuur Amsterdam</h1>
                <p class="temperatuur">
                    <?php echo $temperatuur !== null ? htmlspecialchars($temperatuur) . " &deg;C" : "Niet beschikbaar"; ?>
                </p>

                </article>
                <article class="dashboard-grid-block">

                </article>
                <article class="dashboard-grid-block">

                </article>
                <article class="dashboard-grid-block">

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
