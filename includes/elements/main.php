<main class="main-page">
    <section class="dashboard">
        <div class="block-row">
            <article class="dashboard-block weerverwachting-block">
                <?php include "includes/widgets/weerverwachting.php"; ?>
            </article>
            <article class="dashboard-block">
                <?php include "includes/widgets/gas.php"; ?>
            </article>
        </div>
        <div class="block-row">
            <div class="block-grid">
                <article class="dashboard-grid-block">
                    <?php include "includes/widgets/adamweer.php"; ?>
                </article>
                <article class="dashboard-grid-block">
                    <?php include "includes/widgets/binnen-temp.php"; ?>
                </article>
                <article class="dashboard-grid-block-long">
                    <?php include "includes/widgets/zonnepanelen.php"; ?>
                </article>
            </div>
            <div class="block-grid">
                <article class="dashboard-grid-block-long">
                    <?php include "includes/widgets/tijdspanne.php"; ?>
                </article>
                <article class="dashboard-grid-block">
                    <?php include "includes/widgets/tijd.php"; ?>
                </article>
                <article class="dashboard-grid-block">
                    <?php include "includes/widgets/zonsopkomst.php"; ?>
                </article>
            </div>
        </div>
        <div class="block-row">
            <article class="dashboard-block">
                <?php include "includes/widgets/zakaria-chart.php"; ?>
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