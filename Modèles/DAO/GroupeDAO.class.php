<?php

include_once("DAO.interface.php");
include_once("Groupe.class.php");
include_once("connexionBD.class.php");

class GroupeDAO implements DAO {
    public static function chercherParId(int $cle): ?Groupe {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $unGroupe = null;
        $requete = $connexion->prepare("SELECT * FROM groupe WHERE id = ?");
        $requete->execute([$cle]);

        if ($requete->rowCount() !== 0) {
            $enr = $requete->fetch();
            $unGroupe = new Groupe(
                $enr['id'],
                $enr['nom'],
                $enr['description']
            );
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unGroupe;
    }

    public static function chercherTous(): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM groupe");
        $requete->execute();

        foreach ($requete as $enr) {
            $unGroupe = new Groupe(
                $enr['id'],
                $enr['nom'],
                $enr['description']
            );
            $tableau[] = $unGroupe;
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
        $requete = $connexion->prepare("SELECT * FROM groupe " . $filtre);
        $requete->execute();

        foreach ($requete as $enr) {
            $unGroupe = new Groupe(
                $enr['id'],
                $enr['nom'],
                $enr['description']
            );
            $tableau[] = $unGroupe;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }

    public static function inserer(object $unGroupe): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("INSERT INTO groupe (id, nom, description) VALUES (?, ?, ?)");
        return $requete->execute([
            $unGroupe->getId(),
            $unGroupe->getNom(),
            $unGroupe->getDescription()
        ]);
    }

    public static function modifier(object $unGroupe): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("UPDATE groupe SET nom = ?, description = ? WHERE id = ?");
        return $requete->execute([
            $unGroupe->getNom(),
            $unGroupe->getDescription(),
            $unGroupe->getId()
        ]);
    }

    public static function supprimer(object $unGroupe): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("DELETE FROM groupe WHERE id = ?");
        return $requete->execute([$unGroupe->getId()]);
    }
}
?>
