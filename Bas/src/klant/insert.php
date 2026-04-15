<?php
// auteur: studentnaam
// functie: insert class Klant

require '../../vendor/autoload.php';

use Bas\classes\Klant;

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $klant = new Klant();
    $klant->insertKlant($_POST);

    echo '<script>alert("Klant toegevoegd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}
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
    <h2>Toevoegen</h2>
    <form method="post">
        <label for="nv">Klantnaam:</label>
        <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
        <br>

        <label for="an">Klantemail:</label>
        <input type="text" id="an" name="klantemail" placeholder="Klantemail" required/>
        <br>

        <label for="wp">Klantwoonplaats:</label>
        <input type="text" id="wp" name="klantwoonplaats" placeholder="Klantwoonplaats"/>
        <br><br>

        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>

    <a href='read.php'>Terug</a>

</body>
</html>