<?php
// Créateur de ce fichier : Gnim Gregoire DAO
include_once('connexionBD.class.php');

interface DAO{
    static public function chercherParId(int $cle): ?object;

    static public function chercherTous(): array;

    static public function chercherAvecFiltre(string $filtre): array;

    static public function inserer(object $objet): bool;

    static public function modifier(object $objet): bool;

    static public function supprimer(object $objet): bool;
}

?>