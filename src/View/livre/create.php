<?php

$errors = $errors ?? [];
$results = $results ?? [];
?>
<h2>Ajouter un livre</h2>

<form method="get" action="/livres/create" class="ol-search">
    <input type="text"
           name="ol"
           placeholder="Titre, auteur, ISBN…"
           value="<?= htmlspecialchars($_GET['ol'] ?? '') ?>"
           required>
    <button type="submit">🔍 Open Library</button>
</form>

<?php if (!empty($results['docs'])): ?>
    <p><strong>Résultats Open Library :</strong></p>
    <ul class="ol-list">
    <?php foreach (array_slice($results['docs'], 0, 5) as $doc): ?>
        <?php
            $titre  = $doc['title']            ?? '';
            $auteur = $doc['author_name'][0]   ?? '';
            $annee  = $doc['first_publish_year'] ?? '';
        ?>
        <li>
            <a href="javascript:autoFill(
                '<?= htmlspecialchars(addslashes($titre)) ?>',
                '<?= htmlspecialchars(addslashes($auteur)) ?>',
                '<?= (int)$annee ?>'
            )">
                <?= htmlspecialchars($titre) ?>
                (<?= htmlspecialchars($auteur) ?>, <?= (int)$annee ?>)
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php elseif (isset($_GET['ol']) && empty($results['docs'])): ?>
    <p style="color:orange">Aucun résultat dans Open Library.</p>
<?php endif; ?>

<?php if ($errors): ?>
    <ul style="color:red">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/livres/store" method="post" id="bookForm">
    <label>Titre :<br>
        <input type="text"
               name="titre"
               value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>"
               required>
    </label><br>

    <label>Auteur :<br>
        <input type="text"
               name="auteur"
               value="<?= htmlspecialchars($_POST['auteur'] ?? '') ?>"
               required>
    </label><br>

    <label>Année :<br>
        <input type="number"
               name="annee"
               min="0"
               max="2100"
               value="<?= htmlspecialchars($_POST['annee'] ?? '') ?>">
    </label><br>

    <button type="submit">Enregistrer</button>
    <a href="/livres">Annuler</a>
</form>

<script>
function autoFill(titre, auteur, annee) {
    document.querySelector('[name=titre]').value = titre;
    document.querySelector('[name=auteur]').value = auteur;
    document.querySelector('[name=annee]').value  = annee;
}
</script>