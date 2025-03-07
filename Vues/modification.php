<?php
session_start();
include('connexionBD.php');


$username = $_SESSION['username'];


$sql = "SELECT prenom, nom, username, email FROM users WHERE username = ?";
$requete = $connexion->prepare($sql);
$requete->bindValue(1, $username, PDO::PARAM_STR);
$requete->execute();
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
if ($resultat) {
    $user = $resultat;
} else {
    echo "Erreur : utilisateur non trouvé.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = !empty($_POST['new-username']) ? $_POST['new-username'] : $user['username'];
    $new_password = isset($_POST['new-password']) ? $_POST['new-password'] : ''; // Vérifie si le champ mot de passe est rempli
    $confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';

  
    if (!empty($new_password) && $new_password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

 
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET username = ?, password = ? WHERE username = ?";
        $requete = $connexion->prepare($update_sql);
        $requete->bindValue(1, $new_username, PDO::PARAM_STR);
        $requete->bindValue(2, $hashed_password, PDO::PARAM_STR);
        $requete->bindValue(3, $username, PDO::PARAM_STR);
    } else {
        $requete->bindValue(1, $new_username, PDO::PARAM_STR);
        $requete->bindValue(2, $username, PDO::PARAM_STR);
        $requete = $connexion->prepare($update_sql);
        $requete->bindValue(1, $new_username, PDO::PARAM_STR);
        $requete->bindValue(2, $username, PDO::PARAM_STR);
    }

   
    if ($requete->execute()) {
        echo "Profil mis à jour avec succès.";
        $_SESSION['username'] = $new_username; // Mettre à jour la session avec le nouveau username
        header('Location: profil_utilisateur.php'); // Rediriger vers la page de profil
        exit();
    } else {
        $errorInfo = $requete->errorInfo();
        echo "Erreur lors de la mise à jour du profil : " . $errorInfo[2];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/profilStyle.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier vos informations</h2>
        <form action="modifier_profil.php" method="POST">
            <div class="form-group">
                <label for="new-username">Nouveau Username (laisser vide pour ne pas changer)</label>
                <input type="text" id="new-username" name="new-username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>
            <div class="form-group">
                <label for="new-password">Nouveau Mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" id="new-password" name="new-password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmer le Mot de passe</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
