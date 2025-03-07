<?php

include_once("Controllers/controleur.abstract.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/DAO/UtilisateurDAO.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Utilisateur.class.php");

class AjoutGroupe extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        if(isset($_POST['chercher'])){
            $tabMembre = MembreDAO::chercherAvecFiltre("WHERE nomMembre LIKE '%". $_POST['chercher']. "%'");
            echo "<ul>";
            foreach($tabMembre as $membre){
                echo "<li>";
                echo $membre->getNomUtilisateur();
                echo "</li>";
            }
            echo "</ul>";
        }
        return "ajout_groupe";
    }
}

?>