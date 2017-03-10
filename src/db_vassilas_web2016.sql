-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2016 at 11:14 PM
-- Server version: 5.5.35
-- PHP Version: 5.5.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vassilas_web2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `coordinates`
--

CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int(11) NOT NULL,
  `latitude` decimal(18,14) DEFAULT NULL,
  `longitude` decimal(18,14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coordinates`
--

INSERT INTO `coordinates` (`id`, `latitude`, `longitude`) VALUES
(1, '-61.45859899999999', '-61.45859899999999'),
(3, '-61.45859899999999', '-61.45859899999999'),
(28, '38.25169800000000', '21.73748000000000'),
(29, '12.31100000000000', '93.45400000000000');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE IF NOT EXISTS `measurements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `station_id` int(11) NOT NULL,
  `pollution_type` enum('CO','NO','NO2','O3','SO2','NOX','Smoke') NOT NULL,
  `date` date NOT NULL,
  `measure` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `station_id` (`station_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_api_key` char(32) NOT NULL,
  `type` enum('request_1','request_2','request_3') NOT NULL,
  PRIMARY KEY (`req_id`),
  KEY `user_api_key` (`user_api_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE IF NOT EXISTS `stations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `code`, `name`) VALUES
(1, 'ATH1', 'ΑΘΗΝΑ'),
(3, 'PAT1', 'ΠΑΤΡΑ'),
(28, 'THES2', 'ΘεΣΣΑλονικη'),
(29, 'PAT5', 'HELLO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `passwd` varchar(30) NOT NULL,
  `api_key` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coordinates`
--
ALTER TABLE `coordinates`
  ADD CONSTRAINT `coordinates_ibfk_1` FOREIGN KEY (`id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_api_key`) REFERENCES `users` (`api_key`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;