<?php
// auteur: studentnaam
// functie: verkooporder verwijderen

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();

if (isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] == "Verwijderen") {
    if ($verkooporder->deleteVerkooporder((int)$_POST['verkOrdId'])) {
        echo '<script>alert("Verkooporder verwijderd")</script>';
        echo "<script> location.replace('read.php'); </script>";
    } else {
        $error = "Fout bij verwijderen verkooporder";
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
    <title>Verkooporder verwijderen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Verkooporder verwijderen</h2>
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
            <input type="text" value="<?php echo htmlspecialchars($row['klantNaam']); ?>" readonly>
        </div>

        <div class="row">
            <label>Artikel :</label>
            <input type="text" value="<?php echo htmlspecialchars($row['artOmschrijving']); ?>" readonly>
        </div>

        <div class="row">
            <label>Datum :</label>
            <input type="text" value="<?php echo htmlspecialchars($row['verkOrdDatum']); ?>" readonly>
        </div>

        <div class="row">
            <label>Aantal :</label>
            <input type="text" value="<?php echo htmlspecialchars($row['verkOrdBestAantal']); ?>" readonly>
        </div>

        <div class="row">
            <label>Status :</label>
            <input type="text" value="<?php
                switch ((int)$row['verkOrdStatus']) {
                    case 1: echo 'Genoteerd'; break;
                    case 2: echo 'Wordt verzameld'; break;
                    case 3: echo 'Bij bezorger'; break;
                    case 4: echo 'Afgeleverd'; break;
                    default: echo 'Onbekend';
                }
            ?>" readonly>
        </div>

        <div class="buttons">
            <input class="btn" type="submit" name="confirm_delete" value="Verwijderen">
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