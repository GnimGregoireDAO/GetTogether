<?php
session_start();
include('../PHP/connexionBD.php');  


if (!isset($_SESSION['username'])) {
    header('Location: connexion.php');
    exit();
}


$username = $_SESSION['username'];
$sql = "SELECT prenom, nom, username, email FROM users WHERE username = :username";
$requete = $connexion->prepare($sql); 


$requete->bindParam(':username', $username, PDO::PARAM_STR);


$requete->execute();  


$user = $requete->fetch(PDO::FETCH_ASSOC);

if (!$user) {
   
    echo "Aucun utilisateur trouvé avec ce nom d'utilisateur.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/profil.css">
    <title>Profil Utilisateur</title>
</head>
<body>
    <div class="container mt-5">
        <div class="entete">
            <h2>Profil de <?php echo htmlspecialchars($user['username']); ?></h2>
        </div>
        <div class="main-pu row">
            <div class="col-md-4 gauche">
                <div>
                    <img src="../images/User_Avatar.png" width="100" height="100" alt="User Avatar"> <br>
                    <p><?php echo htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><a href="page_discussions.php">Groupe</a></li>
                    <li class="list-group-item"><a href="créer_groupe.php">Créer un groupe</a></li>
                    <li class="list-group-item"><a href="modifierProfil.php">Personnaliser</a></li>
                    <li class="list-group-item"><a href="acceuil.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5">
        <p>2024 MSGE property</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
