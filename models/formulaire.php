<?php

namespace models;

class Formulaire extends \app\Model
{

        public function __construct()
    {
        $this->getConnection(); // <-- Ajoute cette ligne pour initialiser la connexion
    }

    // =========== DONNEUR ===========
    /*Ici insere un donneur dans la table "donnateur" et les infos des dons dans la table "dons" */
    // Insère un donneur (particulier ou organisme)
    public function createDonneur($nom, $prenom, $tel, $mail, $type) {
        $sql = "INSERT INTO donneurs (nom, prenom, tel, mail, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("sssss", $nom, $prenom, $tel, $mail, $type);
        $stmt->execute();
        return $this->_connexion->insert_id;
    }

    // =========== DONS ===========
    // Fonction pour ajouter un don dans la table "catalogue"
    public function Ajoutdon($titre, $desc1, $desc2, $image, $categories_id, $visible, $quantite) {
        $sql = "INSERT INTO catalogue (titre, desc1, desc2, image, categories_id, visible, quantite) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("ssssiii", $titre, $desc1, $desc2, $image, $categories_id, $visible, $quantite);
        $stmt->execute();
        return $this->_connexion->insert_id;
    }

    //verfie que le produit existe dans la table "catalogue"
    public function produitExiste($titre) {
        $sql = "SELECT id, quantite FROM catalogue WHERE LOWER(titre) = LOWER(?) LIMIT 1";
        $stmt = $this->_connexion->prepare($sql);
        if(!$stmt) {
        \app\Debug::debugDie(array($stmt->errno,$stmt->error)); return false;
        }
        $stmt->bind_param("s", $titre);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }
    
    public function updateQuantite($id, $ajout) {
        $sql = "UPDATE catalogue SET quantite = quantite + ? WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("ii", $ajout, $id);
        return $stmt->execute();
    }
        
    // Récupère les catégories pour le select
    public function getCategories() {
        $sql = "SELECT id, categories_nom FROM categories";
        $result = $this->_connexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =========== BENEVOLE ===========
    // Vérifie si le bénévole existe déjà
    public function benevoleExiste($nom, $prenom, $mail) {
        $sql = "SELECT id FROM benevole WHERE nom = ? AND prenom = ? AND mail = ?";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("sss", $nom, $prenom, $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }

    //Insere un benevole dans la table "benevole" avec ses infos
    public function createBenevole($nom, $prenom, $mail, $telephone, $frequence, $disponibilites, $competences) {
        $sql = "INSERT INTO benevole (nom, prenom, mail, telephone, frequence, disponibilites, competences) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("sssssss", $nom, $prenom, $mail, $telephone, $frequence, $disponibilites, $competences);
        $stmt->execute();
        return $this->_connexion->insert_id;
    }


    // Met à jour les infos du bénévole existant
    public function updateBenevole($id, $telephone, $frequence, $disponibilites, $competences) {
        $sql = "UPDATE benevole SET telephone = ?, frequence = ?, disponibilites = ?, competences = ? WHERE id = ?";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bind_param("ssssi", $telephone, $frequence, $disponibilites, $competences, $id);
        return $stmt->execute();
    }


    }