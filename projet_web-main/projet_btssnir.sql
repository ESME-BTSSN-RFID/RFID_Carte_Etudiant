-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 mai 2022 à 14:31
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
  `idCarteEtudiant` varchar(11) NOT NULL,
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
('202', 'Vercelonne', 'Hugo', 1),
('45', 'AA', 'BB', 2),
('548', 'Ã©Ã©Ã©Ã©', 'Ã©Ã©Ã©Ã©', 1),
('74 8e 61 27', 'CRIDLIG', 'Hugp', 2),
('852', 'De almeida vaz', 'Alexandre', 1),
('96', 'LESGOO', 'AU NAAN', 1),
('ABCD1', 'Shaw', 'Martin', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`idProf`, `nom`, `prenom`) VALUES
(0, 'admin', 'admin'),
(1, 'WANG', 'Victor');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `idSalle` int(11) NOT NULL,
  `room` varchar(10) NOT NULL,
  PRIMARY KEY (`idSalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`idSalle`, `room`) VALUES
(1, 'B01A'),
(2, 'B01B'),
(3, 'B02A'),
(4, 'B02B'),
(5, 'B06A'),
(6, 'B06B'),
(7, 'B07');

-- --------------------------------------------------------

--
-- Structure de la table `scan`
--

DROP TABLE IF EXISTS `scan`;
CREATE TABLE IF NOT EXISTS `scan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `scan`
--

INSERT INTO `scan` (`id`, `uid`, `time`) VALUES
(1003, '74 8e 61 27', '2022-03-30 09:18:33'),
(1004, '74 8e 61 27', '2022-03-30 09:59:43'),
(1005, '74 8e 61 27', '2022-04-04 09:03:35'),
(1006, '548', '2022-04-04 09:04:05'),
(1007, '1234', '2022-04-04 09:04:05'),
(1008, 'ABCD1', '2022-04-04 09:04:51'),
(1009, '1234', '2022-04-04 09:04:00'),
(1010, '74 8e 61 27', '2022-04-11 14:10:35'),
(1011, '1234', '2022-04-11 14:10:35'),
(1012, '74 8e 61 27', '2022-04-11 14:11:13'),
(1013, '548', '2022-04-11 14:11:13'),
(1014, '74 8e 61 27', '2022-05-09 08:04:30');

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
  `idSalle` int(11) NOT NULL,
  `heureDebut` varchar(20) NOT NULL,
  `heureFin` varchar(20) NOT NULL,
  `duree` int(4) NOT NULL,
  PRIMARY KEY (`idSeance`),
  KEY `idClass` (`idClass`),
  KEY `idCours` (`idCours`),
  KEY `idProf` (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`idSeance`, `idClass`, `idCours`, `idProf`, `idSalle`, `heureDebut`, `heureFin`, `duree`) VALUES
(25, 1, 2, 1, 2, '2022-03-11T16:05', '2022-03-11T18:05', 2),
(28, 2, 1, 1, 1, '2022-03-08T16:10', '2022-03-08T18:10', 2),
(29, 1, 5, 1, 3, '2022-03-01T13:27', '2022-03-13T14:27', 1),
(30, 1, 1, 1, 3, '2022-03-03T13:00', '2022-03-03T14:00', 1),
(35, 1, 2, 1, 3, '2022-03-16T16:00', '2022-03-18T18:00', 2),
(37, 2, 3, 1, 3, '2022-03-16T15:00', '2022-03-16T18:00', 3),
(38, 1, 1, 1, 2, '2022-03-14T11:00', '2022-03-14T14:00', 3),
(39, 1, 1, 1, 1, '2022-03-25T11:00', '2022-03-25T13:00', 2),
(41, 1, 1, 1, 1, '2022-03-29T11:00', '2022-03-29T13:00', 2),
(42, 1, 3, 1, 2, '2022-03-30T10:00', '2022-03-30T12:00', 2),
(43, 1, 5, 1, 5, '2022-04-02T11:00', '2022-04-02T15:00', 4),
(44, 1, 1, 1, 1, '2022-04-04T10:00', '2022-04-04T12:00', 2),
(45, 1, 1, 1, 1, '2022-04-11T15:00', '2022-04-11T18:00', 3),
(46, 1, 1, 1, 1, '2022-04-11T18:00', '2022-04-11T19:00', 1),
(47, 1, 1, 1, 2, '2022-04-19T09:00', '2022-04-19T13:00', 4),
(49, 1, 2, 1, 2, '2022-04-20T10:00', '2022-04-20T13:00', 3),
(50, 1, 1, 1, 4, '2022-04-21T14:00', '2022-04-21T17:00', 3),
(51, 1, 1, 1, 1, '2022-04-25T12:00', '2022-04-25T14:00', 2),
(52, 1, 2, 1, 1, '2022-05-04T10:00', '2022-05-04T12:00', 2),
(53, 1, 1, 1, 1, '2022-05-09T10:00', '2022-05-09T12:00', 2),
(54, 1, 1, 1, 4, '2022-05-18T09:00', '2022-05-18T11:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  `idProf` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login`),
  KEY `idProf` (`idProf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`, `idProf`) VALUES
('hugo', '$2y$10$9ALmyyrQicNXvZh/734IT.UrGtgE/H27tKZsEHoRAcVxi4bAccZhm', 1),
('user', '$2y$10$MyS5RLrtOMXoASLNKZOEKuzGsl5PQvZAGx3/9WOoipC8BV/jNYOFy', 0),
('vwang', '$2y$10$kn8CN8w4SkpJdWjMn6F5leC2HIHIp1dTILEYhf0u7bBOEqV1LKWta', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`idClass`) REFERENCES `classe` (`idClass`);

--
-- Contraintes pour la table `scan`
--
ALTER TABLE `scan`
  ADD CONSTRAINT `scan_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `eleve` (`idCarteEtudiant`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`idClass`) REFERENCES `classe` (`idClass`),
  ADD CONSTRAINT `seance_ibfk_2` FOREIGN KEY (`idCours`) REFERENCES `cours` (`idCours`),
  ADD CONSTRAINT `seance_ibfk_3` FOREIGN KEY (`idProf`) REFERENCES `prof` (`idProf`),
  ADD CONSTRAINT `seance_ibfk_4` FOREIGN KEY (`idProf`) REFERENCES `salle` (`idSalle`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idProf`) REFERENCES `prof` (`idProf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
