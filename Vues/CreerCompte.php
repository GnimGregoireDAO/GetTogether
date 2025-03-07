<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sarah Laroubi">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/stylePage.css">
    <title>Créer un compte</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Créer un Compte</h1>
        <form action="../PHP/traitementInscription.php" method="POST">
            <div class="form-group">
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de famille" required>
            </div>
            <div class="form-group">
                <label for="date" id="date">Date de naissance</label><br>
                <input type="date" id="dat" name="dat" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <label for="confirm">Confirmer le mot de passe</label> <br>
                <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Mot de passe" required>
            </div>
            <div class="form-check">
                <input type="checkbox" name="condition_dutilisation" class="form-check-input">
                <label for="condition-dutilisation" class="form-check-label">J'accepte les termes et conditions</label>
            </div>
            <button type="submit" name="ok" class="btn btn-primary mt-3">S'inscrire</button>
        </form>
        <div id="compte" class="mt-3">
            <a href="connexion.php">Vous avez déjà un compte?</a>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
