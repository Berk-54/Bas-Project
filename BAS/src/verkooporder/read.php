<?php
session_start();

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;
use Bas\classes\Werknemer;

$werknemer = new Werknemer();

if (!$werknemer->isIngelogd()) {
    header('Location: ../login.php');
    exit;
}

$verkooporder = new Verkooporder();
$lijst = $verkooporder->getVerkooporders();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Verkooporders</h2>
    </div>

    <?php include '../includes/menu.php'; ?>

    <div class="buttons">
        <a class="btn" href="insert.php">Nieuwe verkooporder</a>
    </div>

    <?php if (!empty($lijst)) { ?>
        <table>
            <tr>
                <th>Klant</th>
                <th>Artikel</th>
                <th>Datum</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>

            <?php foreach ($lijst as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['klantNaam']); ?></td>
                    <td><?php echo htmlspecialchars($row['artOmschrijving']); ?></td>
                    <td><?php echo htmlspecialchars($row['verkOrdDatum']); ?></td>
                    <td><?php echo htmlspecialchars($row['verkOrdBestAantal']); ?></td>
                    <td>
                        <?php
                        switch ((int)$row['verkOrdStatus']) {
                            case 1:
                                echo 'Genoteerd';
                                break;
                            case 2:
                                echo 'Wordt verzameld';
                                break;
                            case 3:
                                echo 'Bij bezorger';
                                break;
                            case 4:
                                echo 'Afgeleverd';
                                break;
                            default:
                                echo 'Onbekend';
                        }
                        ?>
                    </td>
                    <td class="action-cell">
                        <form class="inline-form" method="post" action="update.php?verkOrdId=<?php echo $row['verkOrdId']; ?>">
                            <button name="update">Wzg</button>
                        </form>

                        <form class="inline-form" method="post" action="delete.php?verkOrdId=<?php echo $row['verkOrdId']; ?>">
                            <button name="verwijderen">Verwijderen</button>
                        </form>

                        <form class="inline-form" method="get" action="status.php">
                            <input type="hidden" name="verkOrdId" value="<?php echo $row['verkOrdId']; ?>">
                            <button name="status">Status</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Geen verkooporders gevonden.</p>
    <?php } ?>
</div>

</body>
</html>