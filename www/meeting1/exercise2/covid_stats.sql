-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mar. 08 déc. 2020 à 19:12
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.11

DROP TABLE IF EXISTS `covid_stats`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webprog`
--

-- --------------------------------------------------------

--
-- Structure de la table `covid_stats`
--

CREATE TABLE `covid_stats` (
  `filename` varchar(14) NOT NULL,
  `date` date NOT NULL,
  `province_state` varchar(255) NOT NULL,
  `country_region` varchar(255) NOT NULL,
  `confirmed` int(11) NOT NULL DEFAULT '0',
  `deaths` int(11) NOT NULL DEFAULT '0',
  `recovered` int(11) NOT NULL DEFAULT '0',
  `type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `covid_stats`
--
ALTER TABLE `covid_stats`
  ADD KEY `date` (`date`),
  ADD KEY `country_region` (`country_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
