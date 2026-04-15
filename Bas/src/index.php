<?php
session_start();

if (!isset($_SESSION['gebruiker'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bas boodschappen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="logo">Bas</div>

    <div class="title">
        <h1>Bas boodschappen</h1>
        <h2>Homepagina</h2>
        <p>Welkom <?php echo htmlspecialchars($_SESSION['gebruiker']); ?></p>
        <p>Rol: <?php echo htmlspecialchars($_SESSION['rol']); ?></p>
    </div>

    <?php include 'includes/menu.php'; ?>
</div>
</body>
</html>