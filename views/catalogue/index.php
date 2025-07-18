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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="/CSS/Page_Catalogue.css">

<section id="catalogue" style="padding: 2rem; background-color:rgb(224, 224, 224); position: relative;">

    <!-- ✅ Compteur du panier -->
    <a href="/panier" style="position: absolute; top: 1rem; right: 2rem; background: #333; color: #fff; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
        🛒 Voir le panier (<?= $nbArticles ?>)
    </a>
    <h1 style="margin-bottom: 2rem; font-size: 2rem; text-align: center;">Catalogue</h1>

    <!-- 🔍 Zone de filtres -->
    <div style="text-align:center; margin-bottom: 2rem;">
        <input type="text" id="filtre-catalogue" placeholder="🔍 Rechercher un produit..." 
               style="padding: 0.5rem 1rem; width: 50%; border-radius: 5px; border: 1px solid #ccc;">

        <select id="filtre-categorie" style="margin-left: 1rem; padding: 0.5rem; border-radius: 5px;">
            <option value="">Toutes les catégories</option>
            <option value="Produit ménager">Produit ménager</option>
            <option value="Accessoires">Accessoires</option>
            <option value="Plantes">Plantes</option>
            <option value="Aliments">Aliments</option>
            <option value="Vêtements">Vêtements</option>
            <option value="Chaussures">Chaussures</option>
            
            <!-- Ajoute d'autres options si nécessaire -->
        </select>
    </div>

    <!-- 🛍️ Grille de produits -->
    <div class="product-grid">
        <?php foreach ($catalogue as $produit): ?>
            <div class="product-card" 
                 data-id="<?= $produit['id'] ?>" 
                 data-categorie="<?= htmlspecialchars($produit['categorie'] ?? '') ?>">

                <div class="product-img">
                    <?php if (!empty($produit['image'])): ?>
                        <img src="<?= htmlspecialchars($produit['image']) ?>" alt="Image du produit">
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <h2 class="product-title"><?= htmlspecialchars($produit['titre'] ?? 'Article') ?></h2>
                    <p class="product-desc"><?= htmlspecialchars($produit['desc1'] ?? 'Pas de description.') ?></p>
                    <span class="stock">✔ En stock</span>
                </div>

                <div class="product-actions">
                    <div class="quantity">
                        <button class="minus">-</button>
                        <span class="qty">1</span>
                        <button class="plus">+</button>
                    </div>

                    <button class="add-to-cart-btn">Ajouter au panier</button>
                    <div class="info-msg" style="color: red; font-size: 0.9rem;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- 📜 Script JS -->
<script>
$(document).ready(function () {

    // On récupère le nombre total d'articles actuel dans le panier (injecté depuis PHP)
    let nbArticles = <?= $nbArticles ?>;

    // Incrémenter quantité locale (max 5 par produit)
    $('.plus').click(function () {
        let $qty = $(this).siblings('.qty');
        let val = parseInt($qty.text());
        if (val < 5) {
            $qty.text(val + 1);
            $(this).closest('.product-actions').find('.info-msg').text("");
        } else {
            $(this).closest('.product-actions').find('.info-msg').text("Maximum 5 articles par produit.");
        }
    });

    // Décrémenter quantité locale (min 1)
    $('.minus').click(function () {
        let $qty = $(this).siblings('.qty');
        let val = parseInt($qty.text());
        if (val > 1) {
            $qty.text(val - 1);
            $(this).closest('.product-actions').find('.info-msg').text("");
        }
    });

    // Ajouter au panier via AJAX avec contrôle total max 5 articles dans le panier
    $('.add-to-cart-btn').click(function () {
        const $card = $(this).closest('.product-card');
        const id = $card.data('id');
        const qty = parseInt($card.find('.qty').text());
        const $msg = $card.find('.info-msg');

        if (nbArticles + qty > 5) {
            $msg.css('color', 'red').text("Vous ne pouvez pas avoir plus de 5 articles au total dans le panier.");
            return; // stop l'ajout
        }

        // Si ok, on ajoute via AJAX
        $.post('/panier/ajouter', { id: id, quantite: qty }, function (data) {
            nbArticles += qty; // mettre à jour le total localement
            $msg.css('color', 'green').text("Ajouté au panier !");
            setTimeout(() => $msg.text(""), 2000);

            // Optionnel: mettre à jour le compteur visible dans le header
            $('a[href="/panier"]').text(`🛒 Voir le panier (${nbArticles})`);
        }).fail(function () {
            $msg.css('color', 'red').text("Erreur lors de l'ajout.");
        });
    });

    // Filtrage produits (inchangé)
    function filtrerProduits() {
        const motCle = $('#filtre-catalogue').val().toLowerCase();
        const categorie = $('#filtre-categorie').val();

        $('.product-card').each(function () {
            const titre = $(this).find('.product-title').text().toLowerCase();
            const desc = $(this).find('.product-desc').text().toLowerCase();
            const cat = $(this).data('categorie');

            const matchTexte = titre.includes(motCle) || desc.includes(motCle);
            const matchCategorie = !categorie || cat === categorie;

            if (matchTexte && matchCategorie) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $('#filtre-catalogue').on('input', filtrerProduits);
    $('#filtre-categorie').on('change', filtrerProduits);
});

</script>
