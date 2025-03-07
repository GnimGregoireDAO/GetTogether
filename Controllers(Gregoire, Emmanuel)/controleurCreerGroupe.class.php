<?php

include_once("Controllers/controleur.abstract.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Utilisateur.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/DAO/UtilisateurDAO.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Membre.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/DAO/MembreDAO.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Groupe.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/DAO/GroupeDAO.class.php");

class CreerGroupe extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        if(isset($_POST["nomGroupe"]) && isset($_POST["description"])){
            $createur = new Utilisateur(1, "Emmanuel", "emmanuelbt@yahoo.com", "emmanuel123");
            $unGroupe = new Groupe(2, $_POST["nomGroupe"], $_POST["description"], $createur);
            
            /*if(isset($_POST["membre"])){
                if($_POST["roles"] == "Régulier"){
                    $unMembre = MembreDAO::chercherAvecFiltre("WHERE nom OR prenom LIKE '%". $_POST["membre"]. "%'");
                    $unGroupe->ajouterMembre($unMembre);
                }else{
                    $unMembre = UtilisateurDAO::readByName($_POST["membre"]);
                    $unGroupe->ajouterGerant($unMembre);
                }
            }*/
            GroupeDAO::inserer($unGroupe);
            return "profil_utilisateur";
        }else{
            
        }
        return "creer_groupe";
    }
}

?>