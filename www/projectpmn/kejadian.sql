-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 08:12 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matawarga`
--

-- --------------------------------------------------------

--
-- Table structure for table `kejadian`
--

CREATE TABLE `kejadian` (
  `idkejadian` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_tujuan` enum('PEMKOT','PLN','PDAM','POLISI','Lain-lain') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kejadian`
--

INSERT INTO `kejadian` (`idkejadian`, `username`, `judul`, `deskripsi`, `instansi_tujuan`, `tanggal`) VALUES
(1, 'qwert', 'nabrak andong', 'nabrak andong', 'POLISI', '2020-04-04 00:00:00'),
(2, 'temu', 'tembak tembakan', 'nembak pacar', 'PEMKOT', '2020-04-04 00:00:00'),
(26, 'qwert', 'Aaaaa', 'Bcdeasy', 'PEMKOT', '2020-04-08 00:00:00'),
(34, 'qwert', 'Lokal', 'Loko', 'PEMKOT', '2020-04-16 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kejadian`
--
ALTER TABLE `kejadian`
  ADD PRIMARY KEY (`idkejadian`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kejadian`
--
ALTER TABLE `kejadian`
  MODIFY `idkejadian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kejadian`
--
ALTER TABLE `kejadian`
  ADD CONSTRAINT `kejadian_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
