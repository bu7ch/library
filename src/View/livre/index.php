<?php
/** @var \App\Model\Livre[] $livres */
?>
<p><a href="/livres/create">➕ Ajouter un livre</a></p>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($livres as $l): ?>
        <tr>
            <td><?= htmlspecialchars($l->getTitre()) ?></td>
            <td><?= htmlspecialchars($l->getAuteur()) ?></td>
            <td><?= $l->getAnnee() ?></td>
            <td>
                <a href="/livres/<?= $l->getId() ?>">👁️</a>
                <a href="/livres/<?= $l->getId() ?>/edit">✏️</a>
                <a href="/livres/<?= $l->getId() ?>/delete" onclick="return confirm('Supprimer ?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>