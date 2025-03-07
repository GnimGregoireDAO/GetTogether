<?php
session_start();

include '../PHP/ConnexionBD.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomMembre'], $_POST['typeMembre'])) {
    try {
        $nomMembre = $_POST['nomMembre'];
        $typeMembre = $_POST['typeMembre'];

        $stmt = $pdo->prepare("INSERT INTO Membre (nomMembre, typeMembre) VALUES (:nomMembre, :typeMembre)");

        // Lier les paramètres et exécuter la requête
        $stmt->bindParam(':nomMembre', $nomMembre, PDO::PARAM_STR);
        $stmt->bindParam(':typeMembre', $typeMembre, PDO::PARAM_STR);
        $stmt->execute();

        echo "Le membre a été ajouté avec succès !<br>";
    } catch (PDOException $e) {

        echo "Erreur lors de l'ajout du membre : " . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteMemberId'])) {
    try {
    
        $deleteMemberId = $_POST['deleteMemberId'];

  
        $stmt = $pdo->prepare("DELETE FROM Membre WHERE idMembre = :deleteMemberId");
        $stmt->bindParam(':deleteMemberId', $deleteMemberId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Le membre a été supprimé avec succès !<br>";
    } catch (PDOException $e) {
        // Gérer l'erreur si la suppression échoue
        echo "Erreur lors de la suppression du membre : " . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['memberId']) && isset($_POST['newStatus'])) {
    try {

        $memberId = $_POST['memberId'];
        $newStatus = $_POST['newStatus'];


        $stmt = $pdo->prepare("UPDATE Membre SET typeMembre = :newStatus WHERE idMembre = :memberId");
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Statut du membre mis à jour avec succès.<br>";
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du statut : " . $e->getMessage();
    }
}


try {
    $stmt = $pdo->prepare("SELECT idMembre, nomMembre, typeMembre FROM membre");
    $stmt->execute();
    $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des membres : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Backiny Tamla, Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Groupe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/gestion.css">
</head>
<body>
    <div class="container mt-5">
        <section id="group-management">
            <h2>Gestion du Groupe</h2>

            <!-- Formulaire pour ajouter un membre -->
            <h3>Ajouter un Nouveau Membre</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="nomMembre">Nom du Membre :</label>
                    <input type="text" id="nomMembre" name="nomMembre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="typeMembre">Type de Membre :</label>
                    <select id="typeMembre" name="typeMembre" class="form-control">
                        <option value="Actif">Actif</option>
                        <option value="Désactivé">Désactivé</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter le Membre</button>
            </form>

            <!-- Liste des membres et gestion du statut -->
            <h3>Membres du Groupe</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($membres as $membre): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($membre['nomMembre']); ?></td>
                            <td class="<?php echo $membre['typeMembre'] == 'Actif' ? 'active' : 'inactive'; ?>">
                                <?php echo htmlspecialchars($membre['typeMembre']); ?>
                            </td>
                            <td>
                                <!-- Formulaire pour activer/désactiver un membre -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="memberId" value="<?php echo $membre['idMembre']; ?>">
                                    <input type="hidden" name="newStatus" value="<?php echo $membre['typeMembre'] == 'Actif' ? 'Désactivé' : 'Actif'; ?>">
                                    <button type="submit" class="btn btn-warning"><?php echo $membre['typeMembre'] == 'Actif' ? 'Désactiver' : 'Activer'; ?></button>
                                </form>

                                <!-- Formulaire pour supprimer un membre -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="deleteMemberId" value="<?php echo $membre['idMembre']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
