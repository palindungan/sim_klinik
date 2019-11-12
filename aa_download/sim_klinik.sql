-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Nov 2019 pada 01.18
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
-- Stand-in struktur untuk tampilan `antrian_balai_pengobatan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_balai_pengobatan` (
`kode_antrian_bp` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Periksa','Prioritas','Selesai')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_bp`
--

CREATE TABLE `antrian_bp` (
  `kode_antrian_bp` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Periksa','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_bp`
--

INSERT INTO `antrian_bp` (`kode_antrian_bp`, `no_ref_pelayanan`, `status`) VALUES
('A001', '191001-001', 'Antri'),
('AG002', '191001-002', 'Antri');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_kesehatan_ibu_dan_anak`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_kesehatan_ibu_dan_anak` (
`kode_antrian_kia` char(4)
,`nama` varchar(50)
,`status` enum('Antri','Periksa','Prioritas','Selesai')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_kia`
--

CREATE TABLE `antrian_kia` (
  `kode_antrian_kia` char(4) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Periksa','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_kia`
--

INSERT INTO `antrian_kia` (`kode_antrian_kia`, `no_ref_pelayanan`, `status`) VALUES
('B001', '191001-002', 'Antri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_lab`
--

CREATE TABLE `antrian_lab` (
  `kode_antrian_lab` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Periksa','Prioritas','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_lab`
--

INSERT INTO `antrian_lab` (`kode_antrian_lab`, `no_ref_pelayanan`, `status`) VALUES
('C001', '191001-003', 'Antri'),
('CG002', '191001-001', 'Antri');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_laboratorium`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_laboratorium` (
`kode_antrian_lab` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Periksa','Prioritas','Selesai')
);

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
('RM191112001', 'aji susanto prihaswono', '12345678901234567890', 'jember', '2019-11-20', 'Laki-Laki', 'Jember , rambipuji'),
('RM191112002', 'Dina Suryatmi', '09876543210987654321', 'jember', '2019-11-01', 'Perempuan', 'jember'),
('RM191112003', 'Raden Nababan', '56789043217890654321', 'Lumajang', '2019-11-01', 'Laki-Laki', 'Lumaajang Kunir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `no_ref_pelayanan` char(10) NOT NULL,
  `no_rm` char(25) NOT NULL,
  `no_user_pegawai` char(5) NOT NULL,
  `layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium') NOT NULL,
  `tipe_antrian` enum('Dewasa','Anak-Anak') NOT NULL,
  `tgl_pelayanan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`no_ref_pelayanan`, `no_rm`, `no_user_pegawai`, `layanan_tujuan`, `tipe_antrian`, `tgl_pelayanan`) VALUES
('191001-001', 'RM191112001', 'UP001', 'Balai Pengobatan', 'Dewasa', '2019-11-06'),
('191001-002', 'RM191112002', 'UP001', 'Poli KIA', 'Dewasa', '2019-11-14'),
('191001-003', 'RM191112003', 'UP001', 'Laboratorium', 'Dewasa', '2019-11-06');

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan`  AS  select `ab`.`kode_antrian_bp` AS `kode_antrian_bp`,`pa`.`nama` AS `nama`,`ab`.`status` AS `status` from ((`antrian_bp` `ab` join `pelayanan` `pe` on((`ab`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`ab`.`kode_antrian_bp`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_kesehatan_ibu_dan_anak`
--
DROP TABLE IF EXISTS `antrian_kesehatan_ibu_dan_anak`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak`  AS  select `kia`.`kode_antrian_kia` AS `kode_antrian_kia`,`pa`.`nama` AS `nama`,`kia`.`status` AS `status` from ((`antrian_kia` `kia` join `pelayanan` `pe` on((`kia`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`kia`.`kode_antrian_kia`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium`
--
DROP TABLE IF EXISTS `antrian_laboratorium`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`pa`.`nama` AS `nama`,`lap`.`status` AS `status` from ((`antrian_lab` `lap` join `pelayanan` `pe` on((`lap`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) order by right(`lap`.`kode_antrian_lab`,3) ;

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
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`no_ref_pelayanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
