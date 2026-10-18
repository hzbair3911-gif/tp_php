<?php
session_start();
// Auteur : Hafida Zbair
// Objectif : page protégée accessible uniquement aux utilisateurs connectés
// Date : 18/10/2026
// Accès sans connexion : redirection vers la page de login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Bienvenue <?= htmlspecialchars($_SESSION['login']) ?> !</h2>
<p><a href="deconnexion.php">Se déconnecter</a></p>

<h3>Validation d'une date</h3>
<form action="profil.php" method="get">
    <input type="number" name="jour" placeholder="Jour" min="1" max="31">
    <input type="number" name="mois" placeholder="Mois" min="1" max="12">
    <input type="number" name="annee" placeholder="Année">
    <input type="submit" value="Valider">
</form>
<?php
// Exercice 6.3 : validation avec checkdate(mois, jour, année)
if (isset($_GET['jour'], $_GET['mois'], $_GET['annee'])) {
    $j = (int) $_GET['jour'];
    $m = (int) $_GET['mois'];
    $a = (int) $_GET['annee'];
    if (checkdate($m, $j, $a)) {
        echo "<p>La date $j/$m/$a est valide.</p>";
    } else {
        echo "<p class=\"rouge\">La date $j/$m/$a n'est pas valide.</p>";
    }
}
include 'includes/pied_inc.php';