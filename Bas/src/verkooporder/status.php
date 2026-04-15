<?php
session_start();

if (!isset($_SESSION['gebruiker'])) {
    header("Location: ../login.php");
    exit;
}

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();

if (isset($_POST["save_status"])) {
    if ($verkooporder->updateOrderStatus((int)$_POST['verkOrdId'], (int)$_POST['verkOrdStatus'])) {
        echo '<script>alert("Orderstatus gewijzigd")</script>';
        echo "<script> location.replace('read.php'); </script>";
    } else {
        $error = "Fout bij wijzigen status";
    }
}

if (isset($_GET['verkOrdId'])) {
    $row = $verkooporder->getVerkooporder((int)$_GET['verkOrdId']);
} else {
    $row = [];
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orderstatus wijzigen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Orderstatus wijzigen</h2>
    </div>

    <?php include '../includes/menu.php'; ?>

    <?php if (isset($error)) { ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>

    <?php if (!empty($row)) { ?>
        <form method="post" class="form-box">
            <input type="hidden" name="verkOrdId" value="<?php echo $row['verkOrdId']; ?>">

            <div class="row">
                <label>Klant :</label>
                <input type="text" value="<?php echo htmlspecialchars($row['klantNaam']); ?>" readonly>
            </div>

            <div class="row">
                <label>Artikel :</label>
                <input type="text" value="<?php echo htmlspecialchars($row['artOmschrijving']); ?>" readonly>
            </div>

            <div class="row">
                <label>Huidige status :</label>
                <input type="text" value="<?php echo htmlspecialchars($verkooporder->getStatusTekst((int)$row['verkOrdStatus'])); ?>" readonly>
            </div>

            <div class="row">
                <label>Nieuwe status :</label>
                <select name="verkOrdStatus" required>
                    <option value="1" <?php if ($row['verkOrdStatus'] == 1) echo "selected"; ?>>Genoteerd</option>
                    <option value="2" <?php if ($row['verkOrdStatus'] == 2) echo "selected"; ?>>Wordt verzameld</option>
                    <option value="3" <?php if ($row['verkOrdStatus'] == 3) echo "selected"; ?>>Bij bezorger</option>
                    <option value="4" <?php if ($row['verkOrdStatus'] == 4) echo "selected"; ?>>Afgeleverd</option>
                </select>
            </div>

            <div class="buttons">
                <input class="btn" type="submit" name="save_status" value="Opslaan">
                <a class="btn" href="read.php">Annuleren</a>
            </div>
        </form>
    <?php } else { ?>
        <p>Geen verkooporder gekozen.</p>
    <?php } ?>
</div>

</body>
</html>