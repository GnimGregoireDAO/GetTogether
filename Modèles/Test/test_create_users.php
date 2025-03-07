
<?php
require_once 'utilisateurDAO.php';

$utilisateurDAO = new UtilisateurDAO();

$users = [
    ['nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'password' => 'password1'],
    ['nom' => 'Martin', 'prenom' => 'Marie', 'email' => 'marie.martin@example.com', 'password' => 'password2'],
    ['nom' => 'Durand', 'prenom' => 'Paul', 'email' => 'paul.durand@example.com', 'password' => 'password3'],
    ['nom' => 'Petit', 'prenom' => 'Lucie', 'email' => 'lucie.petit@example.com', 'password' => 'password4']
];

foreach ($users as $user) {
    $utilisateur = new Utilisateur(rand(1, 10), $user['nom'], $user['prenom'], $user['email'], password_hash($user['password'], PASSWORD_BCRYPT));
    if ($utilisateurDAO->create($utilisateur)) {
        echo "Utilisateur " . $user['prenom'] . " " . $user['nom'] . " créé avec succès!<br>";
    } else {
        echo "Erreur lors de la création de l'utilisateur " . $user['prenom'] . " " . $user['nom'] . ".<br>";
    }
}
?>