<?php
// Auteur : Tarek Zbair
// Objectif : exporter les résultats en JSON et comparer serialize() et json_encode()
// Date : 18/10/2026
require 'config.php';
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$csv = __DIR__ . '/data/notes.csv';
$json_fichier = __DIR__ . '/data/notes.json';

echo '<h2>Export JSON</h2>';

if (!file_exists($csv)) {
    echo '<p class="rouge">Aucune note à exporter.</p>';
    include 'includes/pied_inc.php';
    exit;
}

// 1. Construction du tableau associatif des résultats
$resultats = [];
$f = fopen($csv, 'r');
while (($l = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
    if (count($l) < 3) {
        continue;
    }
    $resultats[] = [
        'nom'     => $l[0],
        'info'    => (float) $l[1],
        'math'    => (float) $l[2],
        'moyenne' => ($l[1] + $l[2]) / 2,
    ];
}
fclose($f);

// 2. Écriture dans notes.json
$json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($json_fichier, $json);
echo '<p>Fichier data/notes.json écrit (' . count($resultats) . ' apprenants).</p>';

// 3. Relecture et affichage avec print_r
$lu = json_decode(file_get_contents($json_fichier), true);
echo '<h3>Relu avec json_decode + print_r</h3><pre>';
print_r($lu);
echo '</pre>';

// 4. Comparaison serialize() / json_encode()
echo '<h3>serialize()</h3><pre>' . htmlspecialchars(serialize($resultats)) . '</pre>';
echo '<h3>json_encode()</h3><pre>'
    . htmlspecialchars(json_encode($resultats, JSON_UNESCAPED_UNICODE)) . '</pre>';

// Question : quel format est directement exploitable par JavaScript ?
// Réponse : JSON (JSON.parse, fetch...). serialize() est un format propre à PHP,
// lisible seulement avec unserialize() en PHP.

include 'includes/pied_inc.php';