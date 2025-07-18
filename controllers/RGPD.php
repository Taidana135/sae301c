<?php

namespace controllers;
class RGPD extends \app\Controller{
/**
* Méthode permettant d'afficher un article à partir de son slug
*
* @param string $slug
* @return void
*/
public function index(){


    // On affiche les données
    // var_dump($articles);

    $droit=array();

    // On envoie les données à la vue index
    $this->render('index', compact('droit'));
    }

}
?>