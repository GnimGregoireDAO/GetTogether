<?php
// Créateur de ce fichier : Sarah Laroubi

include_once('../Vues/CreerCompte.php');
include('connexionBD.php');

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$date = $_POST['dat'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$conditions = isset($_POST['condition_dutilisation']);

if (empty($password) || empty($confirm)) {
    die("Le mot de passe est requis.");
}

if ($password !== $confirm) {
    die("Les mots de passe ne correspondent pas.");
}

if (!$conditions) {
    die("Veuillez accepter les termes et conditions");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$requete = $connexion->prepare("INSERT INTO users (prenom, nom, date_naissance, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");

$requete->bindParam(1, $prenom, PDO::PARAM_STR);
$requete->bindParam(2, $nom, PDO::PARAM_STR);
$requete->bindParam(3, $date, PDO::PARAM_STR);
$requete->bindParam(4, $email, PDO::PARAM_STR);
$requete->bindParam(5, $username, PDO::PARAM_STR);
$requete->bindParam(6, $hashed_password, PDO::PARAM_STR);

if ($requete->execute()) {
    header("Location: ../Vues/profil_utilisateur.php");
    exit();
} else {
    echo "Erreur lors de l'inscription : " . $requete->errorInfo()[2];
}

$requete = null;
$connexion = null;
?>
