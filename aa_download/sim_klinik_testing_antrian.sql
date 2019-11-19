-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2019 pada 09.23
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

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
-- Stand-in struktur untuk tampilan `antrian_balai_pengobatan_prioritas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_balai_pengobatan_prioritas` (
`kode_antrian_bp` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_balai_pengobatan_semua`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_balai_pengobatan_semua` (
`kode_antrian_bp` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_balai_pengobatan_tersisa`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_balai_pengobatan_tersisa` (
`kode_antrian_bp` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_bp`
--

CREATE TABLE `antrian_bp` (
  `kode_antrian_bp` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_bp`
--

INSERT INTO `antrian_bp` (`kode_antrian_bp`, `no_ref_pelayanan`, `status`) VALUES
('A001', '191112-005', 'Antri'),
('A003', '191112-007', 'Antri'),
('A004', '191112-008', 'Antri'),
('A007', '191119-014', 'Antri'),
('AG002', '191112-006', 'Antri'),
('AG005', '191112-009', 'Antri'),
('AG006', '191119-013', 'Antri');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_kesehatan_ibu_dan_anak_semua`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_kesehatan_ibu_dan_anak_semua` (
`kode_antrian_kia` char(4)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_kesehatan_ibu_dan_anak_tersisa`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_kesehatan_ibu_dan_anak_tersisa` (
`kode_antrian_kia` char(4)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_kia`
--

CREATE TABLE `antrian_kia` (
  `kode_antrian_kia` char(4) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_kia`
--

INSERT INTO `antrian_kia` (`kode_antrian_kia`, `no_ref_pelayanan`, `status`) VALUES
('1911', '191112-001', 'Antri'),
('B912', '191112-010', 'Antri'),
('B913', '191112-011', 'Antri'),
('B914', '191119-012', 'Antri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_lab`
--

CREATE TABLE `antrian_lab` (
  `kode_antrian_lab` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_lab`
--

INSERT INTO `antrian_lab` (`kode_antrian_lab`, `no_ref_pelayanan`, `status`) VALUES
('C003', '191112-004', 'Antri'),
('CG001', '191112-002', 'Antri'),
('CG002', '191112-003', 'Antri');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_laboratorium_prioritas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_laboratorium_prioritas` (
`kode_antrian_lab` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_laboratorium_semua`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_laboratorium_semua` (
`kode_antrian_lab` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_laboratorium_tersisa`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_laboratorium_tersisa` (
`kode_antrian_lab` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bp_tindakan`
--

CREATE TABLE `bp_tindakan` (
  `no_bp_t` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bp_tindakan`
--

INSERT INTO `bp_tindakan` (`no_bp_t`, `nama`, `harga`) VALUES
('B001', 'asd', 90000),
('B002', 'asd', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kia_tindakan`
--

CREATE TABLE `kia_tindakan` (
  `no_kia_t` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kia_tindakan`
--

INSERT INTO `kia_tindakan` (`no_kia_t`, `nama`, `harga`) VALUES
('K001', 'asdx', 1000009);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab_checkup`
--

CREATE TABLE `lab_checkup` (
  `no_lab_c` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lab_checkup`
--

INSERT INTO `lab_checkup` (`no_lab_c`, `nama`, `harga`) VALUES
('L001', 'Periksa kolestrols', 300009),
('L002', 'Periksa Diabetex', 1000009);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` char(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nama`, `nik`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`) VALUES
('10387212387', 'asdas', '0987654321098765', 'asasd', '1980-01-01', 'Laki-Laki', 'assa'),
('123123', 'dimas tuda', '1234567890123457', 'jember', '1980-11-19', 'Laki-Laki', '123123'),
('12312312ew', 'dwqw', '0987654321098712', 'ee', '1980-01-01', 'Laki-Laki', '23wee1'),
('123123222', 'dimas tuda', '1234567890123411', '123123', '1980-01-01', 'Laki-Laki', '12312'),
('123123ed', 'rizal', '1234567890123458', 'jember', '1980-01-01', 'Laki-Laki', '123123'),
('12312wd', 'rizkika', '1234567890123459', 'jember', '1980-01-01', 'Laki-Laki', '123123'),
('123192838123', 'kika', '1234567890123888', 'jemebr', '1980-01-01', 'Laki-Laki', 'jember'),
('12342gre', 'dimas tuda', '1234567890123443', '123', '1980-01-01', 'Laki-Laki', '12312'),
('12345', 'rizkika zakka palindungan', '1234567890123456', 'jember', '1998-08-01', 'Laki-Laki', 'lumajang'),
('123dq12', 'rizal', '1234567890123422', '123123', '1980-01-01', 'Laki-Laki', '123123'),
('cadad1212', 'adsq12', '1234567890123488', '123123', '1980-01-01', 'Laki-Laki', '12312'),
('cxcaa132', '123dd', '1234567890123477', '123d', '1980-01-01', 'Laki-Laki', '1212'),
('qwdcqd1221', 'rizkika zakka palindungan', '1234567890123433', '123123', '1980-01-01', 'Laki-Laki', '123123'),
('svffd324', 'asdasd', '1234567890123455', '12', '1980-01-01', 'Laki-Laki', '12312');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `no_ref_pelayanan` varchar(10) NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `no_user_pegawai` varchar(5) NOT NULL,
  `layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium') NOT NULL,
  `tipe_antrian` enum('Dewasa','Anak-Anak') NOT NULL,
  `tgl_pelayanan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`no_ref_pelayanan`, `no_rm`, `no_user_pegawai`, `layanan_tujuan`, `tipe_antrian`, `tgl_pelayanan`) VALUES
('191112-001', '12345', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12'),
('191112-002', '123123', 'P001', 'Laboratorium', 'Anak-Anak', '2019-11-12'),
('191112-003', '123123ed', 'P001', 'Laboratorium', 'Anak-Anak', '2019-11-12'),
('191112-004', '12312wd', 'P001', 'Laboratorium', 'Dewasa', '2019-11-12'),
('191112-005', '123123222', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12'),
('191112-006', '123dq12', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12'),
('191112-007', 'qwdcqd1221', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12'),
('191112-008', 'svffd324', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12'),
('191112-009', 'cxcaa132', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12'),
('191112-010', 'cadad1212', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12'),
('191112-011', '12342gre', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12'),
('191119-012', '123192838123', 'P001', 'Poli KIA', 'Anak-Anak', '2019-11-19'),
('191119-013', '10387212387', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-19'),
('191119-014', '12312312ew', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ugd_tindakan`
--

CREATE TABLE `ugd_tindakan` (
  `no_ugd_t` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ugd_tindakan`
--

INSERT INTO `ugd_tindakan` (`no_ugd_t`, `nama`, `harga`) VALUES
('U001', 'Pemberian oksigens', 1000009);

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_prioritas`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_prioritas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_prioritas`  AS  select `abps`.`kode_antrian_bp` AS `kode_antrian_bp`,`abps`.`nama` AS `nama`,`abps`.`status` AS `status`,`abps`.`no_antrian` AS `no_antrian` from `antrian_balai_pengobatan_semua` `abps` where (`abps`.`status` = 'Prioritas') order by `abps`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_semua`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_semua`  AS  select `ab`.`kode_antrian_bp` AS `kode_antrian_bp`,`pa`.`nama` AS `nama`,`ab`.`status` AS `status`,right(`ab`.`kode_antrian_bp`,3) AS `no_antrian` from ((`antrian_bp` `ab` join `pelayanan` `pe` on((`ab`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`ab`.`kode_antrian_bp`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_tersisa`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_tersisa`  AS  select `abps`.`kode_antrian_bp` AS `kode_antrian_bp`,`abps`.`nama` AS `nama`,`abps`.`status` AS `status`,`abps`.`no_antrian` AS `no_antrian` from `antrian_balai_pengobatan_semua` `abps` where (`abps`.`status` <> 'Selesai') order by `abps`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_kesehatan_ibu_dan_anak_semua`
--
DROP TABLE IF EXISTS `antrian_kesehatan_ibu_dan_anak_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak_semua`  AS  select `kia`.`kode_antrian_kia` AS `kode_antrian_kia`,`pa`.`nama` AS `nama`,`kia`.`status` AS `status`,right(`kia`.`kode_antrian_kia`,3) AS `no_antrian` from ((`antrian_kia` `kia` join `pelayanan` `pe` on((`kia`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`kia`.`kode_antrian_kia`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_kesehatan_ibu_dan_anak_tersisa`
--
DROP TABLE IF EXISTS `antrian_kesehatan_ibu_dan_anak_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak_tersisa`  AS  select `x`.`kode_antrian_kia` AS `kode_antrian_kia`,`x`.`nama` AS `nama`,`x`.`status` AS `status`,`x`.`no_antrian` AS `no_antrian` from `antrian_kesehatan_ibu_dan_anak_semua` `x` where (`x`.`status` <> 'Selesai') order by `x`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_prioritas`
--
DROP TABLE IF EXISTS `antrian_laboratorium_prioritas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_prioritas`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`lap`.`nama` AS `nama`,`lap`.`status` AS `status`,`lap`.`no_antrian` AS `no_antrian` from `antrian_laboratorium_semua` `lap` where (`lap`.`status` = 'Prioritas') order by `lap`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_semua`
--
DROP TABLE IF EXISTS `antrian_laboratorium_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_semua`  AS  select `lab`.`kode_antrian_lab` AS `kode_antrian_lab`,`pa`.`nama` AS `nama`,`lab`.`status` AS `status`,right(`lab`.`kode_antrian_lab`,3) AS `no_antrian` from ((`antrian_lab` `lab` join `pelayanan` `pe` on((`lab`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`lab`.`kode_antrian_lab`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_tersisa`
--
DROP TABLE IF EXISTS `antrian_laboratorium_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_tersisa`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`lap`.`nama` AS `nama`,`lap`.`status` AS `status`,`lap`.`no_antrian` AS `no_antrian` from `antrian_laboratorium_semua` `lap` where (`lap`.`status` <> 'Selesai') order by `lap`.`no_antrian` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian_bp`
--
ALTER TABLE `antrian_bp`
  ADD PRIMARY KEY (`kode_antrian_bp`);

--
-- Indeks untuk tabel `antrian_kia`
--
ALTER TABLE `antrian_kia`
  ADD PRIMARY KEY (`kode_antrian_kia`);

--
-- Indeks untuk tabel `antrian_lab`
--
ALTER TABLE `antrian_lab`
  ADD PRIMARY KEY (`kode_antrian_lab`);

--
-- Indeks untuk tabel `bp_tindakan`
--
ALTER TABLE `bp_tindakan`
  ADD PRIMARY KEY (`no_bp_t`);

--
-- Indeks untuk tabel `kia_tindakan`
--
ALTER TABLE `kia_tindakan`
  ADD PRIMARY KEY (`no_kia_t`);

--
-- Indeks untuk tabel `lab_checkup`
--
ALTER TABLE `lab_checkup`
  ADD PRIMARY KEY (`no_lab_c`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`no_ref_pelayanan`);

--
-- Indeks untuk tabel `ugd_tindakan`
--
ALTER TABLE `ugd_tindakan`
  ADD PRIMARY KEY (`no_ugd_t`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;