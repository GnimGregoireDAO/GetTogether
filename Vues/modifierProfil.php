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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = !empty($_POST['new-username']) ? $_POST['new-username'] : $user['username'];
    $new_password = !empty($_POST['new-password']) ? $_POST['new-password'] : null;

   
    if ($new_password) {
       
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      
        $update_sql = "UPDATE users SET username = :new_username, password = :password WHERE username = :username";
        $requete = $connexion->prepare($update_sql);

    
        $requete->bindParam(':new_username', $new_username, PDO::PARAM_STR);
        $requete->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $requete->bindParam(':username', $username, PDO::PARAM_STR);

     
        if ($requete->execute()) {
      
            $_SESSION['username'] = $new_username;
            header('Location: profil_utilisateur.php');
            exit();
        } else {
            echo "Erreur : " . $requete->errorInfo()[2];
        }
    } else {
     
        $update_sql = "UPDATE users SET username = :new_username WHERE username = :username";
        $requete = $connexion->prepare($update_sql);

  
        $requete->bindParam(':new_username', $new_username, PDO::PARAM_STR);
        $requete->bindParam(':username', $username, PDO::PARAM_STR);

       
        if ($requete->execute()) {
    
            $_SESSION['username'] = $new_username;
            header('Location: profil_utilisateur.php');
            exit();
        } else {
            echo "Erreur : " . $requete->errorInfo()[2];
        }
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
    <link rel="stylesheet" href="../Style/personnaliser.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier vos informations</h2>
        <form action="modifierProfil.php" method="POST">
            <div class="form-group">
                <label for="new-username">Nouveau Username :</label>
                <input type="text" id="new-username" name="new-username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>
            <div class="form-group">
                <label for="new-password">Nouveau Mot de Passe :</label>
                <input type="password" id="new-password" name="new-password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

