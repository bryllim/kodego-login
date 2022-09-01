-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 01, 2022 at 12:53 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Pending','Completed') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `status`, `user_id`) VALUES
(16, 'Do assignments/homework', 'Pending', 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(6, 'test', '$2y$10$qBT/MOrWTnm.H2Utty0cle7KAHWq5zVADk58ygO2do1i6H9AAbDy6', '2022-08-27 16:40:57'),
(7, 'example', '$2y$10$Fd2ktAq2NMJWhTVw0MTWKOcOGgH1TU2f5OW1nsLU2nxXNKT5RUsj2', '2022-08-27 16:41:17'),
(9, 'dmeo', '$2y$10$NOFr6yh25gcHQoB6bgWIFeuJ/CMv1fdsfAA9U.qrWEd86HE8Wq2Gi', '2022-08-27 16:42:16'),
(11, 'Raul', '$2y$10$jxd3wUZDvMRtJtC3NMiO5uoelDXBmTP3GA1ibhRvFaxUaWhHuZwO6', '2022-08-27 17:29:43'),
(12, 'bryllim', '$2y$10$yhbOecHNbaaw3Zl7ibVtz.DzR3ksKnkohjS15y3fLOdjRW/c7UyZC', '2022-08-30 19:08:51'),
(14, 'kodego', '$2y$10$7csp/eVqlsi6ScbAJ3cc6u/VB.I5xsde/2e2wuNCAXpR0qRlPCKkq', '2022-08-31 19:18:56'),
(15, 'testuser', '$2y$10$q7dbu2h.Q75Az8EgEfxMEO889v6Qf0N/ZQmPANMv3I2Kh/AoEECOO', '2022-08-31 20:49:48'),
(16, 'ardhen', '$2y$10$JjElGb6EJv/z8Sktf3Wp0OW6B9C/ed9tcTT0dTh9WbU.nrHcr5/ii', '2022-09-01 20:17:35'),
(17, 'kevin', '$2y$10$fvlKYsOrAu49gg2JTeNXDuwfFfYexsoFqsoVI4XU0uS4dF5H5msdq', '2022-09-01 20:17:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
