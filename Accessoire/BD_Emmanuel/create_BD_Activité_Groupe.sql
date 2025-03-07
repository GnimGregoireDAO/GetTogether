-- Créateur de la base de données : Backiny Tamla
-- Modificateur de la base de données : DAO Gnim Gregoire, Sarah Laroubi
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `activites_groupes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `activites_groupes`;

CREATE TABLE `activite` (
  `idActivite` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `idGroupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `gerantId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `gerant` (
  `id` int(11) NOT NULL,
  `membreId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descriptionGroupe` int(11) DEFAULT NULL,
  `idCreateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `groupe_has_membre` (
  `Groupe_idGroupe` int(11) NOT NULL,
  `Membre_idMembre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `auteurId` int(11) DEFAULT NULL,
  `dateEnvoi` datetime DEFAULT NULL,
  `groupeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `prenom`, `nom`, `date_naissance`, `email`, `username`, `password`) VALUES
(5, 'John', 'Doe', '1990-01-01', 'john.doe@example.com', 'johndoe', 'securepassword'),
(6, 'Gnim', 'DAO', '2024-12-05', 'daogregoire09@gmail.com', 'GÃ© la pÃ©pite', '$2y$10$mqjgAopuVzlSMZL22hN4lOYZB/doirFJcfPA9nX2n171gsIGsP2VO'),
(7, 'Gnim', 'DAO', '2024-12-05', 'daogregoire09@gmail.com', 'GÃ© la pÃ©pite', '$2y$10$mqjgAopuVzlSMZL22hN4lOYZB/doirFJcfPA9nX2n171gsIGsP2VO'),
(8, 'Gnim', 'DAO', '2024-12-05', 'daogregoire09@gmail.com', 'GÃ© la pÃ©pite', '$2y$10$mqjgAopuVzlSMZL22hN4lOYZB/doirFJcfPA9nX2n171gsIGsP2VO');


ALTER TABLE `activite`
  ADD PRIMARY KEY (`idActivite`),
  ADD KEY `fk_Activite_Groupe_idx` (`idGroupe`);

ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idGroupe`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `activite`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `groupe`
  MODIFY `idGroupe` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `activite`
  ADD CONSTRAINT `fk_Activite_Groupe` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
