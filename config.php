<?php
// Auteur : Hafida Zbair
// Objectif : constantes globales de l'application et fonction mention()
// Date : 18/10/2026

// Constante définie avec const
const ETABLISSEMENT = "FSSM";

// Constantes définies avec define()
define('NOTE_MIN', 0);
define('NOTE_MAX', 20);
define('SEUIL', 10);

// Retourne la mention correspondant à une note (Exercice 2.1).
// La fonction est placée ici pour être réutilisée par plusieurs pages.
function mention($note)
{
    if ($note >= 16) {
        return 'Très bien';
    } elseif ($note >= 14) {
        return 'Bien';
    } elseif ($note >= 12) {
        return 'Assez bien';
    } elseif ($note >= SEUIL) {
        return 'Passable';
    } else {
        return 'Ajourné';
    }
}