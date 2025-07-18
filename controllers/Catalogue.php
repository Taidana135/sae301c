<?php

namespace controllers;

class Catalogue extends \app\Controller {

    public function index() {
        // On instancie le modèle "Catalogue"
        $this->loadModel('catalogue');

        // On stocke la liste des articles dans $catalogue
        $catalogue = $this->catalogue->getAll();

        // On envoie les données à la vue index
        $this->render('index', compact('catalogue'));
    }

    public function viewItem(string $slug) {
        $this->loadModel('catalogue');
        $article = $this->catalogue->findBySlug($slug);
        $this->render('detail', compact('article'));
    }
}
?>
