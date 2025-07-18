-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 juil. 2025 à 09:25
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae301c_olivier`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `login` int(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `login`, `mdp`) VALUES
(1, 58478, '$2y$10$1G8iHMlwGpD/z9RYmbrsqOtqv9Tz1wy5DFQxRRQsKlWpJc/hv8qr2');

-- --------------------------------------------------------

--
-- Structure de la table `benevole`
--

DROP TABLE IF EXISTS `benevole`;
CREATE TABLE IF NOT EXISTS `benevole` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `telephone` int(255) DEFAULT NULL,
  `disponibilites` text NOT NULL,
  `frequences` varchar(50) NOT NULL,
  `competences` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `benevole`
--

INSERT INTO `benevole` (`id`, `nom`, `prenom`, `mail`, `telephone`, `disponibilites`, `frequences`, `competences`) VALUES
(1, 'losss', 'ange', 'losange@gmail.com', 666666, 'Lundi - matin, Mercredi - matin, Vendredi - matin', 'mensuelle', 'communication, animation');

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `categories_id` int(100) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `quantite` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `catalogue`
--

INSERT INTO `catalogue` (`id`, `titre`, `desc1`, `desc2`, `image`, `categories_id`, `visible`, `quantite`) VALUES
(2, 'Madeleines', 'madeleines la biscuitière', '', '/Images/madeleine.jpg', 0, 1, 0),
(3, 'Mousline', 'purée mousline', '', '/Images/mousline.jpg', 0, 1, 0),
(1, 'Yop', 'yop yoplait', '', '/Images/yop.jpg', 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categories_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categories_nom`) VALUES
(1, 'vetements'),
(2, 'hygiène');

-- --------------------------------------------------------

--
-- Structure de la table `donneurs`
--

DROP TABLE IF EXISTS `donneurs`;
CREATE TABLE IF NOT EXISTS `donneurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `mail` varchar(150) NOT NULL,
  `type` enum('particulier','organisme') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `identifiant_univ` int(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp_chiffrer` text NOT NULL,
  `cocher_notification` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `identifiant_univ`, `mail`, `mdp_chiffrer`, `cocher_notification`) VALUES
(1, 'lassa', 'agneeee', 10001, 'utilisateur@gmail.com', '$2y$10$5Z9kS98aPvL2hqmaLRBCp.N5cRM1Zh0khr0OSx6KzlcwcWyVSKKiW', 0),
(2, 'chin', 'noix', 19478, 'etudiant@gmail.com', '$2y$10$OkLtk9bu.GOS7TjrOCNT2.Vnb5dyA/kI/lGTGh8SPmE3p.igBl/oy', 0),
(3, 'casses', 'ette', 25918, 'jnsaisquoi@gmail.com', '$2y$10$jR1QxZ9Yz/169RxQoQtTeOpzdwMEYPETTxe4ipPfChIhIEinjmMk6', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `desc1`, `desc2`, `image`, `visible`) VALUES
(1, 'Ceci est un titre d\'evenement', 'une description pour vous aider', 'une autre description pour vous embeter', '/Images/une-image.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

DROP TABLE IF EXISTS `horaire`;
CREATE TABLE IF NOT EXISTS `horaire` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `texte` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `texte`) VALUES
(1, ' Du lundi au vendredi  12h à 13h15 —  Mardi & Jeudi  17h à 19h');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant_univ` int(11) NOT NULL,
  `nb_produits` int(10) NOT NULL,
  `nom_produits` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `terminer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `identifiant_univ`, `nb_produits`, `nom_produits`, `date`, `terminer`) VALUES
(1, 10001, 3, 'banane, Choco-biscuit, hamburger', '2025-06-30', 0),
(2, 15489, 2, 'burger, burger', '2025-06-30', 1),
(3, 10245, 4, 'burgerrrree', '2025-06-27', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
