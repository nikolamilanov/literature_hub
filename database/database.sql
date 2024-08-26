-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 05:49 PM
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
-- Database: `literature_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `changes_logs`
--

CREATE TABLE `changes_logs` (
  `log_id` int(11) NOT NULL,
  `log_timestamp` datetime NOT NULL,
  `changed_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `action_type` enum('create','update','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `changes_requests`
--

CREATE TABLE `changes_requests` (
  `request_id` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `request_timestamp` datetime NOT NULL,
  `request_status` enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creations`
--

CREATE TABLE `creations` (
  `creation_id` int(11) NOT NULL,
  `creation_name` char(60) NOT NULL,
  `creation_genre` char(20) NOT NULL,
  `creation_writer` int(11) NOT NULL,
  `creation_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creations`
--

INSERT INTO `creations` (`creation_id`, `creation_name`, `creation_genre`, `creation_writer`, `creation_date`, `is_deleted`) VALUES
(1, 'При Рилския манастир', 'ода', 1, '0000-00-00', 0),
(2, 'Новото гробище над Сливница', 'стихотворение', 1, '0000-00-00', 0),
(3, 'До моето първо либе', 'стихотворение', 2, '0000-00-00', 0),
(4, 'Ветрената мелница', 'разказ', 5, '0000-00-00', 0),
(5, 'Вяра', 'стихотворение', 4, '0000-00-00', 0),
(6, 'История', 'стихотворение', 4, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `creations_changes_list`
--

CREATE TABLE `creations_changes_list` (
  `list_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` char(30) NOT NULL,
  `user_email` char(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` enum('user','teacher','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, 'user', 'user', '$2y$10$yul1dENzImjQx66X8REcG.DBcsLu/gflj8GJobwEoOVdM33/lM/vO', 'user'),
(2, 'teacher', 'teacher', '$2y$10$idgJNorTVJ8rTIgekYk9GeQkMnOVANNvx7sT82451NGYNXwyrfVOK', 'teacher'),
(3, 'admin', 'admin', '$2y$10$BEw5q3IqvrWJjcSUKM5zdOPEUwrNjBJXEA0L5BFMolQtEGJ.408S6', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `writer_id` int(11) NOT NULL,
  `writer_name` char(60) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `death_date` date DEFAULT NULL,
  `birth_place` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`writer_id`, `writer_name`, `birth_date`, `death_date`, `birth_place`) VALUES
(1, 'Иван Вазов', NULL, NULL, NULL),
(2, 'Христо Ботев', NULL, NULL, NULL),
(3, 'Димчо Дебелянов', NULL, NULL, NULL),
(4, 'Никола Вапцаров', NULL, NULL, NULL),
(5, 'Елин Пелин', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `writers_changes_list`
--

CREATE TABLE `writers_changes_list` (
  `list_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changes_logs`
--
ALTER TABLE `changes_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `changed_by` (`changed_by`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `changes_requests`
--
ALTER TABLE `changes_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `requested_by` (`requested_by`);

--
-- Indexes for table `creations`
--
ALTER TABLE `creations`
  ADD PRIMARY KEY (`creation_id`),
  ADD KEY `creation_writer` (`creation_writer`);

--
-- Indexes for table `creations_changes_list`
--
ALTER TABLE `creations_changes_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `log_id` (`log_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`writer_id`);

--
-- Indexes for table `writers_changes_list`
--
ALTER TABLE `writers_changes_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `log_id` (`log_id`),
  ADD KEY `record_id` (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `changes_logs`
--
ALTER TABLE `changes_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `changes_requests`
--
ALTER TABLE `changes_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creations`
--
ALTER TABLE `creations`
  MODIFY `creation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `creations_changes_list`
--
ALTER TABLE `creations_changes_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `writer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `writers_changes_list`
--
ALTER TABLE `writers_changes_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `changes_logs`
--
ALTER TABLE `changes_logs`
  ADD CONSTRAINT `changes_logs_ibfk_1` FOREIGN KEY (`changed_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `changes_logs_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `changes_requests`
--
ALTER TABLE `changes_requests`
  ADD CONSTRAINT `changes_requests_ibfk_1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `creations`
--
ALTER TABLE `creations`
  ADD CONSTRAINT `creations_ibfk_1` FOREIGN KEY (`creation_writer`) REFERENCES `writers` (`writer_id`);

--
-- Constraints for table `creations_changes_list`
--
ALTER TABLE `creations_changes_list`
  ADD CONSTRAINT `creations_changes_list_ibfk_1` FOREIGN KEY (`log_id`) REFERENCES `changes_logs` (`log_id`),
  ADD CONSTRAINT `creations_changes_list_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `creations` (`creation_id`);

--
-- Constraints for table `writers_changes_list`
--
ALTER TABLE `writers_changes_list`
  ADD CONSTRAINT `writers_changes_list_ibfk_1` FOREIGN KEY (`log_id`) REFERENCES `changes_logs` (`log_id`),
  ADD CONSTRAINT `writers_changes_list_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `writers` (`writer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;