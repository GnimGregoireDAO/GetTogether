<?php

include_once("Controllers/controleurAccueilDefaut.class.php");
include_once("Controllers/controleurAjoutGroupe.class.php");
include_once("Controllers/controleurConnexion.class.php");
include_once("Controllers/controleurCreerGroupe.class.php");
include_once("Controllers/controleurDetailGroupe.class.php");
include_once("Controllers/controleurPageDiscussions.class.php");
include_once("Controllers/controleurProfilUtilisateur.class.php");
include_once("controllers/controleurCreerCompte.class.php");

class Manufacture{

    public static function creerControleur($action):Controleur	
	{
		$controleur = null;
		if ($action == "ajout_groupe") {
			$controleur = new AjoutGroupe();
		} elseif ($action == "connexion") {
			$controleur = new Connexion();
		} elseif ($action == "creer_groupe") {
			$controleur = new CreerGroupe();
		} elseif ($action == "detail_groupe") {
			$controleur = new DetailGroupe();
		} elseif ($action == "page_discussions") {
			$controleur = new PageDiscussions();
		} elseif ($action == "profil_utilisateur") {
			$controleur = new ProfilUtilisateur();
		} elseif ($action == "creerCompte") {
			$controleur = new CreerCompte();
		} else {
			$controleur = new AccueilDefaut();
		}



		return $controleur;
	}
}

?>