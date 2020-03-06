-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 08:21 AM
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
-- Table structure for table `rawat_inap_tindakan`
--

CREATE TABLE `rawat_inap_tindakan` (
  `no_rawat_inap_t` char(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(9) NOT NULL,
  `tipe_paket` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawat_inap_tindakan`
--

INSERT INTO `rawat_inap_tindakan` (`no_rawat_inap_t`, `nama`, `harga`, `tipe_paket`) VALUES
('I001', 'Visite Dokter', 30000, '0'),
('I002', 'Japel per-hari', 30000, '0'),
('I003', 'Japel setengah-hari', 15000, '0'),
('I004', 'Gizi Harian', 27000, '0'),
('I005', 'Gizi 9rb/porsi', 9000, '0'),
('I006', 'INFUS SET', 20000, '0'),
('I007', 'TRANSFUSI SET', 20000, '0'),
('I008', 'MEDICUT', 30000, '0'),
('I009', 'On Call Dokter', 15000, '0'),
('I010', 'Paket Obat Pulang', 50000, '1'),
('I011', 'Administrasi', 10000, '0'),
('I012', 'Kebersihan', 5000, '0'),
('I017', 'Paket Selimut', 50000, '0'),
('I018', 'Rawat luka kecil', 20000, '0'),
('I019', 'Rawat luka sedang', 30000, '0'),
('I020', 'Rawat luka besar', 45000, '0'),
('I021', 'Paket Spuit dan Handscoon', 10000, '0'),
('I022', 'paket obat pulang 1', 75000, '1'),
('I023', 'paket obat pulang 2', 40000, '1'),
('I024', 'Paket obat pulang 3', 80000, '1'),
('I025', 'paket obat pulang 4', 30000, '1'),
('I026', 'paket obat pulang 5', 25000, '1'),
('I027', 'Cek GDA', 10000, '0'),
('I028', 'paket obat pulang 6', 45000, '1'),
('I029', 'japel igd dr aya', 5000, '0'),
('I030', 'Tranfusi Darah', 360000, '0'),
('I031', 'paket obat pulang 7', 35000, '1'),
('I032', 'paket obat', 20000, '1'),
('I033', 'surat keterangan sakit', 5000, '0'),
('I034', 'pasang oksigen', 150000, '0'),
('I035', 'underpad', 10000, '0'),
('I036', 'Rawat Luka 1', 25000, '0'),
('I037', 'Visite dr. Al Munawir', 30000, '0'),
('I038', 'Visite dr. Yayak', 30000, '0'),
('I039', 'Visite dr. Gini', 30000, '0'),
('I040', 'Visite dr.Aya', 20000, '0'),
('I041', 'Visite dr. Adit', 30000, '0'),
('I042', 'Visite dr. A', 0, '0'),
('I043', 'Visite dr. B', 0, '0'),
('I044', 'Visite dr. C', 0, '0'),
('I045', 'Visite dr. D', 0, '0'),
('I046', 'Visite dr. E', 0, '0'),
('I047', 'Visite dr. F', 0, '0'),
('I048', 'On Call dr. Al Munawir', 15000, '0'),
('I049', 'On Call dr. Yayak', 15000, '0'),
('I050', 'On Call dr. Gini', 15000, '0'),
('I051', 'On Call dr. Aya', 15000, '0'),
('I052', 'On Call dr. Adit', 50000, '0'),
('I053', 'On Call dr. A', 0, '0'),
('I054', 'On Call dr. B', 0, '0'),
('I055', 'On Call dr. C', 0, '0'),
('I056', 'On Call dr. D', 0, '0'),
('I057', 'On Call dr. E', 0, '0'),
('I058', 'On Call dr. F', 0, '0'),
('I059', 'Japel Dokter', 5000, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rawat_inap_tindakan`
--
ALTER TABLE `rawat_inap_tindakan`
  ADD PRIMARY KEY (`no_rawat_inap_t`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
