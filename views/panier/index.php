<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nbArticles = 0;
if (!empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $qte) {
        $nbArticles += $qte;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre panier - EPISE</title>
    <link rel="stylesheet" href="/CSS/page_panier.css">
    <link rel="stylesheet" href="/CSS/Page_Accueil.css">
    <link rel="stylesheet" href="/CSS/Debug.css">
</head>
<body>

<header class="header"> 
    <a href="/">
    <img src="/Images/logo.png" alt="Logo EPISE">
    </a>

    <h1>Bienvenue à l'EPISE : Épicerie solidaire des étudiants</h1>
    <br>
    <div class="top-bar">
        <div id="search_container">
            <input type="text" id="search_input" placeholder="Rechercher dans la page...">
        </div>
        <div class="auth-buttons">
            <a href="/" class="accueil-btn">Accueil</a>
            <a href="Catalogue" class="catalogue-btn">Catalogue</a>
            <a href="Login" class="btn">Connexion</a>
            <a href="/Inscription/adherent" class="btn">S'incrire</a>
        </div>
        
    </div>
    <br>
    <section class="section_horaire">
  <div class="horaire-marquee">
    🕒 Horaires d'ouverture : 📅 Du lundi au vendredi 🕛 12h à 13h15 — 🌙 Mardi & Jeudi 🕔 17h à 19h 🎓
  </div>
  <br>
</section>
</header>

<section id="panier">
    <a href="/panier" class="btn-panier">
        🛒 Nombre d'article (<?= $nbArticles ?>)
    </a>

    <h1>Votre panier 🛒</h1>

    <a href="/catalogue" class="btn-retour">← Retour au catalogue</a>

    <?php if (!empty($_SESSION['panier'])): ?>
        <table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['panier'] as $id => $quantite): ?>
            <?php
                foreach ($catalogue as $produit) {
                    if ($produit['id'] == $id) {
                        $titre = $produit['titre'] ?? "Produit inconnu";
                        $image = $produit['image'] ?? "/img/default.jpg"; // Chemin par défaut si l'image est manquante
                        break;
                    }
                }
            ?>
            <tr>
                <td><img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($titre) ?>" class="img-produit"></td>
                <td><?= htmlspecialchars($titre) ?></td>
                <td><?= $quantite ?></td>
                <td>
                    <form method="post" action="/panier/supprimer">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" class="btn-supprimer">❌ Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


        <div class="panier-actions">
            <form method="post" action="/panier/vider">
                <button type="submit" class="btn-vider">🗑️ Vider le panier</button>
            </form>

            <form method="post" action="/panier/valider">
                <button type="submit" class="btn-reserver">✅ Réserver les articles</button>
            </form>
        </div>
    <?php else: ?>
        <p class="panier-vide">Votre panier est vide.</p>
    <?php endif; ?>
</section>

<footer>  
    <p>
        EPISE – L'Épicerie Solidaire des Étudiants<br>
        <br>
        Pas encore adhérents ?<a href="/Inscription/adherent" class="btn btn-inscription"> Inscris toi ici</a><br>
        Université de la Nouvelle-Calédonie, Campus de Nouville, BP R4, 98851 Nouméa Cedex, Nouvelle-Calédonie<br>
        <strong> Présidente de l'EPISE</strong> Maéva Teriitau<br>
        +687 72 12 50<br>
        <a href="mailto:epise@unc.nc">epise@unc.nc</a><br>
    </p>

    <!-- Ajout de la photo du plan -->
   <div class="footer-plan">
    <img src="/Images/plan.jpg" alt="Plan de l'université">
</div>


    <p>&copy; 2025 SAE301 - BUT MMI UNC-NC. Tous droits réservés.
    - <a href="RGPD">Politique de Confidentialité - Mentions Légales</a></p>
</footer>

</body>
</html>
