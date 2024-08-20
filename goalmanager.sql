-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 04:31 PM
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
-- Database: `goalmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `goal_tracker`
--

CREATE TABLE `goal_tracker` (
  `goal_no` int(11) NOT NULL,
  `goal_name` varchar(100) NOT NULL,
  `goal_deadline` date NOT NULL,
  `goal_status` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goal_user`
--

CREATE TABLE `goal_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `user_password` varchar(254) NOT NULL,
  `user_email` varchar(15) NOT NULL,
  `user_contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goal_tracker`
--
ALTER TABLE `goal_tracker`
  ADD PRIMARY KEY (`goal_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `goal_user`
--
ALTER TABLE `goal_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goal_tracker`
--
ALTER TABLE `goal_tracker`
  MODIFY `goal_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goal_user`
--
ALTER TABLE `goal_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goal_tracker`
--
ALTER TABLE `goal_tracker`
  ADD CONSTRAINT `goal_tracker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `goal_user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
