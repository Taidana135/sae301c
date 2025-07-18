<?php

namespace controllers;
class Deconnexion extends \app\Controller{
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
    $deconnexion = $this->connexion->getAll();

    // On affiche les données
    // var_dump($articles);

    // On envoie les données à la vue index
    $this->render('index', compact('deconnexion'));
    }

public function lire(string $slug){

    // On instancie le modèle "Article"
    $this->loadModel('connexion');

    // On stocke l'article dans $article
    $deconnexion = $this->connexion->findBySlug($slug);

    // On envoie les données à la vue index
    $this->render('index', compact('deconnexion'));
    }

}
?>