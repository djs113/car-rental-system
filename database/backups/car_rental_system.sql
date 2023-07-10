-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2023 at 05:15 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(20) NOT NULL,
  `passwd` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `passwd`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `card_booking_details`
--

CREATE TABLE IF NOT EXISTS `card_booking_details` (
  `booking_id` int(11) NOT NULL,
  `is_booked_for` varchar(20) DEFAULT NULL,
  `booking_duration` int(11) DEFAULT NULL,
  `pick_up_date` date DEFAULT NULL,
  `pick_up_time` time DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `card_id` bigint(20) DEFAULT NULL,
  `registration_number` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `registration_number` (`registration_number`),
  KEY `card_id` (`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_booking_details`
--

INSERT INTO `card_booking_details` (`booking_id`, `is_booked_for`, `booking_duration`, `pick_up_date`, `pick_up_time`, `payment_amount`, `payment_time`, `card_id`, `registration_number`) VALUES
(22, 'hours', 5, '2023-06-09', '09:07:00', 1000, '2023-06-08 14:05:06', 5643234, 'MN43LLJ23');

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE IF NOT EXISTS `card_details` (
  `card_number` bigint(20) NOT NULL,
  `name_on_card` varchar(30) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`card_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES
(2343131231, 'abc', '2024-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `cash_booking_details`
--

CREATE TABLE IF NOT EXISTS `cash_booking_details` (
  `booking_id` int(11) NOT NULL,
  `is_booked_for` varchar(20) DEFAULT NULL,
  `booking_duration` int(11) DEFAULT NULL,
  `pick_up_date` date DEFAULT NULL,
  `pick_up_time` time DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `registration_number` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `registration_number` (`registration_number`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_booking_details`
--

INSERT INTO `cash_booking_details` (`booking_id`, `is_booked_for`, `booking_duration`, `pick_up_date`, `pick_up_time`, `payment_amount`, `payment_time`, `username`, `registration_number`) VALUES
(45, 'weeks', 2, '2023-03-05', '10:00:04', 5000, '2023-03-03 11:03:05', 'aa', 'MN43LLJ23');

-- --------------------------------------------------------

--
-- Table structure for table `engine_numbers`
--

CREATE TABLE IF NOT EXISTS `engine_numbers` (
  `engine_number` varchar(20) NOT NULL,
  `registration_number` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`engine_number`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `engine_numbers`
--

INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES
('343BDSN452', 'MN43LLJ23');

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE IF NOT EXISTS `user_cards` (
  `card_id` bigint(20) NOT NULL,
  `card_name` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `card_number` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`card_id`),
  KEY `username` (`username`),
  KEY `card_number` (`card_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`card_id`, `card_name`, `username`, `card_number`) VALUES
(5643234, 'card', 'aa', 2343131231);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `username` varchar(20) NOT NULL,
  `passwd` varchar(40) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES
('aa', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'bb'),
('fsda', 'd29aaa0b9cd402b4bfe2395a805f9ada', 'klafvxv', 'ergrwff'),
('nbvnc', '5c56fc99fe03e32897a4b562b502cd81', 'hnxvxxc', 'ytrhrth'),
('vcbcb', '4124bc0a9335c27f086f24ba207a4912', 'bcvbc', 'xcser'),
('vnbvncbcb', '4124bc0a9335c27f086f24ba207a4912', 'rbtbbcvbc', 'xxczxcser'),
('xcvvx', 'c2a82dd938f5d722f574e94f42f60bca', 'sdfa', 'bhgdbdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE IF NOT EXISTS `user_emails` (
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_emails`
--

INSERT INTO `user_emails` (`email`, `username`) VALUES
('a@gmail.com', 'aa'),
('adfsf@gmail.com', 'fsda'),
('nbnv@gmail.com', 'nbvnc'),
('yut@gmail.com', 'vcbcb'),
('yerwewut@gmail.com', 'vnbvncbcb'),
('sfsf@gmail.com', 'xcvvx');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone_numbers`
--

CREATE TABLE IF NOT EXISTS `user_phone_numbers` (
  `phone_number` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`phone_number`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_phone_numbers`
--

INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES
(2313312321323, 'aa'),
(1234567890, 'fsda'),
(31234325534, 'nbvnc'),
(5645223444, 'vcbcb'),
(9845223444, 'vnbvncbcb'),
(8008098934223, 'xcvvx');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `registration_number` varchar(11) NOT NULL,
  `vehicle_color` varchar(20) DEFAULT NULL,
  `is_booked` tinyint(4) DEFAULT '0',
  `model_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`registration_number`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES
('MN43LLJ23', 'lkcvlv', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE IF NOT EXISTS `vehicle_models` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(20) DEFAULT NULL,
  `model_name` varchar(30) DEFAULT NULL,
  `vehicle_type` varchar(20) DEFAULT NULL,
  `hour_price` int(11) DEFAULT NULL,
  `day_price` int(11) DEFAULT NULL,
  `week_price` int(11) DEFAULT NULL,
  `month_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES
(4, 'xcvfs', 'vcvsdfsf', 'cvxsdfs', 300, 1000, 2300, 7000),
(5, 'vcbcx', 'rewtewr', 'adsds', 34, 634, 1234, 6532);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_booking_details`
--
ALTER TABLE `card_booking_details`
  ADD CONSTRAINT `card_booking_details_ibfk_1` FOREIGN KEY (`registration_number`) REFERENCES `vehicles` (`registration_number`),
  ADD CONSTRAINT `card_booking_details_ibfk_2` FOREIGN KEY (`card_id`) REFERENCES `user_cards` (`card_id`);

--
-- Constraints for table `cash_booking_details`
--
ALTER TABLE `cash_booking_details`
  ADD CONSTRAINT `cash_booking_details_ibfk_1` FOREIGN KEY (`registration_number`) REFERENCES `vehicles` (`registration_number`),
  ADD CONSTRAINT `cash_booking_details_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user_details` (`username`);

--
-- Constraints for table `engine_numbers`
--
ALTER TABLE `engine_numbers`
  ADD CONSTRAINT `engine_numbers_ibfk_1` FOREIGN KEY (`registration_number`) REFERENCES `vehicles` (`registration_number`);

--
-- Constraints for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD CONSTRAINT `user_cards_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_details` (`username`),
  ADD CONSTRAINT `user_cards_ibfk_2` FOREIGN KEY (`card_number`) REFERENCES `card_details` (`card_number`);

--
-- Constraints for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD CONSTRAINT `user_emails_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_details` (`username`);

--
-- Constraints for table `user_phone_numbers`
--
ALTER TABLE `user_phone_numbers`
  ADD CONSTRAINT `user_phone_numbers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_details` (`username`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`model_id`);
