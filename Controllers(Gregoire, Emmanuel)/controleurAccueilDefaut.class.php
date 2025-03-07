<?php

include_once("Controllers/controleur.abstract.class.php");

class AccueilDefaut extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        return "Accueil";
    }
}

?>