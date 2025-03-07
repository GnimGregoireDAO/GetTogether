<?php
// Créateur de ce fichier : Sarah Laroubi
session_start();  
session_unset();
session_destroy();
header("Location: connexion.php");
exit();
?>
