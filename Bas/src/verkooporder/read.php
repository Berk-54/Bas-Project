<?php
session_start();

if (!isset($_SESSION['gebruiker'])) {
    header("Location: ../login.php");
    exit;
}

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();
$lijst = $verkooporder->getVerkooporders();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Verkooporders</h2>
    </div>

    <?php include '../includes/menu.php'; ?>

    <?php
    $verkooporder->showTable($lijst);
    ?>
</div>

</body>
</html>