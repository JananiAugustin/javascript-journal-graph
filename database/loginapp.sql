-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 07:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_time`
--

CREATE TABLE `dt_time` (
  `time_id` int(11) NOT NULL,
  `dt` date DEFAULT NULL,
  `waketime` time DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_time`
--

INSERT INTO `dt_time` (`time_id`, `dt`, `waketime`, `id`) VALUES
(594, '2021-09-12', '09:14:00', 3),
(595, '2021-09-13', '05:00:00', 3),
(596, '2021-09-14', '08:06:00', 3),
(612, '2021-09-18', '06:11:00', 3),
(613, '2021-09-19', '05:05:00', 3),
(614, '2021-09-20', '05:15:00', 3),
(619, '2021-09-15', '07:15:00', 3),
(620, '2021-09-16', '06:20:00', 3),
(621, '2021-09-17', '07:35:00', 3),
(622, '2021-09-21', '05:43:00', 3),
(623, '2021-09-01', '06:49:00', 3),
(624, '2021-09-02', '07:52:00', 3),
(625, '2021-09-03', '07:54:00', 3),
(626, '2021-09-04', '06:35:00', 3),
(627, '2021-09-09', '05:56:00', 3),
(628, '2021-09-05', '04:00:00', 3),
(629, '2021-09-06', '07:03:00', 3),
(631, '2021-09-07', '19:02:00', 3),
(633, '2021-09-08', '06:08:00', 3),
(636, '2021-09-10', '04:10:00', 3),
(638, '2021-09-11', '16:19:00', 3),
(640, '2021-08-01', '05:19:00', 3),
(642, '2021-08-02', '05:23:00', 3),
(643, '2021-08-03', '07:26:00', 3),
(644, '2021-09-21', '05:43:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'janani', '$2y$10$e1N3h/g937WbJXw64dIumOJDU8LXq0uzOEroCd2Y7dTIBMr37uCdi'),
(3, 'augustin', '$2y$10$xbiTLaih988BVCjh77Ppu.RNbMoZB/i6jUvUJaYoOqoRM8LcD24NK'),
(4, 'augu', '$2y$10$8mnwIKqRonwW2eFMWdcN6ug1qtc4WAYveSmXpVJPo9J138axVvJte');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_time`
--
ALTER TABLE `dt_time`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_time`
--
ALTER TABLE `dt_time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=840;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dt_time`
--
ALTER TABLE `dt_time`
  ADD CONSTRAINT `dt_time_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
