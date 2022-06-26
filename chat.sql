-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 19 juin 2022 à 23:12
-- Version du serveur : 10.3.31-MariaDB
-- Version de PHP : 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mtmgetce_chat`
--
CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mtmgetce_chat`;

-- --------------------------------------------------------

--
-- Structure de la table `ancien_message`
--

CREATE TABLE `ancien_message` (
  `pseudo` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ancien_message`
--
-- Structure de la table `chat_accounts`
--

CREATE TABLE `chat_accounts` (
  `account_login` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `account_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `mail` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mail_verif` enum('0','1') NOT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat_accounts`
--
-- --------------------------------------------------------

--
-- Structure de la table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `message_id` int(11) NOT NULL,
  `message_text` longtext CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `forwho` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat_messages`
--


-- --------------------------------------------------------

--
-- Structure de la table `chat_online`
--

CREATE TABLE `chat_online` (
  `online_id` int(11) NOT NULL,
  `online_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_user` varchar(255) NOT NULL,
  `online_status` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat_online`
--
-- Structure de la table `private_messages`
--

CREATE TABLE `private_messages` (
  `fromwho` varchar(255) NOT NULL,
  `forwho` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `private_messages`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat_accounts`
--
ALTER TABLE `chat_accounts`
  ADD PRIMARY KEY (`account_login`);

--
-- Index pour la table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index pour la table `chat_online`
--
ALTER TABLE `chat_online`
  ADD PRIMARY KEY (`online_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1201;

--
-- AUTO_INCREMENT pour la table `chat_online`
--
ALTER TABLE `chat_online`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
