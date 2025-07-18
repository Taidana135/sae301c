<?php

namespace models;
class Reservation extends \app\Model{

/**
* @param string $slug
* @return void
*/

public function __construct(){
    // Nous définissons la table par défaut de ce modèle

    $this->table = "reservations";
    // Nous ouvrons la connexion à la base de données

    $this->getConnection();
    }

    public function GetReservations($identifiant_univ) {
      $sql = "SELECT * FROM ".$this->table." WHERE `identifiant_univ`=?";
      $stmt = $this->_connexion->prepare($sql);
      if(!$stmt) {
        \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
      }
      $stmt->bind_param("s", $identifiant_univ);
      if(!$stmt->execute()) {
        \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
      }
      $result = $stmt->get_result();
      $res = array();
      while($row=$result->fetch_array(MYSQLI_ASSOC)) {
        $res[]=$row;
      }
      return $res;
  }

    // fonction qui insère dans la base de données un produit
    public function create() {
      // Récupération des données directement dans le modèle
      $identifiant_univ = $_POST['identifiant'];
      $nb_produits = $_POST['nb_produit'];
      $nom_produits = $_POST['nom_produit'];
      $date = $_POST['date_reservation'];
  
      // Requête préparée
      $sql = "INSERT INTO reservations (identifiant_univ, nb_produits, nom_produits, date) VALUES (?, ?, ?, ?)";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
          return false;
      }
  
      // Attention au bon nombre et type de paramètres
      $stmt->bind_param("iiss", $identifiant_univ, $nb_produits, $nom_produits, $date);
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
  }
  
    // supprime un produit de la base de données
    public function delete($id) {
      $sql = "DELETE FROM reservations WHERE id = ?";
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
      $identifiant_univ = $_POST['identifiant'];
      $nb_produits = $_POST['nb_produit'];
      $nom_produits = $_POST['nom_produit'];
      $date = $_POST['date'];

      // $titre, $desc1, $desc2, $image, $categories_id, $visible
      $sql = "UPDATE reservations SET identifiant_univ = ?, nb_produits = ?, nom_produits = ?, date = ? WHERE id = ?";
      $stmt = $this->_connexion->prepare($sql);
  
      if (!$stmt) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      $stmt->bind_param("iissi", $_POST['identifiant'], $_POST['nb_produit'], $_POST['nom_produit'], $_POST['date'], $id);
      // s = string (nom), d = double (prix), i = integer (quantité), s = string (image), i = integer (id)
  
      if (!$stmt->execute()) {
          \app\Debug::debugDie([$stmt->errno, $stmt->error]);
          return false;
      }
  
      return true;
    }

}

?>