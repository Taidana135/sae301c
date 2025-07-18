<?php

namespace models;
class Articles extends \app\Model{
    public function __construct()
    {
    // Nous définissons la table par défaut de ce modèle
    $this->table = "articles";
    
    // Nous ouvrons la connexion à la base de données
    $this->getConnection();
    }
}

?>