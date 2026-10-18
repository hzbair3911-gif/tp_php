<?php
// Auteur : Hafida Zbair
// Objectif : valider les données POST et les enregistrer dans data/notes.csv
// Date : 18/10/2026
require 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $erreurs[] = 'Veuillez passer par le formulaire de saisie.';
} else {
    // isset() : le champ existe ; empty() : il n'est pas vide
    if (!isset($_POST['nom']) || empty(trim($_POST['nom']))) {
        $erreurs[] = 'Le nom est obligatoire.';
    }
    // Pour les notes on teste === '' car empty("0") vaut true et 0 est une note valide
    foreach (['note_info' => 'info', 'note_math' => 'math'] as $champ => $libelle) {
        if (!isset($_POST[$champ]) || trim($_POST[$champ]) === '') {
            $erreurs[] = "La note de $libelle est obligatoire.";
        } elseif (!is_numeric($_POST[$champ])) {
            $erreurs[] = "La note de $libelle doit être un nombre.";
        } elseif ($_POST[$champ] < NOTE_MIN || $_POST[$champ] > NOTE_MAX) {
            $erreurs[] = "La note de $libelle doit être comprise entre " . NOTE_MIN . ' et ' . NOTE_MAX . '.';
        }
    }
}

if (empty($erreurs)) {
    $nom = trim($_POST['nom']);
    $note_info = (float) $_POST['note_info'];
    $note_math = (float) $_POST['note_math'];

    // Exercice 5.1 : ajout d'une ligne dans le fichier CSV (mode "a" = ajout)
    $f = fopen(__DIR__ . '/data/notes.csv', 'a');
    if ($f === false) {
        echo '<p class="rouge">Impossible d\'ouvrir data/notes.csv.</p>';
    } else {
        fputcsv($f, [$nom, $note_info, $note_math], ';', '"', '\\');
        fclose($f);
    }

    $moyenne = ($note_info + $note_math) / 2;
    echo '<h2>Récapitulatif</h2><ul>';
    echo '<li>Nom : ' . htmlspecialchars($nom) . '</li>';
    echo "<li>Note info : $note_info</li>";
    echo "<li>Note math : $note_math</li>";
    echo '<li>Moyenne : ' . round($moyenne, 2) . ' (' . mention($moyenne) . ')</li>';
    echo '</ul>';
    echo '<p><a href="saisie.html">Saisir un autre apprenant</a> | <a href="liste.php">Voir la liste</a></p>';
} else {
    echo '<h2 class="rouge">Erreur de saisie</h2><ul>';
    foreach ($erreurs as $e) {
        echo '<li class="rouge">' . htmlspecialchars($e) . '</li>';
    }
    echo '</ul><p><a href="saisie.html">Retour au formulaire</a></p>';
}

// Question : pourquoi préférer POST à GET pour un mot de passe ?
// Réponse : avec POST les données sont dans le corps de la requête, elles
// n'apparaissent ni dans l'URL, ni dans l'historique, ni dans les favoris.
// (Cela ne remplace pas HTTPS, qui chiffre réellement la transmission.)

// Question : que contient $_REQUEST ?
// Réponse : le contenu de $_GET, $_POST et $_COOKIE.

// Question (5.1) : que se passerait-il avec le mode "w" au lieu de "a" ?
// Réponse : le fichier serait vidé à chaque ouverture, seule la dernière
// ligne saisie resterait. Le mode "a" ajoute à la fin sans effacer.

include 'includes/pied_inc.php';