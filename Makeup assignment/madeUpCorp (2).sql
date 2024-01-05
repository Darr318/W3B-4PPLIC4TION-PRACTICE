-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2024 at 09:39 PM
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
-- Database: `madeUpCorp`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_order` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_full_text` longtext NOT NULL,
  `article_created_date` datetime NOT NULL,
  `article_last_update` datetime NOT NULL,
  `article_display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_order`, `authorId`, `article_title`, `article_full_text`, `article_created_date`, `article_last_update`, `article_display`) VALUES
(1, 2, 'Tea in the morning', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero assumenda quos dolorem saepe tempore a quaerat nam sit iure id alias, recusandae neque, veniam qui earum cum reiciendis corrupti itaque?', '2024-01-05 11:44:42', '2024-01-05 11:44:42', 1),
(2, 2, 'Water Patek', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptatum doloribus id quam porro, illo adipisci saepe sint cum? Fugiat alias inventore quidem. Excepturi deleniti facilis quam consequatur veniam ut!', '2024-01-05 11:50:28', '2024-01-05 11:50:28', 1),
(4, 2, 'Heavy rain', 'It has just rained cats, goats and dogs today. Good way to start the year', '2024-01-05 16:58:58', '2024-01-05 16:58:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone_Number` int(13) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Password` text NOT NULL,
  `UserType` varchar(255) NOT NULL DEFAULT '1',
  `AccessTime` datetime(6) NOT NULL,
  `profile_Image` longblob DEFAULT NULL,
  `Address` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `Full_Name`, `email`, `phone_Number`, `User_Name`, `Password`, `UserType`, `AccessTime`, `profile_Image`, `Address`) VALUES
(2, 'Mark Kinditi', 'kindizi@gmail.com', 734439844, 'kindim', 'minty', '0', '2024-01-10 00:00:00.000000', 0x657a652d636d662d6677735376783332706c732d756e73706c617368202831292e6a7067, 'Ring road'),
(4, 'vidal M', 'vidalm@gmail.com', 776549454, 'viddy', 'vidzz', '1', '2024-01-10 00:00:00.000000', 0x75706c6f6164732f7261696d6f6e642d6b6c6176696e732d617a77525851674a7655492d756e73706c6173682e6a7067, 'glass house'),
(5, 'jason K', 'okjayson@gmail.com', 775678599, 'JayK', 'boring', '0', '2024-01-05 06:24:45.000000', 0x75706c6f6164732f6a6f686e6e795f6175746f6d617469635f736869705f735f776865656c2e706e67, 'glass mansion'),
(6, 'brook', 'brook@yahoo.com', 745634789, 'brokie', 'brkboyz', '0', '2024-01-05 06:34:43.000000', 0x75706c6f6164732f76696e746167652d313733383833335f313932302e706e67, 'glass mansion'),
(7, 'beezy', 'beezy@gmail.com', 717934528, '2beezy', 'workin', '0', '2024-01-05 06:44:06.000000', 0x75706c6f6164732f73796c7765746b612d706f6c736b695f666961745f3132352e706e67, 'Tropics'),
(8, 'bull dozer', 'bull@gmail.com', 795678493, 'bully', 'beeme', '1', '2024-01-05 06:45:54.000000', 0x75706c6f6164732f3438367834383662625f6175746f5f78312e6a7067, 'kapital'),
(11, 'gonzalez', 'speedyg@gmail.com', 725472537, 'speedy', 'zoom', '1', '2024-01-05 15:16:04.000000', 0x2e2e2f2e2e2f75706c6f6164732f657a652d636d662d6677735376783332706c732d756e73706c617368202831292e6a7067, 'royal oak'),
(14, 'Sam sun', 'sami@gmail.com', 783927346, 'samu', 'sing', '0', '2024-01-05 19:51:30.000000', 0x2e2e2f2e2e2f75706c6f6164732f6361722d33343736325f313932302e706e67, 'China');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_order`),
  ADD KEY `fk_author` (`authorId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`authorId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
