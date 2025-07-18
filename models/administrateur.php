<?php
namespace models;
class administrateur extends \app\Model{
public function __construct()
{
// Nous définissons la table par défaut de ce modèle
$this->table = "administrateur";
// Nous ouvrons la connexion à la base de données
$this->getConnection();
}
/**
* Contrôle de la connexion
*
* @return string
*/
public function connexion(string $login, string $mdp): bool {
    $sql = "SELECT * FROM `{$this->table}` WHERE `login`=?";
        $stmt = $this->_connexion->prepare($sql);
        if(!$stmt) {
            \app\Debug::debugDie(array($stmt->errno,$stmt->error));
            return false;
        }
        $stmt->bind_param("s", $login);
        if(!$stmt->execute()) {
            \app\Debug::debugDie(array($stmt->errno,$stmt->error));
            return false;
        }
        $result = $stmt->get_result();
        $administrateur = $result->fetch_assoc();
        // return true;
        return $administrateur && password_verify($mdp, $administrateur['mdp']);
    }
}
?>