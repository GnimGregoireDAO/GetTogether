<?php

include_once("DAO.interface.php");
include_once("../Activite.class.php");
include_once("../Groupe.class.php");

class ActiviteDAO implements DAO
{
    public static function chercherParId(int $cle): Activite|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $uneActivite = null;

        $requete = $connexion->prepare("SELECT * FROM activite WHERE id=?");
        $requete->execute(array($cle));

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
			$unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$uneActivite = new Activite($enregistrement['idActivite'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['date'], $unGroupe);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $uneActivite;
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

        $requete = $connexion->prepare("SELECT * FROM activite " . $filtre);

        $requete->execute();

        foreach ($requete as $enregistrement) {
			$unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$uneActivite = new Activite($enregistrement['idActivite'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['date'], $unGroupe);
			array_push($liste, $uneActivite);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $liste;        
    }

    public static function inserer(object $uneActivite): bool
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $requete = $connexion->prepare("INSERT INTO activite (idActivite,nom,description,date,idGroupe) VALUES (?,?,?,?,?)");

        $tab = [$uneActivite->getId(), $uneActivite->getNom(), $uneActivite->getDescription(), $uneActivite->getDate(), $uneActivite->getGroupe()->getId()];

        return	$requete->execute($tab);
    }

    static public function modifier(object $uneActivite): bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("UPDATE activite SET nom=?, description=?, date=?");

		$tab = [$uneActivite->getNom(), $uneActivite->getDescription(), $uneActivite->getDate()];
        
		return	$requete->execute($tab);
	}

    static public function supprimer(object $uneActivite):bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("DELETE FROM activite WHERE idActivite=?");

		return	$requete->execute([$uneActivite->getId()]);
	}
}

?>