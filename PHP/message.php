<?php
session_start();
// Créateur de ce fichier : DAO Gnim Gregoire

if (!isset($_SESSION['user_id'])) {
    die('Utilisateur non connecté');
}


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
    $message = trim($_POST['message']);
    $groupeId = $_POST['groupeId'];
    $userId = $_POST['userId'];

    if (!empty($message)) {
      
        $stmt = $pdo->prepare("INSERT INTO message (contenu, auteurId, groupeId) VALUES (:message, :userId, :groupeId)");
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':groupeId', $groupeId);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'empty_message';
    }
}
?>

