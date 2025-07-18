
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo['categories']; 
//$articles = $bo; // $categories = $bo['categories'];
//var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/categories-bo.css">

<div class="objet">
    <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
    
    <form class="d-inline-block" method="POST" action="/backoffice2/create">
        <fieldset>
            <h2 class="titre">Créer une catégorie dans le catalogue</h2>
            <label for="titre">Nom de catégorie :</label>
            <input type="text" name="titre" required/>

            <input type="submit" name="maj" value="Créer"/>
        </fieldset>
    </form>
</div>

<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">
    <fieldset>
    <h2 class="titre">Modifier les objets du catalogue :</h2>
    <label for="titre">Nom de catégorie :</label>
    <input type="text" name="titre" value="<?= $item['categories_nom'] ?>"/>
    <input type="submit" name="maj" value="Mettre à jour"/>

    </fieldset>
    </form>

    </div>
<?php endforeach ?>
</div>