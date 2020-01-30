-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Jan 2020 pada 00.28
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

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
-- Struktur dari tabel `ambulance`
--

CREATE TABLE `ambulance` (
  `no_ambulance` tinyint(2) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ambulance`
--

INSERT INTO `ambulance` (`no_ambulance`, `tujuan`, `harga`) VALUES
(1, 'Rujuk Jember', 250000),
(2, 'Rujuk Balung/Ambulu/Puger', 120000),
(3, 'Antar Pulang Wuluhan', 30000),
(4, 'Antar Pulang Balung/Puger', 60000),
(5, 'Ambil Darah PMI', 200000),
(6, 'Antar Pasien LAB PARAHMITA', 250000);

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
('A001', '200130-001', 'Antri');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian_lab`
--

CREATE TABLE `antrian_lab` (
  `kode_antrian_lab` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Diperiksa','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur dari tabel `bp_penanganan`
--

CREATE TABLE `bp_penanganan` (
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
  `harga` int(9) NOT NULL,
  `status` enum('Terima','Tidak Terima') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bp_tindakan`
--

INSERT INTO `bp_tindakan` (`no_bp_t`, `nama`, `harga`, `status`) VALUES
('T001', 'Paket 1', 30000, 'Terima'),
('T002', 'Paket 2', 35000, 'Terima');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_kamar_rawat_inap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_kamar_rawat_inap` (
`no_detail_transaksi_rawat_inap_k` int(7)
,`status_kamar` enum('Belum Cek Out','Sudah Cek Out')
,`no_kamar_rawat_i` char(4)
,`nama` varchar(50)
,`tanggal_cek_in` datetime
,`tanggal_cek_out` datetime
,`jumlah_hari` float
,`harga_harian` int(9)
,`sub_total_harga` int(10)
,`no_ref_pelayanan` char(10)
,`no_transaksi_rawat_i` char(13)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_pelayanan_ambulan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_pelayanan_ambulan` (
`harga` int(9)
,`no_pelayanan_a` char(13)
,`no_ref_pelayanan` char(10)
,`no_ambulance` tinyint(2)
,`tujuan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_tindakan_bp_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_tindakan_bp_transaksi` (
`no_bp_p` char(13)
,`no_bp_t` char(4)
,`nama` varchar(50)
,`qty` int(3)
,`harga_detail` int(10)
,`harga_tindakan` int(9)
,`no_ref_pelayanan` char(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_tindakan_kia_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_tindakan_kia_transaksi` (
`no_kia_p` char(13)
,`no_kia_t` char(4)
,`nama` varchar(50)
,`qty` int(3)
,`harga` int(10)
,`no_ref_pelayanan` char(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_tindakan_lab_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_tindakan_lab_transaksi` (
`no_lab_t` char(13)
,`no_lab_c` char(4)
,`nama` varchar(50)
,`qty` int(3)
,`harga` int(11)
,`no_ref_pelayanan` char(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_tindakan_rawat_inap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_tindakan_rawat_inap` (
`no_rawat_inap_t` char(4)
,`nama` varchar(30)
,`qty` int(3)
,`harga` int(9)
,`no_ref_pelayanan` char(10)
,`no_transaksi_rawat_i` char(13)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_tindakan_ugd_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_tindakan_ugd_transaksi` (
`no_ugd_p` char(13)
,`no_ugd_t` char(4)
,`nama` varchar(50)
,`qty` int(3)
,`harga` int(10)
,`no_ref_pelayanan` char(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_obat_rawat_inap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_obat_rawat_inap` (
`no_stok_obat_rawat_i` int(7)
,`kode_obat` varchar(4)
,`qty` mediumint(5)
,`nama_obat` varchar(50)
,`nama_kategori` varchar(50)
,`harga_jual` int(9)
);

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
,`qty` mediumint(5)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_pengiriman_obat_apotek_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_pengiriman_obat_apotek_detail` (
`id_detail_obat_keluar_internal` int(7)
,`qty` mediumint(5)
,`no_obat_keluar_i` char(13)
,`nama_obat` varchar(50)
,`harga_jual` int(9)
,`tipe` enum('Alkes','Obat')
,`nama_kategori` varchar(50)
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
,`kode_obat` char(4)
,`nama` varchar(50)
,`qty` int(3)
,`harga_jual` int(9)
,`status_paket` enum('Ya','Tidak')
,`qty_sekarang` mediumint(5)
,`no_penjualan_obat_a` char(13)
,`no_ref_pelayanan` char(10)
,`harga_lama` int(9)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_penjualan_obat_rawat_inap_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_penjualan_obat_rawat_inap_detail` (
`no_stok_obat_rawat_i` int(7)
,`nama_obat` varchar(50)
,`nama_kategori` varchar(50)
,`qty` int(3)
,`harga_jual` int(10)
,`no_ref_pelayanan` char(10)
,`no_transaksi_rawat_i` char(13)
,`qty_sekarang` mediumint(5)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_return_obat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_return_obat` (
`kode_obat` char(4)
,`no_return_obat` char(13)
,`qty_detail` mediumint(5)
,`tanggal` datetime
,`nama` varchar(50)
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
,`tipe` enum('Alkes','Obat')
,`qty` mediumint(5)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_pelayanan_pasien_default`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_pelayanan_pasien_default` (
`no_rm` varchar(25)
,`no_ref_pelayanan` char(10)
,`no_user_pegawai` char(4)
,`layanan_tujuan` enum('Balai Pengobatan','Poli KIA','Laboratorium','UGD')
,`tipe_antrian` enum('Dewasa','Anak-Anak')
,`tgl_pelayanan` datetime
,`status` enum('belum_finish','finish')
,`tipe_pelayanan` enum('Rawat Jalan','Rawat Inap')
,`nama` varchar(50)
,`umur` smallint(3)
,`alamat` text
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_stok_obat_apotek`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_stok_obat_apotek` (
`no_stok_obat_a` int(7)
,`no_penerimaan_o` char(13)
,`harga_supplier` int(9)
,`qty` mediumint(5)
,`tgl_penerimaan_o` datetime
,`kode_obat` char(4)
,`nama_obat` varchar(50)
,`harga_jual` int(9)
,`tipe` enum('Alkes','Obat')
,`no_kat_obat` char(4)
,`nama_kategori` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bp_penanganan`
--

CREATE TABLE `detail_bp_penanganan` (
  `no_detail_bp_p` int(7) NOT NULL,
  `no_bp_p` char(13) NOT NULL,
  `no_bp_t` char(4) NOT NULL,
  `qty` int(3) NOT NULL,
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
  `qty` int(3) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_lab_transaksi`
--

CREATE TABLE `detail_lab_transaksi` (
  `no_detail_lab_t` int(7) NOT NULL,
  `no_lab_t` char(13) NOT NULL,
  `no_lab_c` char(4) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat_keluar_internal`
--

CREATE TABLE `detail_obat_keluar_internal` (
  `id_detail_obat_keluar_internal` int(7) NOT NULL,
  `no_obat_keluar_i` char(13) NOT NULL,
  `kode_obat` char(4) NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_obat_keluar_internal`
--

INSERT INTO `detail_obat_keluar_internal` (`id_detail_obat_keluar_internal`, `no_obat_keluar_i`, `kode_obat`, `qty`) VALUES
(1, 'OK200130-0001', 'O011', 5),
(2, 'OK200130-0001', 'O052', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pelayanan_ambulan`
--

CREATE TABLE `detail_pelayanan_ambulan` (
  `no_detail_pelayanan_ambulan` int(11) NOT NULL,
  `no_pelayanan_a` char(13) NOT NULL,
  `no_ambulance` tinyint(2) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan_obat_apotik`
--

CREATE TABLE `detail_penjualan_obat_apotik` (
  `no_detail_penjualan_obat_a` int(7) NOT NULL,
  `no_penjualan_obat_a` char(13) NOT NULL,
  `kode_obat` varchar(4) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_jual` int(9) NOT NULL,
  `status_paket` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_return_obat`
--

CREATE TABLE `detail_return_obat` (
  `no_detail_return_obat` int(9) NOT NULL,
  `no_return_obat` char(13) NOT NULL,
  `kode_obat` char(4) NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_kamar`
--

CREATE TABLE `detail_transaksi_rawat_inap_kamar` (
  `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_kamar_rawat_i` char(4) NOT NULL,
  `tanggal_cek_in` datetime NOT NULL,
  `tanggal_cek_out` datetime NOT NULL,
  `jumlah_hari` float NOT NULL,
  `harga_harian` int(9) NOT NULL,
  `sub_total_harga` int(10) NOT NULL,
  `status_kamar` enum('Belum Cek Out','Sudah Cek Out') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_obat`
--

CREATE TABLE `detail_transaksi_rawat_inap_obat` (
  `no_detail_transaksi_rawat_inap_o` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_stok_obat_rawat_i` int(7) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_jual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_tindakan`
--

CREATE TABLE `detail_transaksi_rawat_inap_tindakan` (
  `no_detail_transaksi_rawat_inap_t` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_rawat_inap_t` char(4) NOT NULL,
  `qty` int(3) NOT NULL,
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
  `qty` int(3) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('R001', 'R. IGD', 25000, ''),
('R002', 'R. Marwah (Luar)', 50000, ''),
('R003', 'R. Marwah (Dalam)', 50000, ''),
('R004', 'R. Aziziah', 70000, ''),
('R005', 'R. Safa', 70000, ''),
('R006', 'R. Muzdallifah', 50000, ''),
('R007', 'R. Mina', 100000, ''),
('R008', 'R. Misfalah', 50000, ''),
('R009', 'R. Dzumaljah', 100000, ''),
('R010', 'R. Bahutmah', 70000, ''),
('R011', 'R. Arofah', 70000, ''),
('R012', 'R. Shisyah', 70000, '');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `kia_tindakan`
--

CREATE TABLE `kia_tindakan` (
  `no_kia_t` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('L001', 'GDA (Gula Darah)', 10000),
('L002', 'UA (Urit acid/asam urat)', 10000),
('L003', 'Collesterol', 25000),
('L004', 'Lab Luar', 30000),
('L005', 'HB (Hemoglobin)', 15000),
('L006', 'Golongan Darah', 20000),
('L007', 'DL (Darah Lengkap)', 55000),
('L008', 'Widal', 35000),
('L010', 'UL (Urine Lengkap)', 45000),
('L011', 'FA Ginjal (Bun Creat)', 55000),
('L012', 'SGOT / SGPT', 55000),
('L013', 'Malaria', 35000),
('L014', 'Protein Urine', 25000),
('L015', 'Planotest', 5000);

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

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_ri`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_ri` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`tgl_pelayanan` datetime
,`tipe_pelayanan` enum('Rawat Jalan','Rawat Inap')
,`tgl_keluar` datetime
,`uang_masuk` int(10)
,`temp_saldo` int(10)
,`saldo` int(10)
,`total_lab` int(11)
,`total_kia` int(11)
,`total_ugd` int(11)
,`biaya_ambulance` decimal(32,0)
,`total_bp` int(11)
,`gizi_hari` decimal(42,0)
,`gizi_porsi` decimal(42,0)
,`kamar` double
,`obat_ri` decimal(42,0)
,`obat_apotik` decimal(32,0)
,`obat_oral` decimal(44,1)
,`japel_hari` decimal(42,0)
,`japel_setengah` decimal(42,0)
,`visite` decimal(42,0)
,`nama_pasien` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_rj`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_rj` (
`no_ref_pelayanan` char(10)
,`no_rm` varchar(25)
,`tgl_pelayanan` datetime
,`tipe_pelayanan` enum('Rawat Jalan','Rawat Inap')
,`tgl_keluar` datetime
,`gula_darah` decimal(42,0)
,`asam_urat` decimal(42,0)
,`cholesterol` decimal(42,0)
,`lab_non_primer` decimal(42,0)
,`total_kia` int(11)
,`total_ugd` int(11)
,`total_bp` int(11)
,`total_obat_apotik` int(11)
,`nama_pasien` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kode_obat` char(4) NOT NULL,
  `no_kat_obat` char(4) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `min_stok` int(3) NOT NULL,
  `harga_jual` int(9) NOT NULL,
  `tipe` enum('Alkes','Obat') NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kode_obat`, `no_kat_obat`, `nama`, `min_stok`, `harga_jual`, `tipe`, `qty`) VALUES
('O001', '', 'Asering', 100, 32000, 'Obat', 0),
('O002', '', 'RI (Ringer Laktal)', 100, 20000, 'Obat', 0),
('O003', '', 'Ns (Sodium Chloride) ', 100, 20000, 'Obat', 0),
('O004', '', 'Kaen 3b', 100, 27000, 'Obat', 0),
('O005', '', 'D5 Glucose', 100, 20000, 'Obat', 0),
('O006', '', 'Sanmol (Paracetamol)', 100, 50000, 'Obat', 0),
('O007', '', 'D 40%', 100, 25000, 'Obat', 0),
('O008', '', 'D5 1/4 NS', 100, 20000, 'Obat', 0),
('O009', '', 'Metronidazole', 100, 55000, 'Obat', 0),
('O010', '', 'Water Injection', 100, 6000, 'Obat', 0),
('O011', '', 'Albumin', 100, 4000, 'Obat', 15),
('O012', '', 'Epatin', 100, 70000, 'Obat', 0),
('O013', '', 'Psidii (Oral)', 100, 8000, 'Obat', 0),
('O014', '', 'Psidii (Syrup)', 100, 55000, 'Obat', 0),
('O015', '', 'Misoprostol', 100, 10000, 'Obat', 0),
('O016', '', 'Dermazone Cair (50 ml)', 100, 210000, 'Obat', 0),
('O017', '', 'Dermazone Cair (100ml)', 100, 385000, 'Obat', 0),
('O018', '', 'Dermazone Wake (15 gr)', 100, 150000, 'Obat', 0),
('O019', '', 'Dermazone Wake (20 gr)', 100, 250000, 'Obat', 0),
('O020', '', 'Dermazone Wake (40 gr)', 100, 385000, 'Obat', 0),
('O021', '', 'Prontosan Gell', 100, 250000, 'Obat', 0),
('O022', '', 'Prontosan Cair', 100, 250000, 'Obat', 0),
('O023', '', 'Kasa Gulung', 100, 25000, 'Alkes', 0),
('O024', '', 'Kasa Kotak (Hexa)', 100, 5000, 'Alkes', 0),
('O025', '', 'Salep Moist', 100, 10000, 'Obat', 0),
('O026', '', 'Underpad', 100, 10000, 'Alkes', 0),
('O027', '', 'Hepavix (10cm)', 100, 10000, 'Alkes', 0),
('O028', '', 'Hepavix', 100, 90000, 'Alkes', 0),
('O029', '', 'Pampers', 100, 2500, 'Alkes', 0),
('O030', '', 'Oksigen Per-tabung', 100, 150000, 'Alkes', 0),
('O031', '', 'Oksigen Per-jam', 100, 10000, 'Alkes', 0),
('O032', '', 'Ranitidine', 100, 20000, 'Obat', 0),
('O033', '', 'Antrain', 100, 20000, 'Obat', 0),
('O034', '', 'Ondansetron', 100, 20000, 'Obat', 0),
('O035', '', 'Cefotaxime', 100, 20000, 'Obat', 0),
('O036', '', 'Cefoperazone', 100, 150000, 'Obat', 0),
('O037', '', 'Ceftriaxone', 100, 20000, 'Obat', 0),
('O038', '', 'Dexamethasone', 100, 10000, 'Obat', 0),
('O039', '', 'Diphenhidramine', 100, 5000, 'Obat', 0),
('O040', '', 'NB (Neurobion)', 100, 20000, 'Obat', 0),
('O041', '', 'Buscopan', 100, 50000, 'Obat', 0),
('O042', '', 'Lasic / Furosemide', 100, 20000, 'Obat', 0),
('O043', '', 'Asam Tranexamat', 100, 20000, 'Obat', 0),
('O044', '', 'Citicoline', 100, 40000, 'Obat', 0),
('O045', '', 'Diazepam', 100, 50000, 'Obat', 0),
('O046', '', 'Metergin', 100, 30000, 'Obat', 0),
('O047', '', 'Metoclopramide', 100, 20000, 'Obat', 0),
('O048', '', 'Oxitosin / Sintosinon', 100, 20000, 'Obat', 0),
('O049', '', 'Pehacain / Lidocain', 100, 20000, 'Obat', 0),
('O050', '', 'Piracetam', 100, 20000, 'Obat', 0),
('O051', '', 'Trilac', 100, 150000, 'Obat', 0),
('O052', '', 'Aminophylin', 100, 20000, 'Obat', 15),
('O053', '', 'Epineprin', 100, 20000, 'Obat', 0),
('O054', '', 'Spuit /1cc', 100, 2500, 'Alkes', 0),
('O055', '', 'Spuit /3cc', 100, 1500, 'Alkes', 0),
('O056', '', 'Spuit /5cc', 100, 2000, 'Alkes', 0),
('O057', '', 'Handscoon (Non Steril)', 100, 2000, 'Alkes', 0),
('O058', '', 'Handscoon (Steril)', 100, 5000, 'Alkes', 0),
('O059', '', 'Needle ', 100, 1000, 'Alkes', 0),
('O060', '', 'Masker o2 / Nebul', 100, 35000, 'Alkes', 0),
('O061', '', 'Nasal Canul', 100, 20000, 'Alkes', 0),
('O062', '', 'Poli Cateter', 100, 60000, 'Alkes', 0),
('O063', '', 'Urine Bag', 100, 10000, 'Alkes', 0),
('O064', '', 'V-Gell (30 gr)', 100, 15000, 'Alkes', 0),
('O065', '', 'Lavement', 100, 15000, 'Alkes', 0),
('O066', '', 'ATS (Anti Tetanus)', 100, 200000, 'Obat', 0),
('O067', '', 'Sabu', 100, 750000, 'Obat', 0),
('O068', '', 'Stesolid (5mg)', 100, 50000, 'Obat', 0),
('O069', '', 'Stesolid (10mg)', 100, 65000, 'Obat', 0);

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
('OK200130-0001', 'Rawat Inap', '2020-01-30 05:51:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `umur` smallint(3) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nama`, `umur`, `alamat`) VALUES
('asd123', 'Dimas Yudha', 18, 'Jember'),
('asdf1234', 'Ali Akbar', 22, 'Wuluhan'),
('ZXC123', 'Rizkika Zakka', 16, 'Jember');

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
  `status` enum('belum_finish','finish') NOT NULL,
  `tipe_pelayanan` enum('Rawat Jalan','Rawat Inap') NOT NULL,
  `grand_total` int(10) NOT NULL,
  `tgl_keluar` datetime DEFAULT NULL,
  `temp_saldo` int(10) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`no_ref_pelayanan`, `no_rm`, `no_user_pegawai`, `layanan_tujuan`, `tipe_antrian`, `tgl_pelayanan`, `status`, `tipe_pelayanan`, `grand_total`, `tgl_keluar`, `temp_saldo`, `saldo`) VALUES
('200130-001', 'asdf1234', 'P001', 'Balai Pengobatan', 'Dewasa', '2020-01-30 05:17:52', 'belum_finish', 'Rawat Jalan', 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan_ambulan`
--

CREATE TABLE `pelayanan_ambulan` (
  `no_pelayanan_a` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('PO200130-0001', 'S001', '2020-01-30 05:50:45', 460000);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `rawat_inap_tindakan`
--

CREATE TABLE `rawat_inap_tindakan` (
  `no_rawat_inap_t` char(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rawat_inap_tindakan`
--

INSERT INTO `rawat_inap_tindakan` (`no_rawat_inap_t`, `nama`, `harga`) VALUES
('I001', 'Visite Dokter', 30000),
('I002', 'Japel per-hari', 30000),
('I003', 'Japel setengah-hari', 15000),
('I004', 'Gizi 25rb/hari', 25000),
('I005', 'Gizi 8rb/porsi', 8000),
('I006', 'INFUS SET', 20000),
('I007', 'TRANSFUSI SET', 40000),
('I008', 'MEDICUT', 30000),
('I009', 'On Call Dokter', 15000),
('I010', 'Paket Obat Pulang', 35000),
('I011', 'Administrasi', 10000),
('I012', 'Kebersihan', 5000),
('I013', 'Paket', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_obat`
--

CREATE TABLE `return_obat` (
  `no_return_obat` char(13) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setoran_rawat_inap`
--

CREATE TABLE `setoran_rawat_inap` (
  `id_setoran` int(10) NOT NULL,
  `tanggal_setor` datetime NOT NULL,
  `jumlah_setor` int(10) NOT NULL
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
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_obat_apotik`
--

INSERT INTO `stok_obat_apotik` (`no_stok_obat_a`, `no_penerimaan_o`, `kode_obat`, `harga_supplier`, `qty`) VALUES
(1, 'PO200130-0001', 'O011', 3000, 20),
(2, 'PO200130-0001', 'O052', 20000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_obat_rawat_inap`
--

CREATE TABLE `stok_obat_rawat_inap` (
  `no_stok_obat_rawat_i` int(7) NOT NULL,
  `kode_obat` varchar(4) NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_obat_rawat_inap`
--

INSERT INTO `stok_obat_rawat_inap` (`no_stok_obat_rawat_i`, `kode_obat`, `qty`) VALUES
(1, 'O011', 5),
(2, 'O052', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `no_supplier` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `cp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`no_supplier`, `nama`, `cp`, `alamat`) VALUES
('S001', 'PT sumber obat jaya', '08123123123', 'Lumajang'),
('S002', 'CV mantab manjur', '081236123123', 'Jember'),
('S003', 'PT Kencana', '082234641698', 'Jalan cut mutiah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_rawat_inap`
--

CREATE TABLE `transaksi_rawat_inap` (
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `ugd_tindakan`
--

CREATE TABLE `ugd_tindakan` (
  `no_ugd_t` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pegawai`
--

CREATE TABLE `user_pegawai` (
  `no_user_pegawai` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_akses` enum('Loket','Apotek','Administrasi','Rawat Inap','Manager','Admin') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_pegawai`
--

INSERT INTO `user_pegawai` (`no_user_pegawai`, `nama`, `jenis_akses`, `username`, `password`) VALUES
('P001', 'Dimas', 'Manager', 'dimas', '$2y$10$t8SoKGvneQrW10RAhLTpReLluhqUSvN7ZmyiM6MzwbaKMJ3K1LUpq'),
('P002', 'Rizal Ramli', 'Loket', 'rizal', '$2y$10$IccC9tx95tyJWbb5UG51nOZnIL0SDxJJrQ.3lHRpdaQlL8mFTsvde'),
('P003', 'Rizkika', 'Apotek', 'kika', '$2y$10$cOcN4mfdibZxaLLVUgzK6eiUR7LHGbHCo/.oxpjFKJI0GO02pQDiW'),
('P004', 'Ari', 'Administrasi', 'ari', '$2y$10$Kg4BeWfHx5TdhWPlUYsQG.EvhwRId.vBA3NqM1ySb2DdBGMCwI1/a'),
('P005', 'Riyo Adnika', 'Rawat Inap', 'riyo', '$2y$10$4sakC86suXGs3vL5rZemJOxwn1K.Da3qU8u2PN3eoBl.xmZ1oSo2W'),
('P006', 'Ali', 'Admin', 'ali', '$2y$10$SLrVr5XA/2VIdEm/X4BP2es2keDKl0kQmdwrOCC/aA123g.a7.ik.');

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_prioritas`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_prioritas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_prioritas`  AS  select `abps`.`kode_antrian_bp` AS `kode_antrian_bp`,`abps`.`nama` AS `nama`,`abps`.`status` AS `status`,`abps`.`no_antrian` AS `no_antrian` from `antrian_balai_pengobatan_semua` `abps` where `abps`.`status` = 'Prioritas' order by `abps`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_semua`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_semua`  AS  select `ab`.`kode_antrian_bp` AS `kode_antrian_bp`,`pa`.`nama` AS `nama`,`ab`.`status` AS `status`,right(`ab`.`kode_antrian_bp`,3) AS `no_antrian` from ((`antrian_bp` `ab` join `pelayanan` `pe` on(`ab`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`)) join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) order by right(`ab`.`kode_antrian_bp`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_balai_pengobatan_tersisa`
--
DROP TABLE IF EXISTS `antrian_balai_pengobatan_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_balai_pengobatan_tersisa`  AS  select `abps`.`kode_antrian_bp` AS `kode_antrian_bp`,`abps`.`nama` AS `nama`,`abps`.`status` AS `status`,`abps`.`no_antrian` AS `no_antrian` from `antrian_balai_pengobatan_semua` `abps` where `abps`.`status` <> 'Selesai' and `abps`.`status` <> 'Diperiksa' order by `abps`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_kesehatan_ibu_dan_anak_semua`
--
DROP TABLE IF EXISTS `antrian_kesehatan_ibu_dan_anak_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak_semua`  AS  select `kia`.`kode_antrian_kia` AS `kode_antrian_kia`,`pa`.`nama` AS `nama`,`kia`.`status` AS `status`,right(`kia`.`kode_antrian_kia`,3) AS `no_antrian` from ((`antrian_kia` `kia` join `pelayanan` `pe` on(`kia`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`)) join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) order by right(`kia`.`kode_antrian_kia`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_kesehatan_ibu_dan_anak_tersisa`
--
DROP TABLE IF EXISTS `antrian_kesehatan_ibu_dan_anak_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_kesehatan_ibu_dan_anak_tersisa`  AS  select `x`.`kode_antrian_kia` AS `kode_antrian_kia`,`x`.`nama` AS `nama`,`x`.`status` AS `status`,`x`.`no_antrian` AS `no_antrian` from `antrian_kesehatan_ibu_dan_anak_semua` `x` where `x`.`status` <> 'Selesai' and `x`.`status` <> 'Diperiksa' order by `x`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_prioritas`
--
DROP TABLE IF EXISTS `antrian_laboratorium_prioritas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_prioritas`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`lap`.`nama` AS `nama`,`lap`.`status` AS `status`,`lap`.`no_antrian` AS `no_antrian` from `antrian_laboratorium_semua` `lap` where `lap`.`status` = 'Prioritas' order by `lap`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_semua`
--
DROP TABLE IF EXISTS `antrian_laboratorium_semua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_semua`  AS  select `lab`.`kode_antrian_lab` AS `kode_antrian_lab`,`pa`.`nama` AS `nama`,`lab`.`status` AS `status`,right(`lab`.`kode_antrian_lab`,3) AS `no_antrian` from ((`antrian_lab` `lab` join `pelayanan` `pe` on(`lab`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`)) join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) order by right(`lab`.`kode_antrian_lab`,3) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `antrian_laboratorium_tersisa`
--
DROP TABLE IF EXISTS `antrian_laboratorium_tersisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antrian_laboratorium_tersisa`  AS  select `lap`.`kode_antrian_lab` AS `kode_antrian_lab`,`lap`.`nama` AS `nama`,`lap`.`status` AS `status`,`lap`.`no_antrian` AS `no_antrian` from `antrian_laboratorium_semua` `lap` where `lap`.`status` <> 'Selesai' and `lap`.`status` <> 'Diperiksa' order by `lap`.`no_antrian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_kamar_rawat_inap`
--
DROP TABLE IF EXISTS `daftar_detail_kamar_rawat_inap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_kamar_rawat_inap`  AS  select `dtrik`.`no_detail_transaksi_rawat_inap_k` AS `no_detail_transaksi_rawat_inap_k`,`dtrik`.`status_kamar` AS `status_kamar`,`kri`.`no_kamar_rawat_i` AS `no_kamar_rawat_i`,`kri`.`nama` AS `nama`,`dtrik`.`tanggal_cek_in` AS `tanggal_cek_in`,`dtrik`.`tanggal_cek_out` AS `tanggal_cek_out`,`dtrik`.`jumlah_hari` AS `jumlah_hari`,`dtrik`.`harga_harian` AS `harga_harian`,`dtrik`.`sub_total_harga` AS `sub_total_harga`,`tri`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`tri`.`no_transaksi_rawat_i` AS `no_transaksi_rawat_i` from ((`detail_transaksi_rawat_inap_kamar` `dtrik` join `transaksi_rawat_inap` `tri` on(`dtrik`.`no_transaksi_rawat_i` = `tri`.`no_transaksi_rawat_i`)) join `kamar_rawat_inap` `kri` on(`dtrik`.`no_kamar_rawat_i` = `kri`.`no_kamar_rawat_i`)) order by `dtrik`.`no_detail_transaksi_rawat_inap_k` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_pelayanan_ambulan`
--
DROP TABLE IF EXISTS `daftar_detail_pelayanan_ambulan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_pelayanan_ambulan`  AS  select `dpa`.`harga` AS `harga`,`pa`.`no_pelayanan_a` AS `no_pelayanan_a`,`pa`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`a`.`no_ambulance` AS `no_ambulance`,`a`.`tujuan` AS `tujuan` from ((`detail_pelayanan_ambulan` `dpa` join `pelayanan_ambulan` `pa` on(`dpa`.`no_pelayanan_a` = `pa`.`no_pelayanan_a`)) join `ambulance` `a` on(`dpa`.`no_ambulance` = `a`.`no_ambulance`)) order by `dpa`.`no_detail_pelayanan_ambulan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_bp_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_bp_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_bp_transaksi`  AS  select `dbp`.`no_bp_p` AS `no_bp_p`,`bt`.`no_bp_t` AS `no_bp_t`,`bt`.`nama` AS `nama`,`dbp`.`qty` AS `qty`,`dbp`.`harga` AS `harga_detail`,`bt`.`harga` AS `harga_tindakan`,`bp`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_bp_penanganan` `dbp` join `bp_tindakan` `bt` on(`dbp`.`no_bp_t` = `bt`.`no_bp_t`)) join `bp_penanganan` `bp` on(`dbp`.`no_bp_p` = `bp`.`no_bp_p`)) order by `dbp`.`no_detail_bp_p` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_kia_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_kia_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_kia_transaksi`  AS  select `dkp`.`no_kia_p` AS `no_kia_p`,`kt`.`no_kia_t` AS `no_kia_t`,`kt`.`nama` AS `nama`,`dkp`.`qty` AS `qty`,`dkp`.`harga` AS `harga`,`kp`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_kia_penanganan` `dkp` join `kia_tindakan` `kt` on(`dkp`.`no_kia_t` = `kt`.`no_kia_t`)) join `kia_penanganan` `kp` on(`dkp`.`no_kia_p` = `kp`.`no_kia_p`)) order by `dkp`.`no_detail_kia_p` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_lab_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_lab_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_lab_transaksi`  AS  select `dlt`.`no_lab_t` AS `no_lab_t`,`lc`.`no_lab_c` AS `no_lab_c`,`lc`.`nama` AS `nama`,`dlt`.`qty` AS `qty`,`dlt`.`harga` AS `harga`,`lt`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_lab_transaksi` `dlt` join `lab_transaksi` `lt` on(`dlt`.`no_lab_t` = `lt`.`no_lab_t`)) join `lab_checkup` `lc` on(`dlt`.`no_lab_c` = `lc`.`no_lab_c`)) order by `dlt`.`no_detail_lab_t` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_rawat_inap`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_rawat_inap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_rawat_inap`  AS  select `rit`.`no_rawat_inap_t` AS `no_rawat_inap_t`,`rit`.`nama` AS `nama`,`dtrit`.`qty` AS `qty`,`dtrit`.`harga` AS `harga`,`tri`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`dtrit`.`no_transaksi_rawat_i` AS `no_transaksi_rawat_i` from ((`detail_transaksi_rawat_inap_tindakan` `dtrit` join `transaksi_rawat_inap` `tri` on(`dtrit`.`no_transaksi_rawat_i` = `tri`.`no_transaksi_rawat_i`)) join `rawat_inap_tindakan` `rit` on(`dtrit`.`no_rawat_inap_t` = `rit`.`no_rawat_inap_t`)) order by `dtrit`.`no_detail_transaksi_rawat_inap_t` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_ugd_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_ugd_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_ugd_transaksi`  AS  select `dup`.`no_ugd_p` AS `no_ugd_p`,`ut`.`no_ugd_t` AS `no_ugd_t`,`ut`.`nama` AS `nama`,`dup`.`qty` AS `qty`,`dup`.`harga` AS `harga`,`up`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_ugd_penanganan` `dup` join `ugd_tindakan` `ut` on(`dup`.`no_ugd_t` = `ut`.`no_ugd_t`)) join `ugd_penanganan` `up` on(`dup`.`no_ugd_p` = `up`.`no_ugd_p`)) order by `dup`.`no_detail_ugd_p` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_obat_rawat_inap`
--
DROP TABLE IF EXISTS `daftar_obat_rawat_inap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_obat_rawat_inap`  AS  select `stok_obat_rawat_inap`.`no_stok_obat_rawat_i` AS `no_stok_obat_rawat_i`,`stok_obat_rawat_inap`.`kode_obat` AS `kode_obat`,`stok_obat_rawat_inap`.`qty` AS `qty`,`obat`.`nama` AS `nama_obat`,`kategori_obat`.`nama` AS `nama_kategori`,`obat`.`harga_jual` AS `harga_jual` from ((`stok_obat_rawat_inap` join `obat` on(`stok_obat_rawat_inap`.`kode_obat` = `obat`.`kode_obat`)) left join `kategori_obat` on(`obat`.`no_kat_obat` = `kategori_obat`.`no_kat_obat`)) order by `obat`.`nama` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penerimaan_obat_apotek`
--
DROP TABLE IF EXISTS `daftar_penerimaan_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penerimaan_obat_apotek`  AS  select `po`.`no_penerimaan_o` AS `no_penerimaan_o`,`su`.`nama` AS `nama`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`po`.`total_harga` AS `total_harga` from (`penerimaan_obat` `po` join `supplier` `su` on(`po`.`no_supplier` = `su`.`no_supplier`)) order by `po`.`no_penerimaan_o` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penerimaan_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_penerimaan_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penerimaan_obat_apotek_detail`  AS  select `po`.`no_penerimaan_o` AS `no_penerimaan_o`,`su`.`nama` AS `nama_suplier`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`po`.`total_harga` AS `total_harga`,`o`.`nama` AS `nama_obat`,`soa`.`harga_supplier` AS `harga_supplier`,`soa`.`qty` AS `qty` from (((`penerimaan_obat` `po` join `supplier` `su` on(`po`.`no_supplier` = `su`.`no_supplier`)) join `stok_obat_apotik` `soa` on(`po`.`no_penerimaan_o` = `soa`.`no_penerimaan_o`)) join `obat` `o` on(`soa`.`kode_obat` = `o`.`kode_obat`)) order by `soa`.`no_stok_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_pengiriman_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_pengiriman_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_pengiriman_obat_apotek_detail`  AS  select `doki`.`id_detail_obat_keluar_internal` AS `id_detail_obat_keluar_internal`,`doki`.`qty` AS `qty`,`oki`.`no_obat_keluar_i` AS `no_obat_keluar_i`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`o`.`tipe` AS `tipe`,`ko`.`nama` AS `nama_kategori` from (((`detail_obat_keluar_internal` `doki` join `obat` `o` on(`doki`.`kode_obat` = `o`.`kode_obat`)) left join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) join `obat_keluar_internal` `oki` on(`doki`.`no_obat_keluar_i` = `oki`.`no_obat_keluar_i`)) order by `doki`.`id_detail_obat_keluar_internal` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_apotek`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek`  AS  select `poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a`,`poa`.`tanggal_penjualan` AS `tanggal_penjualan`,`poa`.`total_harga` AS `total_harga`,`pe`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pa`.`no_rm` AS `no_rm`,`pa`.`nama` AS `nama_pasien`,`up`.`no_user_pegawai` AS `no_user_pegawai`,`up`.`nama` AS `nama_pegawai` from (((`penjualan_obat_apotik` `poa` join `pelayanan` `pe` on(`poa`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`)) join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) join `user_pegawai` `up` on(`pe`.`no_user_pegawai` = `up`.`no_user_pegawai`)) order by `poa`.`no_penjualan_obat_a` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek_detail`  AS  select `dpoa`.`no_detail_penjualan_obat_a` AS `no_detail_penjualan_obat_a`,`o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama`,`dpoa`.`qty` AS `qty`,`dpoa`.`harga_jual` AS `harga_jual`,`dpoa`.`status_paket` AS `status_paket`,`o`.`qty` AS `qty_sekarang`,`poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a`,`poa`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`o`.`harga_jual` AS `harga_lama` from ((`detail_penjualan_obat_apotik` `dpoa` join `obat` `o` on(`dpoa`.`kode_obat` = `o`.`kode_obat`)) join `penjualan_obat_apotik` `poa` on(`dpoa`.`no_penjualan_obat_a` = `poa`.`no_penjualan_obat_a`)) order by `dpoa`.`no_detail_penjualan_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_rawat_inap_detail`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_rawat_inap_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_rawat_inap_detail`  AS  select `sori`.`no_stok_obat_rawat_i` AS `no_stok_obat_rawat_i`,`o`.`nama` AS `nama_obat`,`ko`.`nama` AS `nama_kategori`,`dtrio`.`qty` AS `qty`,`dtrio`.`harga_jual` AS `harga_jual`,`tri`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`dtrio`.`no_transaksi_rawat_i` AS `no_transaksi_rawat_i`,`sori`.`qty` AS `qty_sekarang` from ((((`detail_transaksi_rawat_inap_obat` `dtrio` join `stok_obat_rawat_inap` `sori` on(`dtrio`.`no_stok_obat_rawat_i` = `sori`.`no_stok_obat_rawat_i`)) join `transaksi_rawat_inap` `tri` on(`dtrio`.`no_transaksi_rawat_i` = `tri`.`no_transaksi_rawat_i`)) join `obat` `o` on(`sori`.`kode_obat` = `o`.`kode_obat`)) join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `dtrio`.`no_detail_transaksi_rawat_inap_o` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_return_obat`
--
DROP TABLE IF EXISTS `daftar_return_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_return_obat`  AS  select `detail_return_obat`.`kode_obat` AS `kode_obat`,`detail_return_obat`.`no_return_obat` AS `no_return_obat`,`detail_return_obat`.`qty` AS `qty_detail`,`return_obat`.`tanggal` AS `tanggal`,`obat`.`nama` AS `nama` from ((`detail_return_obat` join `obat` on(`detail_return_obat`.`kode_obat` = `obat`.`kode_obat`)) join `return_obat` on(`detail_return_obat`.`no_return_obat` = `return_obat`.`no_return_obat`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_obat`
--
DROP TABLE IF EXISTS `data_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_obat`  AS  select `o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`min_stok` AS `min_stok`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori`,`o`.`tipe` AS `tipe`,`o`.`qty` AS `qty` from (`obat` `o` left join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `o`.`nama` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pelayanan_pasien_default`
--
DROP TABLE IF EXISTS `data_pelayanan_pasien_default`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pelayanan_pasien_default`  AS  select `pelayanan`.`no_rm` AS `no_rm`,`pelayanan`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pelayanan`.`no_user_pegawai` AS `no_user_pegawai`,`pelayanan`.`layanan_tujuan` AS `layanan_tujuan`,`pelayanan`.`tipe_antrian` AS `tipe_antrian`,`pelayanan`.`tgl_pelayanan` AS `tgl_pelayanan`,`pelayanan`.`status` AS `status`,`pelayanan`.`tipe_pelayanan` AS `tipe_pelayanan`,`pasien`.`nama` AS `nama`,`pasien`.`umur` AS `umur`,`pasien`.`alamat` AS `alamat` from (`pelayanan` join `pasien` on(`pelayanan`.`no_rm` = `pasien`.`no_rm`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_stok_obat_apotek`
--
DROP TABLE IF EXISTS `data_stok_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_stok_obat_apotek`  AS  select `soa`.`no_stok_obat_a` AS `no_stok_obat_a`,`soa`.`no_penerimaan_o` AS `no_penerimaan_o`,`soa`.`harga_supplier` AS `harga_supplier`,`o`.`qty` AS `qty`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`o`.`tipe` AS `tipe`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori` from (((`stok_obat_apotik` `soa` join `penerimaan_obat` `po` on(`soa`.`no_penerimaan_o` = `po`.`no_penerimaan_o`)) join `obat` `o` on(`soa`.`kode_obat` = `o`.`kode_obat`)) join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `po`.`tgl_penerimaan_o` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_ri`
--
DROP TABLE IF EXISTS `laporan_ri`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_ri`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`tipe_pelayanan` AS `tipe_pelayanan`,`p`.`tgl_keluar` AS `tgl_keluar`,`p`.`grand_total` AS `uang_masuk`,`p`.`temp_saldo` AS `temp_saldo`,`p`.`saldo` AS `saldo`,(select `l`.`total_harga` from `lab_transaksi` `l` where `l`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_lab`,(select `kia`.`total_harga` from `kia_penanganan` `kia` where `kia`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_kia`,(select `ugd`.`total_harga` from `ugd_penanganan` `ugd` where `ugd`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_ugd`,(select sum(`pa`.`total_harga`) from `pelayanan_ambulan` `pa` where `pa`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `biaya_ambulance`,(select `bp`.`total_harga` from `bp_penanganan` `bp` where `bp`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_bp`,(select sum(`dtrit`.`harga` * `dtrit`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_tindakan` `dtrit` on(`tri`.`no_transaksi_rawat_i` = `dtrit`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `dtrit`.`no_rawat_inap_t` = 'I004') AS `gizi_hari`,(select sum(`dtrit`.`harga` * `dtrit`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_tindakan` `dtrit` on(`tri`.`no_transaksi_rawat_i` = `dtrit`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `dtrit`.`no_rawat_inap_t` = 'I005') AS `gizi_porsi`,(select sum(`dtrik`.`harga_harian` * `dtrik`.`jumlah_hari`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_kamar` `dtrik` on(`tri`.`no_transaksi_rawat_i` = `dtrik`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `kamar`,(select sum(`dori`.`harga_jual` * `dori`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_obat` `dori` on(`tri`.`no_transaksi_rawat_i` = `dori`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `obat_ri`,(select sum(`poa`.`total_harga`) from `penjualan_obat_apotik` `poa` where `poa`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `obat_apotik`,(select sum(`dtrio`.`harga_jual` * `dtrio`.`qty` * 0.5) from ((`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_obat` `dtrio` on(`tri`.`no_transaksi_rawat_i` = `dtrio`.`no_transaksi_rawat_i`)) join `stok_obat_rawat_inap` `sori` on(`dtrio`.`no_stok_obat_rawat_i` = `sori`.`no_stok_obat_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `sori`.`kode_obat` = 'O001') AS `obat_oral`,(select sum(`dtrit`.`harga` * `dtrit`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_tindakan` `dtrit` on(`tri`.`no_transaksi_rawat_i` = `dtrit`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `dtrit`.`no_rawat_inap_t` = 'I002') AS `japel_hari`,(select sum(`dtrit`.`harga` * `dtrit`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_tindakan` `dtrit` on(`tri`.`no_transaksi_rawat_i` = `dtrit`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `dtrit`.`no_rawat_inap_t` = 'I003') AS `japel_setengah`,(select sum(`dtrit`.`harga` * `dtrit`.`qty`) from (`transaksi_rawat_inap` `tri` join `detail_transaksi_rawat_inap_tindakan` `dtrit` on(`tri`.`no_transaksi_rawat_i` = `dtrit`.`no_transaksi_rawat_i`)) where `tri`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `dtrit`.`no_rawat_inap_t` = 'I001') AS `visite`,(select `ps`.`nama` from `pasien` `ps` where `ps`.`no_rm` = `p`.`no_rm`) AS `nama_pasien` from `pelayanan` `p` where `p`.`status` = 'finish' ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_rj`
--
DROP TABLE IF EXISTS `laporan_rj`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_rj`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`tipe_pelayanan` AS `tipe_pelayanan`,`p`.`tgl_keluar` AS `tgl_keluar`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L001') AS `gula_darah`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L002') AS `asam_urat`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L003') AS `cholesterol`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` <> 'L001' and `c`.`no_lab_c` <> 'L002' and `c`.`no_lab_c` <> 'L003') AS `lab_non_primer`,(select `kia`.`total_harga` from `kia_penanganan` `kia` where `kia`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_kia`,(select `ugd`.`total_harga` from `ugd_penanganan` `ugd` where `ugd`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_ugd`,(select `bp`.`total_harga` from `bp_penanganan` `bp` where `bp`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_bp`,(select `apotik`.`total_harga` from `penjualan_obat_apotik` `apotik` where `apotik`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_obat_apotik`,(select `ps`.`nama` from `pasien` `ps` where `ps`.`no_rm` = `p`.`no_rm`) AS `nama_pasien` from `pelayanan` `p` where `p`.`status` = 'finish' and `p`.`tipe_pelayanan` = 'Rawat Jalan' ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`no_ambulance`);

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
-- Indeks untuk tabel `bp_penanganan`
--
ALTER TABLE `bp_penanganan`
  ADD PRIMARY KEY (`no_bp_p`);

--
-- Indeks untuk tabel `bp_tindakan`
--
ALTER TABLE `bp_tindakan`
  ADD PRIMARY KEY (`no_bp_t`);

--
-- Indeks untuk tabel `detail_bp_penanganan`
--
ALTER TABLE `detail_bp_penanganan`
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
-- Indeks untuk tabel `detail_obat_keluar_internal`
--
ALTER TABLE `detail_obat_keluar_internal`
  ADD PRIMARY KEY (`id_detail_obat_keluar_internal`);

--
-- Indeks untuk tabel `detail_pelayanan_ambulan`
--
ALTER TABLE `detail_pelayanan_ambulan`
  ADD PRIMARY KEY (`no_detail_pelayanan_ambulan`);

--
-- Indeks untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  ADD PRIMARY KEY (`no_detail_penjualan_obat_a`);

--
-- Indeks untuk tabel `detail_return_obat`
--
ALTER TABLE `detail_return_obat`
  ADD PRIMARY KEY (`no_detail_return_obat`);

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
-- Indeks untuk tabel `rawat_inap_tindakan`
--
ALTER TABLE `rawat_inap_tindakan`
  ADD PRIMARY KEY (`no_rawat_inap_t`);

--
-- Indeks untuk tabel `return_obat`
--
ALTER TABLE `return_obat`
  ADD PRIMARY KEY (`no_return_obat`);

--
-- Indeks untuk tabel `setoran_rawat_inap`
--
ALTER TABLE `setoran_rawat_inap`
  ADD PRIMARY KEY (`id_setoran`);

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
-- AUTO_INCREMENT untuk tabel `ambulance`
--
ALTER TABLE `ambulance`
  MODIFY `no_ambulance` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_bp_penanganan`
--
ALTER TABLE `detail_bp_penanganan`
  MODIFY `no_detail_bp_p` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_kia_penanganan`
--
ALTER TABLE `detail_kia_penanganan`
  MODIFY `no_detail_kia_p` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_lab_transaksi`
--
ALTER TABLE `detail_lab_transaksi`
  MODIFY `no_detail_lab_t` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_obat_keluar_internal`
--
ALTER TABLE `detail_obat_keluar_internal`
  MODIFY `id_detail_obat_keluar_internal` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_pelayanan_ambulan`
--
ALTER TABLE `detail_pelayanan_ambulan`
  MODIFY `no_detail_pelayanan_ambulan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  MODIFY `no_detail_penjualan_obat_a` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_return_obat`
--
ALTER TABLE `detail_return_obat`
  MODIFY `no_detail_return_obat` int(9) NOT NULL AUTO_INCREMENT;

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
  MODIFY `no_detail_ugd_p` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setoran_rawat_inap`
--
ALTER TABLE `setoran_rawat_inap`
  MODIFY `id_setoran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_apotik`
--
ALTER TABLE `stok_obat_apotik`
  MODIFY `no_stok_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_rawat_inap`
--
ALTER TABLE `stok_obat_rawat_inap`
  MODIFY `no_stok_obat_rawat_i` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
