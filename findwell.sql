-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 29 août 2021 à 21:02
-- Version du serveur : 5.7.31
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `findwell`
--

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id_ads` int(3) NOT NULL AUTO_INCREMENT,
  `id_comp` int(3) NOT NULL,
  `image_ads` varchar(100) NOT NULL,
  `display_ads` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ads`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ads`
--

INSERT INTO `ads` (`id_ads`, `id_comp`, `image_ads`, `display_ads`) VALUES
(1, 1, '../images/upload/advertising/ad_1.jpg', 1),
(2, 3, '../images/upload/advertising/ad_2.jpg', 1),
(3, 5, '../images/upload/advertising/ad_3.jpg', 1),
(4, 3, '../images/upload/advertising/ad_4.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `id_cat` int(2) NOT NULL,
  `id_comp` int(3) NOT NULL,
  PRIMARY KEY (`id_cat`,`id_comp`),
  KEY `id_cat` (`id_cat`,`id_comp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`id_cat`, `id_comp`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(5, 3),
(6, 7),
(7, 2),
(7, 7),
(8, 2),
(8, 5),
(9, 5),
(9, 9),
(29, 12),
(30, 12),
(31, 12),
(34, 12);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_cat` int(2) NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(50) NOT NULL,
  `parent_cat` varchar(20) NOT NULL,
  `image_cat` varchar(250) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `name_cat`, `parent_cat`, `image_cat`) VALUES
(1, 'Construction gros oeuvre fermé', 'Gros travaux', '../images/imagesCategories/grosOeuvre.jpg'),
(2, 'Carreleur', 'Gros travaux', '../images/imagesCategories/carreleur.jpg'),
(3, 'Plafonneur', 'Gros travaux', '../images/imagesCategories/plafonneur.jpg'),
(4, 'Chapiste', 'Gros travaux', '../images/imagesCategories/chapiste.jpg'),
(5, 'Menuisier', 'Gros travaux', '../images/imagesCategories/menuisier.jpg'),
(6, 'Chauffagiste', 'Gros travaux', '../images/imagesCategories/chauffagiste.jpg'),
(7, 'Toiture', 'Gros travaux', '../images/imagesCategories/toiture.jpg'),
(8, 'Terrassement', 'Gros travaux', '../images/imagesCategories/terrassement.jpg'),
(9, 'Peintre', 'Gros travaux', '../images/imagesCategories/peintre.jpg'),
(10, 'Ferronnerie', 'Gros travaux', '../images/imagesCategories/ferronnerie.jpg'),
(11, 'Électricien', 'Gros travaux', '../images/imagesCategories/electricien.jpg'),
(12, 'Revêtement de sol', 'Gros travaux', '../images/imagesCategories/revetementDeSol.jpg'),
(13, 'Pose de chassis', 'Gros travaux', '../images/imagesCategories/chassis.jpg'),
(14, 'Frigoriste & climatisation', 'Gros travaux', '../images/imagesCategories/frigoriste.jpg'),
(15, 'Carreleur', 'Petits travaux', '../images/imagesCategories/carreleur.jpg'),
(16, 'Chauffagiste', 'Petits travaux', '../images/imagesCategories/chauffagiste.jpg'),
(17, 'Plombier', 'Petits travaux', '../images/imagesCategories/plombier.jpg'),
(18, 'Menuisier', 'Petits travaux', '../images/imagesCategories/menuisier.jpg'),
(19, 'Peintre', 'Petits travaux', '../images/imagesCategories/peintre.jpg'),
(20, 'Plafonneur', 'Petits travaux', '../images/imagesCategories/plafonneur.jpg'),
(21, 'Électricien', 'Petits travaux', '../images/imagesCategories/electricien.jpg'),
(22, 'Toiture', 'Petits travaux', '../images/imagesCategories/toiture.jpg'),
(23, 'Chapiste', 'Petits travaux', '../images/imagesCategories/chapiste.jpg'),
(24, 'Ferronnerie', 'Petits travaux', '../images/imagesCategories/ferronnerie.jpg'),
(25, 'Revêtement de sol', 'Petits travaux', '../images/imagesCategories/revetementDeSol.jpg'),
(26, 'Maçonnerie', 'Petits travaux', '../images/imagesCategories/macon.jpg'),
(27, 'Chassis', 'Petits travaux', '../images/imagesCategories/chassis.jpg'),
(28, 'Frigoriste & climatisation', 'Petits travaux', '../images/imagesCategories/frigoriste.jpg'),
(29, 'Toiture', 'Dépannage d\'urgence', '../images/imagesCategories/toiture.jpg'),
(30, 'Plombier', 'Dépannage d\'urgence', '../images/imagesCategories/plombier.jpg'),
(31, 'Électricien', 'Dépannage d\'urgence', '../images/imagesCategories/electricien.jpg'),
(32, 'Maçonnerie', 'Dépannage d\'urgence', '../images/imagesCategories/macon.jpg'),
(33, 'Pose de chassis', 'Dépannage d\'urgence', '../images/imagesCategories/chassis.jpg'),
(34, 'Frigoriste & climatisation', 'Dépannage d\'urgence', '../images/imagesCategories/frigoriste.jpg'),
(35, 'Faux plafond & cloison', 'Gros travaux', '../images/imagesCategories/fauxPlafond.jpg'),
(36, 'Faux plafond & cloison', 'Petits travaux', '../images/imagesCategories/fauxPlafond.jpg'),
(37, 'Jardinier', 'Gros travaux', '../images/imagesCategories/jardinier.jpg'),
(38, 'Jardinier', 'Petits travaux', '../images/imagesCategories/jardinier.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `comment_com` varchar(500) NOT NULL,
  `image_com` varchar(500) NOT NULL,
  `rate_com` int(1) NOT NULL,
  `date_com` date DEFAULT NULL,
  `id_comp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deleted_com` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_com`, `comment_com`, `image_com`, `rate_com`, `date_com`, `id_comp`, `id_user`, `deleted_com`) VALUES
(1, 'L\'entreprise est venu carreler l\'entieretée de la maison. Le travail a très bien été effectué et je referais appel dans le futur à eux si je devais effectuer un autre travail ! Je recommande.', '../images/upload/test.png', 5, '2021-07-01', 2, 1, 0),
(2, 'Travail moyen', '', 3, '2021-07-01', 2, 2, 0),
(3, 'Bon travail', '', 5, '2021-07-01', 5, 3, 0),
(4, 'Bof', '', 2, '2021-07-01', 2, 2, 0),
(27, 'ceci est un test', '../images/upload/', 4, '2021-08-17', 3, 12, 0),
(38, 'test', '../images/upload/', 2, '2021-08-22', 2, 12, 0),
(39, 'J\'aime bien', 'images/upload/attention.jpeg', 4, '2021-08-24', 6, 31, 0);

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id_comp` int(3) NOT NULL AUTO_INCREMENT,
  `name_comp` varchar(50) NOT NULL,
  `description_comp` varchar(500) NOT NULL,
  `hours_comp` varchar(300) NOT NULL,
  `city_comp` varchar(50) NOT NULL,
  `street_comp` varchar(100) NOT NULL,
  `number_comp` varchar(5) NOT NULL,
  `postalcode_comp` int(6) NOT NULL,
  `state_comp` varchar(20) NOT NULL,
  `mail_comp` varchar(150) NOT NULL,
  `phone_comp` varchar(15) NOT NULL,
  `image_comp` varchar(200) NOT NULL,
  `tva_comp` varchar(25) NOT NULL,
  `deleted_comp` tinyint(1) NOT NULL DEFAULT '0',
  `certified_comp` tinyint(1) NOT NULL DEFAULT '0',
  `hasPaid_comp` tinyint(1) NOT NULL DEFAULT '0',
  `acceptPending_comp` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_comp`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id_comp`, `name_comp`, `description_comp`, `hours_comp`, `city_comp`, `street_comp`, `number_comp`, `postalcode_comp`, `state_comp`, `mail_comp`, `phone_comp`, `image_comp`, `tva_comp`, `deleted_comp`, `certified_comp`, `hasPaid_comp`, `acceptPending_comp`) VALUES
(1, 'entreprise 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\r\nmardi : 08:00 - 18:00<br>\r\nmercredi : 08:00 - 18:00<br>\r\njeudi : 08:00 - 18:00<br>\r\nvendredi : 08:00 - 18:00<br>\r\nsamedi : fermé<br>\r\ndimanche : fermé', 'Trazegnies', 'rue de gosselies', '60', 6183, '', 'entreprise1@gmail.com', '0485/25.35.78', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(2, 'entreprise 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise2@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(3, 'entreprise 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Courcelles', 'Rue Paul Janson', '1', 6182, '', 'entreprise3@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(4, 'entreprise 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Chapelle-lez-Herlaimont', 'Rue Solvay', '13', 7160, '', 'entreprise4@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(5, 'entreprise 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise5@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(6, 'entreprise 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise6@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 1, 0, 0),
(7, 'entreprise 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise7@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 0, 0, 1),
(8, 'entreprise 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise8@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 0, 0, 1),
(9, 'entreprise 9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise9@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 0, 0, 1),
(10, 'entreprise 10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, '', 'entreprise10@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', 'BE0123456789', 0, 0, 0, 1),
(12, 'Mon entreprise', 'Ceci est une description de mon entreprise', 'Tous les jours de 10h à 18h', 'Trazegnies', 'Rue destrée', '145', 6183, 'Belgique', 'test4@gmail.com', '0488123456', '../images/upload/photos_profils/profil3.png', 'BE0987654321', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_user` int(20) NOT NULL,
  `id_comp` int(3) NOT NULL,
  PRIMARY KEY (`id_user`,`id_comp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_user`, `id_comp`) VALUES
(12, 5),
(12, 12),
(31, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(20) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(30) DEFAULT NULL,
  `password_user` varchar(100) NOT NULL,
  `mail_user` varchar(50) NOT NULL,
  `phone_user` varchar(15) DEFAULT NULL,
  `street_user` varchar(50) DEFAULT NULL,
  `number_user` int(4) DEFAULT NULL,
  `city_user` varchar(30) DEFAULT NULL,
  `state_user` varchar(50) DEFAULT NULL,
  `zip_user` varchar(6) DEFAULT NULL,
  `image_user` varchar(500) DEFAULT NULL,
  `type_user` varchar(10) DEFAULT NULL,
  `confirmed_user` tinyint(1) NOT NULL DEFAULT '0',
  `code_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username_user`, `password_user`, `mail_user`, `phone_user`, `street_user`, `number_user`, `city_user`, `state_user`, `zip_user`, `image_user`, `type_user`, `confirmed_user`, `code_user`) VALUES
(1, 'profil1', '$2y$10$6O.lwTyZp5TIc4WTmLNImuY84Z7WZWx4Y0Bti7icPSnAlVroHdpZW', 'profil1@gmail.com', '0496814072', 'rue test', 60, 'Paris', NULL, '70000', '../images/upload/photos_profils/profil4.jpg', 'user', 1, ''),
(2, 'profil2', 'motdepasse2', 'profil2@gmail.com', NULL, NULL, NULL, NULL, NULL, '', 'https://static.vecteezy.com/ti/vecteur-libre/p1/1840612-image-profil-icon-male-icon-human-or-people-sign-and-symbol-vector-gratuit-vectoriel.jpg', 'company', 1, ''),
(3, 'profil3', 'motdepasse3', 'profil3@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(4, 'profil4', 'motdepasse4', 'profil4@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(5, 'profil5', 'motdepasse5', 'profil5@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(6, 'profil6', 'motdepasse6', 'profil6@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(7, 'profil7', 'motdepasse7', 'profil7@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(8, 'profil8', 'motdepasse8', 'profil8@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(9, 'profil9', 'motdepasse9', 'profil9@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(10, 'profil10', 'motdepasse10', 'profil10@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '', '', 1, ''),
(12, 'Nathan Willeme', '$2y$10$6O.lwTyZp5TIc4WTmLNImuY84Z7WZWx4Y0Bti7icPSnAlVroHdpZW', 'test@gmail.com', '0496814072', 'rue de gosselies', 60, 'Trazegnies', 'Belgique', '6183', '../images/upload/photos_profils/profil4.jpg', 'admin', 1, ''),
(22, '', '$2y$10$IzippInBMKhr6EusS2nUHOkVfvaGTrdWDGoD7V06pzFcuD3gK/OBy', 'test3@gmail.com', '', '', NULL, '', 'Belgique', '', NULL, 'user', 1, ''),
(25, 'Nathan Willeme', '$2y$10$Bwhmgzw9qDoR.DX8r6MbrONhXTO.6.tTrb2pvafuhtL1tTgl3f/5S', 'nathanwilleme@gmail.com', '0496814072', 'Rue du butia', 3, 'Trazegnies', 'Belgique', '6183', '../images/upload/photos_profils/profil4.png', 'user', 1, '610e9b57d6757'),
(27, 'Mon entreprise', '$2y$10$OOXrcWaOpclDPtXMal.sSuZh9qIPCHk6YOMKUbebbAhhphrx188CS', 'test4@gmail.com', '0488123456', 'Rue destrée', 145, 'Trazegnies', 'Belgique', '6183', '../images/upload/photos_profils/profil3.png', 'company', 1, '6113e3e87bd7a'),
(31, 'Mon Prénom', '$2y$10$YTN53VBrKW54W78WUp6rbu545Ckq8iKNLyMfnToueCDhTODhDZu1q', 'la198444@student.helha.be', '0477111111', 'Rue Albert 1er', 12, 'Gosselies', 'Belgique', '6254', 'images/upload/photos_profils/profil6.png', 'user', 1, '6124c5cda1de3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
