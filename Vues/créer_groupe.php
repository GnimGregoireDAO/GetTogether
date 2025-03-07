<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Emmanuel Backiny Tamla">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/GroupeStyle.css">
    <title>Créer Groupe</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Créer un nouveau groupe</h2>
        <form method="post" action="?action=creer_groupe">
            <div class="form-group">
                <label for="nomGroupe">Nom du groupe:</label>
                <input type="text" name="nomGroupe" class="form-control" placeholder="Le nom du groupe">
            </div>
            <div class="form-group">
                <label for="description">Description du groupe:</label>
                <input type="text" name="description" class="form-control" placeholder="Description du groupe">
            </div>
            <button type="submit" class="btn btn-primary">Créer Groupe</button>
            <a href="profil_utilisateur.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
    <footer class="text-center mt-5">
        <p>2024 MSGE property</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
