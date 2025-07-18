<?php

namespace controllers;
class Main extends \app\Controller{
    /**
    * Cette méthode affiche la liste des articles
    *
    * @return void
    */
    public function index(){
        // On instancie le modèle "Articles"
        // $this->loadModel('horaire');

        // On stocke la liste des articles dans $articles
        // $horaire = $this->horaire->getAll();

        // On garde la structure avec une variable $main pour anticiper un éventuel besoin
        $main = array();
        
        // On envoie les données à la vue index
        $this->render('index', compact('main'));
        
        // On affiche les données
        // var_dump($articles);
    }
}

?>
