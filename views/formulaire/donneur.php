<link rel="stylesheet" href="/css/donneur.css">
<form method="post" action="">
    <fieldset>
    <h1>Informations personnelles</h1>
    <label>Vous êtes :</label>
    <select name="type" required>
        <option value="particulier">Particulier</option>
        <option value="organisme">Organisme</option>
    </select>

    <input type="text" name="nom" placeholder="Nom ou nom de l'organisme" required>
    <input type="text" name="prenom" placeholder="Prénom (laisser vide si organisme)">
    <input type="tel" name="tel" placeholder="Téléphone Optionnel">
    <input type="email" name="mail" placeholder="Email" required>

    <p>En cliquant sur continuer, vous accepter de recevoir un recapitulaitf de votre dons par mail. (A changer je ne crois pas que ce soit conforme)</p>
    <button type="submit">Continuer</button>
    </fieldset>
</form>