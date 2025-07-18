
<?php $msg = $bo['msg']; unset($bo['msg']); $ensemble = $bo["reservation"]; 
//$articles = $bo; // $categories = $bo['categories'];
// var_dump($bo);
?>

<link rel="stylesheet" href="/css/Backoffice/reservations-bo.css">

<div class="alert"><?= $msg!=1?$msg:"" ?></div>
<div class="objet">
    <form action="/backoffice2" method="post" class="bouton_table">
    <input type="submit" name="changer" value="Changer de table">
    </form>
    <form class="d-inline-block" method="POST" action="/backoffice2/create">

            <h2 class="identifiant">Créer une réservation :</h2>
            <label for="identifiant">Identifiant Univ :</label>
            <input type="text" name="identifiant" required/>
            <label for="nb_produit">Nombre de produits :</label>
            <input type="number" name="nb_produit" required/>
            <label for="nom_produit">Nom de produits :</label>
            <textarea name="nom_produit" required></textarea>
            <label for="date_reservation">Date de réservation :</label>
            <input type="text" name="date_reservation" required/>
        
            <input type="submit" name="maj" value="Créer"/>

    </form>
</div>

<h2 class="titre">Modifier les réservations : </h2>
<div class="conteneur">
<?php foreach($ensemble as $item): ?>
    <div>
    <form class="d-inline-block" method="POST" action="/backoffice2/update/<?= $item['id'] ?>">

    <label for="identifiant">Identifiant Univ:</label>
    <input type="text" name="identifiant" value="<?= $item['identifiant_univ'] ?>"/>

    <label for="nb_produit">nombre produits :</label>
    <input type="text" name="nb_produit" value="<?= $item['nb_produits'] ?>"/>

    <label for="nom_produit">nom des produits :</label>
    <textarea name="nom_produit"><?= $item['nom_produits'] ?></textarea>

    <label for="date_reservation">date de réservation :</label>
    <input type="text" name="date" value="<?= $item['date'] ?>"/>


    <label for="terminer">Réservation terminée (0 si non, 1 si oui):</label>
        <select name="terminer" id="terminer">
            <option value="0">0</option>
            <option value="1">1</option>
        </select>

    <input type="submit" name="maj" value="Mettre à jour"/>
    <a href="/backoffice2/delete/<?= $item['id'] ?>"><button>Supprimer</button></a><br/><br/>
    </form>

    </div>

<?php endforeach ?>

</div>
