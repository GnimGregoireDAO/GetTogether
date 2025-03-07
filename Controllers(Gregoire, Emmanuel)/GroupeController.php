
<?php
require_once '../Models/Groupe.class.php';

class GroupeController {
    public function createGroup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $createur = $_SESSION['user_id'];
            $groupe = new Groupe(null, $nom, $description, $createur);
            // Save the group to the database
            // ...
            header('Location: groupes.php');
            exit();
        } else {
            require '../Views/createGroup.php';
        }
    }

}
?>