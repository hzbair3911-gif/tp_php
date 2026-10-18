<?php
// Auteur : Hafida Zbair
// Objectif : bases de PHP (commentaires, variables, constantes, types, chaînes)
// Date : 18/10/2026
header('Content-Type: text/html; charset=utf-8');
require 'config.php';

echo 'Hello PHP<br>';   // commentaire sur une ligne avec //
# commentaire sur une ligne avec #
/* commentaire
   sur plusieurs lignes */

// ---- Exercice 1.1 : noms de variables ----
echo '<h2>1.1 Noms de variables</h2>';

// $x : valide (commence par une lettre)
$x = 1;

// $_x : valide (commence par un underscore)
$_x = 2;

// $2x : INVALIDE (ne peut pas commencer par un chiffre)

// $x-y : INVALIDE (le tiret est interprété comme l'opérateur moins)

// $Prix_HT : valide (lettres et underscore)
$Prix_HT = 100;

// $prix ht : INVALIDE (les espaces sont interdits)

// $état : valide (PHP accepte les caractères accentués)
$état = 'ok';

echo "Variables valides : $x, $_x, $Prix_HT, $état<br>";

// $a et $A sont deux variables distinctes (PHP est sensible à la casse)
$a = 'minuscule';
$A = 'MAJUSCULE';
echo "a = $a et A = $A<br>";

// ---- Exercice 1.2 : constantes ----
echo '<h2>1.2 Constantes</h2>';
echo 'ETABLISSEMENT = ' . ETABLISSEMENT . '<br>';
echo 'NOTE_MIN = ' . NOTE_MIN . '<br>';
echo 'NOTE_MAX = ' . NOTE_MAX . '<br>';
echo 'SEUIL = ' . SEUIL . '<br>';

echo "defined('SEUIL') : ";
var_dump(defined('SEUIL'));
echo '<br>';

echo "defined('INCONNUE') : ";
var_dump(defined('INCONNUE'));
echo '<br>';

// Q1 : que se passe-t-il si on affiche une constante non définie ?
//      En PHP 8, cela provoque une erreur fatale (Undefined constant)
//      et le script s'arrête. En PHP 7, c'était un simple avertissement.

// Q2 : différence entre const et define() ?
//      const est évaluée à la compilation et doit être écrite au niveau global
//      (pas dans un if ni dans une fonction).
//      define() est évaluée à l'exécution : on peut l'utiliser dans un if
//      ou avec un nom de constante calculé.

// ---- Exercice 1.3 : calcul du prix TTC ----
echo '<h2>1.3 Calcul</h2>';
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "Le prix TTC du produit est de $prix_ttc €.<br>";

// ---- Exercice 1.4 : types et conversions ----
echo '<h2>1.4 Types et conversions</h2>';
echo '<pre>';

// 1. Cast int -> string
$test = 42;
$test = (string) $test;
var_dump($test);            // string(2) "42"

// 2. Conversions en booléen (prédictions en commentaire)
var_dump((bool) 0);         // false
var_dump((bool) 0.0);       // false
var_dump((bool) "0");       // false
var_dump((bool) "");        // false
var_dump((bool) "abc");     // true
var_dump((bool) []);        // false
var_dump((bool) null);      // false

// 3. Conversions numériques
var_dump((int) 3.9);        // int(3) : troncature, pas d'arrondi
var_dump((int) "12abc");    // int(12) : lit les chiffres du début
var_dump((float) "1.5e3");  // float(1500)
var_dump((int) true);       // int(1)
echo '</pre>';

// 4. Le nombre 255 en quatre notations
$decimal = 255;
$hexa = 0xFF;
$octal = 0377;
$binaire = 0b11111111;
echo "Décimal : $decimal<br>";
echo "Hexadécimal : $hexa<br>";
echo "Octal : $octal<br>";
echo "Binaire : $binaire<br>";
// Les quatre affichent 255 : seule l'écriture change, pas la valeur.

// ---- Exercice 1.5 : chaînes de caractères ----
echo '<h2>1.5 Chaînes de caractères</h2>';
$traitees = "égales à";
$ici = 2;

// 1. Guillemets simples : on échappe l'apostrophe avec \'
echo 'Ahmed a dit : "J\'ai réussi"<br>';

// 2. Guillemets simples : \* reste tel quel
echo 'Voulez-vous supprimer C:\*.*?<br>';

// 3. Guillemets simples : \n n'est pas interprété
echo 'Ceci n\'affichera pas \n de nouvelle ligne<br>';

// 4. Guillemets simples : les variables ne sont pas interprétées
echo 'Les variables ne seront pas $traitees $ici<br>';

// 5. Guillemets doubles : les variables sont interprétées
echo "Les variables seront $traitees $ici<br>";

// trim() retire les * au début et à la fin
$texte = trim("*Bonjour les développeurs*", "*");
echo "Après trim : $texte<br>";

// Une lettre par ligne.
// Remarque : strlen() compte des octets et "é" occupe 2 octets en UTF-8.
// On utilise donc mb_strlen() et mb_substr() pour ne pas couper le "é".
for ($i = 0; $i < mb_strlen($texte); $i++) {
    echo mb_substr($texte, $i, 1) . '<br>';
}