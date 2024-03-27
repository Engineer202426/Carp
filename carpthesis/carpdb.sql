-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 07:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'Carp', 'Carp2324');

-- --------------------------------------------------------

--
-- Table structure for table `death`
--

CREATE TABLE `death` (
  `id` int(11) NOT NULL,
  `numdeath` int(11) NOT NULL,
  `datedeath` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death`
--

INSERT INTO `death` (`id`, `numdeath`, `datedeath`) VALUES
(1, 1, '2024-02-05 05:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `dosensor`
--

CREATE TABLE `dosensor` (
  `do_id` int(11) NOT NULL,
  `do_value` decimal(6,2) NOT NULL,
  `do_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timeday` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosensor`
--

INSERT INTO `dosensor` (`do_id`, `do_value`, `do_create`, `timeday`) VALUES
(1, 8.50, '2023-12-22 23:57:54', 'Morning'),
(2, 8.00, '2023-12-23 04:57:54', 'Afternoon'),
(3, 6.70, '2023-12-23 09:57:54', 'Night'),
(4, 5.50, '2023-12-28 00:55:57', 'Morning'),
(5, 6.80, '2023-12-28 05:55:57', 'Afternoon'),
(6, 7.20, '2023-12-28 10:56:57', 'Night'),
(7, 7.00, '2024-01-03 00:54:40', 'Morning'),
(8, 7.90, '2024-01-03 05:54:40', 'Afternoon'),
(9, 7.50, '2024-01-03 10:54:40', 'Night');

-- --------------------------------------------------------

--
-- Table structure for table `phsensor`
--

CREATE TABLE `phsensor` (
  `ph_id` int(11) NOT NULL,
  `ph_value` decimal(4,2) NOT NULL,
  `ph_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timeday` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phsensor`
--

INSERT INTO `phsensor` (`ph_id`, `ph_value`, `ph_create`, `timeday`) VALUES
(1, 7.30, '2023-12-22 23:57:54', 'Morning'),
(2, 7.00, '2023-12-23 04:57:54', 'Afternoon'),
(3, 6.50, '2023-12-23 09:57:54', 'Night'),
(4, 6.10, '2023-12-28 00:55:57', 'Morning'),
(5, 7.50, '2023-12-28 05:55:57', 'Afternoon'),
(6, 6.90, '2023-12-28 10:55:57', 'Night'),
(7, 7.00, '2024-01-03 00:54:40', 'Morning'),
(8, 7.50, '2024-01-03 05:54:40', 'Afternoon'),
(9, 8.00, '2024-01-03 10:54:40', 'Night');

-- --------------------------------------------------------

--
-- Table structure for table `sensorcontrol`
--

CREATE TABLE `sensorcontrol` (
  `constant_id` int(11) NOT NULL,
  `tempcontrol` int(11) NOT NULL,
  `phcontrol` int(11) NOT NULL,
  `docontrol` int(11) NOT NULL,
  `tdscontrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensorcontrol`
--

INSERT INTO `sensorcontrol` (`constant_id`, `tempcontrol`, `phcontrol`, `docontrol`, `tdscontrol`) VALUES
(1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int(11) NOT NULL,
  `Temperature` float DEFAULT NULL,
  `PH` float DEFAULT NULL,
  `DO` float DEFAULT NULL,
  `TDS` float DEFAULT NULL,
  `timestamp_field` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `Temperature`, `PH`, `DO`, `TDS`, `timestamp_field`) VALUES
(1, -127, -9.78, 0, 2659, '2023-12-20 06:06:14'),
(2, -127, 6.3, 0, 0, '2023-12-20 06:06:41'),
(3, -127, -9.78, 0, 2349, '2023-12-20 06:07:34'),
(4, -127, -9.78, 0, 2381, '2023-12-20 06:08:01'),
(5, -127, 5.75, 0, 0, '2023-12-20 06:08:54'),
(6, -127, 5.63, 0, 0, '2023-12-20 06:09:20'),
(7, -127, 5.12, 0, 0, '2023-12-20 06:10:13'),
(8, -127, -9.78, 0, 2288, '2023-12-20 06:10:40'),
(9, -127, -9.78, 0, 2329, '2023-12-20 06:11:33'),
(10, -127, 15.79, 0, 0, '2023-12-20 07:23:53'),
(11, -127, 15.79, 0, 0, '2023-12-20 07:24:19'),
(12, -127, 15.79, 0, 0, '2023-12-20 07:25:12'),
(13, -127, 15.79, 0, 0, '2023-12-20 07:25:39'),
(14, -127, 15.79, 0, 0, '2023-12-20 07:26:32'),
(15, -127, 15.79, 0, 0, '2024-01-29 20:11:16'),
(16, -127, 15.72, 0, 0, '2024-01-29 20:12:09'),
(17, -127, 15.79, 0, 0, '2024-01-29 20:12:35'),
(18, -127, 15.51, 0, 0, '2024-01-29 20:13:29'),
(19, -127, 15.37, 0, 0, '2024-01-29 20:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `tdssensor`
--

CREATE TABLE `tdssensor` (
  `tds_id` int(11) NOT NULL,
  `tds_value` decimal(6,2) NOT NULL,
  `tds_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timeday` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdssensor`
--

INSERT INTO `tdssensor` (`tds_id`, `tds_value`, `tds_create`, `timeday`) VALUES
(1, 91.00, '2023-12-22 23:57:54', 'Morning'),
(2, 89.00, '2023-12-23 04:57:54', 'Afternoon'),
(3, 86.00, '2023-12-23 09:57:54', 'Night'),
(4, 89.00, '2023-12-28 00:55:57', 'Morning'),
(5, 87.00, '2023-12-28 05:55:57', 'Afternoon'),
(6, 90.00, '2023-12-28 10:55:57', 'Night'),
(7, 87.00, '2024-01-03 00:54:40', 'Morning'),
(8, 88.00, '2024-01-03 05:54:40', 'Afternoon'),
(9, 89.00, '2024-01-03 10:54:40', 'Night');

-- --------------------------------------------------------

--
-- Table structure for table `tempsensor`
--

CREATE TABLE `tempsensor` (
  `temp_id` int(11) NOT NULL,
  `temp_value` decimal(4,2) NOT NULL,
  `temp_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timeday` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempsensor`
--

INSERT INTO `tempsensor` (`temp_id`, `temp_value`, `temp_create`, `timeday`) VALUES
(1, 22.78, '2023-12-22 23:57:54', 'Morning'),
(2, 30.00, '2023-12-23 04:57:54', 'Afternoon'),
(3, 22.78, '2023-12-23 09:57:54', 'Night'),
(4, 22.78, '2023-12-28 00:55:57', 'Morning'),
(5, 29.44, '2023-12-28 05:55:57', 'Afternoon'),
(6, 23.88, '2023-12-28 10:55:57', 'Night'),
(7, 22.22, '2024-01-03 00:54:40', 'Morning'),
(8, 27.78, '2024-01-03 05:54:40', 'Afternoon'),
(9, 22.78, '2024-01-03 10:54:40', 'Night');

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `id` int(11) NOT NULL,
  `carpweight` int(11) NOT NULL,
  `date_taken` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`id`, `carpweight`, `date_taken`) VALUES
(1, 93, '2023-12-03 02:16:50'),
(2, 972, '2024-01-03 03:38:52'),
(3, 1024, '2024-02-03 02:23:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death`
--
ALTER TABLE `death`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosensor`
--
ALTER TABLE `dosensor`
  ADD PRIMARY KEY (`do_id`);

--
-- Indexes for table `phsensor`
--
ALTER TABLE `phsensor`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `sensorcontrol`
--
ALTER TABLE `sensorcontrol`
  ADD PRIMARY KEY (`constant_id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tdssensor`
--
ALTER TABLE `tdssensor`
  ADD PRIMARY KEY (`tds_id`);

--
-- Indexes for table `tempsensor`
--
ALTER TABLE `tempsensor`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `death`
--
ALTER TABLE `death`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dosensor`
--
ALTER TABLE `dosensor`
  MODIFY `do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `phsensor`
--
ALTER TABLE `phsensor`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tdssensor`
--
ALTER TABLE `tdssensor`
  MODIFY `tds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tempsensor`
--
ALTER TABLE `tempsensor`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
