<?php
setcookie('rememberMe', '', time() - 3600, '/');

session_start();
session_unset();
session_destroy();
$_SESSION = array();

// On prévient que l'utillisateur est deconnecté
echo '<script>alert("Vous vous êtes déconnecté");</script>';


// Redirection vers la page des ouvrages
echo '<script>window.location.href = "../ouvrages.php";</script>';
