<?php
session_start();

require '../../vendor/autoload.php';

use Bas\classes\Artikel;
use Bas\classes\Werknemer;

$werknemer = new Werknemer();

if (!$werknemer->isIngelogd()) {
    header('Location: ../login.php');
    exit;
}

$artikel = new Artikel();
$lijst = $artikel->getArtikelen();
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

    <?php include '../includes/menu.php'; ?>

    <div class="buttons">
        <a class="btn" href="insert.php">Nieuw artikel</a>
    </div>

    <?php if (!empty($lijst)) { ?>
        <table>
            <tr>
                <th>Omschrijving</th>
                <th>Inkoop</th>
                <th>Verkoop</th>
                <th>Voorraad</th>
                <th>Locatie</th>
                <th>Acties</th>
            </tr>

            <?php foreach ($lijst as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['artOmschrijving']); ?></td>
                    <td><?php echo htmlspecialchars($row['artInkoop']); ?></td>
                    <td><?php echo htmlspecialchars($row['artVerkoop']); ?></td>
                    <td><?php echo htmlspecialchars($row['artVoorraad']); ?></td>
                    <td><?php echo htmlspecialchars($row['artLocatie']); ?></td>
                    <td class="action-cell">
                        <form class="inline-form" method="post" action="update.php?artId=<?php echo $row['artId']; ?>">
                            <button name="update">Wzg</button>
                        </form>

                        <form class="inline-form" method="post" action="delete.php?artId=<?php echo $row['artId']; ?>">
                            <button name="verwijderen">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Geen artikelen gevonden.</p>
    <?php } ?>
</div>

</body>
</html>