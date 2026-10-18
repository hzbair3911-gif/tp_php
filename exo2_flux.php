<?php

header('Content-Type: text/html; charset=utf-8');
require 'config.php';   // contient SEUIL et la fonction mention()

// ---- Exercice 2.1 : if / elseif / else ----
echo '<h2>2.1 mention()</h2>';
foreach ([18, 16, 15, 14, 12, 10, 9.5, 0] as $n) {
    echo "Note $n : " . mention($n) . '<br>';
}

// ---- Exercice 2.2 : switch ----
echo '<h2>2.2 switch</h2>';
$mois = (int) date("m");
switch ($mois) {
    case 1:  $nom_mois = 'Janvier';   break;
    case 2:  $nom_mois = 'Février';   break;
    case 3:  $nom_mois = 'Mars';      break;
    case 4:  $nom_mois = 'Avril';     break;
    case 5:  $nom_mois = 'Mai';       break;
    case 6:  $nom_mois = 'Juin';      break;
    case 7:  $nom_mois = 'Juillet';   break;
    case 8:  $nom_mois = 'Août';      break;
    case 9:  $nom_mois = 'Septembre'; break;
    case 10: $nom_mois = 'Octobre';   break;
    case 11: $nom_mois = 'Novembre';  break;
    case 12: $nom_mois = 'Décembre';  break;
    default: $nom_mois = 'Mois inconnu';
}
echo "Nous sommes en $nom_mois.<br>";

// Question : que se passe-t-il si on oublie un break dans un case ?
// Réponse : l'exécution continue dans le case suivant (fall-through),
// jusqu'au prochain break ou à la fin du switch.

// ---- Exercice 2.3 : boucles ----
echo '<h2>2.3 Boucles</h2>';

// 1. Triangle avec deux for imbriqués
echo '<h3>Triangle</h3><pre>';
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo '*';
    }
    echo "\n";
}
echo '</pre>';

// 2. while : de 0 à 20 par pas de 2, la valeur 10 en gras
echo '<h3>while</h3>';
$i = 0;
while ($i <= 20) {
    if ($i == 10) {
        echo "<b>$i</b> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}

// 3. for + continue : uniquement les nombres pairs de 0 à 10
echo '<h3>for + continue</h3>';
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        continue;   // on saute les nombres impairs
    }
    echo "$i ";
}

// 4. while + switch + break 2
echo '<h3>break 2</h3>';
$i = 1;
while (true) {
    switch ($i) {
        case 5:
            echo 'At 5<br>';
            break;          // sort seulement du switch
        case 10:
            echo 'At 10; quitting<br>';
            break 2;        // sort du switch ET de la boucle while
        default:
            break;
    }
    $i++;
}

// 5. do-while : même affichage que la question 2
echo '<h3>do-while</h3>';
$i = 0;
do {
    if ($i == 10) {
        echo "<b>$i</b> ";
    } else {
        echo "$i ";
    }
    $i += 2;
} while ($i <= 20);

// Différence essentielle : do-while teste la condition APRÈS le corps,
// donc le corps s'exécute au moins une fois. while teste AVANT :
// le corps peut ne jamais s'exécuter.