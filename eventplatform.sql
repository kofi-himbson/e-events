-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2020 at 02:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventplatform`
--
CREATE DATABASE IF NOT EXISTS `eventplatform` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eventplatform`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `ip_add` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(100) NOT NULL,
  `conf_desc` mediumtext NOT NULL,
  `conf_seats_available` int(11) NOT NULL,
  `conf_seats_left` int(11) NOT NULL,
  `conf_image` varchar(100) NOT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `conf_name`, `conf_desc`, `conf_seats_available`, `conf_seats_left`, `conf_image`) VALUES
(1, 'Hillsong Conference 2020', 'Hillsong Conference is all about championing the cause of THE Church of Jesus Christ — across every nation, denomination, age and background. It is for people who are passionate about the local church and the call of the Kingdom of God.', 100, 96, 'hs.png');

-- --------------------------------------------------------

--
-- Table structure for table `conference_registration`
--

DROP TABLE IF EXISTS `conference_registration`;
CREATE TABLE IF NOT EXISTS `conference_registration` (
  `conf_reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `ip_add` varchar(100) NOT NULL,
  PRIMARY KEY (`conf_reg_id`),
  KEY `conf_id` (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference_registration`
--

INSERT INTO `conference_registration` (`conf_reg_id`, `conf_id`, `name`, `email`, `number`, `ip_add`) VALUES
(2, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(3, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(4, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(5, 1, 'Carbonara', 'adubeabadu@gmail.com', '279489886', '::1'),
(6, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '0', '::1'),
(7, 1, 'Kwaku Boohene', 'kwaku.boohene@ashesi.edu.gh', '233552520588', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) NOT NULL,
  `event_price` int(11) NOT NULL,
  `event_image` varchar(100) NOT NULL,
  `event_desc` mediumtext NOT NULL,
  `tickets_available` int(11) NOT NULL,
  `tickets_left` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_price`, `event_image`, `event_desc`, `tickets_available`, `tickets_left`) VALUES
(1, 'Afronation Ghana 2020', 1, 'afronation.png', 'Afro Nation Ghana - Africa\'s Biggest Urban Music Beach Festivalafronationghana.com\r\nThe biggest urban music beach festival in Europe returns to Africa on December  at Laboma Beach, Accra, Ghana.', 100, 18),
(2, 'Detty Rave', 100, 'dettyrave.png', '', 100, 19),
(3, 'Afrochella', 50, 'afrochella.png', '', 100, 79),
(4, 'Rapperholic', 100, 'rapperholic.png', '', 0, -3),
(5, 'Little Havana', 200, 'littlehavana.png', '', 0, 0),
(6, 'Polo Beach Club', 500, 'polo.png', '', 0, -3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip_add` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `event_id`, `status`, `name`, `email`, `ip_add`) VALUES
(82, 2, 'PAID', 'KwakuBoohene', 'kwaku.kwayisi@gmail.com', '::1'),
(83, 2, 'PAID', 'kwakuBoohene', 'kwaku.kwayisi@gmail.com', '::1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference_registration`
--
ALTER TABLE `conference_registration`
  ADD CONSTRAINT `conference_registration_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`conf_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
