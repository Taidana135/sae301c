<?php

namespace models;
class connexion extends \app\Model{

    /**
    * @param string $slug
    * @return void
    */

    public function __construct(){
        // Nous définissons la table par défaut de ce modèle

        $this->table = "etudiants";
        // Nous ouvrons la connexion à la base de données

        $this->getConnection();
    }

    public function findByEmail(string $mail) : array|null {
      $sql = "SELECT * FROM ".$this->table." WHERE `mail`=?";
      $stmt = $this->_connexion->prepare($sql);
      if(!$stmt) {
        \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
      }
      $stmt->bind_param("s", $mail);
      if(!$stmt->execute()) {
        \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
      }
      $result = $stmt->get_result();


      if ($result->num_rows) return $result->fetch_assoc();
      else return null;
  }
}

?>