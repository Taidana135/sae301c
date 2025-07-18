
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo['horaire']; 
//$articles = $bo; // $categories = $bo['categories'];
//var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/horaires-bo.css">

<form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
    
<div class="objet">
    
    <form class="d-inline-block" method="POST" action="/backoffice2/create">

            <h2 class="titre">Horaires :</h2>
            <label for="titre">créer une horaire :</label>
            <input type="text" name="titre" required/>

            <input type="submit" name="maj" value="Créer"/>

    </form>
</div>

<h2 class="titre">Modifier les horaires de la semaine :</h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">

    <label for="titre">Texte :</label>
    <input type="text" name="titre" value="<?= $item['texte'] ?>"/>

    <input type="submit" name="maj" value="Mettre à jour"/>
    <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/>


    </form>

    </div>
<?php endforeach ?>
</div>
<br>