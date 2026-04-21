<?php
session_start();

require '../../vendor/autoload.php';

use Bas\classes\Klant;
use Bas\classes\Werknemer;

$werknemer = new Werknemer();

if (!$werknemer->isIngelogd()) {
    header('Location: ../login.php');
    exit;
}

$klant = new Klant();
$lijst = $klant->getKlanten();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Klant zoeken</h2>
    </div>

    <?php include '../includes/menu.php'; ?>

    <div class="buttons">
        <a class="btn" href="insert.php">Nieuwe klant</a>
    </div>

    <?php if (!empty($lijst)) { ?>
        <table>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Woonplaats</th>
                <th>Acties</th>
            </tr>

            <?php foreach ($lijst as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['klantNaam']); ?></td>
                    <td><?php echo htmlspecialchars($row['klantEmail']); ?></td>
                    <td><?php echo htmlspecialchars($row['klantWoonplaats']); ?></td>
                    <td class="action-cell">
                        <form class="inline-form" method="post" action="update.php?klantId=<?php echo $row['klantId']; ?>">
                            <button name="update">Wzg</button>
                        </form>

                        <form class="inline-form" method="post" action="delete.php?klantId=<?php echo $row['klantId']; ?>">
                            <button name="verwijderen">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Geen klanten gevonden.</p>
    <?php } ?>
</div>

</body>
</html>