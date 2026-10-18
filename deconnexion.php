<?php
session_start();   // nécessaire pour accéder à la session existante
// Auteur : Hafida zbair
// Objectif : déconnexion, destruction de la session puis redirection vers login.php
// Date : 18/10/2026

session_unset();     // vide les variables de session
session_destroy();   // détruit la session
header('Location: login.php');
exit;