<?php
// Auteur : Hafida Zbair
// Objectif : tableaux (création, affichage, statistiques, tri, opérateurs) et includes
// Date : 18/10/2026
require 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

// ---- Exercice 3.1 : création ----
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ['Algorithmique', 'Base de données', 'PHP'];

echo '<h2>3.1 Modules</h2>';
echo '<p>Avec foreach :</p><ul>';
foreach ($modules as $m) {
    echo "<li>$m</li>";
}
echo '</ul><p>Par indice :</p><ul>';
for ($i = 0; $i < count($modules); $i++) {
    echo "<li>$i : $modules[$i]</li>";
}
echo '</ul>';

// ---- Exercice 3.2 : affichage HTML ----
echo '<h2>3.2 Notes des apprenants</h2>';
echo '<table><tr><th>Nom</th><th>Note</th><th>Mention</th></tr>';
foreach ($notes as $nom => $note) {
    $classe = ($note < SEUIL) ? ' class="rouge"' : '';
    echo "<tr$classe><td>$nom</td><td>$note</td><td>" . mention($note) . '</td></tr>';
}
echo '</table>';

// ---- Exercice 3.3 : statistiques ----
echo '<h2>3.3 Statistiques</h2>';

// 1. Sans array_sum : avec une boucle
$somme = 0;
$nb = 0;
$meilleure = NOTE_MIN;
$faible = NOTE_MAX;
foreach ($notes as $note) {
    $somme += $note;
    $nb++;
    if ($note > $meilleure) {
        $meilleure = $note;
    }
    if ($note < $faible) {
        $faible = $note;
    }
}
$moyenne = $somme / $nb;
echo "Boucle : somme = $somme, moyenne = " . round($moyenne, 2)
    . ", meilleure = $meilleure, plus faible = $faible<br>";

// 2. Vérification avec les fonctions natives
echo 'Natif : somme = ' . array_sum($notes)
    . ', moyenne = ' . round(array_sum($notes) / count($notes), 2)
    . ', max = ' . max($notes) . ', min = ' . min($notes) . '<br>';

// 3. Effectifs par mention
$effectifs = ['Très bien' => 0, 'Bien' => 0, 'Assez bien' => 0, 'Passable' => 0, 'Ajourné' => 0];
foreach ($notes as $note) {
    $effectifs[mention($note)]++;
}
echo '<ul>';
foreach ($effectifs as $m => $effectif) {
    echo "<li>$m : $effectif</li>";
}
echo '</ul>';

// ---- Exercice 3.4 : tri ----
function afficher($tab)
{
    echo '<table><tr><th>Nom</th><th>Note</th></tr>';
    foreach ($tab as $nom => $note) {
        echo "<tr><td>$nom</td><td>$note</td></tr>";
    }
    echo '</table>';
}

echo '<h2>3.4 Tri</h2>';

$t = $notes;
ksort($t);
echo '<h3>Noms croissants (ksort)</h3>';
afficher($t);

$t = $notes;
arsort($t);
echo '<h3>Notes décroissantes (arsort)</h3>';
afficher($t);

$t = $notes;
krsort($t);
echo '<h3>Noms décroissants (krsort)</h3>';
afficher($t);

$t = $notes;
asort($t);
echo '<h3>Notes croissantes (asort)</h3>';
afficher($t);

// Question : quelle fonction de tri pour un tableau indexé comme $modules ?
// Réponse : sort() (ordre croissant) ou rsort() (ordre décroissant).
sort($modules);
echo '<p>$modules triés avec sort() : ' . implode(', ', $modules) . '</p>';

// ---- Exercice 3.5 : opérateurs de tableaux ----
echo '<h2>3.5 Opérateurs de tableaux</h2>';
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];
echo '<pre>';
var_dump($a + $b);      // ["x"=>1, "y"=>2] : union des tableaux
var_dump($a == $b);     // true : mêmes paires clé/valeur
var_dump($a === $b);    // false : l'ordre est différent
echo '</pre>';
// Explication :
// +   : union (on garde les clés de $a, on ajoute celles de $b qui manquent)
// ==  : mêmes paires clé/valeur, sans tenir compte de l'ordre
// === : mêmes paires, même ordre et mêmes types

// ---- Exercice 4.1 : expériences (à tester une par une, puis remettre en commentaire) ----
// Expérience 1 : fichier inexistant
//   include 'includes/inexistant.php';  -> Warning, le reste du script s'exécute.
//   require 'includes/inexistant.php';  -> Fatal error, le script s'arrête.
// Expérience 2 : inclure deux fois le menu
//   include 'includes/menu_inc.php'; (deux fois)       -> le menu s'affiche deux fois.
//   include_once 'includes/menu_inc.php'; (deux fois)  -> le menu ne s'affiche qu'une fois.

include 'includes/pied_inc.php';