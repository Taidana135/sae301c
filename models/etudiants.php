<?php

namespace models;
class Etudiants extends \app\Model{

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

    // fonction qui insère dans la base de données un produit
    public function create() {
      // Récupération des données directement dans le modèle
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $identifiant_univ = $_POST['identifiant'];
      $mail = $_POST['mail'];
      $mdp = $_POST['mdp'];
      $visible = $_POST['visible'];

  
      // Requête préparée
      $sql = "INSERT INTO etudiants (nom, prenom, identifiant_univ, mail, mdp, visible) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
          return false;
      }
  
      // Attention au bon nombre et type de paramètres
      $stmt->bind_param("ssiss", $nom, $prenom, $identifiant_univ, $mail, $mdp, $visible);
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
  }
  
    // supprime un produit de la base de données
    public function delete($id) {
      $sql = "DELETE FROM etudiants WHERE id = ?";
      $stmt = $this->_connexion->prepare($sql);

      if (!$stmt) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }

      $stmt->bind_param("i", $id);
      // "i" = integer

      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }

      return true;
  }

    // fonction qui mets à jour un produit quand celui-ci est modifié
    public function update($id) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $identifiant_univ = $_POST['identifiant'];
      $mail = $_POST['mail'];
      $mdp = $_POST['mdp'];
      $visible = $_POST['visible'];


      // $titre, $desc1, $desc2, $image, $categories_id, $visible
      $sql = "UPDATE etudiants SET nom = ?, prenom = ?, identifiant_univ = ?, mail = ?, mdp_chiffrer = ?, cocher_notification = ? WHERE id = ?";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      $stmt->bind_param("ssissii", $nom, $prenom, $identifiant_univ, $mail, $mdp, $visible, $id);
      // s = string (nom), d = double (prix), i = integer (quantité), s = string (image), i = integer (id)
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
    }
}

?>