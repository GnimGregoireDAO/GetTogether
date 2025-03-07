<?php
 
include_once("DAO.interface.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Groupe.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Utilisateur.class.php");
 
class GroupeDAO implements DAO
{
    public static function chercherParId(int $cle): Groupe|null
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
 
        $unGroupe = null;
 
        $requete = $connexion->prepare("SELECT * FROM groupe WHERE idGroupe=?");
        $requete->execute(array($cle));
 
        if ($requete->rowCount() > 0) {
            $enregistrement = $requete->fetch();
            $unGroupe = new Groupe($enregistrement['idGroupe'], $enregistrement['nomGroupe'], $enregistrement['descriptionGroupe'], $createur);
        }
 
        $requete->closeCursor();
        ConnexionBD::close();
 
        return $unGroupe;
    }
 
    static public function chercherTous():array
    {
        return self::chercherAvecFiltre("");
    }
 
    static public function chercherAvecFiltre(string $filtre): array
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
 
        $liste = array();
 
        $requete = $connexion->prepare("SELECT * FROM groupe " . $filtre);
 
        $requete->execute();
 
        foreach ($requete as $enregistrement) {
            $createur = UtilisateurDAO::chercherParId($enregistrement['idCreateur']);
            $unGroupe = new Groupe($enregistrement['idGroupe'], $enregistrement['nom'], $enregistrement['description'], $createur);
            array_push($liste, $unGroupe);
        }
 
        $requete->closeCursor();
        ConnexionBD::close();
 
        return $liste;        
    }
 
    public static function inserer(object $unGroupe): bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
 
        $requete = $connexion->prepare("INSERT INTO groupe (idGroupe,nomGroupe,descriptionGroupe) VALUES (?,?,?)");
 
        $tab = [rand(1,100), $unGroupe->getNom(), $unGroupe->getDescription()];
 
        return  $requete->execute($tab);
    }
 
    static public function modifier(object $unGroupe): bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
 
        $requete = $connexion->prepare("UPDATE groupe SET nom=?, description=?");
 
        $tab = [$unGroupe->getNom(), $unGroupe->getDescription()];
       
        return  $requete->execute($tab);
    }
 
    static public function supprimer(object $unGroupe):bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
 
        $requete = $connexion->prepare("DELETE FROM groupe WHERE idGroupe=?");
 
        return  $requete->execute([$unGroupe->getId()]);
    }
}
 
?>