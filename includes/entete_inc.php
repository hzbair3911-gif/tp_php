<?php
// Auteur : Hafida Zbair
// Objectif : en-tête commun des pages (ouvre le HTML, titre avec ETABLISSEMENT)
// Date : 18/10/2026
require_once __DIR__ . '/../config.php';
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi des notes - <?= htmlspecialchars(ETABLISSEMENT) ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; }
        table { border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #999; padding: 6px 12px; }
        th { background: #eee; }
        .rouge { color: red; }
        nav a { margin-right: 12px; }
        footer { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 8px; color: #555; }
    </style>
</head>
<body>
<h1>Suivi des notes - <?= htmlspecialchars(ETABLISSEMENT) ?></h1>