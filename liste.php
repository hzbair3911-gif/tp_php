<?php

require 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$fichier = __DIR__ . '/data/notes.csv';

echo '<h2>Liste des notes</h2>';

// 1. Le fichier existe-t-il ?
if (!file_exists($fichier)) {
    echo '<p class="rouge">Aucune note enregistrée. <a href="saisie.html">Saisir des notes</a></p>';
    include 'includes/pied_inc.php';
    exit;
}

// 2. Ouverture en lecture et gestion de l'échec
$f = fopen($fichier, 'r');
if ($f === false) {
    echo '<p class="rouge">Erreur : impossible d\'ouvrir le fichier.</p>';
    include 'includes/pied_inc.php';
    exit;
}

// 3 et 4. Lecture ligne par ligne avec fgetcsv() et affichage dans un tableau
$somme_moyennes = 0;
$nb = 0;
echo '<table><tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>';
while (($ligne = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
    if (count($ligne) < 3) {
        continue;   // ligne vide
    }
    list($nom, $info, $math) = $ligne;
    $moyenne = ($info + $math) / 2;
    $somme_moyennes += $moyenne;
    $nb++;
    $classe = ($moyenne < SEUIL) ? ' class="rouge"' : '';
    echo "<tr$classe><td>" . htmlspecialchars($nom) . "</td><td>$info</td><td>$math</td><td>"
        . number_format($moyenne, 2) . '</td><td>' . mention($moyenne) . '</td></tr>';
}
fclose($f);
echo '</table>';

// 5. Moyenne générale de la classe
if ($nb > 0) {
    echo '<p><b>Moyenne générale de la classe : '
        . number_format($somme_moyennes / $nb, 2) . " ($nb apprenants)</b></p>";
}

// ---- Exercice 5.3 : lecture "bas niveau" avec fgets, feof, explode ----
echo '<h2>Même fichier avec fgets() / feof() / explode()</h2>';
$f = fopen($fichier, 'r');
echo '<ul>';
while (!feof($f)) {
    $ligne = fgets($f);
    if ($ligne === false) {
        break;
    }
    $ligne = trim($ligne);
    if ($ligne === '') {
        continue;
    }
    $champs = explode(';', $ligne);
    echo '<li>' . htmlspecialchars(implode(' | ', $champs)) . '</li>';
}
echo '</ul>';
fclose($f);

// Comparaison :
// fgets + explode : simple, contrôle total, mais il faut gérer à la main les sauts
// de ligne et les lignes vides, et cela casse si une valeur contient le séparateur ";"
// ou des guillemets.
// fgetcsv : découpe directement la ligne en tableau et gère correctement les guillemets
// et les séparateurs dans les valeurs, mais il faut préciser le séparateur et gérer
// la ligne vide (qui retourne un tableau contenant null).

include 'includes/pied_inc.php';