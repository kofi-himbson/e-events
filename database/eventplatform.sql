-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2020 at 09:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ip_add` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `conf_id` int(11) NOT NULL,
  `conf_name` varchar(100) NOT NULL,
  `conf_desc` mediumtext NOT NULL,
  `conf_seats_available` int(11) NOT NULL,
  `conf_seats_left` int(11) NOT NULL,
  `conf_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `conf_name`, `conf_desc`, `conf_seats_available`, `conf_seats_left`, `conf_image`) VALUES
(1, 'Hillsong Conference 2020', 'Hillsong Conference is all about championing the cause of THE Church of Jesus Christ — across every nation, denomination, age and background. It is for people who are passionate about the local church and the call of the Kingdom of God.', 100, 96, 'hs.png'),
(9, 'Healing and Restoration', 'Come and receive your healing', 1000, 999, '10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `conference_registration`
--

CREATE TABLE `conference_registration` (
  `conf_reg_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `ip_add` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference_registration`
--

INSERT INTO `conference_registration` (`conf_reg_id`, `conf_id`, `name`, `email`, `number`, `ip_add`) VALUES
(2, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(3, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(4, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '279489886', '::1'),
(5, 1, 'Carbonara', 'adubeabadu@gmail.com', '279489886', '::1'),
(6, 1, 'Papa Darfoor', 'papadarfoor@gmail.com', '0', '::1'),
(7, 1, 'Philip Owusu-Afriyie', 'philip.afriyie@ashesi.edu.gh', '203045812', '::1'),
(8, 9, 'Munira Adam', 'munira.adam@gmail.com', '550993433', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_price` int(11) NOT NULL,
  `event_image` varchar(100) NOT NULL,
  `event_desc` mediumtext NOT NULL,
  `tickets_available` int(11) NOT NULL,
  `tickets_left` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_price`, `event_image`, `event_desc`, `tickets_available`, `tickets_left`) VALUES
(1, 'Afronation Ghana 2020', 300, 'afronation.png', 'Afro Nation Ghana - Africa\'s Biggest Urban Music Beach Festivalafronationghana.com\r\nThe biggest urban music beach festival in Europe returns to Africa on December  at Laboma Beach, Accra, Ghana.', 100, 15),
(2, 'Detty Rave', 100, 'dettyrave.png', '', 100, 20),
(3, 'Afrochella', 50, 'afrochella.png', '', 100, 79),
(4, 'Rapperholic', 100, 'rapperholic.png', '', 0, -3),
(5, 'Little Havana', 200, 'littlehavana.png', '', 0, 0),
(6, 'Polo Beach Club', 500, 'polo.png', '', 0, -4);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip_add` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `event_id`, `status`, `name`, `email`, `ip_add`) VALUES
(76, 1, 'PAID', 'PapaDarfoor', 'papadarfoor@gmail.com', '::1'),
(77, 1, 'PAID', 'PapaDarfoor', 'papadarfoor@gmail.com', '::1'),
(78, 1, 'PAID', 'PapaDarfoor', 'papadarfoor@gmail.com', '::1'),
(79, 2, 'PAID', 'PapaDarfoor', 'papadarfoor@gmail.com', '::1'),
(80, 1, 'PAID', 'PapaDarfoor', 'papadarfoor@gmail.com', '::1'),
(81, 1, 'PAID', 'Philip Owusu-Afriyie', 'afriyie@gmail.com', '127.0.0.1'),
(82, 1, 'PAID', 'PhilipOwusu-Afriyie', 'pokaj18@gmail.com', '127.0.0.1'),
(83, 1, 'PAID', 'atokwamin', 'ato.yawson@gmail.com', '127.0.0.1'),
(84, 6, 'PAID', 'kwabenakwabena', 'philip.afriyie@ashesi.edu.gh', '::1'),
(85, 1, 'PAID', 'kwabena kwabena', 'philip.afriyie@ashesi.edu.gh', '::1'),
(86, 1, 'PAID', 'PhilipOwusu-Afriyie', 'philip.afriyie@ashesi.edu.gh', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`conf_id`);

--
-- Indexes for table `conference_registration`
--
ALTER TABLE `conference_registration`
  ADD PRIMARY KEY (`conf_reg_id`),
  ADD KEY `conf_id` (`conf_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `conference`
--
ALTER TABLE `conference`
  MODIFY `conf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `conference_registration`
--
ALTER TABLE `conference_registration`
  MODIFY `conf_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
