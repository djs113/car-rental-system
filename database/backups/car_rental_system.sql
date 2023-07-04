-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2023 at 07:17 AM
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

INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES
('aa', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'bb'),
('fsda', 'd29aaa0b9cd402b4bfe2395a805f9ada', 'fsdafvxv', 'ergrwff'),
('nbvnc', '5c56fc99fe03e32897a4b562b502cd81', 'hnxvxxc', 'ytrhrth'),
('xcvvx', 'c2a82dd938f5d722f574e94f42f60bca', 'sdfa', 'bhgdbdf');

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

INSERT INTO `user_emails` (`email`, `username`) VALUES
('a@gmail.com', 'aa'),
('adfsf@gmail.com', 'fsda'),
('vbnv@gmail.com', 'nbvnc'),
('sfsf@gmail.com', 'xcvvx');

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

INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES
(2313312321323, 'aa'),
(1234567890, 'fsda'),
(31234325534, 'nbvnc'),
(8008098934223, 'xcvvx');

--
-- Indexes for dumped tables
--

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
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
