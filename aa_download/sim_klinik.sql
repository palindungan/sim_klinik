-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Jan 2020 pada 17.52
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
  `tujuan` varchar(20) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ambulance`
--

INSERT INTO `ambulance` (`no_ambulance`, `tujuan`, `harga`) VALUES
(1, 'RS Balung', 120000),
(2, 'RS Soebandi', 250000);

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
('A001', '200114-001', 'Antri');

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
('B001', '200119-001', 'Antri');

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
('C001', '200120-002', 'Antri');

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

--
-- Dumping data untuk tabel `bp_penanganan`
--

INSERT INTO `bp_penanganan` (`no_bp_p`, `no_ref_pelayanan`, `tgl_penanganan`, `total_harga`) VALUES
('BP200122-0001', '200120-002', '2020-01-22 23:49:27', 50000),
('BP200122-0002', '200120-001', '2020-01-22 23:49:13', 50000),
('BP200122-0003', '200119-001', '2020-01-22 23:48:23', 50000);

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
('T001', 'vaksin titanus', 50000, 'Terima');

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
,`jumlah_hari` int(3)
,`harga_harian` int(9)
,`sub_total_harga` int(10)
,`tipe` varchar(20)
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
,`tujuan` varchar(20)
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

--
-- Dumping data untuk tabel `detail_bp_penanganan`
--

INSERT INTO `detail_bp_penanganan` (`no_detail_bp_p`, `no_bp_p`, `no_bp_t`, `qty`, `harga`) VALUES
(113, 'BP200122-0003', 'T001', 1, 50000),
(114, 'BP200122-0002', 'T001', 1, 50000),
(115, 'BP200122-0001', 'T001', 1, 50000);

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

--
-- Dumping data untuk tabel `detail_kia_penanganan`
--

INSERT INTO `detail_kia_penanganan` (`no_detail_kia_p`, `no_kia_p`, `no_kia_t`, `qty`, `harga`) VALUES
(104, 'KP200122-0003', 'K001', 1, 200000),
(105, 'KP200122-0002', 'K001', 1, 200000),
(106, 'KP200122-0001', 'K002', 1, 100000);

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

--
-- Dumping data untuk tabel `detail_lab_transaksi`
--

INSERT INTO `detail_lab_transaksi` (`no_detail_lab_t`, `no_lab_t`, `no_lab_c`, `qty`, `harga`) VALUES
(45, 'LB200122-0002', 'L002', 2, 30000),
(46, 'LB200122-0001', 'L001', 3, 20000);

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
(1, '', 'O001', 20),
(2, '', 'O002', 10),
(3, 'OK200114-0003', 'O005', 20),
(4, 'OK200114-0003', 'O003', 15);

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

--
-- Dumping data untuk tabel `detail_pelayanan_ambulan`
--

INSERT INTO `detail_pelayanan_ambulan` (`no_detail_pelayanan_ambulan`, `no_pelayanan_a`, `no_ambulance`, `harga`) VALUES
(47, 'AB200122-0001', 2, 250000);

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

--
-- Dumping data untuk tabel `detail_penjualan_obat_apotik`
--

INSERT INTO `detail_penjualan_obat_apotik` (`no_detail_penjualan_obat_a`, `no_penjualan_obat_a`, `kode_obat`, `qty`, `harga_jual`, `status_paket`) VALUES
(122, 'PA200122-0001', 'O001', 3, 1000, 'Tidak');

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
  `jumlah_hari` int(3) NOT NULL,
  `harga_harian` int(9) NOT NULL,
  `sub_total_harga` int(10) NOT NULL,
  `status_kamar` enum('Belum Cek Out','Sudah Cek Out') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_kamar`
--

INSERT INTO `detail_transaksi_rawat_inap_kamar` (`no_detail_transaksi_rawat_inap_k`, `no_transaksi_rawat_i`, `no_kamar_rawat_i`, `tanggal_cek_in`, `tanggal_cek_out`, `jumlah_hari`, `harga_harian`, `sub_total_harga`, `status_kamar`) VALUES
(60, 'RI200122-0001', 'R001', '2020-01-22 23:11:07', '2020-01-22 23:11:10', 2, 200000, 400000, 'Sudah Cek Out');

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

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_obat`
--

INSERT INTO `detail_transaksi_rawat_inap_obat` (`no_detail_transaksi_rawat_inap_o`, `no_transaksi_rawat_i`, `no_stok_obat_rawat_i`, `qty`, `harga_jual`) VALUES
(27, 'RI200122-0001', 1, 5, 1000);

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

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_tindakan`
--

INSERT INTO `detail_transaksi_rawat_inap_tindakan` (`no_detail_transaksi_rawat_inap_t`, `no_transaksi_rawat_i`, `no_rawat_inap_t`, `qty`, `harga`) VALUES
(34, 'RI200122-0001', 'I001', 2, 20000);

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

--
-- Dumping data untuk tabel `detail_ugd_penanganan`
--

INSERT INTO `detail_ugd_penanganan` (`no_detail_ugd_p`, `no_ugd_p`, `no_ugd_t`, `qty`, `harga`) VALUES
(36, 'UP200122-0001', 'U001', 1, 150000);

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
('R001', 'Saffa', 200000, 'Kelas 1'),
('R002', 'Marwah', 200000, 'Kelas 1'),
('R003', 'Mawaddah', 300000, 'VIP');

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
('KP200122-0001', '200120-002', '2020-01-22 23:49:27', 100000),
('KP200122-0002', '200120-001', '2020-01-22 23:49:13', 200000),
('KP200122-0003', '200114-001', '2020-01-22 23:48:08', 200000);

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
('K001', 'imunisasi semua', 200000),
('K002', 'suntik mutaber', 100000);

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
('L001', 'Gula Darah', 20000),
('L002', 'Asam Urat ', 30000),
('L003', 'Cholesterol', 20000),
('L004', 'Lab Luar', 30000),
('L005', 'HB', 30000),
('L006', 'Golongan Darah', 30000),
('L007', 'Darah Lengkap', 30000),
('L008', 'Widal', 30000),
('L009', 'OTPT', 30000),
('L010', 'UL', 30000),
('L011', 'Buncreat', 30000);

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
('LB200122-0001', '200120-002', '2020-01-22 23:49:27', 60000),
('LB200122-0002', '200119-001', '2020-01-22 23:48:23', 60000);

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
  `no_kat_obat` char(4) NOT NULL,
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
('O001', 'K001', 'Aspirin', 10, 1000, 'Obat', 1),
('O002', 'K002', 'Prednison', 5, 2000, 'Obat', 1),
('O003', 'K003', 'Psyllium ', 10, 3000, 'Obat', 16),
('O004', 'K004', 'simvastatin', 10, 3000, 'Obat', 0),
('O005', 'K005', 'Pentabio', 10, 5000, 'Obat', 15);

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
('OK200114-0001', 'Rawat Inap', '2020-01-14 12:05:47'),
('OK200114-0002', 'Rawat Inap', '2020-01-14 12:08:52'),
('OK200114-0003', 'Rawat Inap', '2020-01-14 12:13:12');

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
('123123', 'fff', 22, '232'),
('qwe123', 'Rizkika', 20, 'Jember'),
('rtt6t67t', 'jjj', 9, 'klkl');

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
  `tipe_pelayanan` enum('Rawat Jalan','Rawat Inap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`no_ref_pelayanan`, `no_rm`, `no_user_pegawai`, `layanan_tujuan`, `tipe_antrian`, `tgl_pelayanan`, `status`, `tipe_pelayanan`) VALUES
('200114-001', 'qwe123', 'P001', 'Balai Pengobatan', 'Dewasa', '2020-01-14 03:11:05', 'belum_finish', 'Rawat Jalan'),
('200119-001', 'qwe123', 'P001', 'Poli KIA', 'Dewasa', '2020-01-19 22:52:03', 'belum_finish', 'Rawat Jalan'),
('200120-001', '123123', 'P001', 'UGD', 'Dewasa', '2020-01-20 00:24:50', 'belum_finish', 'Rawat Inap'),
('200120-002', 'rtt6t67t', 'P001', 'Laboratorium', 'Dewasa', '2020-01-20 01:10:26', 'belum_finish', 'Rawat Inap');

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

--
-- Dumping data untuk tabel `pelayanan_ambulan`
--

INSERT INTO `pelayanan_ambulan` (`no_pelayanan_a`, `no_ref_pelayanan`, `tanggal`, `total_harga`) VALUES
('AB200122-0001', '200120-002', '2020-01-22 23:49:28', 250000);

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
('PO200114-0001', 'S001', '2020-01-14 10:10:26', 450000),
('PO200114-0002', 'S001', '2020-01-14 10:14:48', 150000),
('PO200114-0003', 'S003', '2020-01-14 15:45:41', 600000);

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
('PA200122-0001', '200120-002', '2020-01-22 23:49:28', 3000);

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
('I001', 'Kunjungan Dokter', 20000);

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
(5, 'PO200114-0001', 'O001', 500, 100),
(6, 'PO200114-0001', 'O005', 4000, 100),
(7, 'PO200114-0002', 'O002', 1000, 50),
(8, 'PO200114-0002', 'O003', 2000, 50),
(9, 'PO200114-0003', 'O005', 10000, 20),
(10, 'PO200114-0003', 'O003', 20000, 20);

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
(1, 'O001', -10),
(2, 'O005', -21),
(3, 'O002', 10),
(4, 'O003', 10);

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

--
-- Dumping data untuk tabel `transaksi_rawat_inap`
--

INSERT INTO `transaksi_rawat_inap` (`no_transaksi_rawat_i`, `no_ref_pelayanan`, `tgl_transaksi`, `total_harga`) VALUES
('RI200122-0001', '200120-002', '2020-01-22 23:49:29', 445000);

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
('UP200122-0001', '200120-002', '2020-01-22 23:49:27', 150000);

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
('U001', 'jahit luka', 150000),
('U002', 'periksa luka', 50000);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_kamar_rawat_inap`  AS  select `dtrik`.`no_detail_transaksi_rawat_inap_k` AS `no_detail_transaksi_rawat_inap_k`,`dtrik`.`status_kamar` AS `status_kamar`,`kri`.`no_kamar_rawat_i` AS `no_kamar_rawat_i`,`kri`.`nama` AS `nama`,`dtrik`.`tanggal_cek_in` AS `tanggal_cek_in`,`dtrik`.`tanggal_cek_out` AS `tanggal_cek_out`,`dtrik`.`jumlah_hari` AS `jumlah_hari`,`dtrik`.`harga_harian` AS `harga_harian`,`dtrik`.`sub_total_harga` AS `sub_total_harga`,`kri`.`tipe` AS `tipe`,`tri`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`tri`.`no_transaksi_rawat_i` AS `no_transaksi_rawat_i` from ((`detail_transaksi_rawat_inap_kamar` `dtrik` join `transaksi_rawat_inap` `tri` on(`dtrik`.`no_transaksi_rawat_i` = `tri`.`no_transaksi_rawat_i`)) join `kamar_rawat_inap` `kri` on(`dtrik`.`no_kamar_rawat_i` = `kri`.`no_kamar_rawat_i`)) order by `dtrik`.`no_detail_transaksi_rawat_inap_k` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_obat_rawat_inap`  AS  select `stok_obat_rawat_inap`.`no_stok_obat_rawat_i` AS `no_stok_obat_rawat_i`,`stok_obat_rawat_inap`.`kode_obat` AS `kode_obat`,`stok_obat_rawat_inap`.`qty` AS `qty`,`obat`.`nama` AS `nama_obat`,`kategori_obat`.`nama` AS `nama_kategori`,`obat`.`harga_jual` AS `harga_jual` from ((`stok_obat_rawat_inap` join `obat` on(`stok_obat_rawat_inap`.`kode_obat` = `obat`.`kode_obat`)) join `kategori_obat` on(`obat`.`no_kat_obat` = `kategori_obat`.`no_kat_obat`)) order by `obat`.`nama` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_pengiriman_obat_apotek_detail`  AS  select `doki`.`id_detail_obat_keluar_internal` AS `id_detail_obat_keluar_internal`,`doki`.`qty` AS `qty`,`oki`.`no_obat_keluar_i` AS `no_obat_keluar_i`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`o`.`tipe` AS `tipe`,`ko`.`nama` AS `nama_kategori` from (((`detail_obat_keluar_internal` `doki` join `obat` `o` on(`doki`.`kode_obat` = `o`.`kode_obat`)) join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) join `obat_keluar_internal` `oki` on(`doki`.`no_obat_keluar_i` = `oki`.`no_obat_keluar_i`)) order by `doki`.`id_detail_obat_keluar_internal` ;

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
-- Struktur untuk view `data_obat`
--
DROP TABLE IF EXISTS `data_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_obat`  AS  select `o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`min_stok` AS `min_stok`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori`,`o`.`tipe` AS `tipe`,`o`.`qty` AS `qty` from (`obat` `o` join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `o`.`nama` ;

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
-- Struktur untuk view `laporan_rj`
--
DROP TABLE IF EXISTS `laporan_rj`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_rj`  AS  select `p`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`p`.`no_rm` AS `no_rm`,`p`.`tgl_pelayanan` AS `tgl_pelayanan`,`p`.`tipe_pelayanan` AS `tipe_pelayanan`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L001') AS `gula_darah`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L002') AS `asam_urat`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` = 'L003') AS `cholesterol`,(select sum(`c`.`harga` * `c`.`qty`) from (`lab_transaksi` `m` join `detail_lab_transaksi` `c` on(`m`.`no_lab_t` = `c`.`no_lab_t`)) where `m`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan` and `c`.`no_lab_c` <> 'L001' and `c`.`no_lab_c` <> 'L002' and `c`.`no_lab_c` <> 'L003') AS `lab_non_primer`,(select `kia`.`total_harga` from `kia_penanganan` `kia` where `kia`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_kia`,(select `ugd`.`total_harga` from `ugd_penanganan` `ugd` where `ugd`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_ugd`,(select `bp`.`total_harga` from `bp_penanganan` `bp` where `bp`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_bp`,(select `apotik`.`total_harga` from `penjualan_obat_apotik` `apotik` where `apotik`.`no_ref_pelayanan` = `p`.`no_ref_pelayanan`) AS `total_obat_apotik`,(select `ps`.`nama` from `pasien` `ps` where `ps`.`no_rm` = `p`.`no_rm`) AS `nama_pasien` from `pelayanan` `p` ;

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
  MODIFY `no_ambulance` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_bp_penanganan`
--
ALTER TABLE `detail_bp_penanganan`
  MODIFY `no_detail_bp_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `detail_kia_penanganan`
--
ALTER TABLE `detail_kia_penanganan`
  MODIFY `no_detail_kia_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `detail_lab_transaksi`
--
ALTER TABLE `detail_lab_transaksi`
  MODIFY `no_detail_lab_t` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `detail_obat_keluar_internal`
--
ALTER TABLE `detail_obat_keluar_internal`
  MODIFY `id_detail_obat_keluar_internal` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detail_pelayanan_ambulan`
--
ALTER TABLE `detail_pelayanan_ambulan`
  MODIFY `no_detail_pelayanan_ambulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  MODIFY `no_detail_penjualan_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_kamar`
--
ALTER TABLE `detail_transaksi_rawat_inap_kamar`
  MODIFY `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_obat`
--
ALTER TABLE `detail_transaksi_rawat_inap_obat`
  MODIFY `no_detail_transaksi_rawat_inap_o` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_tindakan`
--
ALTER TABLE `detail_transaksi_rawat_inap_tindakan`
  MODIFY `no_detail_transaksi_rawat_inap_t` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `detail_ugd_penanganan`
--
ALTER TABLE `detail_ugd_penanganan`
  MODIFY `no_detail_ugd_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_apotik`
--
ALTER TABLE `stok_obat_apotik`
  MODIFY `no_stok_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_rawat_inap`
--
ALTER TABLE `stok_obat_rawat_inap`
  MODIFY `no_stok_obat_rawat_i` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
