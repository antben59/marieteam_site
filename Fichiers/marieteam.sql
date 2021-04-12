-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 12, 2021 at 06:58 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marieteam`
--

-- --------------------------------------------------------

--
-- Table structure for table `bateau`
--

DROP TABLE IF EXISTS `bateau`;
CREATE TABLE IF NOT EXISTS `bateau` (
  `id_bateau` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `longueur` varchar(150) NOT NULL,
  `largeur` varchar(150) NOT NULL,
  `vitesse` varchar(150) NOT NULL,
  `equipements` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id_bateau`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bateau`
--

INSERT INTO `bateau` (`id_bateau`, `nom`, `longueur`, `largeur`, `vitesse`, `equipements`, `image`) VALUES
(1, 'CASH-A-L\'EAU', '550', '30', '50', '', ''),
(2, 'ODE MER', '550', '30', '50', '', ''),
(3, 'TITANIC', '550', '30', '50', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `lettre_categorie` char(5) NOT NULL,
  `libelle` varchar(80) NOT NULL,
  PRIMARY KEY (`lettre_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`lettre_categorie`, `libelle`) VALUES
('A', 'Passager'),
('B', 'Veh.inf.2m'),
('C', 'Veh.sup.2m');

-- --------------------------------------------------------

--
-- Table structure for table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `lettre_categorie` char(5) NOT NULL,
  `id_bateau` int(11) NOT NULL,
  `capaciteMax` int(11) NOT NULL,
  PRIMARY KEY (`lettre_categorie`,`id_bateau`),
  KEY `CONTENIR_BATEAU0_FK` (`id_bateau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enregistrer`
--

DROP TABLE IF EXISTS `enregistrer`;
CREATE TABLE IF NOT EXISTS `enregistrer` (
  `num_type` int(11) NOT NULL,
  `num_reservation` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`num_type`,`num_reservation`),
  KEY `ENREGISTRER_RESERVATION0_FK` (`num_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `liaison`
--

DROP TABLE IF EXISTS `liaison`;
CREATE TABLE IF NOT EXISTS `liaison` (
  `code_liaison` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `distance_miles` float NOT NULL,
  `id_secteur` int(11) NOT NULL,
  `port_depart` int(11) NOT NULL,
  `port_arrivee` int(11) NOT NULL,
  PRIMARY KEY (`code_liaison`),
  KEY `LIAISON_SECTEUR_FK` (`id_secteur`),
  KEY `LIAISON_PORT0_FK` (`port_depart`),
  KEY `LIAISON_PORT1_FK` (`port_arrivee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liaison`
--

INSERT INTO `liaison` (`code_liaison`, `nom`, `distance_miles`, `id_secteur`, `port_depart`, `port_arrivee`) VALUES
(15, 'Quiberon - Le Palais', 8.3, 1, 1, 2),
(24, 'Le Palais - Belleville', 9, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `dateDeb` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`dateDeb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`dateDeb`, `dateFin`) VALUES
('2020-09-01', '2021-06-15'),
('2021-06-16', '2021-09-15'),
('2021-09-16', '2022-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `port`
--

DROP TABLE IF EXISTS `port`;
CREATE TABLE IF NOT EXISTS `port` (
  `id_port` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id_port`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `port`
--

INSERT INTO `port` (`id_port`, `nom`) VALUES
(1, 'Quiberon'),
(2, 'Le Palais'),
(3, 'Sauzon'),
(4, 'Vannes'),
(5, 'Port St Gildas'),
(6, 'Port-Tudy'),
(7, 'Lorient');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `num_reservation` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `adr` varchar(80) NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `num_traversee` int(11) NOT NULL,
  PRIMARY KEY (`num_reservation`),
  KEY `RESERVATION_TRAVERSEE_FK` (`num_traversee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
CREATE TABLE IF NOT EXISTS `secteur` (
  `id_secteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id_secteur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secteur`
--

INSERT INTO `secteur` (`id_secteur`, `nom`) VALUES
(1, 'Belle-Ils-en-mer'),
(2, 'Houat'),
(3, 'Ils de Groix'),
(4, 'Ouessant'),
(5, 'Molene'),
(6, 'Sein'),
(7, 'Brehat'),
(8, 'Batz'),
(9, 'Aix'),
(10, 'Yeu');

-- --------------------------------------------------------

--
-- Table structure for table `tarifer`
--

DROP TABLE IF EXISTS `tarifer`;
CREATE TABLE IF NOT EXISTS `tarifer` (
  `dateDeb` date NOT NULL,
  `code_liaison` int(11) NOT NULL,
  `num_type` int(11) NOT NULL,
  `tarif` float NOT NULL,
  PRIMARY KEY (`dateDeb`,`code_liaison`,`num_type`),
  KEY `TARIFER_LIAISON0_FK` (`code_liaison`),
  KEY `TARIFER_TYPE1_FK` (`num_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `traversee`
--

DROP TABLE IF EXISTS `traversee`;
CREATE TABLE IF NOT EXISTS `traversee` (
  `num_traversee` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` datetime NOT NULL,
  `code_liaison` int(11) NOT NULL,
  `id_bateau` int(11) NOT NULL,
  PRIMARY KEY (`num_traversee`),
  KEY `TRAVERSEE_LIAISON_FK` (`code_liaison`),
  KEY `TRAVERSEE_BATEAU0_FK` (`id_bateau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `num_type` int(11) NOT NULL,
  `libelle` varchar(80) NOT NULL,
  `lettre_categorie` char(5) NOT NULL,
  PRIMARY KEY (`num_type`),
  KEY `TYPE_CATEGORIE_FK` (`lettre_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `mot_de_passe` varchar(250) NOT NULL,
  `grade` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `mail`, `mot_de_passe`, `grade`) VALUES
(1, 'bjugtgtt', 'gtgtg', 'rffrfr@gmail.com', 'a', 0),
(4, 'Decool', 'Dylan', 'dylan.decool14@gmail.com', '123', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `CONTENIR_BATEAU0_FK` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id_bateau`),
  ADD CONSTRAINT `CONTENIR_CATEGORIE_FK` FOREIGN KEY (`lettre_categorie`) REFERENCES `categorie` (`lettre_categorie`);

--
-- Constraints for table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD CONSTRAINT `ENREGISTRER_RESERVATION0_FK` FOREIGN KEY (`num_reservation`) REFERENCES `reservation` (`num_reservation`);

--
-- Constraints for table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `LIAISON_PORT0_FK` FOREIGN KEY (`port_depart`) REFERENCES `port` (`id_port`),
  ADD CONSTRAINT `LIAISON_PORT1_FK` FOREIGN KEY (`port_arrivee`) REFERENCES `port` (`id_port`),
  ADD CONSTRAINT `LIAISON_SECTEUR_FK` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id_secteur`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `RESERVATION_TRAVERSEE_FK` FOREIGN KEY (`num_traversee`) REFERENCES `traversee` (`num_traversee`);

--
-- Constraints for table `tarifer`
--
ALTER TABLE `tarifer`
  ADD CONSTRAINT `TARIFER_LIAISON0_FK` FOREIGN KEY (`code_liaison`) REFERENCES `liaison` (`code_liaison`),
  ADD CONSTRAINT `TARIFER_PERIODE_FK` FOREIGN KEY (`dateDeb`) REFERENCES `periode` (`dateDeb`),
  ADD CONSTRAINT `TARIFER_TYPE1_FK` FOREIGN KEY (`num_type`) REFERENCES `type` (`num_type`);

--
-- Constraints for table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `TRAVERSEE_BATEAU0_FK` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id_bateau`),
  ADD CONSTRAINT `TRAVERSEE_LIAISON_FK` FOREIGN KEY (`code_liaison`) REFERENCES `liaison` (`code_liaison`);

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `TYPE_CATEGORIE_FK` FOREIGN KEY (`lettre_categorie`) REFERENCES `categorie` (`lettre_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
