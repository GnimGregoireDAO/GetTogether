
<?php

include_once("Controllers/controleurManufacture.class.php");

if(!ISSET($_GET['action'])){
 $action="";

}else{
$action = $_GET['action'];

}

$controleur = Manufacture::creerControleur($action);

$nomVue = $controleur->executerAction();

include_once("Views/". $nomVue . ".php");

?>