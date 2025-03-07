<?php

session_start();

$host = 'localhost';
$dbname = 'activites_groupes';
$username = 'root';
$password = 'root';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['idUtilisateur'];
        $_SESSION['username'] = $user['username'];
 
 
        header("Location: profil_utilisateur.php");
        exit;
    } else {
   
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Miranda Tchakounte, Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/stylePage.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Se Connecter</h1>
        <form method="POST" action="connexion.php">
            <div class="form-group">
                <label for="login-username">Nom d'utilisateur:</label>
                <input type="text" id="login-username" name="username" class="form-control" required>
            </div>
           
            <div class="form-group">
                <label for="login-password">Mot de passe:</label>
                <input type="password" id="login-password" name="password" class="form-control" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
       
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>
       
        <div id="compte" class="mt-3">
            <a href="CreerCompte.php">Vous n'avez pas de compte?</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
