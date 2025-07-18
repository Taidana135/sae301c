<?php
namespace models;
class Horaire extends \app\Model{
public function __construct()
{
// Nous définissons la table par défaut de ce modèle
$this->table = "horaire";
// Nous ouvrons la connexion à la base de données
$this->getConnection();
}
/**
* Contrôle de la connexion
*
* @return string
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
        // fonction qui insère dans la base de données un produit
        public function create() {
          // Récupération des données directement dans le modèle
          $titre = $_POST['titre'];

          // Requête préparée
          $sql = "INSERT INTO horaire (texte) VALUES (?)";
          $stmt = $this->_connexion->prepare($sql);
      
          if (!$stmt) {
              \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
              return false;
          }
      
          // Attention au bon nombre et type de paramètres
          $stmt->bind_param("s", $titre);
      
          if (!$stmt->execute()) {
              \app\Debug::debugDie([$stmt->errno, $stmt->error]);
              return false;
          }
      
          return true;
      }
      
        // supprime un produit de la base de données
        public function delete($id) {
          $sql = "DELETE FROM horaire WHERE id = ?";
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
          $_POST['titre'] = $_POST['titre'];
    
          // $titre, $desc1, $desc2, $image, $categories_id, $visible
          $sql = "UPDATE horaire SET texte = ? WHERE id = ?";
          $stmt = $this->_connexion->prepare($sql);
      
          if (!$stmt) {
              \app\Debug::debugDie([$stmt->errno, $stmt->error]);
              return false;
          }
      
          $stmt->bind_param("si", $_POST['titre'], $id);
          // s = string (nom), d = double (prix), i = integer (quantité), s = string (image), i = integer (id)
      
          if (!$stmt->execute()) {
              \app\Debug::debugDie([$stmt->errno, $stmt->error]);
              return false;
          }
      
          return true;
        }
}
?>