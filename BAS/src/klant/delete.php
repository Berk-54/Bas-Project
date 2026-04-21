<?php
// auteur: studentnaam
// functie: delete class Klant

require '../../vendor/autoload.php';

use Bas\classes\Klant;

if (isset($_POST["verwijderen"])) {
    $klant = new Klant();
    $klant->deleteKlant((int)$_GET['klantId']);

    echo '<script>alert("Klant verwijderd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}
?>