-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 juin 2024 à 14:00
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thedriver`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `username`, `password`, `nom`, `email`, `date_inscription`) VALUES
(1, 'feriol', 'feriol', 'feriol', 'feriol@gmail.com', '2024-06-22 20:19:08');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `telephone`, `adresse`, `email`, `password`) VALUES
(1, '', '', '', '', '', ''),
(3, 'Lfh', 'Max', '56029580', 'Agla', 'admin@gmail.com', '$2y$10$7LZdJajH2AAh/M6veidd0.acQb2TXhFFo90oglYJA8SWJSl3HnPLC'),
(4, 'Lfh', 'Max', '56029580', 'Agla', 'serveuribanico0@gmail.com', '$2y$10$0pmxrm6zSCWSvDWAo2r2Muj7.jRXwyFjwLDOQRyqXa46JYYHePRPK'),
(5, 'Feriol', 'Francis', '98989898', '312 Rue Francis de Pressensé, Villeurbanne, France', 'feriol@gmail.com', '$2y$10$enslFZAjFSh.X5rDrIcgceaIqfLZy0iLX3GdEZI6vIMEjnSInU/Om');

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

DROP TABLE IF EXISTS `louer`;
CREATE TABLE IF NOT EXISTS `louer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_heure` datetime NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `duree` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `voiture_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voiture_id` (`voiture_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `louer`
--

INSERT INTO `louer` (`id`, `date_heure`, `adresse`, `duree`, `email`, `voiture_id`) VALUES
(1, '2024-06-22 00:15:00', 'Agla', 2, 'lofanhouedemax@gmail.com', 1),
(2, '2024-06-22 00:24:00', 'Agla', 4, 'lofanhouedemax@gmail.com', 2),
(3, '2024-06-09 14:21:00', 'tankpe', 344, 'lofanhouedemax@gmail.com', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voiture_id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `numero_reservation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voiture_id` (`voiture_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `voiture_id`, `nom`, `email`, `telephone`, `date_debut`, `date_fin`, `numero_reservation`) VALUES
(1, 3, 'Max Lfh', 'lofanhouedemax@gmail.com', '56029580', '2024-05-31 16:00:00', '2024-06-02 18:30:00', 'RES-6659de066d8064.28556078'),
(2, 1, 'Francis de Pressensé', 'serveuribanico0@gmail.com', '97784054', '2024-06-01 19:30:00', '2024-06-04 22:30:00', 'RES-6659eb9f758c63.13974545'),
(3, 1, 'Francis de Pressensé', 'serveuribanico0@gmail.com', '97784054', '2024-06-01 19:30:00', '2024-06-04 22:30:00', 'RES-6659f069e48bf3.20475928'),
(4, 1, 'Affo', 'serveuribanico0@gmail.com', '56029580', '2024-05-31 20:51:00', '2024-06-05 20:50:00', 'RES-6659f0d6b53540.24572521'),
(5, 2, 'Max Lfh', 'lofanhouedemax@gmail.com', '56029580', '2024-06-04 14:32:00', '2024-06-12 19:38:00', 'RES-665db80aa64798.43909645'),
(6, 1, 'Max Lfh', 'lofanhouedemax@gmail.com', '56029580', '2024-06-06 17:30:00', '2024-06-14 19:33:00', 'RES-6661c7e34bf435.14839657'),
(7, 2, 'Max Lfh', 'serveuribanico0@gmail.com', '56029580', '2024-06-22 20:40:00', '2024-06-23 20:41:00', 'RES-66771a86af2f09.09698701'),
(8, 5, 'Max Lfh', 'lofanhouedemax@gmail.com', '56029580', '2024-06-25 15:28:00', '2024-06-27 20:25:00', 'RES-667ac4b83f5f58.51404541'),
(9, 5, 'Max Lfh', 'lofanhouedemax@gmail.com', '56029580', '2024-06-25 15:28:00', '2024-06-27 20:25:00', 'RES-667ac4ba426c23.87122597');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
CREATE TABLE IF NOT EXISTS `voiture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `carburant` varchar(50) NOT NULL,
  `capacite` int NOT NULL,
  `bagages` int NOT NULL,
  `prix` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `disponible` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id`, `marque`, `modele`, `transmission`, `carburant`, `capacite`, `bagages`, `prix`, `image`, `disponible`) VALUES
(1, 'Hyundai', 'Tucson', 'Manuelle', 'Essence', 5, 5, 25000, 'img_heidai.jpg', 0),
(2, 'Toyota', 'Camry', 'Automatique', 'Diesel', 5, 4, 19000, 'img_toyota_camry.jpg', 1),
(3, 'Mercedes', '300', 'Manuelle', 'Essence', 5, 3, 41000, 'img_mercedes_300.jpg', 1),
(4, 'Toyota', 'Highlender', 'Automatique', 'Essence', 5, 4, 20000, 'img_totoya_higlender.jpg', 0),
(5, 'BMW', 'New', 'Manuelle', 'Essence', 5, 3, 22000, 'img_bmw.jpg', 0),
(6, 'Rang', 'Rover', 'Automatique', 'Essence', 4, 2, 90000, 'img_range_rover_2020.jpg', 0),
(7, 'Toyota', 'Avalon S', 'Automatique', 'Automatique', 5, 3, 80000, 'img_toyota_avalon.jpg', 0),
(8, 'Mercedes', 'C-Class', 'Automatique', 'Diesel', 5, 4, 40000, 'img_mercedes_4x4.jpg', 0),
(9, 'Nissan', 'Almeria', 'Automatique', 'Electrique', 5, 3, 25000, 'img_nissan_almeira.jpg', 0),
(10, 'toyota', 'rav4', 'Automatique', 'Diesel', 5, 3, 150000, 'img/img_toyota_rav4.jpg', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
