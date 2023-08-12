-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 12, 2023 at 09:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--
CREATE DATABASE IF NOT EXISTS `car_rental_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `car_rental_system`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(20) NOT NULL,
  `passwd` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `passwd`) VALUES('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `card_booking_details`
--

CREATE TABLE `card_booking_details` (
  `booking_id` int(11) NOT NULL,
  `pick_up_date` date DEFAULT NULL,
  `pick_up_time` time DEFAULT NULL,
  `drop_off_date` date DEFAULT NULL,
  `drop_off_time` time DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `card_id` bigint(20) DEFAULT NULL,
  `registration_number` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_booking_details`
--

INSERT INTO `card_booking_details` (`booking_id`, `pick_up_date`, `pick_up_time`, `drop_off_date`, `drop_off_time`, `payment_amount`, `payment_time`, `card_id`, `registration_number`) VALUES(1, '2023-06-09', '09:07:00', '2023-06-13', '19:07:00', 1000, '2023-06-08 14:05:06', 5643234, 'MN43LLJ23');

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `card_number` bigint(20) NOT NULL,
  `name_on_card` varchar(30) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(6757345, 'vxvdvgdf', '2024-09-04');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(2343131231, 'abc', '2024-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `cash_booking_details`
--

CREATE TABLE `cash_booking_details` (
  `booking_id` int(11) NOT NULL,
  `pick_up_date` date DEFAULT NULL,
  `pick_up_time` time DEFAULT NULL,
  `drop_off_date` date DEFAULT NULL,
  `drop_off_time` time DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `registration_number` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_booking_details`
--

INSERT INTO `cash_booking_details` (`booking_id`, `pick_up_date`, `pick_up_time`, `drop_off_date`, `drop_off_time`, `payment_amount`, `payment_time`, `username`, `registration_number`) VALUES(2000000000, '2023-06-05', '10:00:04', '2023-06-15', '15:07:00', 5000, '2023-06-04 11:03:00', 'aa', 'MN43LLJ23');

-- --------------------------------------------------------

--
-- Table structure for table `engine_numbers`
--

CREATE TABLE `engine_numbers` (
  `engine_number` varchar(20) NOT NULL,
  `registration_number` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `engine_numbers`
--

INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('BNN6SN452', 'CVB345345');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('343BDSN452', 'MN43LLJ23');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('HGFDSN452', 'XDC3453');

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE `user_cards` (
  `card_id` bigint(20) NOT NULL,
  `card_name` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `card_number` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`card_id`, `card_name`, `username`, `card_number`) VALUES(5643234, 'card', 'aa', 2343131231);
INSERT INTO `user_cards` (`card_id`, `card_name`, `username`, `card_number`) VALUES(5643237, 'dsfafwerw', 'aa', 6757345);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `username` varchar(20) NOT NULL,
  `passwd` varchar(40) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('aa', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'bb');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('fsda', 'd29aaa0b9cd402b4bfe2395a805f9ada', 'klafvxv', 'ergrwff');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('nbvnc', '5c56fc99fe03e32897a4b562b502cd81', 'hnxvxxc', 'ytrhrth');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('vcbcb', '4124bc0a9335c27f086f24ba207a4912', 'bcvbc', 'xcser');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('vnbvncbcb', '4124bc0a9335c27f086f24ba207a4912', 'rbtbbcvbc', 'xxczxcser');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('xcvvx', 'c2a82dd938f5d722f574e94f42f60bca', 'sdfa', 'bhgdbdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE `user_emails` (
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_emails`
--

INSERT INTO `user_emails` (`email`, `username`) VALUES('a@gmail.com', 'aa');
INSERT INTO `user_emails` (`email`, `username`) VALUES('adfsf@gmail.com', 'fsda');
INSERT INTO `user_emails` (`email`, `username`) VALUES('nbnv@gmail.com', 'nbvnc');
INSERT INTO `user_emails` (`email`, `username`) VALUES('yut@gmail.com', 'vcbcb');
INSERT INTO `user_emails` (`email`, `username`) VALUES('yerwewut@gmail.com', 'vnbvncbcb');
INSERT INTO `user_emails` (`email`, `username`) VALUES('sfsf@gmail.com', 'xcvvx');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone_numbers`
--

CREATE TABLE `user_phone_numbers` (
  `phone_number` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_phone_numbers`
--

INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(2313312321323, 'aa');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(1234567890, 'fsda');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(31234325534, 'nbvnc');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(5645223444, 'vcbcb');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(9845223444, 'vnbvncbcb');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(8008098934223, 'xcvvx');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `registration_number` varchar(11) NOT NULL,
  `vehicle_color` varchar(20) DEFAULT NULL,
  `is_booked` tinyint(4) DEFAULT 0,
  `model_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('CVB345345', 'cvxvsdf', 0, 4);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('MN43LLJ23', 'lkcvlv', 1, 4);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('XDC3453', 'cvxvsdf', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `model_id` int(11) NOT NULL,
  `brand_name` varchar(20) DEFAULT NULL,
  `model_name` varchar(30) DEFAULT NULL,
  `vehicle_type` varchar(20) DEFAULT NULL,
  `hour_price` int(11) DEFAULT NULL,
  `day_price` int(11) DEFAULT NULL,
  `week_price` int(11) DEFAULT NULL,
  `month_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(4, 'xcvfs', 'vcvsdfsf', 'cvxsdfs', 300, 1000, 2300, 7000);
INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(5, 'vcbcx', 'rewtewr', 'adsds', 34, 634, 1234, 6532);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `card_booking_details`
--
ALTER TABLE `card_booking_details`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `registration_number` (`registration_number`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`card_number`);

--
-- Indexes for table `cash_booking_details`
--
ALTER TABLE `cash_booking_details`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `registration_number` (`registration_number`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `engine_numbers`
--
ALTER TABLE `engine_numbers`
  ADD PRIMARY KEY (`engine_number`),
  ADD UNIQUE KEY `registration_number` (`registration_number`);

--
-- Indexes for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `username` (`username`),
  ADD KEY `card_number` (`card_number`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_phone_numbers`
--
ALTER TABLE `user_phone_numbers`
  ADD PRIMARY KEY (`phone_number`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`registration_number`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_booking_details`
--
ALTER TABLE `card_booking_details`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_booking_details`
--
ALTER TABLE `cash_booking_details`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000000001;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `card_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5643238;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
