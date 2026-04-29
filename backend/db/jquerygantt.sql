-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2026 at 01:22 PM
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
-- Database: `jquerygantt`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `dur` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `start`, `end`, `dur`, `progress`, `status`, `descript`) VALUES
(1, 'Project Planning', '2026-07-13', '2027-02-02', 147, 0, 'STATUS_SUSPENDED', 'Initial planning and requirement gathering'),
(2, 'Database Design', '2026-04-17', '2026-06-22', 47, 100, 'STATUS_DONE', 'Design tables and relationships for the system'),
(3, 'Backend Development', '2026-05-07', '2026-05-19', 9, 60, 'STATUS_FAILED', 'Develop PHP APIs and business logic'),
(4, 'Frontend Integration', '2026-05-18', '2026-05-22', 5, 40, 'STATUS_SUSPENDED', 'Connect frontend with backend APIs'),
(5, 'Testing & Bug Fixing NEW', '2026-05-21', '2026-05-25', 3, 20, 'STATUS_ACTIVE', 'TEST'),
(8, 'New', '2026-04-03', '2026-04-08', 4, 0, 'STATUS_ACTIVE', 'TEST'),
(9, 'Test', '2026-04-20', '2026-04-25', 4, 100, 'STATUS_DONE', 'Test'),
(10, 'Hello', '2026-04-01', '2026-04-17', 14, 1, 'STATUS_FAILED', 'Test'),
(11, 'New', '2026-04-01', '2026-04-17', 13, 10, 'STATUS_ACTIVE', 'New'),
(12, 'test', '2026-04-01', '2026-04-17', 13, 10, 'STATUS_ACTIVE', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
