
<?php
require_once '../Models/Utilisateur.class.php';

class UtilisateurController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $utilisateur = new Utilisateur();
            if ($utilisateur->seConnecter($email, $password)) {
                $_SESSION['user_id'] = $utilisateur->getId();
                header('Location: profil.php');
                exit();
            } else {
                echo 'Identifiants incorrects';
            }
        } else {
            require '../Views/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>