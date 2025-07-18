<?php
session_start();
// var_dump($_POST);

$_SESSION['verification'] = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['mdp'] = $_POST['mdp'];

    // $connexion = [
    //     'mdp-chiffrer' => password_hash($confirm['mdp'], PASSWORD_BCRYPT)
    // ];
    if (isset($confirm) && $_SESSION['mail'] == $confirm['mail'] && ($_SESSION['mdp'] == $confirm['mdp'])) {
        // password_verify($_SESSION['mdp'], $confirm['mdp-chiffrer'])) {
        
        $_SESSION['verification'] = true;
    } else {
        $_SESSION['verification'] = false;
    }

}
?>
<link rel="stylesheet" href="/css/Page_Login.css">
<link rel="stylesheet" href="/css/Page_Accueil.css">

<section id="section_general">
    <section id="section_login"><br/>
        <form method="post" action="/">
            <?php
            if ($_SESSION['verification'] == true) {
                echo '<h1>Connexion Réussie</h1>
                <p>Vous êtes maintenant connectée</p>
                <button type="submit">Continuer</button>';

                // var_dump($_SESSION);
                exit;
            } else {
                echo '<h1>Echec de Connexion</h1>
                <p>Adresse Mail ou Mot de Passe Incorrect</p>
                <button type="submit">Réessayez</button>';

                
                // var_dump($_SESSION);
                exit;
            }
            ?>

            <button type="submit">Continuer</button>

        </form>
    </section>
</section>

