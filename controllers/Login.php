<?php

namespace controllers;
class Login extends \app\Controller{
/**
* Méthode permettant d'afficher un article à partir de son slug
*
* @param string $slug
* @return void
*/
public function index(){

    // On instancie le modèle "Articles"
    $this->loadModel('connexion');

    // On stocke la liste des articles dans $articles
    $login = $this->connexion->getAll();

    // On envoie les données à la vue index
    $this->render('index', compact('login'));

}
    public function connect() {
        
        if (isset($_POST['btn-submit'])) {
            // var_dump($_SESSION);
            // session_start();

            $this->loadModel('connexion');
            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];


            $message = ''; // Initialise la variable pour le message
            $error = '';

            $_SESSION['verification'] = false;
            $_SESSION['connexion'] = false;
            
            $login2 = $this->connexion->findByEmail($_POST['mail']);
            // var_dump($login2);
            // die();

            if ($mail) {
                $_SESSION['mail'] = $mail;
                $_SESSION['mdp'] = $mdp;

                $identifiant_univ = $login2['identifiant_univ'];
                $_SESSION['identifiant'] = $identifiant_univ;

                $_SESSION['verification'] = false;

                // die("-". isset($login2));

                if (isset($login2) && $_SESSION['mail'] == $login2['mail'] && password_verify($_SESSION['mdp'], $login2['mdp_chiffrer'])) {
                    // password_verify($_SESSION['mdp'], $confirm['mdp-chiffrer'])) {
                    
                    // n'est plus utile, le backoffice n'est plus le meme
                    // if ($login2['mail'] == 'admin@gmail.com') {
                    // $_SESSION['verification'] = true;
                    // }
                    
                    $_SESSION['connexion'] = true;
                    $message = "Connexion réussi !";
                    header('location: /');
                    $this->render('index', compact('message'));

                } else {
                    $_SESSION['verification'] = false;
                    $_SESSION['connexion'] = false;
                    $error ='Email ou Mot de Passe invalide';
                    $this->render('index', compact('error'));
                }
            }
        }
    }


    public function lire(string $slug){

        // On instancie le modèle "Article"
        $this->loadModel('connexion');

        // On stocke l'article dans $article
        $login = $this->connexion->findBySlug($slug);

        // On envoie les données à la vue lire
        $this->render('lire', compact('login'));
    


    }
}
?>