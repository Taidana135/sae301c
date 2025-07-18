<!-- Pour affiher un message en alerte -->
<?php if (!empty($msg)): ?>
    <script>
    alert("<?= addslashes($msg) ?>");
    </script>
    <?php endif; ?>
    
    <link rel="stylesheet" href="/css/benevole.css">
    <h1>Formulaire de Contact</h1>
    
    
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required />
    
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required />
    
    <label for="mail">Mail :</label>
    <input type="email" name="mail" id="mail" required />
    
    <!-- Telephone optionnel -->
    <label for="telephone">Téléphone :</label>
    <input type="number" name="telephone" id="telephone" />
    
    
    <!-- Fréquence d'engagement -->
    <label>Fréquence d'engagement :</label><br>
    <?php
    $frequences = [
        'hebdomadaire' => 'Hebdomadaire',
        'mensuelle' => 'Mensuelle',
        'occasionnelle' => 'Occasionnelle'
    ];
    echo '<select name="frequence" required>';
    echo '<option value="">-- Choisir une fréquence --</option>';
    foreach ($frequences as $val => $label) {
        echo '<option value="' . $val . '">' . $label . '</option>';
    }
    echo '</select>';
    ?>
    
    
    <!-- Choix des disponibilités du bénévole, ses préférences -->
    <label>Disponibilités :</label><br>
    <?php
    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
    $moments = ['matin', 'apres-midi'];
    foreach ($jours as $jour) {
        foreach ($moments as $moment) {
            $value = $jour . ' - ' . $moment;
            echo '<label><input type="checkbox" name="disponibilites[]" value="' . $value . '"> ' . $value . '</label><br>';
        }
    }
    ?>
    
    <!-- Compétences -->
    <label>Compétences (pour un rôle plus précis):</label><br>

    <?php
    //Liste des competences possibles
    $competences = [
        'accueil' => 'Accueil',
        'logistique' => 'Logistique',
        'communication' => 'Communication',
        'informatique' => 'Informatique',
        'gestion' => 'Gestion',
        'animation' => 'Animation',
    ];
    foreach ($competences as $val => $label) {
        echo '<label><input type="checkbox" name="competences[]" value="' . $val . '"> ' . $label . '</label><br>';
    }
    ?>
    En cliquant sur le bouton Envoyer, vous acceptez que vos informations soient utilisées pour vous contacter dans le cadre de votre engagement bénévole. </br>    
    <input type="submit" name="envoyer" value="Envoyer" /> <!--Bouton pour envoyer le formulaire -->    
</form>