<?php

include_once("DAO.interface.php");
include_once("C:/UwAmpPHP8/www/projet-emmanuel_gregoire_sarah_miranda-CSS/projet-emmanuel_gregoire_sarah_miranda-CSS/Etape1_Gnim_Gregoire_DAO/Modeles/Utilisateur.class.php");

class UtilisateurDAO implements DAO
{
	public static function chercherParId(int $cle): Utilisateur|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $unMembre = null;

        $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id=?");
        $requete->execute(array($cle));

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
			$unUtilisateur = new Utilisateur($enregistrement['id'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse']);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $unMembre;
    }

    public static function chercherParNom(string $cle): Utilisateur|null
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $unUtilisateur = null;

        $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE nomUtilisateur LIKE '%$cle%'");
        $requete->execute();

        if ($requete->rowCount() > 0) {
			$enregistrement = $requete->fetch();
			$unUtilisateur = new Utilisateur($enregistrement['id'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse']);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $unUtilisateur;
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

        $requete = $connexion->prepare("SELECT * FROM utilisateur " . $filtre);

        $requete->execute();

        foreach ($requete as $enregistrement) {
			$unUtilisateur = new Utilisateur($enregistrement['id'], $enregistrement['nomUtilisateur'], $enregistrement['email'], $enregistrement['motDePasse']);
			array_push($liste, $unUtilisateur);
		}

        $requete->closeCursor();
		ConnexionBD::close();

		return $liste;        
    }

    public static function inserer(object $unUtilisateur): bool
    {
        try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

        $requete = $connexion->prepare("INSERT INTO utilisateur (idUtilisateur,nomUtilisateur,motDePasse, Membre_idMembre) VALUES (?,?,?,?)");

        $tab = [$unUtilisateur->getId(), $unUtilisateur->getNomUtilisateur(), $unUtilisateur->getMotPasse(), rand(1, 10)];

        return	$requete->execute($tab);
    }

    static public function modifier(object $unUtilisateur): bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("UPDATE utilisateur SET nomUtilisateur=?, email=?, motDePasse=?");

		$tab = [$unUtilisateur->getNomUtilisateur(), $unUtilisateur->getEmail(), $unUtilisateur->getMotPasse()];
        
		return	$requete->execute($tab);
	}

    static public function supprimer(object $unUtilisateur):bool
	{
		try {
			$connexion = ConnexionBD::getInstance();
		} catch (Exception $e) {
			throw new Exception("Impossible d’obtenir la connexion à la BD.");
		}

		$requete = $connexion->prepare("DELETE FROM utilisateur WHERE id=?");

		return	$requete->execute([$unUtilisateur->getId()]);
	}
}

?>