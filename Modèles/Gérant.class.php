<?php

include_once("DAO.interface.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Gerant.class.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Groupe.class.php");

class GérantDAO implements DAO
{
    public static function chercherParId(int $cle): Gérant|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $unMembre = null;

        $requete = $connexion->prepare("SELECT * FROM gérant WHERE idGérant=?");
        $requete->execute(array($cle));

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
            $unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$unMembre = new Membre($enregistrement['idGerant'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse'], $unGroupe, $enregistrement['statut']);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $unMembre;
    }

	public static function chercherParNom(string $cle): Gérant|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $unMembre = null;

        $requete = $connexion->prepare("SELECT * FROM gérant WHERE nomUtilisateur LIKE '%$cle%'");
        $requete->execute();

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
            $unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$unMembre = new Membre($enregistrement['idGerant'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse'], $unGroupe, $enregistrement['statut']);
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

        $requete = $connexion->prepare("SELECT * FROM gérant " . $filtre);

        $requete->execute();

        foreach ($requete as $enregistrement) {
			$unGroupe = GroupeDAO::chercher($enregistrement['idGroupe']);
			$unMembre = new Membre($enregistrement['idGérant'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse'], $unGroupe, $enregistrement['statut']);
			array_push($liste, $unMembre);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $liste;        
    }

    public static function inserer(object $unGérant): bool
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $requete = $connexion->prepare("INSERT INTO gérant (idGérant,nomUtilisateur,email,motDePasse,idGroupe,statut) VALUES (?,?,?,?,?,?)");

        $tab = [$unGérant->getId(), $unGérant->getNomUtilisateur(), $unGérant->getEmail(), $unGérant->getMotPasse(), $unGérant->getGroupe()->getId(), $unGérant->getSatus()];

        return	$requete->execute($tab);
    }

    static public function modifier(object $unGérant): bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("UPDATE gérant SET nomUtilisateur=?, email=?, motDePasse=? statut=?");

		$tab = [$unGérant->getNomUtilisateur(), $unGérant->getEmail(), $unGérant->getMotPasse(), $unGérant->getSatus()];
        
		return	$requete->execute($tab);
	}

    static public function supprimer(object $unGérant):bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("DELETE FROM gérant WHERE idGérant=?");

		return	$requete->execute([$unGérant->getId()]);
	}
}

?>