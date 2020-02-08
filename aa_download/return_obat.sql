-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2020 at 05:36 AM
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
-- Table structure for table `return_obat`
--

CREATE TABLE `return_obat` (
  `no_return_obat` char(13) NOT NULL,
  `tanggal` datetime NOT NULL,
  `asal` varchar(10) NOT NULL,
  `tujuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_obat`
--

INSERT INTO `return_obat` (`no_return_obat`, `tanggal`, `asal`, `tujuan`) VALUES
('RO200208-0001', '2020-02-08 11:27:24', 'Gudang', 'Supplier'),
('RO200208-0002', '2020-02-08 11:34:19', 'RI', 'Gudang'),
('RO200208-0003', '2020-02-08 11:34:44', 'RI', 'Gudang'),
('RO200208-0004', '2020-02-08 11:35:51', 'RI', 'Gudang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `return_obat`
--
ALTER TABLE `return_obat`
  ADD PRIMARY KEY (`no_return_obat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
