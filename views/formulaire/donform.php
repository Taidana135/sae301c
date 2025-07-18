<link rel="stylesheet" href="../CSS/dons-form.css">
<!--Liste des categories avec php -->
<form method="POST" action="">
    <h2>Don de produits</h2>
    <fieldset>
        <label for="categories_id">Catégorie :</label>
        <select name="categories_id" id="categories_id" >
            <?php foreach($categories as $categorie): ?>
            <option value="<?= $categorie['id'] ?>">
                <?= $categorie['categories_nom'] ?>
            </option>
            <?php endforeach ?>
        </select>

        <label for="titre">Nom du produit :</label>
        <input type="text" name="titre" id="titre" >

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" min="1" >

        <label for="desc1">Description :</label>
        <textarea name="desc1" id="desc1"></textarea>

        <label for="desc2">Description complémentaire :</label>
        <textarea name="desc2" id="desc2"></textarea>

        <button type="submit" name="ajouter_produit">Ajouter un produit</button>

        <button type="submit" name="abandonner" style="background:#ccc;">Abandonner</button>
    </fieldset>
    
                    <button type="submit" name="valide-don">Valider</button>
    </form>
    <?php if (!empty($msg)): ?>
        <div class="alert" style="color:red;"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($liste_produits)): ?>
            <h3>Mes dons :</h3>
            <ul>
                <?php foreach($liste_produits as $prod): ?>
                    <li>
                        <?= htmlspecialchars($prod['titre']) ?> - <?= htmlspecialchars($prod['desc1']) ?>
                        (Catégorie: <?= htmlspecialchars($categoriesById[$prod['categories_id']] ?? $prod['categories_id']) ?>,
                Quantité: <?= htmlspecialchars($prod['quantite']) ?>)
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>



