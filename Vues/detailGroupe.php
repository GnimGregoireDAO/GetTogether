<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Miranda Tchakounte">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Groupe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/detail.css">
</head>
<body>
    <?php
    session_start(); 
 
    $groupes_disponibles = ['Activité Soccer', 'Activité Basket', 'Activité Danse', 'Activité Musique'];
 
  
    if (!isset($_SESSION['groupes_membres'])) {
        $_SESSION['groupes_membres'] = [];
    }
    if (!isset($_SESSION['invitations'])) {
        $_SESSION['invitations'] = [];
    }
 
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['groupe_invite'])) {
        $groupe_invite = $_POST['groupe_invite'];
        if (!in_array($groupe_invite, $_SESSION['invitations']) && $groupe_invite !== "") {
            $_SESSION['invitations'][] = $groupe_invite; // Ajouter l'invitation à la liste
        }
    }
 
  
    if (isset($_POST['accepter_invitation'])) {
        $groupe_accepte = $_POST['groupe_accepte'];
        if (!in_array($groupe_accepte, $_SESSION['groupes_membres'])) {
            $_SESSION['groupes_membres'][] = $groupe_accepte; // Ajouter le groupe à la liste des membres
        }
    
        $_SESSION['invitations'] = array_diff($_SESSION['invitations'], [$groupe_accepte]);
    }
 
  
    $groupes_membres = $_SESSION['groupes_membres'];
    $invitations = $_SESSION['invitations'];
    ?>
 
    <div class="container mt-5">
        <section id="group-details">
            <h2>Détails du Groupe</h2>

            <h4>Groupes Disponibles</h4>
            <ul class="list-group">
                <?php
                foreach ($groupes_disponibles as $groupe) {
                    echo "<li class='list-group-item'>" . htmlspecialchars($groupe) . "</li>";
                }
                ?>
            </ul>

            <h4>Envoyer une Invitation</h4>
            <form action="" method="post" class="form-inline">
                <label for="groupe_invite" class="mr-2">Choisissez un groupe à inviter :</label>
                <select id="groupe_invite" name="groupe_invite" class="form-control mr-2">
                    <option value="">-- Sélectionnez un groupe --</option>
                    <?php
                    foreach ($groupes_disponibles as $groupe) {
                        echo "<option value=\"" . htmlspecialchars($groupe) . "\">" . htmlspecialchars($groupe) . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Envoyer Invitation</button>
            </form>

            <h4>Invitations</h4>
            <ul class="list-group">
                <?php
                if (empty($invitations)) {
                    echo "<li class='list-group-item'>Aucune invitation reçue.</li>";
                } else {
                    foreach ($invitations as $groupe) {
                        echo "<li class='list-group-item'>" . htmlspecialchars($groupe) . "
                                <form action='' method='post' style='display:inline;'>
                                    <input type='hidden' name='groupe_accepte' value='" . htmlspecialchars($groupe) . "'>
                                    <button type='submit' name='accepter_invitation' class='btn btn-success'>Accepter Invitation</button>
                                </form>
                              </li>";
                    }
                }
                ?>
            </ul>

            <div id="groupes-membres">
                <h4>Groupes dont vous êtes membre</h4>
                <ul class="list-group">
                    <?php
                    if (empty($groupes_membres)) {
                        echo "<li class='list-group-item'>Aucun groupe membre.</li>";
                    } else {
                        foreach ($groupes_membres as $groupe) {
                            echo "<li class='list-group-item'>" . htmlspecialchars($groupe) . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>