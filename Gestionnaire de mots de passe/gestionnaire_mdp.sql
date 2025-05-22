-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 mai 2025 à 08:58
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionnaire_mdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mdp_id` int NOT NULL,
  `utilisateur_histo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `mdp_id`, `utilisateur_histo`, `modification`) VALUES
(1, 16, 'test2', '2025-05-21 10:17:22'),
(2, 16, 'test2', '0000-00-00 00:00:00'),
(3, 16, 'test2', '0000-00-00 00:00:00'),
(4, 16, 'test2', '0000-00-00 00:00:00'),
(5, 16, 'test2', '2025-05-22 10:49:46'),
(6, 16, 'test2', '2025-05-22 10:50:03'),
(7, 16, 'test2', '2025-05-22 10:53:14');

-- --------------------------------------------------------

--
-- Structure de la table `mdp`
--

DROP TABLE IF EXISTS `mdp`;
CREATE TABLE IF NOT EXISTS `mdp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur` text NOT NULL,
  `site` text NOT NULL,
  `lien` text NOT NULL,
  `identifiant` text NOT NULL,
  `mdp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mdp`
--

INSERT INTO `mdp` (`id`, `utilisateur`, `site`, `lien`, `identifiant`, `mdp`) VALUES
(16, 'test2', 'youtube.fr', 'https://www.test.fr', '', 'Qy7y@zx!NKi(');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL,
  `login` text NOT NULL,
  `mdpMaitre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `login`, `mdpMaitre`) VALUES
(1, 'test', 'test', '', 'test', 'test'),
(11, 'test2', 'test2', 'altair89@hotmail.fr', 'test2', 'dfc3f2763fcf9b85593d9ef649cfb1eff6c6d8a6200c1eb7c7e937c10330c171'),
(10, 'admin', 'admin', '', 'admin', 'admin'),
(12, 'test2', 'test2', '', 'test2', 'dfc3f2763fcf9b85593d9ef649cfb1eff6c6d8a6200c1eb7c7e937c10330c171'),
(13, 'test3', 'test3', '', 'test3', 'a9e2dc0e2d045152b985e5ccadb1ca34cada4f74053761ff39c6ed3e6b39984f'),
(14, 'test4', 'test4', '', 'test4', 'f607d43c30556a5315e22ef6f837417e8ffa127bdd9e7b80d8e9980b86f16ec1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
