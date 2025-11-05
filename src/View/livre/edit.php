<?php
/** @var \App\Model\Livre $livre */
/** @var array $errors */
?>
<h2>Modifier un livre</h2>

<?php if (!empty($errors)): ?>
    <ul style="color:red">
    <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/livres/<?= $livre->getId() ?>/update" method="post">
    <label>Titre :<br>
        <input type="text" name="titre"
               value="<?= htmlspecialchars($_POST['titre'] ?? $livre->getTitre()) ?>" required>
    </label><br>

    <label>Auteur :<br>
        <input type="text" name="auteur"
               value="<?= htmlspecialchars($_POST['auteur'] ?? $livre->getAuteur()) ?>" required>
    </label><br>

    <label>Année :<br>
        <input type="number" name="annee" min="0" max="2100"
               value="<?= htmlspecialchars($_POST['annee'] ?? $livre->getAnnee()) ?>">
    </label><br>

    <button type="submit">Sauvegarder</button>
    <a href="/livres">Annuler</a>
</form>