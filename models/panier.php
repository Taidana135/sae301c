<?php

namespace models;
class Panier extends \app\Model{

/**
* @param string $slug
* @return void
*/

public function __construct(){
    // Nous définissons la table par défaut de ce modèle

    $this->table = "panier";
    // Nous ouvrons la connexion à la base de données

    $this->getConnection();
    }

    public function findBySlug(string $slug): array|bool {
        $sql = "SELECT * FROM ".$this->table." WHERE `slug`=?";
        $stmt = $this->_connexion->prepare($sql);
        if(!$stmt) {
          \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
        }
        $stmt->bind_param("s", $slug);
        if(!$stmt->execute()) {
          \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}





?>