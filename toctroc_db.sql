-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2014 at 03:11 
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toctroc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

CREATE TABLE IF NOT EXISTS `adresses` (
  `adresse_id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `rue` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero_appartement` int(11) DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  PRIMARY KEY (`adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `annonce_id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`),
  KEY `appartanances_annonces_fk` (`appartenance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annonces_categories`
--

CREATE TABLE IF NOT EXISTS `annonces_categories` (
  `annonce_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`,`categorie_id`),
  KEY `categorie_annonce_possede_categorie_fk` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `appartenances`
--

CREATE TABLE IF NOT EXISTS `appartenances` (
  `appartenance_id` int(11) NOT NULL AUTO_INCREMENT,
  `communaute_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `valide` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`appartenance_id`),
  KEY `communaute_appartient_fk` (`communaute_id`),
  KEY `user_appartient_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `canals`
--

CREATE TABLE IF NOT EXISTS `canals` (
  `canal_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`canal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories_offres`
--

CREATE TABLE IF NOT EXISTS `categories_offres` (
  `offre_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`offre_id`,`categorie_id`),
  KEY `categorie_offre_possede_categorie_fk` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `commentaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`commentaire_id`),
  KEY `appartenances_commentaires_fk` (`appartenance_id`),
  KEY `posts_commentaires_fk` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `communautes`
--

CREATE TABLE IF NOT EXISTS `communautes` (
  `communaute_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `parametres` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `adresse_id` int(11) NOT NULL,
  PRIMARY KEY (`communaute_id`),
  KEY `adresse_communaute_fk` (`adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `appartenance_id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `date_demande` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `appartient_demande_fk` (`appartenance_id`),
  KEY `offre_demande_fk` (`offre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emprunts`
--

CREATE TABLE IF NOT EXISTS `emprunts` (
  `id_emprune` int(11) NOT NULL AUTO_INCREMENT,
  `appartenance_id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `qualite_retour` int(11) NOT NULL,
  `commentaire` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_emprune`),
  KEY `appartient_emprunt_fk` (`appartenance_id`),
  KEY `offre_emprunt_fk` (`offre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE IF NOT EXISTS `offres` (
  `offre_id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  PRIMARY KEY (`offre_id`),
  KEY `appartanances_offres_fk` (`appartenance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `document_joint` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime NOT NULL,
  `canal_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `canal_post_fk` (`canal_id`),
  KEY `appartanances_posts_fk` (`appartenance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `nom`) VALUES
(1, 'Administrateur'),
(2, 'Modérateur'),
(3, 'Utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

CREATE TABLE IF NOT EXISTS `titres` (
  `titre_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`titre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `image_profil` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telephone_2` int(11) DEFAULT NULL,
  `telephone_2_1` int(11) DEFAULT NULL,
  `telephone_3` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `adresse_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `profil_user_fk` (`role_id`),
  KEY `adresse_user_fk` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `prenom`, `nom`, `email`, `password`, `image_profil`, `telephone_2`, `telephone_2_1`, `telephone_3`, `date`, `adresse_id`, `role_id`) VALUES
(4, 'Geoffray', 'Menudier', 'menu@hotmail.fr', '451dd656bc353a7e36ef6df5b63751c0865dc945', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_titres`
--

CREATE TABLE IF NOT EXISTS `users_titres` (
  `user_id` int(11) NOT NULL,
  `titre_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`titre_id`),
  KEY `titre_possede_titre_fk` (`titre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `appartanances_annonces_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `annonces_categories`
--
ALTER TABLE `annonces_categories`
  ADD CONSTRAINT `annonce_annonce_possede_categorie_fk` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`annonce_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `categorie_annonce_possede_categorie_fk` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `appartenances`
--
ALTER TABLE `appartenances`
  ADD CONSTRAINT `communaute_appartient_fk` FOREIGN KEY (`communaute_id`) REFERENCES `communautes` (`communaute_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_appartient_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `categories_offres`
--
ALTER TABLE `categories_offres`
  ADD CONSTRAINT `categorie_offre_possede_categorie_fk` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_offre_possede_categorie_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `appartenances_commentaires_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `posts_commentaires_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `communautes`
--
ALTER TABLE `communautes`
  ADD CONSTRAINT `adresse_communaute_fk` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `appartient_demande_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_demande_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `appartient_emprunt_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_emprunt_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `appartanances_offres_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `appartanances_posts_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `canal_post_fk` FOREIGN KEY (`canal_id`) REFERENCES `canals` (`canal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `adresse_user_fk` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profil_user_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_titres`
--
ALTER TABLE `users_titres`
  ADD CONSTRAINT `titre_possede_titre_fk` FOREIGN KEY (`titre_id`) REFERENCES `titres` (`titre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_possede_titre_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
