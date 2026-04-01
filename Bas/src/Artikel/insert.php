<?php
// auteur: studentnaam
// functie: home page CRUD Artikel

require '../../vendor/autoload.php';

use Bas\classes\Artikel;

$artikel = new Artikel();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Artikel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Artikelen</h2>
    </div>

    <div class="buttons">
        <a class="btn" href="../index.html">Home</a>
        <a class="btn" href="insert.php">Nieuw artikel</a>
    </div>

    <?php
    $artikel->crudArtikel();
    ?>
</div>

</body>
</html>