<?php
namespace controllers;
class Backoffice2 extends \app\Controller {
/**
* Cette méthode appelle la vue adéquate en fonction de l'état de connexion de l'utilisateur
*
* @return void
*/
    public function index(): void {
        // Vérifie si l'utilisateur est connecté
        if(isset($_SESSION["connecte"])) {

            // Vérifie si l'utilisateur veut se déconnecter
            if(isset($_POST['deco'])) {
                unset($_SESSION['connecte']);
                $bo['msg'] = "Déconnexion réussie !";
                $this->render('connexion', compact('bo'));

            } else {
            // Vérifie si l'utilisateur a choisi un modèle
                if(isset($_POST['choisir'])) {
                $_SESSION['modele'] = $_POST['modele'];
                }
                
            // Vérifie si l'utilisateur veut changer de modèle
            if(isset($_POST['changer'])) {
            unset($_SESSION['modele']);
            }
                // Si un modèle est sélectionné
                if(isset($_SESSION['modele'])) {
                $modele = $_SESSION['modele'];

                // On instancie le modèle "choisi"
                $this->loadModel("$modele");

                // On stocke la liste des éléments dans $bo
                $bo[strtolower($modele)] = $this->$modele->getAllOrderbyID();
                
                $cleEtrangere = $this->$modele->cle_etrangere;
                if (isset($cleEtrangere) && strlen($cleEtrangere)) {
                    $this->loadModel($cleEtrangere);
                    $bo[strtolower($cleEtrangere)] = $this->$cleEtrangere->getAllOrderbyID();
                }
                //var_dump($bo);
                $bo['msg'] = "";
                // On envoie les données à la vue qui a le nom du modèle
                // var_dump($bo);
            
                $this->render("$modele", compact('bo'));

                } else {
                // Si aucun modèle n'est sélectionné, on affiche la vue de choix
                $bo = array();
                $this->render('choix', compact('bo'));
                }
            }
        } else {
        // Si l'utilisateur n'est pas connecté, on affiche la vue de connexion

        $bo = array();
        $render = "connexion";

        // Vérifie si le formulaire de connexion a été soumis
            if(isset($_POST['valide'])) {

            // Vérifie si les champs sont remplis et non vides (required mis mais piratage possible)
                if(isset($_POST['log']) && isset($_POST['pass'])){
                $log = $_POST['log'];
                $pass = $_POST['pass'];

                // On instancie le modèle "administrateur" qui contient les informations de connexion
                $this->loadModel('administrateur');

                // Vérifie les informations de connexion
                    if($this->administrateur->connexion($log, $pass)) {
                    $_SESSION['connecte'] = $log;
                    $bo['msg'] = "Bienvenue $log !";

                    // On passe à l'étape suivante, le choix du modèle
                    $render = "choix";
                    } else {
                    $bo['msg'] = "Erreur de connexion !";
                    }
                } else {
                $bo['msg'] = "Problème de formulaire";
                }
            }
            
        // On envoie les données à la vue de connexion
        $this->render($render, compact('bo'));
    }
}
/**
* Met à jour un élément en fonction de son ID
*
* @param int $id
* @return void
*/
public function create(): void {
    if (isset($_SESSION['modele'])) {
        $modele = $_SESSION['modele'];
        // On instancie le modèle choisi
        $this->loadModel("$modele");
        $msg = $this->$modele->create();
        // On stocke les éléments dans $bo
   // On stocke la liste des éléments dans $bo
        $bo[strtolower($modele)] = $this->$modele->getAllOrderbyID();
                        
        $cleEtrangere = $this->$modele->cle_etrangere;
        if (isset($cleEtrangere) && strlen($cleEtrangere)) {
            $this->loadModel($cleEtrangere);
            $bo[strtolower($cleEtrangere)] = $this->$cleEtrangere->getAllOrderbyID();
        }
        $bo['msg'] = $msg;
        // On envoie les données à la vue index
        $this->render("$modele", compact('bo'));
    }
}

public function delete(int $id): void {
    if (isset($_SESSION['modele'])) {
        $modele = $_SESSION['modele'];
        // On instancie le modèle choisi
        $this->loadModel("$modele");

        // Appel à la méthode delete() du modèle
        $msg = $this->$modele->delete($id);

        // On stocke les éléments dans $bo
   // On stocke la liste des éléments dans $bo
        $bo[strtolower($modele)] = $this->$modele->getAllOrderbyID();
                        
        $cleEtrangere = $this->$modele->cle_etrangere;
        if (isset($cleEtrangere) && strlen($cleEtrangere)) {
            $this->loadModel($cleEtrangere);
            $bo[strtolower($cleEtrangere)] = $this->$cleEtrangere->getAllOrderbyID();
        }
        $bo['msg'] = $msg;

        // On envoie les données à la vue index
        $this->render("$modele", compact('bo'));
    }
}

public function update(int $id): void {
    if(isset($_SESSION['modele'])) {
        $modele = $_SESSION['modele'];
        // On instancie le modèle choisi
        $this->loadModel("$modele");
        $msg = $this->$modele->update($id);
        // On stocke les éléments dans $bo
   // On stocke la liste des éléments dans $bo
        $bo[strtolower($modele)] = $this->$modele->getAllOrderbyID();
                        
        $cleEtrangere = $this->$modele->cle_etrangere;
        if (isset($cleEtrangere) && strlen($cleEtrangere)) {
            $this->loadModel($cleEtrangere);
            $bo[strtolower($cleEtrangere)] = $this->$cleEtrangere->getAllOrderbyID();
        }
        $bo['msg'] = $msg;
        // On envoie les données à la vue index
        $this->render("$modele", compact('bo'));
    }
}};
?>