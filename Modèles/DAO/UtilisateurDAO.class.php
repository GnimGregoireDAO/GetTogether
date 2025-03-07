<?php

include_once("DAO.interface.php");
include_once("Utilisateur.class.php");
include_once("connexionBD.class.php");

class UtilisateurDAO implements DAO {
    public static function chercherParId(int $cle): ?Utilisateur {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $unUtilisateur = null;
        $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $requete->execute([$cle]);

        if ($requete->rowCount() !== 0) {
            $enr = $requete->fetch();
            $unUtilisateur = new Utilisateur(
                $enr['id'],
                $enr['nomUtilisateur'],
                $enr['email'],
                $enr['motDePasse']
            );
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unUtilisateur;
    }

    public static function chercherTous(): array {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $tableau = [];
        $requete = $connexion->prepare("SELECT * FROM utilisateur");
        $requete->execute();

        foreach ($requete as $enr) {
            $unUtilisateur = new Utilisateur(
                $enr['id'],
                $enr['nomUtilisateur'],
                $enr['email'],
                $enr['motDePasse']
            );
            $tableau[] = $unUtilisateur;
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
        $requete = $connexion->prepare("SELECT * FROM utilisateur " . $filtre);
        $requete->execute();

        foreach ($requete as $enr) {
            $unUtilisateur = new Utilisateur(
                $enr['id'],
                $enr['nomUtilisateur'],
                $enr['email'],
                $enr['motDePasse']
            );
            $tableau[] = $unUtilisateur;
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $tableau;
    }

    public static function inserer(object $unUtilisateur): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("INSERT INTO utilisateur (id, nomUtilisateur, email, motDePasse) VALUES (?, ?, ?, ?)");
        return $requete->execute([
            $unUtilisateur->getId(),
            $unUtilisateur->getNomUtilisateur(),
            $unUtilisateur->getEmail(),
            $unUtilisateur->getMotDePasse()
        ]);
    }

    public static function modifier(object $unUtilisateur): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("UPDATE utilisateur SET nomUtilisateur = ?, email = ?, motDePasse = ? WHERE id = ?");
        return $requete->execute([
            $unUtilisateur->getNomUtilisateur(),
            $unUtilisateur->getEmail(),
            $unUtilisateur->getMotDePasse(),
            $unUtilisateur->getId()
        ]);
    }

    public static function supprimer(object $unUtilisateur): bool {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("DELETE FROM utilisateur WHERE id = ?");
        return $requete->execute([$unUtilisateur->getId()]);
    }
}
?>
