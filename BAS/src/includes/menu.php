<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use Bas\classes\Werknemer;

$werknemer = new Werknemer();

if (!$werknemer->isIngelogd()) {
    header('Location: /Bas/src/login.php');
    exit;
}
?>

<div class="menu">
    <a href="/Bas/src/index.php">Home</a>

    <?php if ($werknemer->magNaarPagina('klanten')) { ?>
        <a href="/Bas/src/klant/read.php">Klanten</a>
    <?php } ?>

    <?php if ($werknemer->magNaarPagina('artikelen')) { ?>
        <a href="/Bas/src/artikel/read.php">Artikelen</a>
    <?php } ?>

    <?php if ($werknemer->magNaarPagina('verkooporders')) { ?>
        <a href="/Bas/src/verkooporder/read.php">Verkooporders</a>
    <?php } ?>

    <?php if ($werknemer->magNaarPagina('orderstatus')) { ?>
        <a href="/Bas/src/verkooporder/status.php">Orderstatus</a>
    <?php } ?>

    <a href="/Bas/src/logout.php">Logout</a>
</div>