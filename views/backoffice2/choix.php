<link rel="stylesheet" href="/css/Backoffice/Page_Backoffice.css">
</form>

    <form method="post" action='<?= $_SERVER['REQUEST_URI']?>'>

    <input type="radio" name='modele' value='horaire' checked>Afficher horaire de la semaine<br/>
    <input type="radio" name='modele' value='etudiants'>Afficher les comptes étudiants<br/>
    <input type="radio" name='modele' value='benevole'>Afficher les comptes benevole<br/>
    <input type="radio" name='modele' value='evenements'>Afficher les Événements<br/>
    <input type="radio" name='modele' value='catalogue'>Afficher les stocks / catalogue<br/>
    <input type="radio" name='modele' value='categories'>Afficher les catégories du catalogue<br/>
    <input type="radio" name='modele' value='reservation'>Afficher les réservations<br/>
    <input type="submit" name='choisir' value="Continuer">
<input type="submit" value="Se déconnecter" name="deco"></td>
</form>