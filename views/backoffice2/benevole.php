
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo["benevole"]; 
//$articles = $bo; // $categories = $bo['categories'];
// var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/donateurs-bo.css">

<div class="alert"><?= $msg!=1?$msg:"" ?></div>
<div class="objet">
    <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
</div>

<h2 class="titre">Modifier les comptes (benevole) :</h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">

    <label for="titre">Nom:</label>
    <input type="text" name="nom" value="<?= $item['nom'] ?>"/>

    <label for="titre">Prénom:</label>
    <input type="text" name="prenom" value="<?= $item['prenom'] ?>"/>

    <label for="titre">Adresse mail :</label>
    <input type="text" name="mail" value="<?= $item['mail'] ?>"/>

    <label for="titre">Tél :</label>
    <input type="text" name="tel" value="<?= $item['telephone'] ?>"/>

    <label for="dispo">disponibilités :</label>
    <input type="text" name="dispo" value="<?= $item['disponibilites'] ?>"/>

    <label for="frequences">fréquences :</label>
    <input type="text" name="frequences" value="<?= $item['frequences'] ?>"/>

    <label for="competences">compétences :</label>
    <input type="text" name="competences" value="<?= $item['competences'] ?>"/>

    <input type="submit" name="maj" value="Mettre à jour"/>
    <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/><br/>
    </form>

    </div>
<?php endforeach ?>
</div>