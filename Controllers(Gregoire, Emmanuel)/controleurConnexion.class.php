<?php

include_once("Controllers/controleur.abstract.class.php");

class Connexion extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        /*if (isset($_POST['email']) and isset($_POST['password'])) {
			$unUtilisateur = UtilisateurDAO::chercher($_POST['nom']);
			if ($unUtilisateur == null) {
				array_push($this->messagesErreur, "Cet utilisateur n'existe pas.");
				return "pageSeConnecter";
			} elseif (!$unUtilisateur->verifierMotPasse($_POST['mot_passe'])) {
				array_push($this->messagesErreur, "Le mot de passe est incorrect.");
				return "pageSeConnecter";
			} else {
				$this->acteur = "utilisateur";
				$_SESSION['utilisateurConnecte'] = $_POST['nom'];
				$this->tabProduits = ProduitDAO::chercherTous();
				return "pageAdministration";
			}
		} else {
            return "connexion";
		}*/
        
    }
}

?>