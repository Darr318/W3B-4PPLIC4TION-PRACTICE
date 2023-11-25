-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2023 at 06:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorstb`
--

CREATE TABLE `authorstb` (
  `AuthorId` int(11) NOT NULL,
  `AuthorFullName` varchar(255) NOT NULL,
  `AuthorEmail` varchar(100) NOT NULL,
  `AuthorAddress` varchar(255) NOT NULL,
  `AuthorBiography` longtext NOT NULL,
  `AuthorDateOfBirth` date NOT NULL,
  `AuthorSuspended` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authorstb`
--

INSERT INTO `authorstb` (`AuthorId`, `AuthorFullName`, `AuthorEmail`, `AuthorAddress`, `AuthorBiography`, `AuthorDateOfBirth`, `AuthorSuspended`) VALUES
(2, 'Joseph Kanini', 'jaykanini@gmail.com', 'Menelink Road', 'Don\'t like cats', '2010-02-12', 1),
(3, 'Mark Kinditi', 'kinditim@gmail.com', 'Ring road', 'Love to eat', '2006-10-16', 0),
(4, 'Mark Mende', 'kungfundi@gmail.com', 'Oloitoktok', 'Martial Arts legend', '2004-12-31', 1),
(5, 'Collins Gerard', 'Gerardocoll@gmail.com', 'Kiambu Road', 'Football prodigy', '2012-07-07', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorstb`
--
ALTER TABLE `authorstb`
  ADD PRIMARY KEY (`AuthorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorstb`
--
ALTER TABLE `authorstb`
  MODIFY `AuthorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
