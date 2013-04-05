-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2013 at 02:02 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stages`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(14) NOT NULL,
  `adr` varchar(127) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `id` (`id`),
  KEY `entreprise_id_7` (`entreprise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `tel`, `adr`, `entreprise_id`, `city_id`) VALUES
(7, '+212524389360', 'ARSET MY ABDESSALAM, AV MOHAMED V', 1, 2),
(8, '+212524361592', 'LOTISSEMENT SAADA 4 BLOC B N° 174 M''HAMID', 1, 2),
(9, '+212524437401', 'AV MED V GUELIZ', 1, 2),
(10, '+212524619456', 'AV IDRISS 1ER, VILLE NOUVELLE', 1, 1),
(11, '+212524669720', 'Hay ESSALAM SIDI ABDELKRIM II', 1, 1),
(12, '+212522956565', 'Twin Center, Tour A, Angle Boulevards Zerktouni et Al Massira Al Khadra, BP 5199', 2, 3),
(13, '+212537708700', 'Bouregreg, Avenue Azilal', 3, 4),
(14, '+212537717735', 'Hay Riad, Autoroute Rabat-Tanger', 3, 4),
(15, '+212529003561', 'Roue de Marrakech 46000', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `nom`, `country_id`) VALUES
(1, 'Asfi', 1),
(2, 'Marrakech', 1),
(3, 'Casablanca', 1),
(4, 'Rabat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `nom`) VALUES
(1, 'Maroc');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `site` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `logo`, `site`) VALUES
(1, 'Maroc Telecom', 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Maroc_telecom.png/200px-Maroc_telecom.png', 'www.iam.ma'),
(2, 'MANAGEM', 'http://upload.wikimedia.org/wikipedia/fr/thumb/4/49/Managem.gif/220px-Managem.gif', 'www.managemgroup.com'),
(3, 'Marjane', 'http://upload.wikimedia.org/wikipedia/en/9/98/Marjane.png', 'www.marjane.co.ma');

-- --------------------------------------------------------

--
-- Table structure for table `entreprise_city`
--

CREATE TABLE IF NOT EXISTS `entreprise_city` (
  `entreprise_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `nom`) VALUES
(1, '3IIR'),
(2, '3IAII');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entreprise_id` (`entreprise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `nom`, `prenom`, `email`, `entreprise_id`) VALUES
(6, 'AHIZOUNE', 'Abdeslam', 'abd.ah@menara.ma', 1),
(7, 'ABARRO', 'Abdellaziz', 'managem@managemgroup.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `duree` tinyint(4) NOT NULL COMMENT 'En quinzaine de jours',
  `branch_id` int(11) NOT NULL,
  `proposer_id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`branch_id`),
  KEY `proposer_id` (`proposer_id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `student_id` (`student_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `date`, `duree`, `branch_id`, `proposer_id`, `supervisor_id`, `student_id`) VALUES
(3, '2012-09-01', 2, 15, 6, 6, 1),
(4, '2011-08-01', 4, 9, 7, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `nom`) VALUES
(1, 'PHP'),
(2, 'Perl'),
(3, 'Python'),
(4, 'Ruby on Rails'),
(5, 'C++'),
(6, 'Prolog'),
(7, 'HTML'),
(8, 'CSS'),
(9, 'Java'),
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
(3, 1),
(3, 2),
(3, 6),
(4, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(32) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `sex` bit(1) DEFAULT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `ne_le` date DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `option_id` (`option_id`),
  KEY `option_id_2` (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pass`, `email`, `tel`, `prenom`, `sex`, `nom`, `ne_le`, `option_id`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', 'bel3atar@aol.com', '+212600782098', 'Mohammed Ousama', b'1', 'BELATAR', '1991-05-28', 1),
(2, '81dc9bdb52d04dc20036dbd8313ed055', 'mouhssine_wa3re@hotmail.com', '+212645962780', 'Mouhssine', NULL, 'ERRAJAI', '1991-02-01', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `branches_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `stages_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

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
