<?php


// session_start();
// $message = ''; // Initialise la variable pour le message
// $messageClass = ''; // Classe CSS pour styliser le message
// var_dump($_POST);
// var_dump($_SESSION);
// var_dump($_SESSION['verification']);
?>

<link rel="stylesheet" href="/css/Page_Login.css">

<section id="section_general">
    <section id="section_login"><br/>
        <form method="POST" action="/login/connect">
            <h1>Se Connecter</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="mail" required>
                <label for="">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="mdp" required>
                <label for="">Mot de Passe</label>
            </div>

            <?php if (isset($message)): ?>
                <span id="success" style="color: white;"><?php echo ($message); ?></span> 
                <!-- Affichage du message -->
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <span id="error" style="color: white;"><?php echo ($error); ?></span> 
                <!-- Affichage du message -->
            <?php endif; ?>

            <div class="forget">
                <label for=""><input type="checkbox">Rester connecté</label>
                <!-- <a href="MDPOublie">Mot de Passe Oublié</a> -->
            </div>

            <button type="submit" name="btn-submit">Continuer</button>

            <div class="register">
                <p>Pas De Compte ?<a href="/inscription">S'enregistrer</a></p>
            </div>
        </form>
    </section>
</section>

