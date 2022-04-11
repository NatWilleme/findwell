-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 11 avr. 2022 à 22:18
-- Version du serveur : 10.3.31-MariaDB-0+deb10u1
-- Version de PHP : 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `findw1710907`
--
CREATE DATABASE IF NOT EXISTS `findw1710907` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `findw1710907`;

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE `ads` (
  `id_ads` int(3) NOT NULL,
  `id_comp` int(3) NOT NULL,
  `imagePC_ads` varchar(100) NOT NULL,
  `imageMobile_ads` varchar(100) NOT NULL,
  `display_ads` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `id_cat` int(2) NOT NULL,
  `id_comp` int(3) NOT NULL
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
(1, 18),
(1, 21),
(2, 1),
(2, 2),
(2, 16),
(2, 18),
(2, 21),
(3, 1),
(3, 2),
(4, 16),
(4, 21),
(5, 3),
(6, 7),
(6, 13),
(7, 2),
(7, 7),
(7, 21),
(7, 23),
(8, 2),
(8, 5),
(9, 5),
(9, 9),
(9, 19),
(10, 17),
(11, 12),
(11, 15),
(11, 24),
(12, 19),
(12, 21),
(13, 22),
(14, 13),
(15, 16),
(15, 18),
(15, 21),
(16, 13),
(17, 13),
(19, 19),
(21, 15),
(21, 24),
(22, 23),
(23, 16),
(23, 21),
(24, 17),
(25, 19),
(25, 21),
(26, 18),
(26, 21),
(26, 23),
(27, 22),
(28, 13),
(29, 11),
(30, 11),
(30, 13),
(31, 11),
(31, 15),
(31, 24),
(34, 11),
(34, 13),
(39, 14),
(39, 20),
(40, 14),
(40, 20),
(45, 15),
(46, 15),
(47, 15);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(2) NOT NULL,
  `name_cat` varchar(50) NOT NULL,
  `parent_cat` varchar(20) NOT NULL,
  `image_cat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(14, 'Frigoriste et climatisation', 'Gros travaux', '../images/imagesCategories/frigoriste.jpg'),
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
(28, 'Frigoriste et climatisation', 'Petits travaux', '../images/imagesCategories/frigoriste.jpg'),
(29, 'Toiture', 'Dépannage d\'urgence', '../images/imagesCategories/toiture.jpg'),
(30, 'Plombier', 'Dépannage d\'urgence', '../images/imagesCategories/plombier.jpg'),
(31, 'Électricien', 'Dépannage d\'urgence', '../images/imagesCategories/electricien.jpg'),
(32, 'Maçonnerie', 'Dépannage d\'urgence', '../images/imagesCategories/macon.jpg'),
(33, 'Pose de chassis', 'Dépannage d\'urgence', '../images/imagesCategories/chassis.jpg'),
(34, 'Frigoriste et climatisation', 'Dépannage d\'urgence', '../images/imagesCategories/frigoriste.jpg'),
(35, 'Faux plafond et cloison', 'Gros travaux', '../images/imagesCategories/fauxPlafond.jpg'),
(36, 'Faux plafond et cloison', 'Petits travaux', '../images/imagesCategories/fauxPlafond.jpg'),
(37, 'Jardinier', 'Gros travaux', '../images/imagesCategories/jardinier.jpg'),
(38, 'Jardinier', 'Petits travaux', '../images/imagesCategories/jardinier.jpg'),
(39, 'Isolation', 'Gros travaux', '../images/imagesCategories/isolation.png'),
(40, 'Isolation', 'Petits travaux', '../images/imagesCategories/isolation.png'),
(41, 'Rejointoyage', 'Gros travaux', '../images/imagesCategories/rejointoyage.png'),
(42, 'Rejointoyage', 'Petits travaux', '../images/imagesCategories/rejointoyage.png'),
(43, 'Sableur', 'Petits travaux', '../images/imagesCategories/sableur.png'),
(44, 'Sableur', 'Gros travaux', '../images/imagesCategories/sableur.png'),
(45, 'Alarme et sécurité', 'Gros travaux', '../images/imagesCategories/securite.png'),
(46, 'Alarme et sécurité', 'Petits travaux', '../images/imagesCategories/securite.png'),
(47, 'Alarme et sécurité', 'Dépannage d\'urgence', '../images/imagesCategories/securite.png'),
(48, 'Carreleur', 'Service', '../images/imagesCategories/carreleur.jpg'),
(49, 'Chapiste', 'Service', '../images/imagesCategories/chapiste.jpg'),
(50, 'Chauffagiste', 'Service', '../images/imagesCategories/chauffagiste.jpg'),
(51, 'Électricien', 'Service', '../images/imagesCategories/electricien.jpg'),
(52, 'Faux plafond et cloison', 'Service', '../images/imagesCategories/fauxPlafond.jpg'),
(53, 'Frigoriste et climatisation', 'Service', '../images/imagesCategories/frigoriste.jpg'),
(54, 'Jardinier', 'Service', '../images/imagesCategories/jardinier.jpg'),
(55, 'Menuisier', 'Service', '../images/imagesCategories/menuisier.jpg'),
(56, 'Peintre', 'Service', '../images/imagesCategories/peintre.jpg'),
(57, 'Plafonneur', 'Service', '../images/imagesCategories/plafonneur.jpg'),
(58, 'Revêtement de sol', 'Service', '../images/imagesCategories/revetementDeSol.jpg'),
(59, 'Matériaux de construction', 'Materiel', '../images/imagesCategories/materiauxDeConstruction.jpg'),
(60, 'Matériel de toiture', 'Materiel', '../images/imagesCategories/materielDeToiture.jpg'),
(61, 'Matériel de chauffage et sanitaire', 'Materiel', '../images/imagesCategories/materielDeChauffageEtSanitaire.jpg'),
(62, 'Matériel d\'électricité', 'Materiel', '../images/imagesCategories/materielElectricite.jpg'),
(63, 'Matériel de carrelage', 'Materiel', '../images/imagesCategories/materielDeCarrelage.jpg'),
(64, 'Autre', 'Service', '../images/imagesCategories/autre.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_com` int(11) NOT NULL,
  `comment_com` varchar(500) NOT NULL,
  `image_com` varchar(500) NOT NULL,
  `rate_com` int(1) NOT NULL,
  `date_com` date DEFAULT NULL,
  `id_comp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deleted_com` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_com`, `comment_com`, `image_com`, `rate_com`, `date_com`, `id_comp`, `id_user`, `deleted_com`) VALUES
(1, 'ceci est un test', '', 4, '2021-08-17', 3, 1, 0),
(2, 'test', '', 2, '2021-08-22', 2, 1, 0),
(3, 'J\'aime bien', 'images/upload/attention.jpeg', 4, '2021-08-24', 6, 3, 0),
(7, 'super je suis vraiment content de la réalisation de mes travaux , travail soigneux et méticuleux , réalisé dans les délais !\r\n\r\nje recommande vivement :-)', 'images/upload/salle de bain .jpg', 5, '2021-09-12', 2, 5, 0),
(10, 'Je suis super content de la construction de ma maison , le délais a été respecté , un travail de qualité et très professionnel :) ', 'images/upload/comments/comment2.jpeg', 5, '2021-09-23', 3, 5, 0),
(11, 'je suis super content de votre travaille que vous avez fait chez moi !\r\nje recommande a 100%. \r\nLe délais a été respecté et le personnel est super sympa :-)', 'images/upload/comments/comment3.jpg', 5, '2021-10-01', 13, 5, 0),
(12, 'Quelqu\'un de très sérieux, fais attention au détaille, je vous le recommande à tous.', '', 5, '2021-10-19', 19, 15, 0),
(13, 'Conseils précieux, professionnalisme, travail de qualité… À recommander les yeux fermés !', '', 5, '2021-10-19', 19, 17, 0),
(14, 'Travaille de qualité, réactif, sérieux et super professionnel !!!\r\nJe recommande vivement ', '', 5, '2021-10-19', 19, 19, 0),
(15, 'Travaux effectués avec professionnalisme et sérieux avec une finition impeccable.\r\nEnfin un entrepreneur qui commence son chantier a l\'heure chaque  jours et qui termine son travail sans interruption.\r\nMerci a vous', '', 5, '2021-10-19', 19, 21, 0),
(16, 'Travail soigné. Personne très minutieuse. De bon conseil.. je vous le recommande a 100%', '', 5, '2021-10-20', 19, 23, 0),
(17, 'Que de magnifiques réalisations ????\r\nTravail soigné et précis. ????\r\nJe recommande vivement.', '', 5, '2021-10-20', 19, 16, 0);

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

CREATE TABLE `companies` (
  `id_comp` int(3) NOT NULL,
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
  `web_comp` varchar(150) DEFAULT NULL,
  `tva_comp` varchar(25) NOT NULL,
  `deleted_comp` tinyint(1) NOT NULL DEFAULT 0,
  `certified_comp` tinyint(1) NOT NULL DEFAULT 0,
  `hasPaid_comp` tinyint(1) NOT NULL DEFAULT 0,
  `acceptPending_comp` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id_comp`, `name_comp`, `description_comp`, `hours_comp`, `city_comp`, `street_comp`, `number_comp`, `postalcode_comp`, `state_comp`, `mail_comp`, `phone_comp`, `image_comp`, `web_comp`, `tva_comp`, `deleted_comp`, `certified_comp`, `hasPaid_comp`, `acceptPending_comp`) VALUES
(1, 'entreprise 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00\r\nmardi : 08:00 - 18:00\r\nmercredi : 08:00 - 18:00\r\njeudi : 08:00 - 18:00\r\nvendredi : 08:00 - 18:00\r\nsamedi : fermé\r\ndimanche : fermé', 'Trazegnies', 'rue de gosselies', '60', 6183, 'Belgique', 'entreprise1@gmail.com', '0485/25.35.78', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(2, 'entreprise 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00\r\nmardi : 08:00 - 18:00\r\nmercredi : 08:00 - 18:00\r\njeudi : 08:00 - 18:00\r\nvendredi : 08:00 - 18:00\r\nsamedi : fermé\r\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise2@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(3, 'entreprise 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Courcelles', 'Rue Paul Janson', '1', 6182, 'Belgique', 'entreprise3@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(4, 'entreprise 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Chapelle-lez-Herlaimont', 'Rue Solvay', '13', 7160, 'Belgique', 'entreprise4@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(5, 'entreprise 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\r\nmardi : 08:00 - 18:00<br>\r\nmercredi : 08:00 - 18:00<br>\r\njeudi : 08:00 - 18:00<br>\r\nvendredi : 08:00 - 18:00<br>\r\nsamedi : fermé<br>\r\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise5@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(6, 'entreprise 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\r\nmardi : 08:00 - 18:00<br>\r\nmercredi : 08:00 - 18:00<br>\r\njeudi : 08:00 - 18:00<br>\r\nvendredi : 08:00 - 18:00<br>\r\nsamedi : fermé<br>\r\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise6@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 1, 0),
(7, 'entreprise 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise7@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 0, 0),
(8, 'entreprise 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise8@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 0, 0, 0, 0),
(9, 'entreprise 9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise9@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 1, 1, 0, 0),
(10, 'entreprise 10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae sapien nec erat bibendum ultrices id interdum lectus. Vivamus eleifend sapien ipsum, a rutrum quam vestibulum ut. Phasellus elementum felis in sollicitudin ullamcorper. Donec mollis arcu elit, vitae interdum metus ultrices sit amet. Maecenas mattis a neque eget consequat. Curabitur metus lectus, tristique sed libero quis, consectetur venenatis sapien. Nam quis neque vitae proin.', 'lundi : 08:00 - 18:00<br>\nmardi : 08:00 - 18:00<br>\nmercredi : 08:00 - 18:00<br>\njeudi : 08:00 - 18:00<br>\nvendredi : 08:00 - 18:00<br>\nsamedi : fermé<br>\ndimanche : fermé', 'Charleroi', 'rue Neuve', '71', 6000, 'Belgique', 'entreprise10@gmail.com', '0485/96.54.25', 'https://vss.astrocenter.fr/habitatpresto/pictures/29568772-adobestock-81895775.jpeg', NULL, 'BE0123456789', 0, 0, 0, 0),
(11, 'Mon entreprise', 'Ceci est une description de mon entreprise', 'Tous les jours de 10h à 18h', 'Trazegnies', 'Rue destrée', '145', 6183, 'Belgique', 'test4@gmail.com', '0488123456', 'images/upload/photos_profils/profil5.png', NULL, 'BE0987654321', 1, 1, 1, 0),
(12, 'Johnny et fils', 'Entreprise de père en fils', '08h -> 18h', 'Charleroi', 'Rue destrée', '123', 7800, 'Belgique', 'nathanwilleme@gmail.com', '0485888888', '', NULL, 'BE0123456789', 1, 1, 0, 0),
(13, ' LT PRO RENOV', 'LT PRO RENOV Chauffage et Sanitaire est une entreprise située à Jumet. Avec 15 ans d’expérience, nous pouvons prendre en charge tout type d’installations de chauffage , sanitaire , climatisation, ventilation ainsi que les entretiens et réparations et sans oublier les aménagements de salle de bain. LT PRO RENOV Chauffage et Sanitaire c’est le choix d’un service de qualité, alors n’hésitez pas à nous contacter.<br />\r\n', 'Lundi: 07h00 -18h30<br />\r\nMardi: 07h00 -18h30<br />\r\nMercredi: 07h00 -18h30<br />\r\nJeudi: 07h00 -18h30<br />\r\nVendredi: 07h00 -18h30<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé', 'Charleroi', 'Rue de la Machine ', '11', 6040, 'Belgique', 'ltprorenov@hotmail.com', '0476175027', 'images/upload/photos_profils/profil11.JPG', 'https://www.facebook.com/ltprorenov', 'BE0738574925', 0, 1, 1, 0),
(14, 'Projectio-iso', 'Prenez contact avec Projectio-ISO, le spécialiste dans l\'isolation par projection de mousse isolante qui vous propose un service complet pour l\'isolation thermique de vos bâtiments Et un suivi complet pour les primes à l\'isolation .<br />\r\nVotre habitation n\'est pas bien isolée ? Vous cherchez une solution économique, durable et écoresponsable <br />\r\nDepuis plusieurs années, nous faisons en sorte de développer des techniques efficaces', 'Lundi : 07h00 - 18h00<br />\r\nMardi : 07h00 - 18h00<br />\r\nMercredi : 07h00 - 18h00<br />\r\nJeudi : 07h00 - 18h00<br />\r\nVendredi : 07h00 - 18h00<br />\r\nSamedi : Fermé<br />\r\nDimanche : Fermé', 'Berzee (walcourt)', 'Rue froide ', '90', 5651, 'Belgique', 'projectio.iso@gmail.com', '0474237858', 'images/upload/photos_profils/profil12.jpg', ' https://projectio-iso.be/devis/', 'BE0659.955.633', 0, 1, 1, 0),
(15, 'Confort-sécurité', 'Vous souhaitez entreprendre des travaux d’électricité ? Vous avez besoin d’un dépannage d’urgence ?  CONFORT&SECURITE  est à votre service pour tout ce qui concerne vos travaux électriques. Notre travail soigneux et notre grande expérience  sont la garantie d’un résultat à la hauteur de vos attentes. <br />\r\n<br />\r\nNotre société de sécurité et d\'électronique créée en 2011 est aussi active dans la télécommunication, la vidéosurveillance, la vidéophonie, la motorisation et le contrôle d\'accès.', 'Lundi: 07h00-18h00<br />\r\nMardi: 07h00-18h00<br />\r\nMercredi: 07h00-18h00<br />\r\nJeudi: 07h00-18h00<br />\r\nVendredi: 07h00-18h00<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé', 'Landelies', 'Rue de leernes', '49', 6111, 'Belgique', 'confort-securite@outlook.be', '0497269329', 'images/upload/photos_profils/profil13.jpg', 'https://www.facebook.com/confortsecurite/about', 'BE0839645460', 0, 1, 1, 0),
(16, 'ONAL CHAPE sprl', 'Onal Chape Sprl  est le spécialiste pour tous vos travaux d’isolation, de pose de chape, de pose de carrelage mais également pour votre choix de carrelage.<br />\r\n<br />\r\nSi Onal Chape Sprl bénéficie d’une excellente réputation dans le milieu , c’est parce que nous nous entourons d’ouvriers hautement qualifiés et que nous utilisons des produits de qualité.', 'Lundi: 07h00 - 18h00<br />\r\nMardi: 07h00 - 18h00<br />\r\nMercredi: 07h00 - 18h00<br />\r\nJeudi: 07h00 - 18h00<br />\r\nVendredi: 07h00 -18h00<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé ', 'LAMBUSART', 'Rue de Moignelée', '151', 6220, 'Belgique', 'onalchape@outlook.com', '0471907905', 'images/upload/photos_profils/profil14.png', '', ' BE 0550.567.050', 0, 1, 1, 0),
(17, 'Ferronnerie Tibermont', 'Ferronnerie Tibermont propose ses services aux particuliers et aux entreprises pour la réalisation de portails, escaliers et garde-corps en acier, en aluminium ou encore en fer forgé. Nous mettons à votre disposition notre expérience en projet de construction pour doter votre bâtiment de balustrades et barrières. Nous vous remettons après analyse de votre projet un devis comprenant la fabrication, l’installation et la vente du produit. Nous nous déplaçons à travers toute la région de Charleroi d', 'Lundi: 07h00 - 18h00<br />\r\nMardi: 07h00 - 18h00<br />\r\nMercredi: 07h00 - 18h00<br />\r\nJeudi: 07h00 - 18h00<br />\r\nVendredi: 07h00 - 18h00<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé<br />\r\n', 'Fleurus', 'Rue du Trou à la Vigne', '116', 6220, 'Belgique', 'tibermontc@hotmail.com', '0479367720', 'images/upload/photos_profils/profil15.png', 'https://www.facebook.com/ferronnerietibermont', 'BE0553922755', 0, 1, 1, 0),
(18, 'VVS CONSTRUCTION', 'Vous désirez soumettre votre projet de construction à un professionnel du métier ? Comptez désormais sur VVS CONSTRUCTION , votre entreprise générale de construction . Depuis 20 ans, notre patron vous livre un travail unique sur base de vos besoins et de votre budget. Nos points forts ? Construction gros oeuvre, rénovation intérieure ,transformation <br />\r\ncarrelage ,pavage. Notre mission ? Votre satisfaction !<br />\r\n<br />\r\n<br />\r\n', 'Lundi: 07h30-16h30<br />\r\nMardi: 07h30-16h30<br />\r\nMercredi: 07h30-16h30<br />\r\nJeudi: 07h30-16h30<br />\r\nVendredi: 07h30-16h30<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé ', 'Manage', 'Allée des Ifs', '35', 7170, 'Belgique', 'marullofabio1@gmail.com', '0495707126', 'images/upload/photos_profils/profil16.jpg', '', 'BE 0703 962 751', 0, 1, 1, 0),
(19, 'MG Color', 'MG Color est une societe de peintre en batiment<br />\r\nNous effectuons tout type de travaux dans le domaine de la peinture et deco<br />\r\nPeinture interieur et exterieur<br />\r\nPistolage ( Airless )<br />\r\nRevetement de sol<br />\r\nTapissage<br />\r\nDéco mur<br />\r\nPose de store<br />\r\nStucco   ', 'Lundi: 08h00 - 20h00<br />\r\nMardi: 08h00 - 20h00<br />\r\nMercredi: 08h00 - 20h00<br />\r\nJeudi: 08h00 - 20h00<br />\r\nVendredi: 08h00 - 20h00<br />\r\nSamedi: 08h00 - 20h00<br />\r\nDimanche: Fermé', 'Chatelet', 'Rue des trieux', '88', 6200, 'Belgique', 'Mgcolor@outlook.be', '0493995396', 'images/upload/photos_profils/profil17.jpg', 'https://www.facebook.com/MG-Color-101634868743773', 'BE0767373829', 0, 1, 1, 0),
(20, 'ISO PROJECTION', 'Construite dans les années 1960, votre habitation est énergivore et vous désirez faire des travaux d’isolation thermique.<br />\r\nN’hésitez pas à faire appel à notre entreprise ! <br />\r\nNon seulement l’isolation thermique vous permet de conserver une température idéale, mais elle est également plus écologique. Nous sommes à votre service pour divers travaux d’isolation :', 'Lundi: 08h00 - 17h00<br />\r\nMardi: 08h00 - 17h00<br />\r\nMercredi: 08h00 - 17h00<br />\r\nJeudi: 08h00 - 17h00<br />\r\nVendredi: 08h00 - 17h00<br />\r\nSamedi: 08h00 - 17h00<br />\r\nDimanche: Fermé', 'WASMUEL', 'Rue du Marais ', '121', 7390, 'Belgique', 'isoprojectionbelgique@gmail.com', '0484777517', 'images/upload/photos_profils/profil20.jpg', NULL, 'BE0658970587', 0, 1, 1, 0),
(21, 'D\'Angelo construct ', 'Vous requérez les services d’une entreprise experte en travaux de rénovation. Qu’il s’agisse d’une rénovation intérieure complète ou d’un chantier d’annexe, vous pouvez faire confiance a  D\'Angelo construct. Nous vous garantissons un travail impeccable, dans le total respect de vos attendes.<br />\r\n', 'Lundi: 08h00 - 17h00<br />\r\nMardi: 08h00 - 17h00<br />\r\nMercredi: 08h00 - 17h00<br />\r\nJeudi: 08h00 - 17h00<br />\r\nVendredi: 08h00 - 17h00<br />\r\nSamedi:  Fermé<br />\r\nDimanche: Fermé ', 'Jumet', 'Rue Paul Janson', '1', 6040, 'Belgique', 'Dangelom@outlook.be', '0498259002', 'images/upload/photos_profils/profil21.jpg', 'https://www.facebook.com/maxime.dangeloconstruct.5', 'BE0673.608.580', 0, 1, 1, 0),
(22, 'Chassis Math Srl', 'la société Chassis Math Srl des châssis adaptés à votre habitation, à votre budget et à vos goûts<br />\r\n<br />\r\nNous sommes spécialisé dans la vente et placement de menuiseries extérieures, volets et porte de garage, moustiquaires <br />\r\n<br />\r\nQue choisir pour embellir votre fenêtre ? Il n’est pas toujours facile de comparer les avantages et inconvénients des différents matériaux,  Nous nous ferons un plaisir de vous conseiller et vous offrire le meilleur service. ', 'Lundi : 09h00 - 18h00<br />\r\nMardi :09h00 - 18h00<br />\r\nMercredi :09h00 - 18h00<br />\r\nJeudi :09h00 - 18h00<br />\r\nVendredi :09h00 - 18h00<br />\r\nSamedi : Fermé<br />\r\nDimanche : Fermé ', 'Charleroi', 'Avenue Général Michel', '1', 6000, 'Belgique', 'Info@chassismath.be', '0483816816', 'images/upload/photos_profils/profil22.jpg', 'https://chassismath.be/', 'BE 0734819738', 0, 1, 1, 0),
(23, 'DS TOITURE-RENOV', 'Vous souhaitez faire poser tous types de plateforme (zinc, derbigum, ..) sur votre toiture platte à Braine-L’Alleud, Waterloo ou Nivelles ? Vous êtes à la recherche d’une entreprise experte dans le domaine des toitures pour la pose d’un bardage sur votre façade ou la rénovation du pignon de votre maison ? Vous souhaitez faire réaliser des travaux de maçonnerie ? DS Toiture et Renov, entreprise professionnelle dans le domaine des toitures à Gosselies, Mons et La Louvière, est à votre écoute.', 'Lundi: 08h00 - 17h00<br />\r\nMardi: 08h00 - 17h00<br />\r\nMercredi: 08h00 - 17h00<br />\r\nJeudi: 08h00 - 17h00<br />\r\nVendredi: 08h00 - 17h00<br />\r\nSamedi: Fermé<br />\r\nDimanche: Fermé', 'Sint-pieters leeuw', 'bergensesteenweg', '421', 1600, 'Belgique', 'info@dstoiture-renov.be', '0470746107', 'images/upload/photos_profils/profil23.jpg', 'https://dstoiture-renov.be/?fbclid=IwAR07eUzYDZPuy4ot-WxnoQ4LTaSXgqdjkMRU92QcaZKLMWifa31MljIEWOA', '0758503574', 0, 1, 1, 0),
(24, 'Hacardiaux électricité', 'UN SYSTÈME ÉLECTRIQUE SUR MESURE<br />\r\n<br />\r\n Notre entreprise donne beaucoup d’importance à vos attentes. Nous étudions votre projet avec vous et nous restons à votre écoute tout au long du chantier. Vous pouvez compter, par ailleurs, sur un travail minutieux réalisé dans les temps préfixés. Nous prenons tous vos travaux d’électricité en charge que ce soit pour une nouvelle construction, une rénovation ou une transformation.<br />\r\n<br />\r\n', 'Lundi:  8h00 à 17h00<br />\r\nMardi:  8h00 à 17h00<br />\r\nMercredi: 8h00 à 17h00<br />\r\nJeudi:  8h00 à 17h00<br />\r\nVendredi:  8h00 à 17h00<br />\r\nSamedi: 8h00 à 17h00<br />\r\nDimanche: Fermé', 'Vellereille-les-Brayeux', ' Saint Ursmer', '32', 7120, 'Belgique', 'contact@hacardiaux-elec.com', '0497549805', 'images/upload/photos_profils/profil24.jpg', 'https://www.facebook.com/Hacardiaux-Électricité-487899824991207/?ref=page_internal', 'TVA BE0665.504.132', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id_user` int(20) NOT NULL,
  `id_comp` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_user`, `id_comp`) VALUES
(4, 4),
(4, 6),
(5, 1),
(5, 2),
(5, 13),
(12, 5),
(12, 12),
(15, 19),
(19, 19),
(31, 6);

-- --------------------------------------------------------

--
-- Structure de la table `occasions`
--

CREATE TABLE `occasions` (
  `id_occ` int(20) NOT NULL,
  `title_occ` varchar(100) NOT NULL,
  `description_occ` varchar(500) NOT NULL,
  `image_occ` varchar(500) NOT NULL,
  `price_occ` varchar(10) NOT NULL,
  `id_user` int(20) NOT NULL,
  `date_occ` date NOT NULL,
  `region_occ` varchar(50) NOT NULL,
  `mail_occ` varchar(50) NOT NULL,
  `phone_occ` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `occasions`
--

INSERT INTO `occasions` (`id_occ`, `title_occ`, `description_occ`, `image_occ`, `price_occ`, `id_user`, `date_occ`, `region_occ`, `mail_occ`, `phone_occ`) VALUES
(1, 'Disqueuse Bosch', 'Je vend ma disqueuse de marque Bosch en bon état ', 'a:1:{i:0;s:38:\"images/upload/occasions/occasion7.jpeg\";}', '150', 5, '2022-03-23', 'Jumet', 'Leloup@hotmail.com', '0492/47.45.88');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id_serv` int(20) NOT NULL,
  `title_serv` varchar(40) DEFAULT NULL,
  `description_serv` varchar(500) DEFAULT NULL,
  `date_serv` date DEFAULT NULL,
  `region_serv` varchar(50) DEFAULT NULL,
  `image_serv` varchar(250) DEFAULT NULL,
  `id_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `servicescategories`
--

CREATE TABLE `servicescategories` (
  `id_serv` int(20) NOT NULL,
  `id_cat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(20) NOT NULL,
  `username_user` varchar(30) DEFAULT NULL,
  `password_user` varchar(100) NOT NULL,
  `mail_user` varchar(50) NOT NULL,
  `phone_user` varchar(15) DEFAULT NULL,
  `street_user` varchar(50) DEFAULT NULL,
  `number_user` int(4) DEFAULT NULL,
  `city_user` varchar(30) DEFAULT NULL,
  `state_user` varchar(50) DEFAULT NULL,
  `zip_user` varchar(6) DEFAULT NULL,
  `image_user` varchar(500) DEFAULT 'images/default-profil.jpg',
  `type_user` varchar(10) DEFAULT NULL,
  `confirmed_user` tinyint(1) NOT NULL DEFAULT 0,
  `code_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username_user`, `password_user`, `mail_user`, `phone_user`, `street_user`, `number_user`, `city_user`, `state_user`, `zip_user`, `image_user`, `type_user`, `confirmed_user`, `code_user`) VALUES
(1, 'Eric François', '$2y$10$6O.lwTyZp5TIc4WTmLNImuY84Z7WZWx4Y0Bti7icPSnAlVroHdpZW', 'test@gmail.com', '0475123456', 'Rue du bois', 40, 'Charleroi', NULL, '6000', 'images/upload/photos_profils/profil5.png', 'user', 1, ''),
(2, 'Mon entreprise', '$2y$10$OOXrcWaOpclDPtXMal.sSuZh9qIPCHk6YOMKUbebbAhhphrx188CS', 'test4@gmail.com', '0488123456', 'Rue destrée', 145, 'Trazegnies', 'Belgique', '6183', 'images/upload/photos_profils/profil5.png', 'company', 1, '6113e3e87bd7a'),
(3, 'Marc Henry', '$2y$10$YTN53VBrKW54W78WUp6rbu545Ckq8iKNLyMfnToueCDhTODhDZu1q', 'la198444@student.helha.be', '0477111111', 'Rue Albert 1er', 12, 'Gosselies', 'Belgique', '6254', 'images/upload/photos_profils/profil3.png', 'user', 1, '6124c5cda1de3'),
(4, 'Nathan Willeme', '$2y$10$ATRy1zAA6dWfdQEKcawsyuulw1iS/2E.GPNZhHRJ4OWEIZNqOfVUS', 'nathanwilleme@gmail.com', '0496814072', 'Rue de gosselies', 60, 'Trazegnies', 'Belgique', '6183', 'images/upload/photos_profils/profil5.png', 'admin', 1, '6138aac6b68d2'),
(5, 'Benjamen ', '$2y$10$js0as1dbPyl.Btw4c3xsSugf5JyXtPiXL8FQT3YrWMxgKBamdn3oW', 'Aness@outlook.be', NULL, NULL, 0, NULL, 'Belgique', NULL, 'images/upload/photos_profils/profil5.png', 'admin', 1, '613ddd0ed07a9'),
(6, '', '$2y$10$Hz3hQRAlM/Ve9YUPl.0VHe/r3i/B8Ph68HBJQbC2MfCAnXVXhavS2', 'hegatit302@ppp998.com', '', '', 0, '', NULL, '', 'images/upload/photos_profils/profil6.png', 'user', 1, '613df536b6809'),
(7, ' LT PRO RENOV', '$2y$10$1UE8oCqGJssCHLNM13h1mef6BOlerezzL8fbb3FcMG16UVQrTQPjK', 'ltprorenov@hotmail.com', '0476175027', 'Rue de la Machine ', 11, 'Charleroi', 'Belgique', '6040', 'images/upload/photos_profils/profil11.JPG', 'company', 1, '615756a9aa3d5'),
(8, NULL, '$2y$10$HpUAoQpsAga8qM.bvpYmGu/7auEkdhE1nhnUyCp.NAs.ZQTLFQzY.', 'hakimmazouz1980@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 1, '615a0b3531d89'),
(9, 'Projectio-iso', '$2y$10$wrturGdr8VOZt0c2qieYOu0lZPvbgYA8B1ZKTxvFQ3TuUNXwsGG8W', 'projectio.iso@gmail.com', '0474237858', 'Rue froide  90', 90990, 'Berzee (walcourt)', 'Belgique', '5651', 'images/upload/photos_profils/profil12.pdf', 'company', 1, '615d57a179ddc'),
(10, 'Confort-sécurité', '$2y$10$nPoSn2SpfFVWsha1.WPYUefH5smI0TqbNwM0lwnGyU55EXl.4aZlK', 'confort-securite@outlook.be', '0497269329', 'Rue de leernes', 49, 'Landelies', 'Belgique', '6111', 'images/upload/photos_profils/profil13.jpg', 'company', 1, '615d714f2ff57'),
(11, 'ONAL CHAPE sprl', '$2y$10$sHNSYV5if.v5728LhmSr1u3yVfXsw2GhIMSN.olTlkgz2tAK8eMVG', 'onalchape@outlook.com', '0471907905', 'Rue de Moignelée', 151, 'LAMBUSART', 'Belgique', '6220', 'images/upload/photos_profils/profil14.png', 'company', 1, '61601436f35d5'),
(12, 'Ferronnerie Tibermont', '$2y$10$jrl8X60rrwxA4GFUxRZyl.udlo2.sJiQZy8iVbvokxkROlVActEUS', 'tibermontc@hotmail.com', '0479367720', 'Rue du Trou à la Vigne', 116, 'Fleurus', 'Belgique', '6220', 'images/upload/photos_profils/profil15.png', 'company', 1, '6165e430c60b8'),
(13, 'VVS CONSTRUCTION', '$2y$10$2MTFYoazDakkAHe.ZMYYFuAeqYpGc1RKjDr2kOYMV2CelOuUNIj3m', 'marullofabio1@gmail.com', '0495707126', 'Allée des Ifs', 35, 'Manage', 'Belgique', '7170', 'images/upload/photos_profils/profil16.jpg', 'company', 1, '616d6b09e1665'),
(14, 'MG Color', '$2y$10$tvGlAbZQXCEbEmMDvhf9QuPu6tsodKTULq.7k1jo1W/nmUSv9khHS', 'Mgcolor@outlook.be', '0493995396', 'Rue des trieux', 88, 'Chatelet', 'Belgique', '6200', 'images/upload/photos_profils/profil17.jpg', 'company', 1, '616e8cc860ba3'),
(15, 'Eren uman ', '$2y$10$WIu26TIRkZoqUt5pXr3EgOIsnR.OGie4Cge6D3zg.M7f1uNkOvowq', 'eren.uman@gmail.com', '+32484528676', 'Rue Decoux 2-2', NULL, 'Chatelet', 'Belgique', '6200', 'images/default-profil.jpg', 'user', 1, '616e9a188e42f'),
(16, 'Marchal', '$2y$10$0j3yCOB3LmMxNBG/j6hXauL5VZZeNHUSa9kjUUf2eDqhP1OHYFBnO', 'isaetlois@hotmail.com', '0472290840', 'Culot du bois ', 20, 'Velaine S/s', 'Belgique', '5060', 'images/default-profil.jpg', 'user', 1, '616e9d95dded8'),
(17, 'PRÖS Pauline', '$2y$10$dZTbMCEK8WWhTxxh6iYeCObDnUziPtFE2DRu9qrq9Js7vdpqyEYvm', 'pros.pauline@gmail.com', NULL, NULL, NULL, NULL, 'Belgique', NULL, 'images/default-profil.jpg', 'user', 1, '616e9ea192956'),
(18, NULL, '$2y$10$X6NPtWt.8SFgmXl5LPEGPu3e2d5U5w0UmAMTLGBn91E46KL5v4U56', 'aalicia94@hotamil.com', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 0, '616ea11e2c8d7'),
(19, 'El Araichi Hichem ', '$2y$10$1qPAKFZW7N4/QyKfHgFQue4x7VUbypojPvgh93l7EgVO2bUqYhkE6', 'hichem.elaraichi@gmail.com', '0498592339', NULL, NULL, NULL, 'Belgique', NULL, 'images/default-profil.jpg', 'user', 1, '616eab555a0cd'),
(20, NULL, '$2y$10$CKXbhkeR5KAS3V2cSVldu.F4NHZIjrcWGXAouUKb44HHmkVdiVMzG', 'steiih.x3@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 1, '616eaed283f55'),
(21, 'Pgt Nathalie ', '$2y$10$O42OGALj/0x6hqld9HEYF.qDGkUWCX7qJcCahCDEe0M8VNc6PSZeS', 'meumeuh007@hotmail.com', '0476 98 62 05 ', 'Des Trieux ', 62, 'Châtelet ', 'Belgique', '6200', 'images/default-profil.jpg', 'user', 1, '616eb1dd73ff9'),
(22, 'Sandrine', '$2y$10$IdOtOXauUHHBhp3/aJGvOe1xSZkpQRC7WDfdDj/zpllLd.2Qshh4m', 'sandrine.deperon@infrabel.be', '', '', 0, '', NULL, '', 'images/default-profil.jpg', 'user', 0, '616ec6ebbf277'),
(23, 'Alicia ', '$2y$10$z8PNNB48iA/D6GJDgehnv.zLdJpjWOMgUAH.sccCAZX3kXEp119RG', 'aalicia94@hotmail.com', NULL, NULL, NULL, NULL, 'Belgique', NULL, 'images/default-profil.jpg', 'user', 1, '616ed18d068f4'),
(27, NULL, '$2y$10$QSdLe2HiEJAgMAjp.JVsK.MsoAPYT/nrVhhI2IqEw/t.iZuF.OLRq', 'samira.kasmi@outlook.be', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 1, '616f293798f8d'),
(28, 'ISO PROJECTION', '$2y$10$uTK5D6Z.yKWEW0260euLcuyovSVeUGv/A0AK3EV7a9DdC3/GcYY.i', 'isoprojectionbelgique@gmail.com', '0484777517', 'Rue du Marais ', 121, 'WASMUEL', 'Belgique', '7390', 'images/upload/photos_profils/profil19.jpg', NULL, 1, '61730d42db97d'),
(29, 'D\'Angelo construct ', '$2y$10$tGZaSn81Avd7gIHkMA9heO.gyYqnZIfF09SK9gjAdClnLmGTVvD7K', 'Dangelom@outlook.be', '0498259002', 'Rue Paul Janson', 1, 'Jumet', 'Belgique', '6040', 'images/upload/photos_profils/profil21.jpg', 'company', 1, '61d2ffa1acb38'),
(30, 'Chassis Math Srl', '$2y$10$TzsE8GIxGTXxLOyUOWddMOc1xdvRyrpmSwHyQtmpcXHv3VflBr19K', 'info@chassismath.be', '0483816816', 'Avenue Général Michel', 1, 'Charleroi', 'Belgique', '6000', 'images/upload/photos_profils/profil22.jpg', 'company', 1, '61e4798c19373'),
(31, NULL, '$2y$10$PecnyWfUKEkHe4DuOR.4b.Y4Svnzh3POV6Z4Mz07lZEMdcHEIrlfG', 'anessmazouz1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 1, '61e6b944a260e'),
(32, 'DS TOITURE-RENOV', '$2y$10$PdFQI2rEPZzMJ6OANdOMEO3Dh1ec0RifEnhoQHm7LO5x8KC2K7nbm', 'info@dstoiture-renov.be', '0470746107', 'bergensesteenweg', 421, 'Sint-pieters leeuw', 'Belgique', '1600', 'images/upload/photos_profils/profil23.jpg', 'company', 1, '61f7cfe100586'),
(33, NULL, '$2y$10$Jy99T4iA7mnqz7bxAtK9R.P.SQjmhWf6SrLMbZPxKA.yPk9C8F8Sa', 'sebastianmeunier9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'images/default-profil.jpg', 'user', 1, '620ff8661a3db'),
(34, 'Hacardiaux électricité', '$2y$10$c5UPJIchWfqvJXlSm3IQO.rl7SDFMSkww0ukUt5QTNGqCXGTJpaL6', 'contact@hacardiaux-elec.com', '0497549805', ' Saint Ursmer', 32, 'Vellereille-les-Brayeux', 'Belgique', '7120', 'images/upload/photos_profils/profil24.jpg', 'company', 1, '623f205f245f6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id_ads`);

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`id_cat`,`id_comp`),
  ADD KEY `id_cat` (`id_cat`,`id_comp`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_com`);

--
-- Index pour la table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id_comp`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id_user`,`id_comp`);

--
-- Index pour la table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`id_occ`),
  ADD KEY `idAnnUser` (`id_user`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_serv`),
  ADD KEY `idUserService` (`id_user`);

--
-- Index pour la table `servicescategories`
--
ALTER TABLE `servicescategories`
  ADD KEY `idCategory` (`id_cat`),
  ADD KEY `idService` (`id_serv`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ads`
--
ALTER TABLE `ads`
  MODIFY `id_ads` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `companies`
--
ALTER TABLE `companies`
  MODIFY `id_comp` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id_occ` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id_serv` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `occasions`
--
ALTER TABLE `occasions`
  ADD CONSTRAINT `idAnnUser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `idUserService` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `servicescategories`
--
ALTER TABLE `servicescategories`
  ADD CONSTRAINT `idCategory` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`),
  ADD CONSTRAINT `idService` FOREIGN KEY (`id_serv`) REFERENCES `services` (`id_serv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
