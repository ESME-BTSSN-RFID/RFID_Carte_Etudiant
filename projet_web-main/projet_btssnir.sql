-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 02 mars 2022 à 09:49
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_btssnir`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `idAdmin` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `classe` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `idClass` int(11) NOT NULL,
  `label` varchar(20) NOT NULL,
  PRIMARY KEY (`idClass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`idClass`, `label`) VALUES
(1, 'BTS1'),
(2, 'BTS2');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idCours` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  PRIMARY KEY (`idCours`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idCours`, `matiere`) VALUES
(1, 'Informatique'),
(2, 'Réseaux'),
(3, 'Mathématiques'),
(4, 'Physique'),
(5, 'Culture Générale'),
(6, 'Electronique');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `idCarteEtudiant` varchar(5) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `idClass` int(11) NOT NULL,
  PRIMARY KEY (`idCarteEtudiant`),
  KEY `idClass` (`idClass`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`idCarteEtudiant`, `nom`, `prenom`, `idClass`) VALUES
('1234', 'Bon bah', 'go au naan', 1),
('17', 'Cridlig', 'Hugo', 1),
('202', 'Vercelonne', 'Hugo', 1),
('556', 'Peintureaux', 'QuÃ©vine', 2),
('852', 'De almeida vaz', 'Alexandre', 1),
('96', 'LESGOO', 'AU NAAN', 1),
('ABCD1', 'Shaw', 'Martin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

DROP TABLE IF EXISTS `prof`;
CREATE TABLE IF NOT EXISTS `prof` (
  `idProf` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`idProf`, `nom`, `prenom`) VALUES
(1, 'WANG', 'Victor');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `idSeance` int(11) NOT NULL AUTO_INCREMENT,
  `idClass` int(11) NOT NULL,
  `idCours` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `heureDebut` varchar(20) NOT NULL,
  `heureFin` varchar(20) NOT NULL,
  PRIMARY KEY (`idSeance`),
  KEY `idClass` (`idClass`),
  KEY `idCours` (`idCours`),
  KEY `idProf` (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`idSeance`, `idClass`, `idCours`, `idProf`, `heureDebut`, `heureFin`) VALUES
(5, 2, 4, 1, '2022-03-02T09:50', '2022-03-02T12:50');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id`, `uid`) VALUES
(1, 'RFID TAG ID:74 8E 61 27 \r\n'),
(2, 'RFID TAG ID:74 8E 61 27 \r\n'),
(3, 'RFID TAG ID:74 8E 61 27 \r\n'),
(4, 'RFID TAG ID:74 8E 61 27 \r\n'),
(5, 'RFID TAG ID:74 8E 61 27 \r\n'),
(6, 'RFID TAG ID:74 8E 61 27 \r\n'),
(7, 'RFID TAG ID:74 8E 61 27 \r\n'),
(8, 'RFID TAG ID:74 8E 61 27 \r\n'),
(9, 'RFID TAG ID:74 8E 61 27 \r\n');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`) VALUES
('user', 'root');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`idClass`) REFERENCES `classe` (`idClass`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`idClass`) REFERENCES `classe` (`idClass`),
  ADD CONSTRAINT `seance_ibfk_2` FOREIGN KEY (`idCours`) REFERENCES `cours` (`idCours`),
  ADD CONSTRAINT `seance_ibfk_3` FOREIGN KEY (`idProf`) REFERENCES `prof` (`idProf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
