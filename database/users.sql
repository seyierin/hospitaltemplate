-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2025 at 12:49 PM
-- Server version: 11.4.8-MariaDB-cll-lve-log
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eksuhwld_db_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `webmail` varchar(250) NOT NULL,
  `bio` longtext DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `roleID` varchar(250) NOT NULL,
  `profile_image` varchar(250) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `is_tmc` varchar(250) NOT NULL DEFAULT 'no',
  `tmc_order` int(10) DEFAULT NULL,
  `website` longtext DEFAULT NULL,
  `linkedin` longtext DEFAULT NULL,
  `instagram` longtext DEFAULT NULL,
  `facebook` longtext DEFAULT NULL,
  `twitter` longtext DEFAULT NULL,
  `tiktok` longtext DEFAULT NULL,
  `token` varchar(250) NOT NULL,
  `is_2fa` int(5) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
