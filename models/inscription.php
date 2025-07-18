<?php

namespace models;

class Inscription extends \app\Model
{
    /**
    * Insère un nouvel utilisateur dans la base de données
    * @param array $data
    * @return bool
    */
    
    // fonction qui utilise le debug.php + va chercher les données
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

    public function create(array $data) {

        if (!isset($this->_connexion)) {
            $this->getConnection();
        }
        $sql = "INSERT INTO etudiants (nom, prenom, mail, identifiant_univ, mdp_chiffrer) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);

        if (!$stmt) {
            \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
            return false;
        }

        $stmt->bind_param("sssss", $data['nom'], $data['prenom'], $data['mail'], $data['identifiant_univ'], $data['mdp_chiffrer']);

      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
    }
    public function emailExists($mail)
    {
        if (!isset($this->_connexion)) {
            $this->getConnection();
        }
        $sql = "SELECT id FROM etudiants WHERE mail = ?";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>