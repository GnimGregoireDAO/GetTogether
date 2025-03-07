<?php

include_once("Controllers/controleur.abstract.class.php");

class PageDiscussions extends Controleur{

    public function __construct()
    {
        parent::__construct();
    }

    public function executerAction()
    {
        return "page_discussions";
    }
}

?>