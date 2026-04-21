<?php
session_start();

require '../vendor/autoload.php';

use Bas\classes\Werknemer;

$werknemer = new Werknemer();
$fout = '';

if (isset($_POST['login'])) {
    $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
    $wachtwoord = trim($_POST['wachtwoord'] ?? '');

    if ($werknemer->login($gebruikersnaam, $wachtwoord)) {
        header('Location: index.php');
        exit;
    } else {
        $fout = 'Onjuiste gebruikersnaam of wachtwoord';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login BAS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Inloggen</h2>
    </div>

    <?php if ($fout != '') { ?>
        <p class="error"><?php echo htmlspecialchars($fout); ?></p>
    <?php } ?>

    <form method="post" class="form-box">
        <div class="row">
            <label>Gebruikersnaam :</label>
            <input type="text" name="gebruikersnaam" required>
        </div>

        <div class="row">
            <label>Wachtwoord :</label>
            <input type="password" name="wachtwoord" required>
        </div>

        <div class="buttons">
            <input class="btn" type="submit" name="login" value="Login">
        </div>
    </form>

    <div class="result-box">
        <p><strong>Testaccounts:</strong></p>
        <p>magazijn / 1234</p>
        <p>bezorger / 1234</p>
        <p>verkoper / 1234</p>
        <p>inkoper / 1234</p>
    </div>
</div>
</body>
</html>