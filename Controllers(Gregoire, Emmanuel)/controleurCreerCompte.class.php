<?php

include_once("Controllers/controleur.abstract.class.php");
include_once("../Modele/DAO/UtilisateurDAO.php");
include_once("../Modele/Utilisateur.class.php");

class CreerCompte extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        if(isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["dat"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm"]) && isset($_POST["condition-dutilisation"])){
            $unUtilisateur = new Utilisateur(102, $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["password"]);
            $unUtilisateur = UtilisateurDAO::create($unUtilisateur);
        }else{
            return "créerCompte";
        }
    }
}

?>