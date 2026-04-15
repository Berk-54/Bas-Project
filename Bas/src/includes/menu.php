<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="menu">
    <a href="/Bas/src/index.php">Home</a>

    <?php if ($_SESSION['rol'] === 'magazijn') { ?>
        <a href="/Bas/src/klant/read.php">Klanten</a>
        <a href="/Bas/src/artikel/read.php">Artikelen</a>
        <a href="/Bas/src/verkooporder/read.php">Verkooporders</a>
        <a href="/Bas/src/verkooporder/status.php">Orderstatus</a>
    <?php } ?>

    <?php if ($_SESSION['rol'] === 'bezorger') { ?>
        <a href="/Bas/src/verkooporder/read.php">Verkooporders</a>
        <a href="/Bas/src/verkooporder/status.php">Orderstatus</a>
    <?php } ?>

    <a href="/Bas/src/logout.php">Logout</a>
</div>