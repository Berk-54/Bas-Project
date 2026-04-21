<?php
session_start();

require '../vendor/autoload.php';

use Bas\classes\Werknemer;

$werknemer = new Werknemer();
$werknemer->logout();

header('Location: login.php');
exit;
?>