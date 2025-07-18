<!DOCTYPE html>
<html>
<head>
    <title>Site EPISE UNC NC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/Page_Accueil.css">
    <link rel="stylesheet" href="/css/Debug.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="/slick-master/slick/slick.min.js"></script>
    <link rel="stylesheet" href="/slick-master/slick/slick.css">
    <link rel="stylesheet" href="/slick-master/slick/slick-theme.css">
    
    <script src="/magnific-popup/jquery.magnific-popup.js"></script>
    <link rel="stylesheet" href="/magnific-popup/magnific-popup.css">
</head>

<header class="header"> 
    <a href="/">
    <img src="/Images/logo.png" alt="Logo EPISE">
    </a>

    <h1>Bienvenue à l'EPISE : Épicerie solidaire des étudiants</h1>

    <div class="top-bar">
        <div id="search_container">
            <input type="text" id="search_input" placeholder="Rechercher dans la page...">
        </div>
        <div class="auth-buttons">
            <a href="/" class="accueil-btn">Accueil</a>
            <a href="Catalogue" class="catalogue-btn">Catalogue</a>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['mail']) && ($_SESSION['connexion'] == true)) {
                echo '
                <a href="Deconnexion" class="btn">Se déconnecter</a>
                <a href="Profil" class="btn">Profil</a>
                ';
            // le backoffice ne sera pas visible ici, car une autre connexion se fait dans le backoffice
            // if (isset($_SESSION['mail']) && ($_SESSION['verification'] == true)) {
            //     echo '
            //     <li><a href="backoffice">Backoffice</a></li>
            //     ';
            // }
            } else {
                echo '
                <a href="Login" class="btn">Connexion</a>
                <a href="/Inscription" class="btn">S\'incrire</a>
                ';
            };
            ?>

        </div>
        
    </div>
    <br>
    <section class="section_horaire">
  <div class="horaire-marquee">
  🕒 Horaires d'ouverture : 
  <?php foreach ($horaire as $horaire): ?>
    📅 <?= htmlspecialchars($horaire['texte']) ?>
  <?php endforeach; ?>
    <!-- 🕒 Horaires d'ouverture : 📅 Du lundi au vendredi 🕛 12h à 13h15 — 🌙 Mardi & Jeudi 🕔 17h à 19h 🎓 -->
  </div>
  <br>
</section>
</header>
<br>
<body>
    <?= $content ?>
</body>
<footer>  
    <p>
        EPISE - L'Épicerie Solidaire des Étudiants<br>
        <br>
        Pas encore adhérents ?<a href="Inscription" class="btn btn-inscription"> Inscris toi ici</a><br>
        Université de la Nouvelle-Calédonie, Campus de Nouville, BP R4, 98851 Nouméa Cedex, Nouvelle-Calédonie<br>
        <strong> Présidente de l'EPISE</strong> Maéva Teriitau<br>
        +687 72 12 50<br>
        <a href="mailto:epise@unc.nc">epise@unc.nc</a><br>
    </p>

    <!-- Ajout de la photo du plan -->
<div class="map-container" style="max-width:600px;height:450px;max-height:460px;margin:auto;">
    <strong>EPISE – Épicerie solidaire des étudiants</strong><br>
    <span>145, Avenue James Cook - BP R4 98851 Nouméa, Nouvelle-Calédonie</span>
    <iframe
        width="100%"
        height="350"
        frameborder="0" style="border:0"
        src="https://www.google.com/maps?q=145+Avenue+James+Cook+BP+R4+98851+Nouméa+New+Caledonia&output=embed"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>


<p>&copy; 2025 SAE301 - BUT MMI UNC-NC. Tous droits réservés.
    - <a href="RGPD">Politique de Confidentialité - Mentions Légales</a></p>
</footer>


</html>
