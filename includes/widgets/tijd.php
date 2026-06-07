<?php

$datumtijd = date('d-m-Y H:i:s');

?>

<h1>Huidige datum en tijd</h1>
<div class="fadeIn">
    <p class="datum-tijd" id="datumtijd"><?php echo htmlspecialchars($datumtijd); ?></p>
</div>
<?php include "includes/footers/fynn.php" ?>