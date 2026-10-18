<?php
// Auteur : Hafida Zbair
// Objectif : afficher un message de bienvenue à partir des données GET
// Date : 18/10/2026
require 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

if (isset($_GET['nom'], $_GET['prenom'], $_GET['sexe'])
    && trim($_GET['nom']) !== '' && trim($_GET['prenom']) !== '') {
    $civilite = ($_GET['sexe'] === 'F') ? 'Madame' : 'Monsieur';
    $prenom = htmlspecialchars($_GET['prenom']);
    $nom = htmlspecialchars($_GET['nom']);
    echo "<p>Bonjour $civilite $prenom $nom</p>";
} else {
    echo '<p class="rouge">Données manquantes. <a href="info.html">Retour</a></p>';
}

// Observation : après l'envoi, l'URL contient les données en clair :
// info.php?nom=...&prenom=...&sexe=M

include 'includes/pied_inc.php';