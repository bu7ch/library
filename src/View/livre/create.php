<?php
/** @var array $errors (facultatif) */
?>
<h2>Ajouter un livre</h2>

<?php if (!empty($errors)): ?>
    <ul style="color:red">
    <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/livres/store" method="post">
    <label>Titre :<br>
        <input type="text" name="titre" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>
    </label><br>

    <label>Auteur :<br>
        <input type="text" name="auteur" value="<?= htmlspecialchars($_POST['auteur'] ?? '') ?>" required>
    </label><br>

    <label>Année :<br>
        <input type="number" name="annee" min="0" max="2100"
               value="<?= htmlspecialchars($_POST['annee'] ?? '') ?>">
    </label><br>

    <button type="submit">Enregistrer</button>
    <a href="/livres">Annuler</a>
</form>