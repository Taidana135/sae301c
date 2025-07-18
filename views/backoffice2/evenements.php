
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo["evenements"]; 
//$articles = $bo; // $categories = $bo['categories'];
// var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/evenements-bo.css">

 <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
    
    <div class="objet">
            <h2 class="titre">Créer un événement :</h2>
            <label for="image">image :</label>
            <textarea name="image" required></textarea>
            <label for="visible">visible (0 si non, 1 si oui):</label>
            <select name="visible" id="visible" required>
                <option value="0">0</option>    
                <option value="1">1</option>
            </select>
            <input type="submit" name="maj" value="Créer"/>
</div>

<h2 class="titre">Modifier les événements : </h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">

    <label for="contenu2">image :</label>
    <input type="text" name="image" value="<?= $item['image'] ?>"/>

    <label for="visible">visible (0 si non, 1 si oui):</label>
        <select name="visible" id="visible">
            <option value="0">0</option>
            <option value="1">1</option>

    </select>
    <input type="submit" name="maj" value="Mettre à jour"/>
        <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/>
    </form>
    </div>
<?php endforeach ?>
</div>
<br>