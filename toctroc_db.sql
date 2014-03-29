-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2014 at 11:29 
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
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `rue` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero_appartement` int(11) DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `annonce_possede_categorie`
--

CREATE TABLE IF NOT EXISTS `annonce_possede_categorie` (
  `id_annonce` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`,`id_categorie`),
  KEY `categorie_annonce_possede_categorie_fk` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `appartient`
--

CREATE TABLE IF NOT EXISTS `appartient` (
  `id_appartient` int(11) NOT NULL AUTO_INCREMENT,
  `id_communaute` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `valide` int(11) NOT NULL,
  PRIMARY KEY (`id_appartient`),
  KEY `communaute_appartient_fk` (`id_communaute`),
  KEY `user_appartient_fk` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `canal`
--

CREATE TABLE IF NOT EXISTS `canal` (
  `id_canal` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id_canal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `canal`
--

INSERT INTO `canal` (`id_canal`, `nom`, `description`) VALUES
(1, 'Test', 'test canal');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commente`
--

CREATE TABLE IF NOT EXISTS `commente` (
  `id_commentaire` int(11) NOT NULL,
  `id_appartient` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`,`id_appartient`,`id_post`),
  KEY `post_commente_fk` (`id_post`),
  KEY `appartient_commente_fk` (`id_appartient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `communautes`
--

CREATE TABLE IF NOT EXISTS `communautes` (
  `id_communaute` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `parametres` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `id_adresse` int(11) NOT NULL,
  PRIMARY KEY (`id_communaute`),
  KEY `adresse_communaute_fk` (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `id_appartient` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `date_demande` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `offre_demande_fk` (`id_offre`),
  KEY `appartient_demande_fk` (`id_appartient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `droits`
--

CREATE TABLE IF NOT EXISTS `droits` (
  `id_droits` int(11) NOT NULL AUTO_INCREMENT,
  `exemple_droit_1` tinyint(1) DEFAULT NULL,
  `exemple_droit_2` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_droits`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emprunts`
--

CREATE TABLE IF NOT EXISTS `emprunts` (
  `id_emprune` int(11) NOT NULL AUTO_INCREMENT,
  `id_appartient` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `qualite_retour` int(11) NOT NULL,
  `commentaire` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_emprune`),
  KEY `offre_emprunt_fk` (`id_offre`),
  KEY `appartient_emprunt_fk` (`id_appartient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE IF NOT EXISTS `offres` (
  `id_offre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offre_possede_categorie`
--

CREATE TABLE IF NOT EXISTS `offre_possede_categorie` (
  `id_offre` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_offre`,`id_categorie`),
  KEY `categorie_offre_possede_categorie_fk` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `possede_titre`
--

CREATE TABLE IF NOT EXISTS `possede_titre` (
  `id_user` int(11) NOT NULL,
  `id_titre` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_titre`),
  KEY `titre_possede_titre_fk` (`id_titre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `document_joint` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime NOT NULL,
  `id_canal` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `canal_post_fk` (`id_canal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `titre`, `contenu`, `document_joint`, `date`, `id_canal`) VALUES
(1, 'Salut', 'post test', NULL, '2014-03-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profils`
--

CREATE TABLE IF NOT EXISTS `profils` (
  `id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id_profil`),
  KEY `droits_profil_fk` (`id_droits`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publie_annonce`
--

CREATE TABLE IF NOT EXISTS `publie_annonce` (
  `id_appartient` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  PRIMARY KEY (`id_appartient`,`id_annonce`),
  KEY `annonce_publie_annonce_fk` (`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `publie_offre`
--

CREATE TABLE IF NOT EXISTS `publie_offre` (
  `id_appartient` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  PRIMARY KEY (`id_appartient`,`id_offre`),
  KEY `offre_publie_offre_fk` (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `publie_post`
--

CREATE TABLE IF NOT EXISTS `publie_post` (
  `id_post` int(11) NOT NULL,
  `id_appartient` int(11) NOT NULL,
  PRIMARY KEY (`id_post`,`id_appartient`),
  KEY `appartient_publie_post_fk` (`id_appartient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

CREATE TABLE IF NOT EXISTS `titres` (
  `id_titre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id_titre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `image_profil` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telephone_1` int(11) DEFAULT NULL,
  `telephone_2` int(11) DEFAULT NULL,
  `telephone_3` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `id_adresse` int(11) DEFAULT NULL,
  `id_profil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `profil_user_fk` (`id_profil`),
  KEY `adresse_user_fk` (`id_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `prenom`, `nom`, `email`, `password`, `image_profil`, `telephone_1`, `telephone_2`, `telephone_3`, `created`, `id_adresse`, `id_profil`) VALUES
(2, 'Geoffray', 'Menudier', 'g.menu@hotmail.fr', 'b2375c2c831593b56429c11bb99d274078b12cac', NULL, 0, NULL, NULL, '2014-03-29 22:28:54', NULL, NULL),
(3, 'admin', 'admin', 'admin@admin.com', '0fb23eb0a9cf948e43b3c59c3ac04746aee05522', NULL, 658, NULL, NULL, '2014-03-29 22:38:01', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonce_possede_categorie`
--
ALTER TABLE `annonce_possede_categorie`
  ADD CONSTRAINT `annonce_annonce_possede_categorie_fk` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id_annonce`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `categorie_annonce_possede_categorie_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `user_appartient_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `communaute_appartient_fk` FOREIGN KEY (`id_communaute`) REFERENCES `communautes` (`id_communaute`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commente`
--
ALTER TABLE `commente`
  ADD CONSTRAINT `appartient_commente_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `commentaire_commente_fk` FOREIGN KEY (`id_commentaire`) REFERENCES `commentaires` (`id_commentaire`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_commente_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `communautes`
--
ALTER TABLE `communautes`
  ADD CONSTRAINT `adresse_communaute_fk` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `appartient_demande_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_demande_fk` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `appartient_emprunt_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_emprunt_fk` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offre_possede_categorie`
--
ALTER TABLE `offre_possede_categorie`
  ADD CONSTRAINT `categorie_offre_possede_categorie_fk` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_offre_possede_categorie_fk` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `possede_titre`
--
ALTER TABLE `possede_titre`
  ADD CONSTRAINT `user_possede_titre_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titre_possede_titre_fk` FOREIGN KEY (`id_titre`) REFERENCES `titres` (`id_titre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `canal_post_fk` FOREIGN KEY (`id_canal`) REFERENCES `canal` (`id_canal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profils`
--
ALTER TABLE `profils`
  ADD CONSTRAINT `droits_profil_fk` FOREIGN KEY (`id_droits`) REFERENCES `droits` (`id_droits`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publie_annonce`
--
ALTER TABLE `publie_annonce`
  ADD CONSTRAINT `appartient_publie_annonce_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `annonce_publie_annonce_fk` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id_annonce`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publie_offre`
--
ALTER TABLE `publie_offre`
  ADD CONSTRAINT `appartient_publie_offre_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_publie_offre_fk` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publie_post`
--
ALTER TABLE `publie_post`
  ADD CONSTRAINT `appartient_publie_post_fk` FOREIGN KEY (`id_appartient`) REFERENCES `appartient` (`id_appartient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_publie_post_fk` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `adresse_user_fk` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profil_user_fk` FOREIGN KEY (`id_profil`) REFERENCES `profils` (`id_profil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
