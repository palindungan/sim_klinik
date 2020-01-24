-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2020 at 06:34 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `setoran_rawat_inap`
--

CREATE TABLE `setoran_rawat_inap` (
  `id_setoran` int(10) NOT NULL,
  `tanggal_setor` datetime NOT NULL,
  `jumlah_setor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setoran_rawat_inap`
--

INSERT INTO `setoran_rawat_inap` (`id_setoran`, `tanggal_setor`, `jumlah_setor`) VALUES
(1, '2020-01-24 00:00:00', 10000),
(2, '2020-01-25 00:13:34', 100000),
(3, '2020-01-25 00:29:34', 500000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `setoran_rawat_inap`
--
ALTER TABLE `setoran_rawat_inap`
  ADD PRIMARY KEY (`id_setoran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `setoran_rawat_inap`
--
ALTER TABLE `setoran_rawat_inap`
  MODIFY `id_setoran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
