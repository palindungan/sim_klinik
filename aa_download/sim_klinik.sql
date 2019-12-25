-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2019 pada 23.19
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
-- Struktur dari tabel `ambulan`
--

CREATE TABLE `ambulan` (
  `no_ambulan` char(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(9) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_balai_pengobatan_prioritas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_balai_pengobatan_prioritas` (
`kode_antrian_bp` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
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
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
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
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_bp`
--

CREATE TABLE `antrian_bp` (
  `kode_antrian_bp` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Diperiksa','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_bp`
--

INSERT INTO `antrian_bp` (`kode_antrian_bp`, `no_ref_pelayanan`, `status`) VALUES
('A001', '191112-005', 'Selesai'),
('A003', '191112-007', 'Diperiksa'),
('A004', '191112-008', 'Antri'),
('A007', '191119-014', 'Antri'),
('A008', '191125-015', 'Antri'),
('AG002', '191112-006', 'Selesai'),
('AG005', '191112-009', 'Selesai'),
('AG006', '191119-013', 'Antri'),
('AG009', '191129-020', 'Selesai');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_kesehatan_ibu_dan_anak_semua`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_kesehatan_ibu_dan_anak_semua` (
`kode_antrian_kia` char(4)
,`nama` varchar(50)
,`status` enum('Antri','Diperiksa','Selesai')
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
,`status` enum('Antri','Diperiksa','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_kia`
--

CREATE TABLE `antrian_kia` (
  `kode_antrian_kia` char(4) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Diperiksa','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_kia`
--

INSERT INTO `antrian_kia` (`kode_antrian_kia`, `no_ref_pelayanan`, `status`) VALUES
('1911', '191112-001', 'Selesai'),
('B912', '191112-010', 'Selesai'),
('B913', '191112-011', 'Diperiksa'),
('B914', '191119-012', 'Antri'),
('B915', '191125-017', 'Antri'),
('B916', '191125-018', 'Antri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_lab`
--

CREATE TABLE `antrian_lab` (
  `kode_antrian_lab` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Diperiksa','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian_lab`
--

INSERT INTO `antrian_lab` (`kode_antrian_lab`, `no_ref_pelayanan`, `status`) VALUES
('C003', '191112-004', 'Diperiksa'),
('C004', '191125-016', 'Antri'),
('CG001', '191112-002', 'Selesai'),
('CG002', '191112-003', 'Selesai');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `antrian_laboratorium_prioritas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `antrian_laboratorium_prioritas` (
`kode_antrian_lab` char(5)
,`nama` varchar(50)
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
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
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
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
,`status` enum('Antri','Prioritas','Diperiksa','Selesai')
,`no_antrian` varchar(3)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bp_penangan`
--

CREATE TABLE `bp_penangan` (
  `no_bp_p` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tgl_penanganan` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bp_tindakan`
--

CREATE TABLE `bp_tindakan` (
  `no_bp_t` char(4) NOT NULL,
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
-- Stand-in struktur untuk tampilan `daftar_penerimaan_obat_apotek`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_penerimaan_obat_apotek` (
`no_penerimaan_o` char(13)
,`nama` varchar(50)
,`tgl_penerimaan_o` datetime
,`total_harga` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_penerimaan_obat_apotek_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_penerimaan_obat_apotek_detail` (
`no_penerimaan_o` char(13)
,`nama_suplier` varchar(50)
,`tgl_penerimaan_o` datetime
,`total_harga` int(10)
,`nama_obat` varchar(50)
,`harga_supplier` int(9)
,`qty_awal` mediumint(5)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_pengiriman_obat_apotek_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_pengiriman_obat_apotek_detail` (
`no_obat_keluar_i` char(13)
,`qty_awal` int(3)
,`nama` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_penjualan_obat_apotek`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_penjualan_obat_apotek` (
`no_penjualan_obat_a` char(13)
,`tanggal_penjualan` datetime
,`total_harga` int(10)
,`no_ref_pelayanan` char(10)
,`no_rm` char(25)
,`nama_pasien` varchar(50)
,`no_user_pegawai` char(4)
,`nama_pegawai` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_penjualan_obat_apotek_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_penjualan_obat_apotek_detail` (
`no_detail_penjualan_obat_a` int(7)
,`nama` varchar(50)
,`qty` int(3)
,`harga_jual` int(9)
,`no_penjualan_obat_a` char(13)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_obat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_obat` (
`kode_obat` char(4)
,`nama_obat` varchar(50)
,`min_stok` int(3)
,`harga_jual` int(9)
,`no_kat_obat` char(4)
,`nama_kategori` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_pelayanan_pasien`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_pelayanan_pasien` (
`no_ref_pelayanan` char(10)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`no_rm` char(25)
,`nama` varchar(50)
,`nik` char(20)
,`tempat_lahir` varchar(50)
,`tgl_lahir` date
,`jenkel` enum('Laki-Laki','Perempuan')
,`alamat` text
,`status` enum('belum_finish','finish')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_stok_obat_apotek`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_stok_obat_apotek` (
`no_stok_obat_a` int(7)
,`harga_supplier` int(9)
,`qty_sekarang` mediumint(5)
,`tgl_penerimaan_o` datetime
,`kode_obat` char(4)
,`nama_obat` varchar(50)
,`harga_jual` int(9)
,`no_kat_obat` char(4)
,`nama_kategori` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bp_penangan`
--

CREATE TABLE `detail_bp_penangan` (
  `no_detail_bp_p` int(7) NOT NULL,
  `no_bp_p` char(13) NOT NULL,
  `no_bp_t` char(4) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kia_penanganan`
--

CREATE TABLE `detail_kia_penanganan` (
  `no_detail_kia_p` int(7) NOT NULL,
  `no_kia_p` char(13) NOT NULL,
  `no_kia_t` char(4) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_kia_penanganan`
--

INSERT INTO `detail_kia_penanganan` (`no_detail_kia_p`, `no_kia_p`, `no_kia_t`, `harga`) VALUES
(1, 'KP191125-0001', 'K001', 1000000),
(2, 'KP191125-0001', 'K002', 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_lab_transaksi`
--

CREATE TABLE `detail_lab_transaksi` (
  `no_detail_lab_t` int(7) NOT NULL,
  `no_lab_t` char(13) NOT NULL,
  `no_lab_c` char(4) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_lab_transaksi`
--

INSERT INTO `detail_lab_transaksi` (`no_detail_lab_t`, `no_lab_t`, `no_lab_c`, `harga`) VALUES
(1, 'LB191125-0001', 'L001', 600000),
(2, 'LB191125-0001', 'L001', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan_obat_apotik`
--

CREATE TABLE `detail_penjualan_obat_apotik` (
  `no_detail_penjualan_obat_a` int(7) NOT NULL,
  `no_penjualan_obat_a` char(13) NOT NULL,
  `no_stok_obat_a` int(7) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_jual` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan_obat_apotik`
--

INSERT INTO `detail_penjualan_obat_apotik` (`no_detail_penjualan_obat_a`, `no_penjualan_obat_a`, `no_stok_obat_a`, `qty`, `harga_jual`) VALUES
(1, 'PA191226-0001', 3, 2, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_kamar`
--

CREATE TABLE `detail_transaksi_rawat_inap_kamar` (
  `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_kamar_rawat_i` char(4) NOT NULL,
  `harga_harian` int(9) NOT NULL,
  `jumlah_hari` int(3) NOT NULL,
  `sub_total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_obat`
--

CREATE TABLE `detail_transaksi_rawat_inap_obat` (
  `no_detail_transaksi_rawat_inap_o` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_stok_obat_rawat_i` int(7) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_tindakan`
--

CREATE TABLE `detail_transaksi_rawat_inap_tindakan` (
  `no_detail_transaksi_rawat_inap_t` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_rawat_inap_t` char(4) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ugd_penanganan`
--

CREATE TABLE `detail_ugd_penanganan` (
  `no_detail_ugd_p` int(7) NOT NULL,
  `no_ugd_p` char(13) NOT NULL,
  `no_ugd_t` char(4) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_ugd_penanganan`
--

INSERT INTO `detail_ugd_penanganan` (`no_detail_ugd_p`, `no_ugd_p`, `no_ugd_t`, `harga`) VALUES
(1, 'UP191125-0001', 'U001', 10000000),
(2, 'UP191125-0001', 'U001', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_rawat_inap`
--

CREATE TABLE `kamar_rawat_inap` (
  `no_kamar_rawat_i` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga_harian` int(9) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar_rawat_inap`
--

INSERT INTO `kamar_rawat_inap` (`no_kamar_rawat_i`, `nama`, `harga_harian`, `tipe`) VALUES
('R001', 'asd', 300000, 'asd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `no_kat_obat` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_obat`
--

INSERT INTO `kategori_obat` (`no_kat_obat`, `nama`) VALUES
('K001', 'Analgesik'),
('K002', 'Agen imunosupresif'),
('K003', 'Laksatif'),
('K004', 'Statin'),
('K005', 'Vaksin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kia_penanganan`
--

CREATE TABLE `kia_penanganan` (
  `no_kia_p` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tgl_penanganan` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kia_penanganan`
--

INSERT INTO `kia_penanganan` (`no_kia_p`, `no_ref_pelayanan`, `tgl_penanganan`, `total_harga`) VALUES
('KP191125-0001', '191125-017', '2019-11-25 03:10:51', 1070000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kia_tindakan`
--

CREATE TABLE `kia_tindakan` (
  `no_kia_t` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kia_tindakan`
--

INSERT INTO `kia_tindakan` (`no_kia_t`, `nama`, `harga`) VALUES
('K001', 'asdx', 1000000),
('K002', 'hhfghfg', 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab_checkup`
--

CREATE TABLE `lab_checkup` (
  `no_lab_c` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lab_checkup`
--

INSERT INTO `lab_checkup` (`no_lab_c`, `nama`, `harga`) VALUES
('L001', 'Periksa kolestrols', 300000),
('L002', 'Periksa Diabetex', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab_transaksi`
--

CREATE TABLE `lab_transaksi` (
  `no_lab_t` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lab_transaksi`
--

INSERT INTO `lab_transaksi` (`no_lab_t`, `no_ref_pelayanan`, `tgl_transaksi`, `total_harga`) VALUES
('LB191125-0001', '191125-016', '2019-11-25 01:09:35', 900000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kode_obat` char(4) NOT NULL,
  `no_kat_obat` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `min_stok` int(3) NOT NULL,
  `harga_jual` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kode_obat`, `no_kat_obat`, `nama`, `min_stok`, `harga_jual`) VALUES
('O001', 'K002', 'parasetamol', 50, 20000),
('O002', 'K004', 'panadol', 40, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat_keluar_internal`
--

CREATE TABLE `obat_keluar_internal` (
  `no_obat_keluar_i` char(13) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `tgl_obat_keluar_i` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat_keluar_internal`
--

INSERT INTO `obat_keluar_internal` (`no_obat_keluar_i`, `tujuan`, `tgl_obat_keluar_i`) VALUES
('OK191210-0001', 'Rawat Inap', '2019-12-10 00:11:16');

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
('01232322', 'asdadssd', '1234567890098723', 'wqewe', '1980-11-01', 'Laki-Laki', '12312asd'),
('098128092', 'hhhh', '1111111111111114', 'ghjhgj', '1976-09-01', 'Perempuan', 'ghjgh'),
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
('60088879', 'asdassad', '1111111111111111', 'qdqw', '2010-01-01', 'Laki-Laki', '2121'),
('adsmkaskm', 'loooo', '1111111111111112', 'asdasd', '2001-09-01', 'Perempuan', 'asdsda'),
('cadad1212', 'adsq12', '1234567890123488', '123123', '1980-01-01', 'Laki-Laki', '12312'),
('cxcaa132', '123dd', '1234567890123477', '123d', '1980-01-01', 'Laki-Laki', '1212'),
('qwdcqd1221', 'rizkika zakka palindungan', '1234567890123433', '123123', '1980-01-01', 'Laki-Laki', '123123'),
('qweqwe', 'rizkika', '1234123412341234', 'jember', '1980-01-01', 'Laki-Laki', 'adasda'),
('svffd324', 'asdasd', '1234567890123455', '12', '1980-01-01', 'Laki-Laki', '12312'),
('tyu56756', 'asa', '1234567890098765', 'qwewq', '1980-01-01', 'Laki-Laki', 'qweqw');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `no_ref_pelayanan` char(10) NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `no_user_pegawai` char(4) NOT NULL,
  `layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD') NOT NULL,
  `tipe_antrian` enum('Dewasa','Anak-Anak') NOT NULL,
  `tgl_pelayanan` datetime NOT NULL,
  `status` enum('belum_finish','finish') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`no_ref_pelayanan`, `no_rm`, `no_user_pegawai`, `layanan_tujuan`, `tipe_antrian`, `tgl_pelayanan`, `status`) VALUES
('191112-001', '12345', 'P001', 'Poli KIA', 'Dewasa', '2019-12-02 00:00:00', 'finish'),
('191112-002', '123123', 'P001', 'Laboratorium', 'Anak-Anak', '2019-12-02 00:00:00', 'belum_finish'),
('191112-003', '123123ed', 'P001', 'Laboratorium', 'Anak-Anak', '2019-12-02 00:00:00', 'belum_finish'),
('191112-004', '12312wd', 'P001', 'Laboratorium', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191112-005', '123123222', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191112-006', '123dq12', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12 00:00:00', 'belum_finish'),
('191112-007', 'qwdcqd1221', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191112-008', 'svffd324', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191112-009', 'cxcaa132', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12 00:00:00', 'belum_finish'),
('191112-010', 'cadad1212', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191112-011', '12342gre', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish'),
('191119-012', '123192838123', 'P001', 'Poli KIA', 'Anak-Anak', '2019-11-19 00:00:00', 'belum_finish'),
('191119-013', '10387212387', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-19 00:00:00', 'belum_finish'),
('191119-014', '12312312ew', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-19 00:00:00', 'belum_finish'),
('191125-015', '01232322', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish'),
('191125-016', 'tyu56756', 'P001', 'Laboratorium', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish'),
('191125-017', '60088879', 'P001', 'Poli KIA', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish'),
('191125-018', 'adsmkaskm', 'P001', 'Poli KIA', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish'),
('191125-019', '098128092', 'P001', 'UGD', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish'),
('191129-020', 'qweqwe', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-29 00:00:00', 'belum_finish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan_ambulan`
--

CREATE TABLE `pelayanan_ambulan` (
  `no_pelayanan_a` char(4) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `no_ambulan` char(4) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelayanan_tujuan_bp`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelayanan_tujuan_bp` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`no_user_pegawai` char(4)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`status` enum('belum_finish','finish')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelayanan_tujuan_kia`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelayanan_tujuan_kia` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`no_user_pegawai` char(4)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`status` enum('belum_finish','finish')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelayanan_tujuan_lab`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelayanan_tujuan_lab` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`no_user_pegawai` char(4)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`status` enum('belum_finish','finish')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelayanan_tujuan_ugd`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pelayanan_tujuan_ugd` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`no_user_pegawai` char(4)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`status` enum('belum_finish','finish')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_obat`
--

CREATE TABLE `penerimaan_obat` (
  `no_penerimaan_o` char(13) NOT NULL,
  `no_supplier` char(4) NOT NULL,
  `tgl_penerimaan_o` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerimaan_obat`
--

INSERT INTO `penerimaan_obat` (`no_penerimaan_o`, `no_supplier`, `tgl_penerimaan_o`, `total_harga`) VALUES
('PO191201-0001', 'S001', '2019-12-01 22:22:18', 140000),
('PO191202-0001', 'S001', '2019-11-30 02:03:25', 43000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_obat_apotik`
--

CREATE TABLE `penjualan_obat_apotik` (
  `no_penjualan_obat_a` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tanggal_penjualan` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_obat_apotik`
--

INSERT INTO `penjualan_obat_apotik` (`no_penjualan_obat_a`, `no_ref_pelayanan`, `tanggal_penjualan`, `total_harga`) VALUES
('PA191226-0001', '191112-004', '2019-12-26 05:18:28', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rawat_inap_tindakan`
--

CREATE TABLE `rawat_inap_tindakan` (
  `no_rawat_inap_t` char(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_obat_apotik`
--

CREATE TABLE `stok_obat_apotik` (
  `no_stok_obat_a` int(7) NOT NULL,
  `no_penerimaan_o` char(13) NOT NULL,
  `kode_obat` char(4) NOT NULL,
  `harga_supplier` int(9) NOT NULL,
  `qty_awal` mediumint(5) NOT NULL,
  `qty_sekarang` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_obat_apotik`
--

INSERT INTO `stok_obat_apotik` (`no_stok_obat_a`, `no_penerimaan_o`, `kode_obat`, `harga_supplier`, `qty_awal`, `qty_sekarang`) VALUES
(1, 'PO191201-0001', 'O002', 60000, 1, 1),
(2, 'PO191201-0001', 'O001', 40000, 2, 2),
(3, 'PO191202-0001', 'O002', 8000, 2, 0),
(4, 'PO191202-0001', 'O001', 9000, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_obat_rawat_inap`
--

CREATE TABLE `stok_obat_rawat_inap` (
  `no_stok_obat_rawat_i` int(7) NOT NULL,
  `no_obat_keluar_i` char(13) NOT NULL,
  `no_stok_obat_a` int(7) NOT NULL,
  `qty_awal` int(3) NOT NULL,
  `qty_sekarang` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_obat_rawat_inap`
--

INSERT INTO `stok_obat_rawat_inap` (`no_stok_obat_rawat_i`, `no_obat_keluar_i`, `no_stok_obat_a`, `qty_awal`, `qty_sekarang`) VALUES
(1, 'OK191210-0001', 4, 2, 2),
(2, 'OK191210-0001', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `no_supplier` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `cp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`no_supplier`, `nama`, `cp`, `email`, `alamat`) VALUES
('S001', 'PT sumber obat jaya', '08123123123', 'gg@gmail.com', 'Lumajang'),
('S002', 'CV mantab manjur', '081236123123', 'HH@gmail.com', 'lele');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_rawat_inap`
--

CREATE TABLE `transaksi_rawat_inap` (
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ugd_penanganan`
--

CREATE TABLE `ugd_penanganan` (
  `no_ugd_p` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tgl_penanganan` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ugd_penanganan`
--

INSERT INTO `ugd_penanganan` (`no_ugd_p`, `no_ref_pelayanan`, `tgl_penanganan`, `total_harga`) VALUES
('UP191125-0001', '191125-019', '2019-11-25 03:35:24', 11000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ugd_tindakan`
--

CREATE TABLE `ugd_tindakan` (
  `no_ugd_t` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ugd_tindakan`
--

INSERT INTO `ugd_tindakan` (`no_ugd_t`, `nama`, `harga`) VALUES
('U001', 'Pemberian oksigens', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pegawai`
--

CREATE TABLE `user_pegawai` (
  `no_user_pegawai` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_akses` enum('Loket','Apotek','Administrasi','Balai Pengobatan','Laboratorium','KIA','Rawat Inap') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_pegawai`
--

INSERT INTO `user_pegawai` (`no_user_pegawai`, `nama`, `jenis_akses`, `username`, `password`) VALUES
('P001', 'afri', 'Rawat Inap', 'afri', '$2y$10$5rtXCrmfFXQlovbbXY/J6u3eplLbiSp3ls0nn9ERXG9gBGifxHiVO'),
('U002', 'kika', 'Loket', 'kika', '$2y$10$gIQgZO4D5b8LUWDVvH5Q6.PjmLjM8gLwEtpzkK.6bsXHv1tczykoG');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_tersisa`  AS  select `abps`.`kode_antrian_bp` AS `kode_antrian_bp`,`abps`.`nama` AS `nama`,`abps`.`status` AS `status`,`abps`.`no_antrian` AS `no_antrian` from `antrian_balai_pengobatan_semua` `abps` where ((`abps`.`status` <> 'Selesai') and (`abps`.`status` <> 'Diperiksa')) order by `abps`.`no_antrian` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak_tersisa`  AS  select `x`.`kode_antrian_kia` AS `kode_antrian_kia`,`x`.`nama` AS `nama`,`x`.`status` AS `status`,`x`.`no_antrian` AS `no_antrian` from `antrian_kesehatan_ibu_dan_anak_semua` `x` where ((`x`.`status` <> 'Selesai') and (`x`.`status` <> 'Diperiksa')) order by `x`.`no_antrian` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_tersisa`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`lap`.`nama` AS `nama`,`lap`.`status` AS `status`,`lap`.`no_antrian` AS `no_antrian` from `antrian_laboratorium_semua` `lap` where ((`lap`.`status` <> 'Selesai') and (`lap`.`status` <> 'Diperiksa')) order by `lap`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penerimaan_obat_apotek`
--
DROP TABLE IF EXISTS `daftar_penerimaan_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penerimaan_obat_apotek`  AS  select `po`.`no_penerimaan_o` AS `no_penerimaan_o`,`su`.`nama` AS `nama`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`po`.`total_harga` AS `total_harga` from (`penerimaan_obat` `po` join `supplier` `su` on((`po`.`no_supplier` = `su`.`no_supplier`))) order by `po`.`no_penerimaan_o` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penerimaan_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_penerimaan_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penerimaan_obat_apotek_detail`  AS  select `po`.`no_penerimaan_o` AS `no_penerimaan_o`,`su`.`nama` AS `nama_suplier`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`po`.`total_harga` AS `total_harga`,`o`.`nama` AS `nama_obat`,`soa`.`harga_supplier` AS `harga_supplier`,`soa`.`qty_awal` AS `qty_awal` from (((`penerimaan_obat` `po` join `supplier` `su` on((`po`.`no_supplier` = `su`.`no_supplier`))) join `stok_obat_apotik` `soa` on((`po`.`no_penerimaan_o` = `soa`.`no_penerimaan_o`))) join `obat` `o` on((`soa`.`kode_obat` = `o`.`kode_obat`))) order by `soa`.`no_stok_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_pengiriman_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_pengiriman_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_pengiriman_obat_apotek_detail`  AS  select `sori`.`no_obat_keluar_i` AS `no_obat_keluar_i`,`sori`.`qty_awal` AS `qty_awal`,`o`.`nama` AS `nama` from ((`stok_obat_rawat_inap` `sori` join `stok_obat_apotik` `soa` on((`sori`.`no_stok_obat_a` = `soa`.`no_stok_obat_a`))) join `obat` `o` on((`soa`.`kode_obat` = `o`.`kode_obat`))) order by `sori`.`no_stok_obat_rawat_i` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_apotek`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek`  AS  select `poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a`,`poa`.`tanggal_penjualan` AS `tanggal_penjualan`,`poa`.`total_harga` AS `total_harga`,`pe`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pa`.`no_rm` AS `no_rm`,`pa`.`nama` AS `nama_pasien`,`up`.`no_user_pegawai` AS `no_user_pegawai`,`up`.`nama` AS `nama_pegawai` from (((`penjualan_obat_apotik` `poa` join `pelayanan` `pe` on((`poa`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`))) join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) join `user_pegawai` `up` on((`pe`.`no_user_pegawai` = `up`.`no_user_pegawai`))) order by `poa`.`no_penjualan_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek_detail`  AS  select `dpoa`.`no_detail_penjualan_obat_a` AS `no_detail_penjualan_obat_a`,`o`.`nama` AS `nama`,`dpoa`.`qty` AS `qty`,`dpoa`.`harga_jual` AS `harga_jual`,`poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a` from (((`detail_penjualan_obat_apotik` `dpoa` join `stok_obat_apotik` `soa` on((`dpoa`.`no_stok_obat_a` = `soa`.`no_stok_obat_a`))) join `obat` `o` on((`soa`.`kode_obat` = `o`.`kode_obat`))) join `penjualan_obat_apotik` `poa` on((`dpoa`.`no_penjualan_obat_a` = `poa`.`no_penjualan_obat_a`))) order by `dpoa`.`no_detail_penjualan_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_obat`
--
DROP TABLE IF EXISTS `data_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_obat`  AS  select `o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`min_stok` AS `min_stok`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori` from (`obat` `o` join `kategori_obat` `ko` on((`o`.`no_kat_obat` = `ko`.`no_kat_obat`))) order by `o`.`nama` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pelayanan_pasien`
--
DROP TABLE IF EXISTS `data_pelayanan_pasien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pelayanan_pasien`  AS  select `pe`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pe`.`layanan_tujuan` AS `layanan_tujuan`,`pe`.`tipe_antrian` AS `tipe_antrian`,`pe`.`tgl_pelayanan` AS `tgl_pelayanan`,`pa`.`no_rm` AS `no_rm`,`pa`.`nama` AS `nama`,`pa`.`nik` AS `nik`,`pa`.`tempat_lahir` AS `tempat_lahir`,`pa`.`tgl_lahir` AS `tgl_lahir`,`pa`.`jenkel` AS `jenkel`,`pa`.`alamat` AS `alamat`,`pe`.`status` AS `status` from (`pelayanan` `pe` join `pasien` `pa` on((`pe`.`no_rm` = `pa`.`no_rm`))) where (`pe`.`status` = 'belum_finish') order by `pe`.`no_ref_pelayanan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_stok_obat_apotek`
--
DROP TABLE IF EXISTS `data_stok_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_stok_obat_apotek`  AS  select `soa`.`no_stok_obat_a` AS `no_stok_obat_a`,`soa`.`harga_supplier` AS `harga_supplier`,`soa`.`qty_sekarang` AS `qty_sekarang`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori` from (((`stok_obat_apotik` `soa` join `penerimaan_obat` `po` on((`soa`.`no_penerimaan_o` = `po`.`no_penerimaan_o`))) join `obat` `o` on((`soa`.`kode_obat` = `o`.`kode_obat`))) join `kategori_obat` `ko` on((`o`.`no_kat_obat` = `ko`.`no_kat_obat`))) order by `po`.`tgl_penerimaan_o` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelayanan_tujuan_bp`
--
DROP TABLE IF EXISTS `pelayanan_tujuan_bp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelayanan_tujuan_bp`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`no_user_pegawai` AS `no_user_pegawai`,`p`.`layanan_tujuan` AS `layanan_tujuan`,`p`.`tipe_antrian` AS `tipe_antrian`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`status` AS `status` from `pelayanan` `p` where ((`p`.`layanan_tujuan` = 'Balai Pengobatan') and (`p`.`status` = 'belum_finish')) order by `p`.`no_ref_pelayanan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelayanan_tujuan_kia`
--
DROP TABLE IF EXISTS `pelayanan_tujuan_kia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelayanan_tujuan_kia`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`no_user_pegawai` AS `no_user_pegawai`,`p`.`layanan_tujuan` AS `layanan_tujuan`,`p`.`tipe_antrian` AS `tipe_antrian`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`status` AS `status` from `pelayanan` `p` where ((`p`.`layanan_tujuan` = 'Poli KIA') and (`p`.`status` = 'belum_finish')) order by `p`.`no_ref_pelayanan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelayanan_tujuan_lab`
--
DROP TABLE IF EXISTS `pelayanan_tujuan_lab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelayanan_tujuan_lab`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`no_user_pegawai` AS `no_user_pegawai`,`p`.`layanan_tujuan` AS `layanan_tujuan`,`p`.`tipe_antrian` AS `tipe_antrian`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`status` AS `status` from `pelayanan` `p` where ((`p`.`layanan_tujuan` = 'Laboratorium') and (`p`.`status` = 'belum_finish')) order by `p`.`no_ref_pelayanan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelayanan_tujuan_ugd`
--
DROP TABLE IF EXISTS `pelayanan_tujuan_ugd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelayanan_tujuan_ugd`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`no_user_pegawai` AS `no_user_pegawai`,`p`.`layanan_tujuan` AS `layanan_tujuan`,`p`.`tipe_antrian` AS `tipe_antrian`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`status` AS `status` from `pelayanan` `p` where ((`p`.`layanan_tujuan` = 'UGD') and (`p`.`status` = 'belum_finish')) order by `p`.`no_ref_pelayanan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ambulan`
--
ALTER TABLE `ambulan`
  ADD PRIMARY KEY (`no_ambulan`);

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
-- Indeks untuk tabel `bp_penangan`
--
ALTER TABLE `bp_penangan`
  ADD PRIMARY KEY (`no_bp_p`);

--
-- Indeks untuk tabel `bp_tindakan`
--
ALTER TABLE `bp_tindakan`
  ADD PRIMARY KEY (`no_bp_t`);

--
-- Indeks untuk tabel `detail_bp_penangan`
--
ALTER TABLE `detail_bp_penangan`
  ADD PRIMARY KEY (`no_detail_bp_p`);

--
-- Indeks untuk tabel `detail_kia_penanganan`
--
ALTER TABLE `detail_kia_penanganan`
  ADD PRIMARY KEY (`no_detail_kia_p`);

--
-- Indeks untuk tabel `detail_lab_transaksi`
--
ALTER TABLE `detail_lab_transaksi`
  ADD PRIMARY KEY (`no_detail_lab_t`);

--
-- Indeks untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  ADD PRIMARY KEY (`no_detail_penjualan_obat_a`);

--
-- Indeks untuk tabel `detail_transaksi_rawat_inap_kamar`
--
ALTER TABLE `detail_transaksi_rawat_inap_kamar`
  ADD PRIMARY KEY (`no_detail_transaksi_rawat_inap_k`);

--
-- Indeks untuk tabel `detail_transaksi_rawat_inap_obat`
--
ALTER TABLE `detail_transaksi_rawat_inap_obat`
  ADD PRIMARY KEY (`no_detail_transaksi_rawat_inap_o`);

--
-- Indeks untuk tabel `detail_transaksi_rawat_inap_tindakan`
--
ALTER TABLE `detail_transaksi_rawat_inap_tindakan`
  ADD PRIMARY KEY (`no_detail_transaksi_rawat_inap_t`);

--
-- Indeks untuk tabel `detail_ugd_penanganan`
--
ALTER TABLE `detail_ugd_penanganan`
  ADD PRIMARY KEY (`no_detail_ugd_p`);

--
-- Indeks untuk tabel `kamar_rawat_inap`
--
ALTER TABLE `kamar_rawat_inap`
  ADD PRIMARY KEY (`no_kamar_rawat_i`);

--
-- Indeks untuk tabel `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`no_kat_obat`);

--
-- Indeks untuk tabel `kia_penanganan`
--
ALTER TABLE `kia_penanganan`
  ADD PRIMARY KEY (`no_kia_p`);

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
-- Indeks untuk tabel `lab_transaksi`
--
ALTER TABLE `lab_transaksi`
  ADD PRIMARY KEY (`no_lab_t`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indeks untuk tabel `obat_keluar_internal`
--
ALTER TABLE `obat_keluar_internal`
  ADD PRIMARY KEY (`no_obat_keluar_i`);

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
-- Indeks untuk tabel `pelayanan_ambulan`
--
ALTER TABLE `pelayanan_ambulan`
  ADD PRIMARY KEY (`no_pelayanan_a`);

--
-- Indeks untuk tabel `penerimaan_obat`
--
ALTER TABLE `penerimaan_obat`
  ADD PRIMARY KEY (`no_penerimaan_o`);

--
-- Indeks untuk tabel `penjualan_obat_apotik`
--
ALTER TABLE `penjualan_obat_apotik`
  ADD PRIMARY KEY (`no_penjualan_obat_a`);

--
-- Indeks untuk tabel `stok_obat_apotik`
--
ALTER TABLE `stok_obat_apotik`
  ADD PRIMARY KEY (`no_stok_obat_a`);

--
-- Indeks untuk tabel `stok_obat_rawat_inap`
--
ALTER TABLE `stok_obat_rawat_inap`
  ADD PRIMARY KEY (`no_stok_obat_rawat_i`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`no_supplier`);

--
-- Indeks untuk tabel `transaksi_rawat_inap`
--
ALTER TABLE `transaksi_rawat_inap`
  ADD PRIMARY KEY (`no_transaksi_rawat_i`);

--
-- Indeks untuk tabel `ugd_penanganan`
--
ALTER TABLE `ugd_penanganan`
  ADD PRIMARY KEY (`no_ugd_p`);

--
-- Indeks untuk tabel `ugd_tindakan`
--
ALTER TABLE `ugd_tindakan`
  ADD PRIMARY KEY (`no_ugd_t`);

--
-- Indeks untuk tabel `user_pegawai`
--
ALTER TABLE `user_pegawai`
  ADD PRIMARY KEY (`no_user_pegawai`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_bp_penangan`
--
ALTER TABLE `detail_bp_penangan`
  MODIFY `no_detail_bp_p` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_kia_penanganan`
--
ALTER TABLE `detail_kia_penanganan`
  MODIFY `no_detail_kia_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_lab_transaksi`
--
ALTER TABLE `detail_lab_transaksi`
  MODIFY `no_detail_lab_t` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  MODIFY `no_detail_penjualan_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_kamar`
--
ALTER TABLE `detail_transaksi_rawat_inap_kamar`
  MODIFY `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_obat`
--
ALTER TABLE `detail_transaksi_rawat_inap_obat`
  MODIFY `no_detail_transaksi_rawat_inap_o` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_tindakan`
--
ALTER TABLE `detail_transaksi_rawat_inap_tindakan`
  MODIFY `no_detail_transaksi_rawat_inap_t` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_ugd_penanganan`
--
ALTER TABLE `detail_ugd_penanganan`
  MODIFY `no_detail_ugd_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_apotik`
--
ALTER TABLE `stok_obat_apotik`
  MODIFY `no_stok_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_rawat_inap`
--
ALTER TABLE `stok_obat_rawat_inap`
  MODIFY `no_stok_obat_rawat_i` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
