
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo["etudiants"]; 
//$articles = $bo; // $categories = $bo['categories'];
// var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/etudiants-bo.css">

<div class="alert"><?= $msg!=1?$msg:"" ?></div>
<div class="objet">
    <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
</div>

<h2 class="titre">Modifier les comptes (étudiants) :</h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">

    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?= $item['nom'] ?>"/>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?= $item['prenom'] ?>"/>

    <label for="identifiant">Identifiant Univ:</label>
    <input type="text" name="identifiant" value="<?= $item['identifiant_univ'] ?>"/>

    <label for="mail">Adresse mail :</label>
    <input type="text" name="mail" value="<?= $item['mail'] ?>"/>

    <label for="mdp">Mot de passe :</label>
    <input type="text" name="mdp" value="<?= $item['mdp_chiffrer'] ?>"/>

    <label for="visible">notification activé (0 si non, 1 si oui):</label>
        <select name="visible" id="visible">
            <option value="0">0</option>
            <option value="1">1</option>
        </select>


    <input type="submit" name="maj" value="Mettre à jour"/>
    <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/><br/>
    </form>

    </div>
<?php endforeach ?>
</div>