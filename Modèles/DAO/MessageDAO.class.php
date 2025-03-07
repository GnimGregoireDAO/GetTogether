<?php

include_once("DAO.interface.php");
include_once("Message.class.php");
include_once("connexionBD.class.php");

class MessageDAO implements DAO {
    public static function chercherParId(int $cle): ?Message {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $unMessage = null;
        $requete = $connexion->prepare("SELECT * FROM message WHERE id = ?");
        $requete->execute([$cle]);

        if ($requete->rowCount() !== 0) {
            $enr = $requete->fetch();
            $unMessage = new Message(
                $enr['id'],
                $enr['contenu'],
                $enr['dateEnvoi'],
                $enr['idUtilisateur']
            );
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unMessage;
    }

    public static function chercherTous(): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM message");
        $requete->execute();

        foreach ($requete as $enr) {
            $unMessage = new Message(
                $enr['id'],
                $enr['contenu'],
                $enr['dateEnvoi'],
                $enr['idUtilisateur']
            );
            $tableau[] = $unMessage;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }

    public static function chercherAvecFiltre(string $filtre): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM message " . $filtre);
        $requete->execute();

        foreach ($requete as $enr) {
            $unMessage = new Message(
                $enr['id'],
                $enr['contenu'],
                $enr['dateEnvoi'],
                $enr['idUtilisateur']
            );
            $tableau[] = $unMessage;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }

    public static function inserer(object $unMessage): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("INSERT INTO message (id, contenu, dateEnvoi, idUtilisateur) VALUES (?, ?, ?, ?)");
        return $requete->execute([
            $unMessage->getId(),
            $unMessage->getContenu(),
            $unMessage->getDateEnvoi(),
            $unMessage->getIdUtilisateur()
        ]);
    }

    public static function modifier(object $unMessage): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("UPDATE message SET contenu = ?, dateEnvoi = ?, idUtilisateur = ? WHERE id = ?");
        return $requete->execute([
            $unMessage->getContenu(),
            $unMessage->getDateEnvoi(),
            $unMessage->getIdUtilisateur(),
            $unMessage->getId()
        ]);
    }

    public static function supprimer(object $unMessage): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("DELETE FROM message WHERE id = ?");
        return $requete->execute([$unMessage->getId()]);
    }
}
?>
