-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 06:15 PM
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
-- Structure for view `laporan_rj`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_rj`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,(select sum(`c`.`harga`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L001') AS `gula_darah`,(select sum(`c`.`harga`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L002') AS `asam_urat`,(select sum(`c`.`harga`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L003') AS `cholesterol`,(select sum(`c`.`harga`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` <> 'L001' and `c`.`no_lab_c` <> 'L002' and `c`.`no_lab_c` <> 'L003') AS `lab_non_primer`,(select `kia`.`total_harga` from `kia_penanganan` `kia` where `kia`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_kia`,(select `ugd`.`total_harga` from `ugd_penanganan` `ugd` where `ugd`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_ugd`,(select `bp`.`total_harga` from `bp_penanganan` `bp` where `bp`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_bp`,(select `apotik`.`total_harga` from `penjualan_obat_apotik` `apotik` where `apotik`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_obat_apotik` from `pelayanan` `p` ;

--
-- VIEW  `laporan_rj`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
