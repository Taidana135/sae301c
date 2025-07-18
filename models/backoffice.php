<?php

namespace models;
class Backoffice extends \app\Model{

/**
* @param string $slug
* @return void
*/

public function __construct(){
    // Nous définissons la table par défaut de ce modèle

    $this->table = "boutique";
    // Nous ouvrons la connexion à la base de données

    $this->getConnection();
    }

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
    public function insert($nom, $prix, $quantite, $image) {
        $sql = "INSERT INTO boutique (nom, price, quantity, lien_img) VALUES (?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);
    
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $stmt->bind_param("sdis", $nom, $prix, $quantite, $image);
        // ici "sdis" pour "s" string, "d" double (float), "i" integer, "s" string, pour les 4 insert $nom, $prix, $quantite, $image
    
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        return true;
    }

    // supprime un produit de la base de données
    public function delete($id) {
        $sql = "DELETE FROM boutique WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);
    
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $stmt->bind_param("i", $id); // "i" pour integer
    
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        return true;
    }

    // liste tout les éléments demandée
    public function liste() {
        $sql = "SELECT * FROM boutique";
        $stmt = $this->_connexion->prepare($sql);
    
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // liste les objets par leur id spécifiquement
    public function findById($id) {
        $sql = "SELECT * FROM boutique WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);
    
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $stmt->bind_param("i", $id); // "i" pour integer
    
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // fonction qui mets à jour un produit quand celui-ci est modifié
    public function update($id, $nom, $prix, $quantite, $image) {
        $sql = "UPDATE boutique SET nom = ?, price = ?, quantity = ?, lien_img = ? WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);
    
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        $stmt->bind_param("sdisi", $nom, $prix, $quantite, $image, $id);
        // s = string (nom), d = double (prix), i = integer (quantité), s = string (image), i = integer (id)
    
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
    
        return true;
    }
}

?>