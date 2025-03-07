<?php

include_once("Controllers/controleur.abstract.class.php");

class DetailGroupe extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        return "detailGroupe";
    }
}

?>