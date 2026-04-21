<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();
$klanten = $verkooporder->getKlantenVoorDropdown();
$artikelen = $verkooporder->getArtikelenVoorDropdown();

if (isset($_POST["insert"]) && $_POST["insert"] == "Opslaan") {
    if ($verkooporder->insertVerkooporder($_POST)) {
        echo '<script>alert("Verkooporder toegevoegd")</script>';
        echo "<script> location.replace('read.php'); </script>";
    } else {
        $error = "Fout bij toevoegen verkooporder";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe verkooporder</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Nieuwe verkooporder</h2>
    </div>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="post" class="form-box">
        <div class="row">
            <label>Klant :</label>
            <select name="klantId" required>
                <option value="">-- Kies klant --</option>
                <?php foreach ($klanten as $klant) { ?>
                    <option value="<?php echo $klant['klantId']; ?>">
                        <?php echo htmlspecialchars($klant['klantNaam']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="row">
            <label>Artikel :</label>
            <select name="artId" required>
                <option value="">-- Kies artikel --</option>
                <?php foreach ($artikelen as $artikel) { ?>
                    <option value="<?php echo $artikel['artId']; ?>">
                        <?php echo htmlspecialchars($artikel['artOmschrijving']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="row">
            <label>Datum :</label>
            <input type="date" name="verkOrdDatum" required>
        </div>

        <div class="row">
            <label>Aantal :</label>
            <input type="number" name="verkOrdBestAantal" min="1" required>
        </div>

        <div class="row">
            <label>Status :</label>
            <select name="verkOrdStatus" required>
                <option value="1">Genoteerd</option>
                <option value="2">Wordt verzameld</option>
                <option value="3">Bij bezorger</option>
                <option value="4">Afgeleverd</option>
            </select>
        </div>

        <div class="buttons">
            <input class="btn" type="submit" name="insert" value="Opslaan">
            <a class="btn" href="read.php">Annuleren</a>
        </div>
    </form>
</div>

</body>
</html>