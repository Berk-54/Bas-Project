<?php
// auteur: studentnaam
// functie: update class Klant

require '../../vendor/autoload.php';

use Bas\classes\Klant;

$klant = new Klant();

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    $klant->updateKlant($_POST);

    echo '<script>alert("Klant gewijzigd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}

if (isset($_GET['klantId'])) {
    $row = $klant->getKlant((int)$_GET['klantId']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>

<form method="post">
    <input type="hidden" name="klantId"
        value="<?php if (isset($row)) { echo $row['klantId']; } ?>">

    <input type="text" name="klantnaam" required
        value="<?php if (isset($row)) { echo $row['klantNaam']; } ?>"> *</br>

    <input type="text" name="klantemail" required
        value="<?php if (isset($row)) { echo $row["klantEmail"]; } ?>"> *</br></br>

    <input type="submit" name="update" value="Wijzigen">
</form>
</br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
} else {
    echo "Geen klantId opgegeven<br>";
}
?>