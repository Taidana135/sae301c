
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo['catalogue']; 
//$articles = $bo; // $categories = $bo['categories'];
//var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/catalogue-bo.css">

<div class="alert"><?= $msg!=1?$msg:"" ?></div>
<div class="objet">
    <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
    <form class="d-inline-block" method="POST" action="/backoffice2/create">
        <fieldset>
            <h2 class="titre">Créer un objet dans le catalogue</h2>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" required/>
            <label for="contenu">description 1 :</label>
            <textarea name="contenu" required></textarea>
            <label for="contenu2">description 2 :</label>
            <textarea name="contenu2" required></textarea>
            <label for="image">image :</label>
            <textarea name="image" required></textarea>
            <label for="visible">visible (0 si non, 1 si oui):</label>
            <select name="visible" id="visible" required>
                <option value="0">0</option>
                <option value="1">1</option>
            </select>
            

            <label for="categories_id">Catégorie :</label>
            <select name="categories_id" id="categories_id" required>
            <option value="0">0</option>
            <option value="1">1</option>

                <?php /*$first = true; var_dump($categories_id); foreach($categories_id as $categorie): ?>
                    <option value="<?= $categorie['categories_id'] ?>" <?= $first ? "selected" : "" ?>>
                        <?= $categorie['categories_id'] ?>
                    </option>
                    <?php $first = false; ?>
                <?php endforeach */ ?>
            </select>
            <input type="submit" name="maj" value="Créer"/>
        </fieldset>
    </form>
</div>

<h2 class="titre">Modifier les objets du catalogue :</h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">
    <fieldset>
    <label for="titre">Titre:</label>
    <input type="text" name="titre" value="<?= $item['titre'] ?>"/>

    <label for="contenu">description 1 :</label>
    <textarea name="desc1"><?= $item['desc1'] ?></textarea>

    <label for="contenu2">description 2 :</label>
    <textarea name="desc2"><?= $item['desc2'] ?></textarea>

    <label for="contenu2">image :</label>
    <input type="text" name="image" value="<?= $item['image'] ?>"/>

    <label for="visible">visible (0 si non, 1 si oui):</label>
        <select name="visible" id="visible">
            <option value="0">0</option>
            <option value="1">1</option>
        </select>
    
    <label for="categories_id">Catégorie:</label>
    <select name="categories_id">
    <option value="0">0</option>
    <option value="1">1</option>

    <?php /* foreach($categories as $categorie): ?>

    <option value="<?=$categorie['categories_id']?>" <?php
        if($categorie['categories_id']==$item['categories_id']) {echo"selected";}?>>
        <?=$categorie['categories_id']?></option>

    <?php endforeach */ ?>
    </select>

    <input type="submit" name="maj" value="Mettre à jour"/>
    <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/>

    </fieldset>
    </form>

    </div>
<?php endforeach ?>
</div>
<br>