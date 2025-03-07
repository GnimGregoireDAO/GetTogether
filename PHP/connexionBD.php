<?php
// Créateur de ce fichier : Sarah Laroubi et Miranda Tchakounte
$host = 'localhost';
$dbname = 'activites_groupes';
$username = 'root';
$password = 'root';
 
try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Erreur de connexion : " . $e->getMessage();
}
try {
  
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['groupe']) && isset($_POST['idUtilisateur'])) {
        $action = $_POST['action'];
        $groupe = $_POST['groupe'];
        $idUtilisateur = $_POST['idUtilisateur'];
       
   
        $statut = ($action == "Accepter") ? "accepté" : "refusé";
 
   
        $query = "UPDATE Groupe_has_Membre
                  SET statut = ?
                  WHERE Groupe_idGroupe = ? AND Membre_idMembre = ?";
       
   
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $statut, PDO::PARAM_STR); // Paramètre pour le statut
        $stmt->bindParam(2, $idGroupe, PDO::PARAM_INT); // Paramètre pour le groupe
        $stmt->bindParam(3, $idUtilisateur, PDO::PARAM_INT); // Paramètre pour l'utilisateur
       
        if ($stmt->execute()) {
            echo "Invitation pour le groupe $groupe $statut avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du statut de l'invitation.";
        }
       
 
        $stmt->closeCursor();
    }
}
?>