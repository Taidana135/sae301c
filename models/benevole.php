<?php

namespace models;
class Benevole extends \app\Model{

/**
* @param string $slug
* @return void
*/

public function __construct(){
    // Nous définissons la table par défaut de ce modèle

    $this->table = "benevole";
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
      $mail = $_POST['mail'];
      $telephone = $_POST['tel'];
      $disponibilites = $_POST['dispo'];
      $frequences = $_POST['frequences'];
      $competences = $_POST['competences'];
  
      // Requête préparée
      $sql = "INSERT INTO benevole (nom, prenom, mail, telephone, disponibilites, frequences, competences) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
          return false;
      }
  
      // Attention au bon nombre et type de paramètres
      $stmt->bind_param("sssisss", $nom, $prenom, $mail, $telephone, $disponibilites, $frequences, $competences);
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
  }
  
    // supprime un produit de la base de données
    public function delete($id) {
      $sql = "DELETE FROM benevole WHERE id = ?";
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
      $mail = $_POST['mail'];
      $telephone = $_POST['tel'];
      $disponibilites = $_POST['dispo'];
      $frequences = $_POST['frequences'];
      $competences = $_POST['competences'];

      // $titre, $desc1, $desc2, $image, $categories_id, $visible
      $sql = "UPDATE benevole SET nom = ?, prenom = ?, mail = ?, telephone = ?, disponibilites = ?, frequences = ?, competences = ? WHERE id = ?";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      $stmt->bind_param("sssisssi", $nom, $prenom, $mail, $telephone, $disponibilites, $frequences, $competences, $id);
      // s = string (nom), d = double (prix), i = integer (quantité), s = string (image), i = integer (id)
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
    }
}

?>