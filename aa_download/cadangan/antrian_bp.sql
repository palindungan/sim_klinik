-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 04:33 PM
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
-- Table structure for table `antrian_bp`
--

CREATE TABLE `antrian_bp` (
  `id_antri_bp` int(11) NOT NULL,
  `kode_antrian_bp` char(6) NOT NULL,
  `tanggal_antrian` date NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tipe_antrian` enum('Dewasa','Anak-Anak') NOT NULL,
  `waktu_antrian` enum('Pagi','Sore') NOT NULL,
  `status_antrian` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian_bp`
--
ALTER TABLE `antrian_bp`
  ADD PRIMARY KEY (`id_antri_bp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian_bp`
--
ALTER TABLE `antrian_bp`
  MODIFY `id_antri_bp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
