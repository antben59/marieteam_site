-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 07 nov. 2020 à 22:49
-- Version du serveur :  10.3.23-MariaDB-0+deb10u1
-- Version de PHP :  7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `marieteam`
--

-- --------------------------------------------------------

--
-- Structure de la table `BATEAU`
--

CREATE TABLE `BATEAU` (
  `id_bateau` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORIE`
--

CREATE TABLE `CATEGORIE` (
  `lettre_categorie` char(5) NOT NULL,
  `libelle` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `CONTENIR`
--

CREATE TABLE `CONTENIR` (
  `lettre_categorie` char(5) NOT NULL,
  `id_bateau` int(11) NOT NULL,
  `capaciteMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ENREGISTRER`
--

CREATE TABLE `ENREGISTRER` (
  `num_type` int(11) NOT NULL,
  `num_reservation` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `LIAISON`
--

CREATE TABLE `LIAISON` (
  `code_liaison` int(11) NOT NULL,
  `distance` float NOT NULL,
  `id_secteur` int(11) NOT NULL,
  `id_port` int(11) NOT NULL,
  `id_port_ARRIVEE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `PERIODE`
--

CREATE TABLE `PERIODE` (
  `dateDeb` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `PORT`
--

CREATE TABLE `PORT` (
  `id_port` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `RESERVATION`
--

CREATE TABLE `RESERVATION` (
  `num_reservation` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `adr` varchar(80) NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `num_traversee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `SECTEUR`
--

CREATE TABLE `SECTEUR` (
  `id_secteur` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `TARIFER`
--

CREATE TABLE `TARIFER` (
  `dateDeb` date NOT NULL,
  `code_liaison` int(11) NOT NULL,
  `num_type` int(11) NOT NULL,
  `tarif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `TRAVERSEE`
--

CREATE TABLE `TRAVERSEE` (
  `num_traversee` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` datetime NOT NULL,
  `code_liaison` int(11) NOT NULL,
  `id_bateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `TYPE`
--

CREATE TABLE `TYPE` (
  `num_type` int(11) NOT NULL,
  `libelle` varchar(80) NOT NULL,
  `lettre_categorie` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `BATEAU`
--
ALTER TABLE `BATEAU`
  ADD PRIMARY KEY (`id_bateau`);

--
-- Index pour la table `CATEGORIE`
--
ALTER TABLE `CATEGORIE`
  ADD PRIMARY KEY (`lettre_categorie`);

--
-- Index pour la table `CONTENIR`
--
ALTER TABLE `CONTENIR`
  ADD PRIMARY KEY (`lettre_categorie`,`id_bateau`),
  ADD KEY `CONTENIR_BATEAU0_FK` (`id_bateau`);

--
-- Index pour la table `ENREGISTRER`
--
ALTER TABLE `ENREGISTRER`
  ADD PRIMARY KEY (`num_type`,`num_reservation`),
  ADD KEY `ENREGISTRER_RESERVATION0_FK` (`num_reservation`);

--
-- Index pour la table `LIAISON`
--
ALTER TABLE `LIAISON`
  ADD PRIMARY KEY (`code_liaison`),
  ADD KEY `LIAISON_SECTEUR_FK` (`id_secteur`),
  ADD KEY `LIAISON_PORT0_FK` (`id_port`),
  ADD KEY `LIAISON_PORT1_FK` (`id_port_ARRIVEE`);

--
-- Index pour la table `PERIODE`
--
ALTER TABLE `PERIODE`
  ADD PRIMARY KEY (`dateDeb`);

--
-- Index pour la table `PORT`
--
ALTER TABLE `PORT`
  ADD PRIMARY KEY (`id_port`);

--
-- Index pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD PRIMARY KEY (`num_reservation`),
  ADD KEY `RESERVATION_TRAVERSEE_FK` (`num_traversee`);

--
-- Index pour la table `SECTEUR`
--
ALTER TABLE `SECTEUR`
  ADD PRIMARY KEY (`id_secteur`);

--
-- Index pour la table `TARIFER`
--
ALTER TABLE `TARIFER`
  ADD PRIMARY KEY (`dateDeb`,`code_liaison`,`num_type`),
  ADD KEY `TARIFER_LIAISON0_FK` (`code_liaison`),
  ADD KEY `TARIFER_TYPE1_FK` (`num_type`);

--
-- Index pour la table `TRAVERSEE`
--
ALTER TABLE `TRAVERSEE`
  ADD PRIMARY KEY (`num_traversee`),
  ADD KEY `TRAVERSEE_LIAISON_FK` (`code_liaison`),
  ADD KEY `TRAVERSEE_BATEAU0_FK` (`id_bateau`);

--
-- Index pour la table `TYPE`
--
ALTER TABLE `TYPE`
  ADD PRIMARY KEY (`num_type`),
  ADD KEY `TYPE_CATEGORIE_FK` (`lettre_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `BATEAU`
--
ALTER TABLE `BATEAU`
  MODIFY `id_bateau` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `PORT`
--
ALTER TABLE `PORT`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `SECTEUR`
--
ALTER TABLE `SECTEUR`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CONTENIR`
--
ALTER TABLE `CONTENIR`
  ADD CONSTRAINT `CONTENIR_BATEAU0_FK` FOREIGN KEY (`id_bateau`) REFERENCES `BATEAU` (`id_bateau`),
  ADD CONSTRAINT `CONTENIR_CATEGORIE_FK` FOREIGN KEY (`lettre_categorie`) REFERENCES `CATEGORIE` (`lettre_categorie`);

--
-- Contraintes pour la table `ENREGISTRER`
--
ALTER TABLE `ENREGISTRER`
  ADD CONSTRAINT `ENREGISTRER_RESERVATION0_FK` FOREIGN KEY (`num_reservation`) REFERENCES `RESERVATION` (`num_reservation`),
  ADD CONSTRAINT `ENREGISTRER_TYPE_FK` FOREIGN KEY (`num_type`) REFERENCES `TYPE` (`num_type`);

--
-- Contraintes pour la table `LIAISON`
--
ALTER TABLE `LIAISON`
  ADD CONSTRAINT `LIAISON_PORT0_FK` FOREIGN KEY (`id_port`) REFERENCES `PORT` (`id_port`),
  ADD CONSTRAINT `LIAISON_PORT1_FK` FOREIGN KEY (`id_port_ARRIVEE`) REFERENCES `PORT` (`id_port`),
  ADD CONSTRAINT `LIAISON_SECTEUR_FK` FOREIGN KEY (`id_secteur`) REFERENCES `SECTEUR` (`id_secteur`);

--
-- Contraintes pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD CONSTRAINT `RESERVATION_TRAVERSEE_FK` FOREIGN KEY (`num_traversee`) REFERENCES `TRAVERSEE` (`num_traversee`);

--
-- Contraintes pour la table `TARIFER`
--
ALTER TABLE `TARIFER`
  ADD CONSTRAINT `TARIFER_LIAISON0_FK` FOREIGN KEY (`code_liaison`) REFERENCES `LIAISON` (`code_liaison`),
  ADD CONSTRAINT `TARIFER_PERIODE_FK` FOREIGN KEY (`dateDeb`) REFERENCES `PERIODE` (`dateDeb`),
  ADD CONSTRAINT `TARIFER_TYPE1_FK` FOREIGN KEY (`num_type`) REFERENCES `TYPE` (`num_type`);

--
-- Contraintes pour la table `TRAVERSEE`
--
ALTER TABLE `TRAVERSEE`
  ADD CONSTRAINT `TRAVERSEE_BATEAU0_FK` FOREIGN KEY (`id_bateau`) REFERENCES `BATEAU` (`id_bateau`),
  ADD CONSTRAINT `TRAVERSEE_LIAISON_FK` FOREIGN KEY (`code_liaison`) REFERENCES `LIAISON` (`code_liaison`);

--
-- Contraintes pour la table `TYPE`
--
ALTER TABLE `TYPE`
  ADD CONSTRAINT `TYPE_CATEGORIE_FK` FOREIGN KEY (`lettre_categorie`) REFERENCES `CATEGORIE` (`lettre_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
