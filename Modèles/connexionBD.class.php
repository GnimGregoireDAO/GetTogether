<?php


include_once('config/configBD.interface.php');


class ConnexionBD {
   
    private static ?PDO $instance = null;


    private function __construct() {}
    public static function getInstance(): PDO {

        if (self::$instance === null) {
            $configuration = "mysql:host=" . ConfigBD::BD_HOTE . ";dbname=" . ConfigBD::BD_NOM;
            $utilisateur = ConfigBD::BD_UTILISATEUR;
            $motPasse = ConfigBD::BD_MOT_PASSE;

            self::$instance = new PDO($configuration, $utilisateur, $motPasse);
            // S’assurer que les transactions se font avec les caractères UTF8
            self::$instance->exec("SET character_set_results = 'utf8'");
            self::$instance->exec("SET character_set_client = 'utf8'");
            self::$instance->exec("SET character_set_connection = 'utf8'");
        }
      
        return self::$instance;
    }


    public static function close(): void {
        self::$instance = null;
    }
}
?>
