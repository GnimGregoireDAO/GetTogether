<?php

include_once("DAO.interface.php");
include("Administrateur.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Administrateur.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Groupe.class.php");

class AmdministrateurDAO implements DAO
{
    public static function chercherParId(int $cle): Administrateur|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $unMembre = null;

        $requete = $connexion->prepare("SELECT * FROM administrateur WHERE idAdministrateur=?");
        $requete->execute(array($cle));

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
            $unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$unAdministrateur = new Administrateur($enregistrement['idAdministrateur'], $enregistrement['nom'], $enregistrement['prenom'], $enregistrement['email'], $enregistrement['motDePasse'], $unGroupe, $enregistrement['statut']);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $unMembre;
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

        $requete = $connexion->prepare("SELECT * FROM administrateur " . $filtre);

        $requete->execute();

        foreach ($requete as $enregistrement) {
			$unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$unAdministrateur = new Administrateur($enregistrement['idAdministrateur'], $enregistrement['nom'], $enregistrement['prenom'], $enregistrement['email'], $enregistrement['motDePasse'], $unGroupe, $enregistrement['statut']);
			array_push($liste, $unAdministrateur);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $liste;        
    }

    public static function inserer(object $unAdministrateur): bool
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $requete = $connexion->prepare("INSERT INTO administrateur (idAdministrateur,nom,prenom,email,motDePasse,idGroupe,statut) VALUES (?,?,?,?,?,?,?)");

        $tab = [$unAdministrateur->getId(), $unAdministrateur->getNom(), $unAdministrateur->getPrenom(), $unAdministrateur->getEmail(), $unAdministrateur->getMotPasse(), $unAdministrateur->getGroupe()->getId(), $unAdministrateur->getSatus()];

        return	$requete->execute($tab);
    }

    static public function modifier(object $unAdministrateur): bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("UPDATE administrateur SET nom=?, prenom=?, email=?, motDePasse=?, statut=?");

		$tab = [$unAdministrateur->getNom(), $unAdministrateur->getPrenom(), $unAdministrateur->getEmail(), $unAdministrateur->getSatus()];
        
		return	$requete->execute($tab);
	}

    static public function supprimer(object $unAdministrateur):bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("DELETE FROM administrateur WHERE idAdministrateur=?");

		return	$requete->execute([$unAdministrateur->getId()]);
	}
}

?>