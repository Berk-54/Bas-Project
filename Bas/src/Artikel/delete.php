<?php
// auteur: studentnaam
// functie: update class Artikel

require '../../vendor/autoload.php';

use Bas\classes\Artikel;

$artikel = new Artikel();

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    $artikel->updateArtikel($_POST);

    echo '<script>alert("Artikel gewijzigd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}

if (isset($_GET['artId'])) {
    $row = $artikel->getArtikel((int)$_GET['artId']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel wijzigen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Artikel wijzigen</h2>
    </div>

    <form method="post" class="form-box">
        <input type="hidden" name="artId" value="<?php echo $row['artId']; ?>">

        <div class="row">
            <label>Omschrijving :</label>
            <input type="text" name="artOmschrijving" value="<?php echo $row['artOmschrijving']; ?>" required>
        </div>

        <div class="row">
            <label>Inkoopprijs :</label>
            <input type="text" name="artInkoop" value="<?php echo $row['artInkoop']; ?>" required>
        </div>

        <div class="row">
            <label>Verkoopprijs :</label>
            <input type="text" name="artVerkoop" value="<?php echo $row['artVerkoop']; ?>" required>
        </div>

        <div class="row">
            <label>Voorraad :</label>
            <input type="text" name="artVoorraad" value="<?php echo $row['artVoorraad']; ?>" required>
        </div>

        <div class="row">
            <label>Min voorraad :</label>
            <input type="text" name="artMinVoorraad" value="<?php echo $row['artMinVoorraad']; ?>" required>
        </div>

        <div class="row">
            <label>Max voorraad :</label>
            <input type="text" name="artMaxVoorraad" value="<?php echo $row['artMaxVoorraad']; ?>" required>
        </div>

        <div class="row">
            <label>Locatie :</label>
            <input type="text" name="artLocatie" value="<?php echo $row['artLocatie']; ?>" required>
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
    echo "Geen artId opgegeven<br>";
}
?>