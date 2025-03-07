<?php

include_once("DAO.interface.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Message.class.php");

class MessageDAO implements DAO
{
    public static function chercherParId(int $cle): Message|null
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $unMessage = null;

        $requete = $connexion->prepare("SELECT * FROM message WHERE id=?");
        $requete->execute(array($cle));

        if ($requete->rowCount() > 0) {
            $enregistrement = $requete->fetch();
            $unMessage = new Message($enregistrement['id'], $enregistrement['contenu'], $enregistrement['dateEnvoi'], $enregistrement['idUtilisateur']);
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unMessage;
    }

    public static function chercherParNom(string $cle): Message|null
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $unMessage = null;

        $requete = $connexion->prepare("SELECT * FROM message WHERE contenu LIKE '%$cle%'");
        $requete->execute();

        if ($requete->rowCount() > 0) {
            $enregistrement = $requete->fetch();
            $unMessage = new Message($enregistrement['id'], $enregistrement['contenu'], $enregistrement['dateEnvoi'], $enregistrement['idUtilisateur']);
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $unMessage;
    }

    static public function chercherTous():array
    {
        return self::chercherAvecFiltre("");
    }

    static public function chercherAvecFiltre(string $filtre): array
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $liste = array();

        $requete = $connexion->prepare("SELECT * FROM message " . $filtre);

        $requete->execute();

        foreach ($requete as $enregistrement) {
            $unMessage = new Message($enregistrement['id'], $enregistrement['contenu'], $enregistrement['dateEnvoi'], $enregistrement['idUtilisateur']);
            array_push($liste, $unMessage);
        }

        $requete->closeCursor();
        ConnexionBD::close();

        return $liste;        
    }

    public static function inserer(object $unMessage): bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("INSERT INTO message (id, contenu, dateEnvoi, idUtilisateur) VALUES (?,?,?,?)");

        $tab = [$unMessage->getId(), $unMessage->getContenu(), $unMessage->getDateEnvoi(), $unMessage->getIdUtilisateur()];

        return $requete->execute($tab);
    }

    static public function modifier(object $unMessage): bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("UPDATE message SET contenu=?, dateEnvoi=?, idUtilisateur=? WHERE id=?");

        $tab = [$unMessage->getContenu(), $unMessage->getDateEnvoi(), $unMessage->getIdUtilisateur(), $unMessage->getId()];
        
        return $requete->execute($tab);
    }

    static public function supprimer(object $unMessage):bool
    {
        try {
            $connexion = ConnexionBD::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }

        $requete = $connexion->prepare("DELETE FROM message WHERE id=?");

        return $requete->execute([$unMessage->getId()]);
    }
}

?>