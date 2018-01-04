-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2017 at 07:50 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elektornikstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brendovi`
--

CREATE TABLE `brendovi` (
  `id` int(5) UNSIGNED NOT NULL,
  `naziv` varchar(30) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `brendovi`
--

INSERT INTO `brendovi` (`id`, `naziv`) VALUES
(1, 'Asus'),
(2, 'Toshiba'),
(3, 'Intel'),
(4, 'MSI'),
(5, 'Genius');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) UNSIGNED NOT NULL,
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(3, 'Desktop računari'),
(6, 'Grafičke karte'),
(4, 'Laptop računari'),
(2, 'Matične ploče'),
(1, 'Procesori'),
(5, 'Zvučnici');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) UNSIGNED NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `akcijskacena` decimal(10,2) NOT NULL,
  `kolicina` int(5) UNSIGNED NOT NULL,
  `kategorija` int(11) UNSIGNED NOT NULL,
  `brend` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `cena`, `akcijskacena`, `kolicina`, `kategorija`, `brend`) VALUES
(1, 'Intel B960', '2399.00', '21999.00', 5, 1, 3),
(2, 'Intel i7 4790k', '35999.00', '31500.00', 20, 1, 3),
(3, 'MSI 789', '24980.00', '19900.00', 3, 2, 4),
(4, 'Asus 456', '10050.00', '0.00', 6, 2, 1),
(5, 'Toshiba T456', '82000.00', '79000.00', 6, 4, 2),
(6, 'Asus n5632', '51000.00', '0.00', 19, 4, 1),
(7, 'Genius m21', '4500.00', '0.00', 3, 5, 5),
(8, 'AURORA STANDARD A150 ', '21990.00', '0.00', 9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'pera@gmail.com', 'pera123'),
(2, 'mika@gmail.com', 'mika123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brendovi`
--
ALTER TABLE `brendovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proiz_pripada_kat` (`kategorija`),
  ADD KEY `proiz_pripada_brendu` (`brend`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brendovi`
--
ALTER TABLE `brendovi`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proiz_pripada_brendu` FOREIGN KEY (`brend`) REFERENCES `brendovi` (`Id`),
  ADD CONSTRAINT `proiz_pripada_kat` FOREIGN KEY (`kategorija`) REFERENCES `kategorije` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
