-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2013 at 09:54 PM
-- Server version: 5.5.31-MariaDB-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stages`
--
CREATE DATABASE IF NOT EXISTS `stages` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stages`;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `nom`) VALUES
(9, 'a'),
(1, 'Asfi'),
(8, 'a\\bc'),
(10, 'b'),
(11, 'bf'),
(5, 'Casablanca'),
(12, 'fefef'),
(14, 'fefez&ab=cd'),
(13, 'ffd&fef'),
(7, 'kkk'),
(2, 'Marrakech'),
(6, 'Oujda'),
(4, 'Rabat');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `site` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `site` (`site`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `site`) VALUES
(1, 'Maroc Telecom', 'http://www.iam.ma  '),
(2, 'MANAGEM', 'http://www.managemgroup.com'),
(3, 'Marjane', 'http://www.marjane.co.ma'),
(36, 'Compaq', 'http://compaq.com'),
(38, 'Black Sabbath', 'http://blacksabbath.com');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `nom` (`nom`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `nom`) VALUES
(5, '2IAII'),
(4, '2IIR'),
(2, '3IAII'),
(1, '3IIR'),
(8, '3IRT'),
(6, '4IIR'),
(7, '4IRT'),
(3, 'AP'),
(9, 'Asfi'),
(10, 'AsfiR');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `entreprise_id` (`entreprise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `nom`, `prenom`, `email`, `entreprise_id`) VALUES
(6, 'AHIZOUNE', 'Abdeslam', 'abd.ah@menara.ma', 1),
(7, 'ABARRO', 'Abdellaziz', 'managem@managemgroup.com', 2),
(10, 'LAMDAK', 'Wadii', 'lwadia@facebook.net', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `duree` tinyint(4) NOT NULL COMMENT 'En quinzaine de jours',
  `entreprise_id` int(11) NOT NULL,
  `proposer_id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`entreprise_id`),
  KEY `proposer_id` (`proposer_id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `student_id` (`student_id`),
  KEY `branch_id` (`entreprise_id`),
  KEY `city_id_2` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `date`, `duree`, `entreprise_id`, `proposer_id`, `supervisor_id`, `student_id`, `city_id`, `description`) VALUES
(1, '2013-05-16', 2, 2, 10, NULL, 3, 1, 'Webapp pour gestion d''archivage de stages'),
(2, '2013-06-11', 1, 3, 6, NULL, 5, 5, 'Gestion de formations en ligne'),
(3, '2013-06-14', 4, 36, 10, NULL, 6, 2, 'Gestion de pharmacie');

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `nom`) VALUES
(28, 'Assembleur'),
(34, 'a\\bc'),
(29, 'Bash'),
(22, 'C'),
(25, 'C#'),
(24, 'C++'),
(35, 'HTML'),
(9, 'Java'),
(26, 'Javascript'),
(33, 'L''algorithmique'),
(32, 'OpenGL'),
(2, 'Perl'),
(1, 'PHP'),
(6, 'Prolog'),
(20, 'Python'),
(27, 'Ruby'),
(21, 'Ruby on Rails'),
(31, 'SQL'),
(10, 'Unix');

-- --------------------------------------------------------

--
-- Table structure for table `technology_stage`
--

CREATE TABLE IF NOT EXISTS `technology_stage` (
  `stage_id` int(11) NOT NULL,
  `technology_id` int(11) NOT NULL,
  PRIMARY KEY (`stage_id`,`technology_id`),
  KEY `stage_id` (`stage_id`,`technology_id`),
  KEY `technology_id` (`technology_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `technology_stage`
--

INSERT INTO `technology_stage` (`stage_id`, `technology_id`) VALUES
(1, 24),
(1, 26),
(1, 35),
(2, 1),
(3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(60) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `ne_le` date DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `option_id` (`option_id`),
  KEY `option_id_2` (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pass`, `email`, `tel`, `prenom`, `nom`, `ne_le`, `option_id`, `is_admin`) VALUES
(1, '$2y$10$vrMedShM8oNZao027g7j3e3O3lovpQmqWZBjUFvVmha5otEZYE1Nu', 'bel3atar@aol.com', '+212600782098', 'Mohammed Ousama', 'BELATAR', '1991-05-28', NULL, 1),
(3, '$2y$10$i8ypBB2JJAJ9u.mFnXR5.OFLtfMmPndW/BTQqjMSwSz15hHyyGKsS', 'spirite.125@gmail.com', NULL, 'Abdessalam', 'ELAZZAM', NULL, 1, NULL),
(5, '$2y$10$J2ZT.j/ZwwKQNSWqT7LoPurinjkzvnxOe9XiinfaGQ8kLdrqi8nPW', 'mouhssine_wa3re@hotmail.com', NULL, 'Mouhssine', 'ERRAJAI', NULL, 7, NULL),
(6, '$2y$10$L99IyBvyTfXXbKVTPcLswuJOfTnzqwWKdxGWjBWNdPxpwzqLqQ6C.', 'lachgar.m@gmail.com', NULL, 'Mohammed', 'LACHGAR', NULL, 3, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_2` FOREIGN KEY (`proposer_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `stages_ibfk_3` FOREIGN KEY (`supervisor_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `stages_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stages_ibfk_5` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `stages_ibfk_6` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `technology_stage`
--
ALTER TABLE `technology_stage`
  ADD CONSTRAINT `technology_stage_ibfk_1` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`),
  ADD CONSTRAINT `technology_stage_ibfk_2` FOREIGN KEY (`technology_id`) REFERENCES `technologies` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
