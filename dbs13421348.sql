-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 03:36 PM
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
-- Database: `dbs13421348`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_url` varchar(500) NOT NULL,
  `file_size` int(11) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`file_id`, `file_name`, `file_url`, `file_size`, `uploaded_at`) VALUES
(1, 'Lebenslauf', '/downloads/protected/basic/Lebenslauf_patrick_kaserer.pdf', 118, '2025-01-07 13:37:05'),
(2, 'Test_Motivationsschreiben', '/download/protected/basic/motivation/test_motivationsschreiben.pdf', 239, '2025-01-07 13:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `job_desc` varchar(255) NOT NULL,
  `initial_appli` tinyint(1) NOT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `passwort`, `job_desc`, `initial_appli`, `created_ad`) VALUES
(1, 'Admin', '', 'Fag5fj5vLC', 'Softwareentwickler', 0, '2025-01-07 13:27:59'),
(2, 'Test', '', '123', 'Projektmanager', 0, '2025-01-07 13:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`user_id`, `document_id`, `assigned_at`) VALUES
(1, 1, '2025-01-07 13:38:17'),
(1, 2, '2025-01-07 13:38:17'),
(2, 1, '2025-01-07 13:38:17'),
(2, 2, '2025-01-07 13:38:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`user_id`,`document_id`),
  ADD KEY `document_id` (`document_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_documents_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`file_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
