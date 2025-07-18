
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
    // ... Traitement de l'inscription (enregistrement en base, etc.) ...

    // Redirection vers la page d'accueil après inscription
    header('Location: /main');
    exit;
}
?>

<link rel="stylesheet" href="/css/Page_Inscription.css">
<div class="container-inscription">
    <a href="/main" class="btn-retour-accueil">Retour à l'accueil</a>

    <h2 class="titre-inscription">Inscription</h2>
    <p class="texte-inscription">Inscrivez-vous</p>

    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" class="form-inscription">
        <input type="text" name="nom" placeholder="Nom" required class="input-inscription" />
        <input type="text" name="prenom" placeholder="Prénom" required class="input-inscription" />
        <input type="number" name="identifiant_univ" placeholder="Numéro étudiant" required class="input-inscription" />
        <input type="email" name="mail" placeholder="Mail" required class="input-inscription" />
        <input type="password" name="mdp_chiffrer" placeholder="Mot de passe" required class="input-inscription" />

        <div class="checkbox-row">
            <input type="checkbox" name="conditions" id="conditions" required />
            <label for="conditions" class="checkbox-inscription">
                J'accepte les conditions d'utilisation et politique de confidentialité.
            </label>
        </div>
        
        <div class="checkbox-row">
            <input type="checkbox" name="cocher_notification" id="cocher_notification" />
            <label for="cocher_notification" class="checkbox-inscription">
                J'accepte de recevoir les notifications pour les nouveaux produits par mail
            </label>
        </div>

        <input type="submit" name="inscription" value="Continuer" class="btn-inscription">
    </form>

    <div class="footer-inscription">
        Déjà inscrit ? <a href="/login">Connectez-vous ici</a>
    </div>
</div>