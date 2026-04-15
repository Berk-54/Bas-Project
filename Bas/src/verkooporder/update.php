<?php
// auteur: studentnaam
// functie: verkooporder wijzigen

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();
$klanten = $verkooporder->getKlantenVoorDropdown();
$artikelen = $verkooporder->getArtikelenVoorDropdown();

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    if ($verkooporder->updateVerkooporder($_POST)) {
        echo '<script>alert("Verkooporder gewijzigd")</script>';
        echo "<script> location.replace('read.php'); </script>";
    } else {
        $error = "Fout bij wijzigen verkooporder";
    }
}

if (isset($_GET['verkOrdId'])) {
    $row = $verkooporder->getVerkooporder((int)$_GET['verkOrdId']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporder wijzigen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Verkooporder wijzigen</h2>
    </div>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="post" class="form-box">
        <input type="hidden" name="verkOrdId" value="<?php echo $row['verkOrdId']; ?>">

        <div class="row">
            <label>Klant :</label>
            <select name="klantId" required>
                <?php foreach ($klanten as $klant) { ?>
                    <option value="<?php echo $klant['klantId']; ?>"
                        <?php if ($klant['klantId'] == $row['klantId']) { echo "selected"; } ?>>
                        <?php echo htmlspecialchars($klant['klantNaam']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="row">
            <label>Artikel :</label>
            <select name="artId" required>
                <?php foreach ($artikelen as $artikel) { ?>
                    <option value="<?php echo $artikel['artId']; ?>"
                        <?php if ($artikel['artId'] == $row['artId']) { echo "selected"; } ?>>
                        <?php echo htmlspecialchars($artikel['artOmschrijving']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="row">
            <label>Datum :</label>
            <input type="date" name="verkOrdDatum" value="<?php echo htmlspecialchars($row['verkOrdDatum']); ?>" required>
        </div>

        <div class="row">
            <label>Aantal :</label>
            <input type="number" name="verkOrdBestAantal" min="1" value="<?php echo htmlspecialchars($row['verkOrdBestAantal']); ?>" required>
        </div>

        <div class="row">
            <label>Status :</label>
            <select name="verkOrdStatus" required>
                <option value="1" <?php if ($row['verkOrdStatus'] == 1) echo "selected"; ?>>Genoteerd</option>
                <option value="2" <?php if ($row['verkOrdStatus'] == 2) echo "selected"; ?>>Wordt verzameld</option>
                <option value="3" <?php if ($row['verkOrdStatus'] == 3) echo "selected"; ?>>Bij bezorger</option>
                <option value="4" <?php if ($row['verkOrdStatus'] == 4) echo "selected"; ?>>Afgeleverd</option>
            </select>
        </div>

        <div class="buttons">
            <input class="btn" type="submit" name="update" value="Wijzigen">
            <a class="btn" href="read.php">Annuleren</a>
        </div>
    </form>
</div>

</body>
</html>
<?php
} else {
    echo "Geen verkOrdId opgegeven";
}
?>