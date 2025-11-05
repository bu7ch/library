<?php
/** @var \App\Model\Livre $livre */
?>
<h2><?= htmlspecialchars($livre->getTitre()) ?></h2>
<p><strong>Auteur :</strong> <?= htmlspecialchars($livre->getAuteur()) ?></p>
<p><strong>Année :</strong> <?= $livre->getAnnee() ?></p>
<a href="/livres">← Retour à la liste</a>