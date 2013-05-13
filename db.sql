-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2013 at 08:48 PM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(40) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
