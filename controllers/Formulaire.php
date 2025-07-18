<?php

namespace controllers;

class Formulaire extends \app\Controller
{
    
    //Choix dans le choix benevole ou donneur 
    public function choix(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['QUI'])) {
            $choix = $_POST['QUI'];
            if ($choix === 'benevole') {
                header('Location: /formulaire/benevole');
                exit();
            } elseif ($choix === 'donneur') {
                header('Location: /formulaire/donneur');
                exit();
            }
        }
        // Affiche la vue : views/inscription/index.php -------- vue choix.php de formulaire
        $this->render('choix', ['hideHeaderFooter' => true]);
    }
    
    public function donneur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère les données du formulaire
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? null;
            $tel = $_POST['tel'] ?? '';
            $type = $_POST['type'] ?? '';
            $mail = $_POST['mail'] ?? '';
            
            // Charge le modèle
            $this->loadModel('Formulaire');
            
            // Insère le donneur en BDD
            $idDonneur = $this->Formulaire->createDonneur($nom, $prenom, $tel, $mail, $type);
            $_SESSION['donneur_id'] = $idDonneur;
            
            if ($idDonneur) {
                // Vider la liste temporaire de produits à chaque nouveau donneur
                $_SESSION['don_produits'] = [];
                header('Location: /formulaire/donform');
                exit();
            } else {
                $msg = "Erreur lors de l'enregistrement du donneur.";
            }
        }
            // Cette ligne est OBLIGATOIRE pour afficher la vue !
    $this->render('/donneur');
        
    }

    // Formulaire pour ajouter des produits à donner
    public function donform()
    {

        $this->loadModel('Formulaire');
        $msg = null;

        //Si le user appuie sur abandonner, on vide et on retourne 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['abandonner'])) {
            $_SESSION['don_produits'] = [];
            header('Location: /');
            exit();

        }

        // Ajouter un produit à la liste temporaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_produit'])) {
            $titre = $_POST['titre'] ?? '';
            $categories_id = $_POST['categories_id'] ?? '';
            $desc1 = $_POST['desc1'] ?? '';
            $desc2 = $_POST['desc2'] ?? '';
            $quantite = $_POST['quantite'] ?? 1;

            $found = false;
            foreach ($_SESSION['don_produits'] as &$prod) {
                if (
                    $prod['titre'] === $titre &&
                    $prod['categories_id'] === $categories_id &&
                    $prod['desc1'] === $desc1 &&
                    $prod['desc2'] === $desc2
                ) {
                    $prod['quantite'] += $quantite;
                    $found = true;
                    break;
                }
            }
            unset($prod); // bonne pratique après foreach par référence

            if (!$found) {
                $produit = [
                    'categories_id' => $categories_id,
                    'titre' => $titre,
                    'quantite' => $quantite,
                    'desc1' => $desc1,
                    'desc2' => $desc2
                ];
                $_SESSION['don_produits'][] = $produit;
            }
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        // Valider tous les produits (enregistrer en BDD)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valide-don'])) {
            if (empty($_SESSION['don_produits'])) {
                $msg = "Vous devez ajouter au moins un produit avant de valider.";
            } else {
                foreach ($_SESSION['don_produits'] as $prod) {
                    $existant = $this->Formulaire->produitExiste($prod['titre']);
                    if ($existant) {
                        // Produit déjà en BDD, on augmente la quantité
                        $this->Formulaire->updateQuantite($existant['id'], $prod['quantite']);
                    } else {
                        // Nouveau produit, on l'ajoute
                        $donneur_id = $_SESSION['donneur_id'] ?? null;
                        $this->Formulaire->Ajoutdon(
                            $prod['titre'],
                            $prod['desc1'],
                            $prod['desc2'],
                            '', // image
                            $prod['categories_id'],
                            0, // visible
                            $prod['quantite'],
                            $donneur_id // <-- ici tu lies le don au bon donneur
                        );
                    }
                }
                $_SESSION['don_produits'] = [];
                $msg = "Tous les produits ont été enregistrés et seront validés par un administrateur.";
            }
        }

        $categories = $this->Formulaire->getCategories();
        $liste_produits = $_SESSION['don_produits'];
        $this->render('/donform', compact('msg', 'categories', 'liste_produits'));
    }



    //pour s'inscrire en tant que bénévole formulaire
    public function benevole()
    {
        $this->loadModel('Formulaire');
        $msg = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $mail = $_POST['mail'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $disponibilites = isset($_POST['disponibilites']) ? implode(', ', $_POST['disponibilites']) : '';
        $competences = isset($_POST['competences']) ? implode(', ', $_POST['competences']) : '';
        $frequence = $_POST['frequence'] ?? '';


        if (empty($_POST['disponibilites'])) {
            $msg = "Veuillez cocher au moins une disponibilité.";
        } else {
            $existant = $this->Formulaire->benevoleExiste($nom, $prenom, $mail);
            if ($existant) {
                // Met à jour les infos du bénévole existant
                $this->Formulaire->updateBenevole($existant['id'], $telephone, $frequence, $disponibilites, $competences);                $_SESSION['flash_msg'] = "Vos informations de bénévole ont été mises à jour !";
            } else {
                // Crée un nouveau bénévole
                $this->Formulaire->createBenevole($nom, $prenom, $mail, $telephone, $frequence, $disponibilites, $competences);                $_SESSION['flash_msg'] = "Merci pour votre engagement en tant que bénévole !";
            }
            header('Location: /');
            exit();
        }

    }
        $this->render('/benevole', compact('msg'));
}

}