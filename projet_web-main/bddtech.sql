-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 mai 2021 à 09:31
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
-- Base de données : `bddtech`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `idCand` int(11) NOT NULL,
  `nom` varchar(25) COLLATE latin1_bin NOT NULL,
  `Prenoms` varchar(35) COLLATE latin1_bin NOT NULL,
  `DateNaissance` varchar(10) COLLATE latin1_bin NOT NULL,
  `Adresse` varchar(75) COLLATE latin1_bin NOT NULL,
  `courriel` varchar(75) COLLATE latin1_bin NOT NULL,
  `Telephone` int(10) DEFAULT NULL,
  `idSpec` int(11) NOT NULL,
  `password` varchar(30) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idCand`),
  KEY `specialite` (`idSpec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`idCand`, `nom`, `Prenoms`, `DateNaissance`, `Adresse`, `courriel`, `Telephone`, `idSpec`, `password`) VALUES
(0, '', '', '', '', 'admin@infsup.net', NULL, 100, 'admin'),
(1010, 'RIVAY', 'Claude', '1995-05-02', '24 rue de Montreuil 75020', 'no_adr1@info.sup', 743893553, 200, 'fe8f484fnju4'),
(1020, 'DUBOIS', 'Clement', '1998-04-23', '10 Bd. Voltaire 75011', 'no_adr2@info.sup', 771077541, 300, 'ferfr585ed8'),
(1030, 'LAVERDURE', 'Patrick', '1996-09-02', '74 rue Daumesnil 75008', 'no_adr3@info.sup', 645017492, 300, 'NLq5pm9B8e)~>#fT'),
(1155, 'RATTIER', 'Claude', '2001-03-13', '44 rue de Montreuil 75020', 'no_adr10@info.sup', 622614605, 100, 'h^sc6k%dG}!*[MHJ'),
(1212, 'Edme', 'Liza', '1996-06-28', '12 rue de Montreuil 75020', 'no_adr13@info.sup', 747460728, 100, 'g=y{Qkv[]n`GR3f)'),
(1941, 'Hazem', 'Karim', '1986-12-17', '13 Av. Gl De Gaule 94000', 'no_adr15@info.sup', 741332340, 400, 'e9bz%AR/pP&'),
(2109, 'LEE', 'Yan Fu', '1992-06-19', '113 Av. Gl De Gaule 92000', 'no_adr14@info.sup', 715704692, 400, 'bm,.tG<8Mw$anz9'),
(3325, 'Tripon', 'Arnaud', '1996-09-03', '51 rue de Montreuil 75020', 'no_adr12@info.sup', 694435615, 500, 'eWB<;x8+5V6AM)k`'),
(5500, 'LEROY', 'Axelle', '2000-11-28', '11 Av. Gl De Gaule 77000', 'no_adr5@info.sup', 690559297, 100, 's4*]tAa;6}ZPzD)5'),
(6500, 'FISCHER', 'Vincent', '1994-03-16', '15 rue de la Pierre Levee 75011', 'no_adr6@info.sup', 613200413, 400, 'b%PE),h2mXL-+arC'),
(7070, 'CORNU', 'Isabelle', '2000-02-12', '76 rue de Montreuil 75020', 'no_adr7@info.sup', 753697252, 500, 'qxD4<Q,5;Xwd&BFT'),
(7090, 'CORNU', 'Isabelle', '1999-05-08', '1 Av. de la Republique 75011', 'no_adr9@info.sup', 660752717, 400, 'L</VP2uj7X69r{E]'),
(7150, 'BORIS', 'Jean', '2000-08-17', '25 Av. Parmentier 75011', 'no_adr8@info.sup', 713419823, 300, 'UxBPs5q`\"VA]3?yk'),
(9801, 'GRANDVALLET', 'lucas', '1998-03-14', '33 rue du Maroc 75020', 'no_adr11@info.sup', 658632555, 300, 'T],zs\"5:*)9f6;.Q');

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `idEpr` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(25) COLLATE latin1_bin NOT NULL,
  `Coef` int(11) NOT NULL,
  `Note_eliminat` int(11) NOT NULL,
  PRIMARY KEY (`idEpr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `epreuve`
--

INSERT INTO `epreuve` (`idEpr`, `designation`, `Coef`, `Note_eliminat`) VALUES
(1, 'Informatique', 5, 3),
(2, 'Francais', 3, 2),
(3, 'Anglais', 2, 2),
(4, 'Culture_Generale', 2, 3),
(5, 'Physique', 3, 3),
(6, 'Mathematiques', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `idCand` int(11) NOT NULL,
  `idEpr` int(11) NOT NULL,
  `note` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idCand`,`idEpr`),
  KEY `idEpr` (`idEpr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `resultat`
--

INSERT INTO `resultat` (`idCand`, `idEpr`, `note`) VALUES
(1010, 1, '9.00'),
(1010, 2, '11.50'),
(1010, 3, '14.00'),
(1010, 4, '7.00'),
(1010, 5, '10.00'),
(1010, 6, '13.00'),
(1020, 1, '13.00'),
(1020, 2, '14.50'),
(1020, 3, '8.00'),
(1020, 4, '5.00'),
(1020, 5, '14.00'),
(1020, 6, '14.00'),
(1030, 1, '17.00'),
(1030, 2, '15.50'),
(1030, 3, '11.00'),
(1030, 4, '7.50'),
(1030, 5, '11.00'),
(1030, 6, '9.00'),
(1155, 1, '16.50'),
(1155, 2, '12.00'),
(1155, 3, '12.00'),
(1155, 4, '13.50'),
(1155, 5, '3.00'),
(1155, 6, '15.25'),
(1212, 1, '3.00'),
(1212, 2, '11.50'),
(1212, 3, '10.00'),
(1212, 4, '11.00'),
(1212, 5, '10.00'),
(1212, 6, '4.00'),
(1941, 1, '5.50'),
(1941, 2, '7.50'),
(1941, 3, '3.00'),
(1941, 4, '2.50'),
(1941, 5, '4.50'),
(1941, 6, '15.00'),
(2109, 1, '13.50'),
(2109, 2, '14.50'),
(2109, 3, '11.00'),
(2109, 4, '13.00'),
(2109, 5, '15.50'),
(2109, 6, '1.00'),
(3325, 1, '2.50'),
(3325, 2, '5.50'),
(3325, 3, '4.00'),
(3325, 4, '3.00'),
(3325, 5, '3.00'),
(3325, 6, '5.00'),
(5500, 1, '3.00'),
(5500, 2, '9.00'),
(5500, 3, '8.00'),
(5500, 4, '5.00'),
(5500, 5, '11.00'),
(5500, 6, '7.00'),
(6500, 1, '0.00'),
(6500, 2, '3.50'),
(6500, 3, '9.00'),
(6500, 4, '4.50'),
(6500, 5, '3.00'),
(6500, 6, '20.00'),
(7070, 1, '15.50'),
(7070, 2, '14.50'),
(7070, 3, '13.00'),
(7070, 4, '12.00'),
(7070, 5, '18.00'),
(7070, 6, '18.00'),
(7090, 1, '0.50'),
(7090, 2, '0.00'),
(7090, 3, '0.00'),
(7090, 4, '0.00'),
(7090, 5, '15.00'),
(7090, 6, '10.00'),
(7150, 1, '9.50'),
(7150, 2, '10.50'),
(7150, 3, '11.00'),
(7150, 4, '9.00'),
(7150, 5, '11.00'),
(7150, 6, '11.00'),
(9801, 1, '7.50'),
(9801, 2, '13.50'),
(9801, 3, '11.00'),
(9801, 4, '13.00'),
(9801, 5, '10.00'),
(9801, 6, '10.00');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `idSpec` int(11) NOT NULL,
  `specialite` varchar(35) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idSpec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`idSpec`, `specialite`) VALUES
(100, 'DEV APP'),
(200, 'ING RESEAUX'),
(300, 'INTEG BDD'),
(400, 'ADM SYS '),
(500, 'Chef de projets');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUser` int(11) NOT NULL,
  `login` varchar(40) COLLATE latin1_bin NOT NULL,
  `password` varchar(30) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `login`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`idSpec`) REFERENCES `specialite` (`idSpec`);

--
-- Contraintes pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD CONSTRAINT `resultat_ibfk_1` FOREIGN KEY (`idCand`) REFERENCES `candidat` (`idCand`),
  ADD CONSTRAINT `resultat_ibfk_2` FOREIGN KEY (`idEpr`) REFERENCES `epreuve` (`idEpr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
