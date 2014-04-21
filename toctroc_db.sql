-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2014 at 04:07 
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
-- Table structure for table `abusCommentaire`
--

CREATE TABLE IF NOT EXISTS `abusCommentaire` (
  `abusCommentaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `explication` text COLLATE utf8_bin,
  PRIMARY KEY (`abusCommentaire_id`),
  KEY `commentaire_abusCommentaire_fk` (`commentaire_id`),
  KEY `appartenance_abusCommentaire_fk` (`appartenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `abusOffre`
--

CREATE TABLE IF NOT EXISTS `abusOffre` (
  `abusOffre_id` int(11) NOT NULL AUTO_INCREMENT,
  `offre_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `explication` text COLLATE utf8_bin,
  PRIMARY KEY (`abusOffre_id`),
  KEY `offre_abusOffre_fk` (`offre_id`),
  KEY `appartenance_abusOffre_fk` (`appartenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `abusPost`
--

CREATE TABLE IF NOT EXISTS `abusPost` (
  `abusPost_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `explication` text COLLATE utf8_bin,
  PRIMARY KEY (`abusPost_id`),
  KEY `post_abusPost_fk` (`post_id`),
  KEY `appartenance_abusPost_fk` (`appartenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `abusProfil`
--

CREATE TABLE IF NOT EXISTS `abusProfil` (
  `abusProfil_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `explication` text COLLATE utf8_bin,
  PRIMARY KEY (`abusProfil_id`),
  KEY `profil_abusProfil_fk` (`user_id`),
  KEY `appartenance_abusProfil_fk` (`appartenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`adresse_id`, `numero`, `rue`, `code_postal`, `ville`, `numero_appartement`, `etage`) VALUES
(1, 321, 'Pascal', NULL, '', NULL, NULL),
(2, 26, 'Pascal', NULL, '', NULL, NULL),
(3, 486, 'Alain', 44000, 'Nantes', NULL, NULL),
(4, 265, 'bob', 4458028, 'bob', NULL, NULL),
(5, NULL, '', NULL, '', NULL, NULL),
(6, 32, '', NULL, '', NULL, NULL),
(7, 656, 'zdad', 0, 'zdz', NULL, NULL),
(8, 0, 'zdad', NULL, '', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `appartenances`
--

INSERT INTO `appartenances` (`appartenance_id`, `communaute_id`, `user_id`, `valide`, `role`) VALUES
(2, 27, 4, 1, 2),
(3, 28, 5, 1, 2),
(5, 27, 5, 1, 2),
(6, 29, 7, 1, 2),
(7, 30, 4, 1, 2),
(8, 31, 4, 1, 2),
(9, 32, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `canals`
--

CREATE TABLE IF NOT EXISTS `canals` (
  `canal_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`canal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `canals`
--

INSERT INTO `canals` (`canal_id`, `nom`, `description`) VALUES
(1, 'Tous', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categorie_id`, `nom`) VALUES
(1, 'Bricolage'),
(2, 'Livres');

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

--
-- Dumping data for table `categories_offres`
--

INSERT INTO `categories_offres` (`offre_id`, `categorie_id`) VALUES
(23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `commentaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `etat` int(11) DEFAULT '1',
  PRIMARY KEY (`commentaire_id`),
  KEY `appartenances_commentaires_fk` (`appartenance_id`),
  KEY `posts_commentaires_fk` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`commentaire_id`, `contenu`, `created`, `appartenance_id`, `post_id`, `etat`) VALUES
(1, 'Si les commentaires marchent, c''est clairement parce que Geoffray Menudier est une torche !', '2014-04-03 08:00:00', 2, 5, 1),
(2, 'Oui la je dois bien dire que j''ai fait fort', '2014-04-04 00:00:00', 2, 5, 1),
(3, 'Ok, Geoffray est clairement une torche', '2014-04-03 11:19:17', 5, 5, 1),
(4, 'Je peux même écrire un commentaire sur le site !', '2014-04-04 06:00:00', 2, 5, 1),
(5, 'Incroyable! En plus je peux le commenter en live !', '2014-04-04 16:47:45', 2, 6, 1),
(6, 'Je suis en train de résoudre un bug', '2014-04-04 16:50:13', 2, 6, 1),
(8, 'Sympa le post !', '2014-04-16 16:50:13', 2, 8, 1),
(9, 'Elle a pas de photo !', '2014-04-20 16:25:55', 2, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `communautes`
--

CREATE TABLE IF NOT EXISTS `communautes` (
  `communaute_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `parametres` varchar(20) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `adresse_id` int(11) NOT NULL,
  PRIMARY KEY (`communaute_id`),
  KEY `adresse_communaute_fk` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Dumping data for table `communautes`
--

INSERT INTO `communautes` (`communaute_id`, `nom`, `description`, `parametres`, `created`, `adresse_id`) VALUES
(16, 'Communauté Test', '', '0', '0000-00-00 00:00:00', 2),
(27, 'Test2', 'Nouveau test', '0', '0000-00-00 00:00:00', 3),
(28, 'bobtest', 'bob', '0', '0000-00-00 00:00:00', 4),
(29, 'AdminCo', 'Communauté d''admin', '0', '2014-04-07 19:10:34', 5),
(30, 'Toc', 'toc', '0', '2014-04-08 16:20:55', 6),
(31, 'zdzd', 'azsdz', '0', '2014-04-08 16:21:11', 7),
(32, 'zd', 'zdzd', '0', '2014-04-08 16:26:39', 8);

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
  `etat` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  PRIMARY KEY (`offre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`offre_id`, `titre`, `description`, `image`, `etat`, `created`) VALUES
(23, 'qqqqqq', 'zadzd', NULL, 2, '2014-04-14 17:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `document_joint` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime NOT NULL,
  `canal_id` int(11) NOT NULL,
  `appartenance_id` int(11) NOT NULL,
  `etat` int(11) DEFAULT '1',
  PRIMARY KEY (`post_id`),
  KEY `canal_post_fk` (`canal_id`),
  KEY `appartanances_posts_fk` (`appartenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `contenu`, `document_joint`, `created`, `canal_id`, `appartenance_id`, `etat`) VALUES
(3, 'Post de geoffray', NULL, '2014-04-03 00:00:00', 1, 2, 1),
(4, 'post de Bob', NULL, '2014-04-05 00:00:00', 1, 5, 1),
(5, 'testest', NULL, '2014-04-05 11:14:15', 1, 2, 1),
(6, 'Premier post via le site !', NULL, '2014-04-04 16:47:10', 1, 2, 1),
(8, 'Sympa le design!', NULL, '2014-04-16 16:50:04', 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `publieOffre`
--

CREATE TABLE IF NOT EXISTS `publieOffre` (
  `publieOffre_id` int(11) NOT NULL AUTO_INCREMENT,
  `appartenance_id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  PRIMARY KEY (`publieOffre_id`),
  KEY `appartient_publie_offre_fk` (`appartenance_id`),
  KEY `offre_publie_offre_fk` (`offre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=70 ;

--
-- Dumping data for table `publieOffre`
--

INSERT INTO `publieOffre` (`publieOffre_id`, `appartenance_id`, `offre_id`) VALUES
(67, 2, 23),
(68, 7, 23),
(69, 9, 23);

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
  `telephone_1` int(11) DEFAULT NULL,
  `telephone_3` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `adresse_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `profil_user_fk` (`role_id`),
  KEY `adresse_user_fk` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `prenom`, `nom`, `email`, `password`, `image_profil`, `telephone_2`, `telephone_1`, `telephone_3`, `created`, `adresse_id`, `role_id`, `etat`) VALUES
(4, 'Geoffray', 'Menudier', 'menu@hotmail.fr', '451dd656bc353a7e36ef6df5b63751c0865dc945', 'png', NULL, 2147483647, NULL, '0000-00-00 00:00:00', NULL, 2, 1),
(5, 'Bob', 'Joséphine', 'bob@hmiail.com', '211fb15019df6a5b278499f83ea70e37a04bf1ee', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 3, 2),
(6, 'Victor', 'Enaud', 'vic@enaud.fr', 'db5718c4f3e3dcdc184bd06a9803eb6f18c4daa9', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 3, 1),
(7, 'admin', 'admin', 'admin@admin.com', '0fb23eb0a9cf948e43b3c59c3ac04746aee05522', NULL, NULL, NULL, NULL, '2014-04-07 19:10:02', NULL, 1, 1),
(8, 'Geoffray', 'Menudier', 'men@hotmail.fr', 'e24d689baf184c7a86c054f7bf1b04753af2646c', NULL, NULL, 601498516, NULL, '2014-04-17 14:59:42', NULL, 3, 1),
(14, 'John', 'John', 'john@hotmail.fr', 'e0ae0121a705af295f7fc9bb1415f1280883a48a', NULL, NULL, 233543135, NULL, '2014-04-17 15:27:54', NULL, 3, 1),
(18, 'John2', 'John2', 'john2@hotmail.fr', 'e238534e746be46b3776d2e52f7bdd0c95c70b97', NULL, NULL, 601498516, NULL, '2014-04-17 15:34:45', NULL, 3, 1),
(19, 'John2', 'John3', 'john3@hotmail.fr', '87bc5b5c3af7d981d5c06573feab467ea3be8c00', NULL, NULL, 601498516, NULL, '2014-04-17 15:36:12', NULL, 3, 1),
(21, 'Gerard3', 'Gerard2', 'gerard@gmail.com', 'b7348f169a242781ff07642ce10b8490bcf8140d', NULL, NULL, 3546465, NULL, '2014-04-17 15:37:55', NULL, 3, 1);

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
-- Constraints for table `abusCommentaire`
--
ALTER TABLE `abusCommentaire`
  ADD CONSTRAINT `appartenance_abusCommentaire_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `commentaire_abusCommentaire_fk` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`commentaire_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `abusOffre`
--
ALTER TABLE `abusOffre`
  ADD CONSTRAINT `appartenance_abusOffre_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offre_abusOffre_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `abusPost`
--
ALTER TABLE `abusPost`
  ADD CONSTRAINT `appartenance_abusPost_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_abusPost_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `abusProfil`
--
ALTER TABLE `abusProfil`
  ADD CONSTRAINT `appartenance_abusProfil_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profil_abusProfil_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `categorie_offre_possede_categorie_fk` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offre_offre_possede_categorie_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `appartanances_posts_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `canal_post_fk` FOREIGN KEY (`canal_id`) REFERENCES `canals` (`canal_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publieOffre`
--
ALTER TABLE `publieOffre`
  ADD CONSTRAINT `appartient_publie_offre_fk` FOREIGN KEY (`appartenance_id`) REFERENCES `appartenances` (`appartenance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offre_publie_offre_fk` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
