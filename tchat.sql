-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 15 nov. 2020 à 03:52
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `message` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `chats`
--

INSERT INTO `chats` (`id`, `from_user`, `to_user`, `is_read`, `message`, `created_at`) VALUES
(1, 20, 22, 1, 'test', '2020-11-15 02:13:52'),
(2, 20, 22, 1, 'test1', '2020-11-15 02:14:27'),
(3, 20, 0, 0, '', '2020-11-15 02:22:59'),
(4, 22, 20, 1, '', '2020-11-15 03:22:34'),
(5, 22, 20, 1, 'Merci', '2020-11-15 03:23:46'),
(6, 22, 20, 1, 'Nop', '2020-11-15 03:26:00'),
(7, 20, 22, 1, 'OOK', '2020-11-15 03:26:30');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_online`, `created_at`) VALUES
(20, 'admin@admin.ma', '$2y$10$MSrHq/cZUkWq55XTd4LdRuC4DwQREKrecx03rYrwoAPQ48freZ9oK', 1, '2020-11-15 00:36:38'),
(21, 'test@test.ma', '$2y$10$UrlPGywRCbpFvEiHrlKX6ObvJ8ZWK3O0uGFMh.5IqW6CMsFZ8F6w2', 0, '2020-11-15 00:36:38'),
(22, 'zlaiga@zlaiga.ma', '$2y$10$1ir4cvI1.yf69SHU9pNAaeGarr0srDE7EMi5AQE/m7tIerAnNTroK', 1, '2020-11-15 01:16:27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
