-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2023 at 09:08 AM
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

INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(12356, '123', '2023-09-29');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(5634534423, 'ccbfgef', '2023-08-17');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(6342411313, 'bbxffsrfw', '2023-09-08');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(8553352452, 'dfsdfvc', '2023-09-09');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(34535466345, 'vbcbbf', '2023-08-23');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(56423123128, 'n,jhjljlk', '2023-08-31');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(85634424223, 'sa', '2023-09-29');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(567563424234, 'bvnbv', '2023-08-17');
INSERT INTO `card_details` (`card_number`, `name_on_card`, `expiry_date`) VALUES(32145435345345, 'vbcbbf', '2023-09-22');

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

-- --------------------------------------------------------

--
-- Table structure for table `contact_details_1`
--

CREATE TABLE `contact_details_1` (
  `contact_email` varchar(20) NOT NULL,
  `contact_number_1` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details_1`
--

INSERT INTO `contact_details_1` (`contact_email`, `contact_number_1`) VALUES('sfas@gmail.com', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details_2`
--

CREATE TABLE `contact_details_2` (
  `contact_number_2` bigint(20) NOT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details_2`
--

INSERT INTO `contact_details_2` (`contact_number_2`, `address`) VALUES(1234523453, 'fsfvvxcvdfv');

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

INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('B421-1234', 'KL07CR2314');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('J983-3654', 'KL07CR9814');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('K098-4876', 'KL07CT8932');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('G764-1742', 'KL07CX7645');
INSERT INTO `engine_numbers` (`engine_number`, `registration_number`) VALUES('Z165-5416', 'KL07CZ2315');

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

INSERT INTO `user_cards` (`card_id`, `card_name`, `username`, `card_number`) VALUES(5643275, 'jknk', 'aa', 85634424223);
INSERT INTO `user_cards` (`card_id`, `card_name`, `username`, `card_number`) VALUES(5643276, 'vbcb', 'aa', 12356);

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

INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('aa', '4124bc0a9335c27f086f24ba207a4912', 'dfsf', 'sdafdsf');
INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('john', '4124bc0a9335c27f086f24ba207a4912', 'John', 'Smith');

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

INSERT INTO `user_emails` (`email`, `username`) VALUES('sfsf@gmail.com', 'aa');
INSERT INTO `user_emails` (`email`, `username`) VALUES('johnsmith123@gmail.com', 'john');

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

INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(1234567890, 'aa');
INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(9867541320, 'john');

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

INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('KL07CR2314', 'Red', 0, 24);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('KL07CR9814', 'Red', 0, 27);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('KL07CT8932', 'Black', 0, 25);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('KL07CX7645', 'Blue', 0, 26);
INSERT INTO `vehicles` (`registration_number`, `vehicle_color`, `is_booked`, `model_id`) VALUES('KL07CZ2315', 'Black', 0, 24);

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

INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(24, 'Audi', 'Q5', 'SUV', 3000, 15000, 60000, 150000);
INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(25, 'BMW', 'Z4', 'Convertible', 3800, 20000, 80000, 200000);
INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(26, 'Jaguar', 'F-TYPE', 'Coupe', 6000, 25000, 100000, 300000);
INSERT INTO `vehicle_models` (`model_id`, `brand_name`, `model_name`, `vehicle_type`, `hour_price`, `day_price`, `week_price`, `month_price`) VALUES(27, 'BMW', 'X5', 'SUV', 4000, 23000, 90000, 180000);

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
-- Indexes for table `contact_details_1`
--
ALTER TABLE `contact_details_1`
  ADD PRIMARY KEY (`contact_email`);

--
-- Indexes for table `contact_details_2`
--
ALTER TABLE `contact_details_2`
  ADD PRIMARY KEY (`contact_number_2`);

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `cash_booking_details`
--
ALTER TABLE `cash_booking_details`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000000041;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `card_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5643277;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
