<?php

namespace controllers;
class Profil extends \app\Controller{
/**
* Méthode permettant d'afficher un article à partir de son slug
*
* @param string $slug
* @return void
*/
    public function index(){
    
     // On instancie le modèle "Articles"
    $this->loadModel('connexion');
    $this->loadModel('reservation');

    // On stocke la liste des articles dans $articles
    $profil = $this->connexion->getAll();
    $reservations = $this->reservation->GetReservations($_SESSION['identifiant']);

    // On affiche les données
    // var_dump($reservations);

    // On envoie les données à la vue index
    $this->render('index', compact('profil','reservations'));

    }

    public function lire(string $slug){

    // On instancie le modèle "Article"
    $this->loadModel('connexion');

    // On stocke l'article dans $article
    $profil = $this->connexion->findBySlug($slug);

    // On envoie les données à la vue index
    $this->render('index', compact('profil'));
    }

    // fonction qui appelle les reservations qui sont de l'utilisateur, donc avec les ids, liée et mettre en place la function
}
?>