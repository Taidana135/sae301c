<link rel="stylesheet" href="/css/Page_Profil.css">

<section id="section_general">

    <?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['mail']) && $_SESSION['connexion'] === true) {
        ?>

<div class="profil-container">
    <div class="profil-header">
        <p class="nom">NOM PRENOM</p>
        <div class="profil-info">
            
            <p class="texte">Souhaitez-vous recevoir des notifications par mail ? veuillez alors cochez "Recevoir des notifications" et y mettre l'adresse mail de votre choix.</p>
            <form id="profil-form">
                <div class="input-row">
                    <label for="email">Recevoir des notifications :</label>

                    <label class="switch">
                        <input type="checkbox" id="email-toggle">
                        <span class="slider round"></span>
                    </label>

                    <input type="text" id="email" placeholder="Votre adresse mail">
                    <div class="btn-group">
                        <input type="submit" value="Enregistrer" disabled id="save-button">
                </div>
            </form>
        </div>
    </div>
</div>
        <div class="profil-info">
            <p class="texte">Souhaitez-vous recevoir des messages ? Veuillez alors cocher "Recevoir des messages" et y mettre votre numéro de téléphone.</p>
                <form id="profil-form">
                    <div class="input-row">
                        <label for="message-toggle">Recevoir des messages :</label>

                        <label class="switch">
                            <input type="checkbox" id="message-toggle">
                            <span class="slider round"></span>
                        </label>

                    <input type="tel" id="phone" placeholder="Votre numéro de téléphone">
                    <div class="btn-group">
                        <input type="submit" value="Enregistrer" disabled id="save-button2">
                </div>
            </form>
        </div>
</div>

    <!-- Avatar avec cadre fixe -->
    <div class="profil-avatar-wrapper">
      <div class="profil-avatar">
        <img src="/Images/logo.png" alt="Image utilisateur">
      </div>
      <label for="identif" class="profil-id">ID Univ. : 00000</label>
    </div>
  </div>

<table border="1">
    <thead>
        <tr>
            <th>Nombre de Produits</th>
            <th>Nom des Produits</th>
            <th>Date</th>
            <th>Terminée</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation):?>
                <tr>
                    <td><?= htmlspecialchars("". $reservation['nb_produits']) ?></td>
                    <td><?= htmlspecialchars($reservation['nom_produits']) ?></td>
                    <td><?= htmlspecialchars($reservation['date']) ?></td>
                    <td><?= $reservation['terminer'] ?></td>
                </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
const toggle = document.getElementById('email-toggle');
const emailInput = document.getElementById('email');
const saveBtn = document.getElementById('save-button');

const toggle2 = document.getElementById('message-toggle');
const msgInput = document.getElementById('phone');
const saveBtn2 = document.getElementById('save-button2');

toggle.addEventListener('change', () => {
    const isEditable = toggle.checked;
    emailInput.readOnly = !isEditable;
    saveBtn.disabled = !isEditable;

    // Style changement si besoin
    emailInput.style.backgroundColor = isEditable ? "#fff" : "#D9D9D9";
});

toggle2.addEventListener('change', () => {
    const isEditable2 = toggle2.checked;
    msgInput.readOnly = !isEditable2;
    saveBtn2.disabled = !isEditable2;

    // Style changement si besoin
    msgInput.style.backgroundColor = isEditable2 ? "#fff" : "#D9D9D9";
});
</script>


    <?php
    } else {
    ?>
    <div class="profil-container">
        <h2>Erreur</h2>
        <p class="texte2">Veuillez être connectée pour intéragir avec votre profil.</p>
    </div>
    <?php
}
?>

</section>
