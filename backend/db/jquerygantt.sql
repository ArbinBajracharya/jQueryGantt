-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 12:44 PM
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
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `start`, `end`, `dur`, `progress`, `descript`) VALUES
(1, 'Project Planning', '2026-05-01', '2026-05-03', 3, 100, 'Initial planning and requirement gathering'),
(2, 'Database Design', '2026-05-04', '2026-05-06', 3, 80, 'Design tables and relationships for the system'),
(3, 'Backend Development', '2026-05-07', '2026-05-15', 9, 60, 'Develop PHP APIs and business logic'),
(4, 'Frontend Integration', '2026-05-16', '2026-05-20', 5, 40, 'Connect frontend with backend APIs'),
(5, 'Testing & Bug Fixing NEW', '2026-05-21', '2026-05-25', 3, 20, 'TEST'),
(7, 'NEW', '2026-04-01', '2026-04-03', 4, 10, 'TEST');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
