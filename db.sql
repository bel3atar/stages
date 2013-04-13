-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2013 at 06:53 PM
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
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `nom`) VALUES
(1, 'Asfi'),
(5, 'Casablanca'),
(2, 'Marrakech'),
(4, 'Rabat');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `site` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `logo` (`logo`),
  UNIQUE KEY `site` (`site`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `logo`, `site`) VALUES
(1, 'Maroc Telecom', 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Maroc_telecom.png/200px-Maroc_telecom.png', 'www.iam.ma'),
(2, 'MANAGEM', 'http://upload.wikimedia.org/wikipedia/fr/thumb/4/49/Managem.gif/220px-Managem.gif', 'www.managemgroup.com'),
(3, 'Marjane', 'http://upload.wikimedia.org/wikipedia/en/9/98/Marjane.png', 'www.marjane.co.ma'),
(9, 'Acima', 'http://fff.com/img.jpg', 'http://acima.ma'),
(10, 'Microchoix', 'http://fstg.ac.ma/logo.png', 'http://fstg.ac.ma');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `nom`) VALUES
(2, '3IAII'),
(1, '3IIR');

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
  UNIQUE KEY `email` (`email`),
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
  `entreprise_id` int(11) NOT NULL,
  `proposer_id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`entreprise_id`),
  KEY `proposer_id` (`proposer_id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `student_id` (`student_id`),
  KEY `branch_id` (`entreprise_id`),
  KEY `city_id_2` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `date`, `duree`, `entreprise_id`, `proposer_id`, `supervisor_id`, `student_id`, `city_id`) VALUES
(3, '2012-09-01', 2, 1, 6, 6, 1, 1),
(4, '2011-08-01', 4, 9, 7, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `nom`) VALUES
(9, 'Java'),
(2, 'Perl'),
(1, 'PHP'),
(6, 'Prolog'),
(10, 'Unix'),
(17, 'XML');

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
(4, 1),
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

INSERT INTO `users` (`id`, `pass`, `email`, `tel`, `prenom`, `nom`, `ne_le`, `option_id`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', 'bel3atar@aol.com', '+212600782098', 'Mohammed Ousama', 'BELATAR', '1991-05-28', 1),
(2, '81dc9bdb52d04dc20036dbd8313ed055', 'mouhssine_wa3re@hotmail.com', '+212645962780', 'Mouhssine', 'ERRAJAI', '1991-02-01', 2);

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
