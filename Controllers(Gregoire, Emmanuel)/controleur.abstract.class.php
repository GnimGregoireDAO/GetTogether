<?php

abstract class Controleur{

    protected $messagesErreur = array();

    protected $acteur = "visiteur";

    public function __construct() {
        $this->determinerActeur();
    }

    public function getMessagesErreur():array { return $this->messagesErreur; }
	public function getActeur():string
	{
		return $this->acteur;
	}

    abstract public function executerAction();

    private function determinerActeur():void
	{
		//creation d'une session ou recuperation de la session existante
		session_start();
		//Si la session de l'utilisateur existe, le type d'utilisateur
		// devient, utilisateur, il est connecté
		if (isset($_SESSION['utilisateurConnecte'])) {
			$this->acteur = "utilisateur";
		}
	}
}

?>