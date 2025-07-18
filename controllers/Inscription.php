<?php 

namespace controllers;
class Inscription extends \app\Controller {



     /**
    * Affiche le formulaire d'inscription et traite l'inscription
    */
    public function index()
    {
        $this->loadModel('Inscription');

        $msg = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);

            $identifiant_univ = htmlspecialchars($_POST['identifiant_univ']); 

            $mdp_chiffrer = password_hash($_POST['mdp_chiffrer'], PASSWORD_BCRYPT);

            // Vérifier si l'email existe déjà dans la BDD
            if ($this->Inscription->emailExists($mail)) {
                $msg = "Cet email est déjà utilisé.";
            } else {
                $result = $this->Inscription->create([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'mail' => $mail,
                    'identifiant_univ' => $identifiant_univ, 
                    'mdp_chiffrer' => $mdp_chiffrer,
                ]);
/*                 if ($result) {
                    header('Location: /inscription/confirmation');
                    exit;
                } else {
                    $msg = "Erreur lors de l'inscription.";
                } */
            }
        }
        // $this->render('index');
        $this->render('adherent', ['hideHeaderFooter' => true]);
    }
}
