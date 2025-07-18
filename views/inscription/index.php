
<!-- Page d'inscription -->
<link rel="stylesheet" href="/css/Page_Inscription.css">
<!-- Boutton retour accueil fixe en haut a gauche -->
<a href="/main" class="btn-retour-accueil">Retour à l'accueil</a>

<div class="container-inscription">
    <h1>Création d'un compte</h1>
    <label>Vous êtes</label>
    <!-- Liste deroulante ??? -->
     <!-- option Adherent ou bien Donneur 
     Si Choix == adhérent, afficher page inscrption adherent else afficher page inscription donneur -->


<!--Formulaire choix du compte-->

<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <select name="QUI" id="selection-qui">
        <option value="" disabled selected>Choisissez une option</option>
        <option value="adherent">Adhérent</option>
        <option value="donneur">Donneur</option>
    </select>

<button type="submit" name="btn-submit">Continuer</button>
<button type="submit" name="btn-submit">Continuer</button>
        <div class="footer-inscription">
            Déjà inscrit ? Connectez-vous <a href="/login">ICI</a>
        </div>
</div>  