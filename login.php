<?php
session_start();

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    if ($login === '') {
        $erreur = 'Veuillez saisir un login.';
    } else {
        $_SESSION['login'] = $login;

        // Cookie valable 24 heures
        setcookie('dernier_login', $login, time() + 86400, '/');

        // Variante : un seul cookie contenant un tableau (login + date) en JSON
        setcookie('infos_connexion',
            json_encode(['login' => $login, 'date' => date('d/m/Y H:i')]),
            time() + 86400, '/');

        header('Location: profil.php');
        exit;
    }
}

// Pré-remplissage du champ login avec le cookie
$dernier_login = $_COOKIE['dernier_login'] ?? '';
// Relecture du cookie JSON
$infos = isset($_COOKIE['infos_connexion'])
    ? json_decode($_COOKIE['infos_connexion'], true) : null;

include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Connexion</h2>
<?php if ($erreur !== ''): ?>
    <p class="rouge"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>
<form action="login.php" method="post">
    <p><label>Login :
        <input type="text" name="login" value="<?= htmlspecialchars($dernier_login) ?>">
    </label></p>
    <p><input type="submit" value="Se connecter"></p>
</form>
<?php if (is_array($infos)): ?>
    <p>Dernière connexion : <?= htmlspecialchars($infos['login'] ?? '') ?>
       le <?= htmlspecialchars($infos['date'] ?? '') ?></p>
<?php endif; ?>
<?php
// Question 1 : où est stockée une session ? où est stocké un cookie ?
// Réponse : la session est stockée côté serveur (le navigateur ne garde que
// l'identifiant PHPSESSID). Le cookie est stocké côté navigateur (client).

// Question 2 : pourquoi setcookie() et header() doivent-ils être appelés avant tout affichage ?
// Réponse : ils envoient des en-têtes HTTP, qui précèdent le corps de la réponse.
// Dès qu'on affiche quelque chose, les en-têtes sont déjà partis
// (erreur "headers already sent").
include 'includes/pied_inc.php';