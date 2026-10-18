<?php
// Auteur : Hafida Zbair
// Objectif : pied de page commun (date du jour, jours restants avant la fin du semestre)
// Date : 18/10/2026

// Date du jour au format 14/10/2026
$date_jour = date('d/m/Y');

// Nombre de jours restants avant la fin du semestre (date à adapter)
$aujourdhui = new DateTime('today');
$fin_semestre = new DateTime('2027-02-31');
$diff = $aujourdhui->diff($fin_semestre);
$jours_restants = $diff->invert ? 0 : $diff->days;
?>
<footer>
    <p>Date du jour : <?= $date_jour ?> |
       Jours restants avant la fin du semestre (<?= $fin_semestre->format('d/m/Y') ?>) :
       <?= $jours_restants ?></p>
</footer>
</body>
</html>