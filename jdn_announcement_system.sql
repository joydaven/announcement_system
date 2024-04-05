-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 06:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jdn_announcement_system`
--
CREATE DATABASE IF NOT EXISTS `jdn_announcement_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jdn_announcement_system`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`, `start_date`, `end_date`, `user_id`, `active`, `date_created`) VALUES
(1, 'Welcome to my announcement', 'this is a sample announcement', '2024-04-05', '2024-04-09', 1, 1, '2024-04-05 06:12:48'),
(2, 'masdfasdf', 'asdfasdfs', '2024-04-06', '2024-04-09', 10, 1, '2024-04-05 16:31:21'),
(11, 'testadfasdfdasf', 'adsfadsfadsfasdfadsfasdfdsf', '2024-04-06', '2024-04-07', 1, 1, '2024-04-05 16:44:20'),
(12, 'asdfasdfsadf', 'asdfsdfasdf', '2024-04-07', '2024-04-08', 23, 1, '2024-04-05 16:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(32) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(90) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `last_login`, `active`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'edie', 'hwang', 'edie@email.com', '2024-04-05 02:54:14', 1),
(10, 'test2', 'ad0234829205b9033196ba818f7a872b', 'lamar', 'jhonson', 'lam@email.com', '2024-04-05 16:42:07', 1),
(21, 'test3', '8ad8757baa8564dc136c1e07507f4a98', 'jason', 'bee', 'asd@asdf.com', '2024-04-05 16:44:52', 1),
(22, 'test4', '86985e105f79b95d6bc918fb45ec7727', 'jason', 'bee', 'asd@asdf.com', '2024-04-05 16:45:12', 1),
(23, 'test5', 'e3d704f3542b44a621ebed70dc0efe13', 'rob', 'jhonson', 'asdf@asdf.com', '2024-04-05 16:46:22', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
