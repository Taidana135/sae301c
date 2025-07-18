<?php

namespace models;

class Catalogue extends \app\Model {

    public function __construct() {
        $this->table = "catalogue";
        $this->cle_etrangere = "categories";
        $this->getConnection();
    }

    /**
     * Récupère un produit par son slug
     */
    public function findBySlug(string $slug): array|bool {
        $sql = "SELECT * FROM " . $this->table . " WHERE `slug` = ?";
        $stmt = $this->_connexion->prepare($sql);
        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
        $stmt->bind_param("s", $slug);
        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Insère un produit dans la base de données
     */
    public function create() {
        $titre = $_POST['titre'];
        $desc1 = $_POST['contenu'];
        $desc2 = $_POST['contenu2'];
        $image = $_POST['image'];
        $categories_id = isset($_POST['categories_id']);
        $visible = isset($_POST['visible']);

        $sql = "INSERT INTO catalogue (titre, desc1, desc2, image, categories_id, visible) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);

        if (!$stmt) {
            \app\Debug::debugDie([$this->_connexion->errno, $this->_connexion->error]);
            return false;
        }

        $stmt->bind_param("ssssii", $titre, $desc1, $desc2, $image, $categories_id, $visible);

        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }

        return true;
    }

    /**
     * Supprime un produit par son ID
     */
    public function delete($id) {
        $sql = "DELETE FROM catalogue WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);

        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }

        return true;
    }

    /**
     * Met à jour un produit par son ID
     */
    public function update($id) {
        $sql = "UPDATE catalogue SET titre = ?, desc1 = ?, desc2 = ?, image = ?, categories_id = ?, visible = ? WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);

        if (!$stmt) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }

        $stmt->bind_param("ssssiii", $_POST['titre'], $_POST['desc1'], $_POST['desc2'], $_POST['image'], $_POST['categories_id'], $_POST['visible'], $id);

        if (!$stmt->execute()) {
            \app\Debug::debugDie([$stmt->errno, $stmt->error]);
            return false;
        }

        return true;
    }

    /**
     * Récupère tous les produits du catalogue
     */
    public function getProduits(): array|bool {
        $sql = "SELECT * FROM " . $this->table;
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
}

?>
