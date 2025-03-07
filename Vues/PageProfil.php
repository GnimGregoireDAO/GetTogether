<?php
session_start();
include('connexionBD.php');

if (!isset($_SESSION['username'])) {
    header('Location: connexion.php');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT prenom, nom, username, email FROM users WHERE username = ?";
$requete = $connexion->prepare($sql);
$requete->bindValue(1, $username, PDO::PARAM_STR);
$requete->execute();
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // User found
} else {
    echo "Erreur : utilisateur non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Personnel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/profilStyle.css">
</head>
<body>
    <div class="container mt-5">
        <div class="profile-header">
            <div>
                <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                <p><?php echo htmlspecialchars($user['username']); ?></p>
            </div>
        </div>
        
        <div class="profile-details">
            <h2>Informations personnelles</h2>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['prenom']); ?></p>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['nom']); ?></p>
            <p><strong>Username :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Mot de passe :</strong> ****</p>
        </div>

        <form action="modifierProfil.php" method="POST">
            <button class="btn btn-primary" type="submit">Modifier le profil</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
