-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Jan 2020 pada 03.47
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
-- Struktur dari tabel `antrian_bp`
--

CREATE TABLE `antrian_bp` (
  `kode_antrian_bp` char(5) NOT NULL,
  `no_ref_pelayanan` char(10) NOT NULL,
  `status` enum('Antri','Prioritas','Diperiksa','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_detail_kamar_transaksi_ri`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_detail_kamar_transaksi_ri` (
`no_kamar_rawat_i` char(4)
,`nama` varchar(50)
,`harga_harian` int(9)
,`tanggal_cek_in` datetime
,`tanggal_cek_out` datetime
,`sub_total_harga` int(10)
,`tipe` varchar(20)
,`no_ref_pelayanan` char(10)
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
,`harga` int(11)
,`no_ref_pelayanan` char(10)
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
,`harga` int(10)
,`no_ref_pelayanan` char(10)
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
,`no_ref_pelayanan` char(10)
,`no_stok_obat_a` int(7)
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
,`umur` smallint(3)
,`alamat` text
,`status` enum('belum_finish','finish')
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat_keluar_internal`
--

CREATE TABLE `detail_obat_keluar_internal` (
  `id_detail_obat_keluar_internal` int(7) NOT NULL,
  `kode_obat` char(4) NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan_obat_apotik`
--

CREATE TABLE `detail_penjualan_obat_apotik` (
  `no_detail_penjualan_obat_a` int(7) NOT NULL,
  `no_penjualan_obat_a` char(13) NOT NULL,
  `no_stok_obat_a` int(7) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_jual` int(9) NOT NULL,
  `status_paket` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_rawat_inap_kamar`
--

CREATE TABLE `detail_transaksi_rawat_inap_kamar` (
  `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL,
  `no_transaksi_rawat_i` char(13) NOT NULL,
  `no_kamar_rawat_i` char(4) NOT NULL,
  `harga_harian` int(9) NOT NULL,
  `tanggal_cek_in` datetime NOT NULL,
  `tanggal_cek_out` datetime NOT NULL,
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
  `qty` int(3) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `sub_total_harga` int(10) NOT NULL
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
-- Stand-in struktur untuk tampilan `laporan_rawat_jalan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_rawat_jalan` (
`no_bp_p` char(13)
,`no_bp_t` char(4)
,`nama_tindakan` varchar(50)
,`harga_detail` int(10)
,`harga_tindakan` int(9)
,`no_ref_pelayanan` char(10)
,`nama_pasien` varchar(50)
,`tgl_pelayanan` datetime
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
('O001', 'K001', 'Aspirin', 10, 1000, 'Obat', 0),
('O002', 'K002', 'Prednison', 5, 2000, 'Obat', 0),
('O003', 'K003', 'Psyllium ', 10, 3000, 'Obat', 0),
('O004', 'K004', 'simvastatin', 10, 3000, 'Obat', 0),
('O005', 'K005', 'Pentabio', 10, 5000, 'Obat', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat_keluar_internal`
--

CREATE TABLE `obat_keluar_internal` (
  `no_obat_keluar_i` char(13) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `tgl_obat_keluar_i` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur dari tabel `penerimaan_obat`
--

CREATE TABLE `penerimaan_obat` (
  `no_penerimaan_o` char(13) NOT NULL,
  `no_supplier` char(4) NOT NULL,
  `tgl_penerimaan_o` datetime NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_obat_rawat_inap`
--

CREATE TABLE `stok_obat_rawat_inap` (
  `no_stok_obat_rawat_i` int(7) NOT NULL,
  `kode_obat` varchar(4) NOT NULL,
  `qty` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur untuk view `daftar_detail_kamar_transaksi_ri`
--
DROP TABLE IF EXISTS `daftar_detail_kamar_transaksi_ri`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_kamar_transaksi_ri`  AS  select `kri`.`no_kamar_rawat_i` AS `no_kamar_rawat_i`,`kri`.`nama` AS `nama`,`dtrik`.`harga_harian` AS `harga_harian`,`dtrik`.`tanggal_cek_in` AS `tanggal_cek_in`,`dtrik`.`tanggal_cek_out` AS `tanggal_cek_out`,`dtrik`.`sub_total_harga` AS `sub_total_harga`,`kri`.`tipe` AS `tipe`,`tri`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_transaksi_rawat_inap_kamar` `dtrik` join `transaksi_rawat_inap` `tri` on(`dtrik`.`no_transaksi_rawat_i` = `tri`.`no_transaksi_rawat_i`)) join `kamar_rawat_inap` `kri` on(`dtrik`.`no_kamar_rawat_i` = `kri`.`no_kamar_rawat_i`)) order by `dtrik`.`no_detail_transaksi_rawat_inap_k` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_bp_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_bp_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_bp_transaksi`  AS  select `dbp`.`no_bp_p` AS `no_bp_p`,`bt`.`no_bp_t` AS `no_bp_t`,`bt`.`nama` AS `nama`,`dbp`.`harga` AS `harga_detail`,`bt`.`harga` AS `harga_tindakan`,`bp`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_bp_penanganan` `dbp` join `bp_tindakan` `bt` on(`dbp`.`no_bp_t` = `bt`.`no_bp_t`)) join `bp_penanganan` `bp` on(`dbp`.`no_bp_p` = `bp`.`no_bp_p`)) order by `dbp`.`no_detail_bp_p` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_kia_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_kia_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_kia_transaksi`  AS  select `dkp`.`no_kia_p` AS `no_kia_p`,`kt`.`no_kia_t` AS `no_kia_t`,`kt`.`nama` AS `nama`,`dkp`.`harga` AS `harga`,`kp`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_kia_penanganan` `dkp` join `kia_tindakan` `kt` on(`dkp`.`no_kia_t` = `kt`.`no_kia_t`)) join `kia_penanganan` `kp` on(`dkp`.`no_kia_p` = `kp`.`no_kia_p`)) order by `dkp`.`no_detail_kia_p` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_lab_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_lab_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_lab_transaksi`  AS  select `dlt`.`no_lab_t` AS `no_lab_t`,`lc`.`no_lab_c` AS `no_lab_c`,`lc`.`nama` AS `nama`,`dlt`.`harga` AS `harga`,`lt`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_lab_transaksi` `dlt` join `lab_transaksi` `lt` on(`dlt`.`no_lab_t` = `lt`.`no_lab_t`)) join `lab_checkup` `lc` on(`dlt`.`no_lab_c` = `lc`.`no_lab_c`)) order by `dlt`.`no_detail_lab_t` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_detail_tindakan_ugd_transaksi`
--
DROP TABLE IF EXISTS `daftar_detail_tindakan_ugd_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_detail_tindakan_ugd_transaksi`  AS  select `dup`.`no_ugd_p` AS `no_ugd_p`,`ut`.`no_ugd_t` AS `no_ugd_t`,`ut`.`nama` AS `nama`,`dup`.`harga` AS `harga`,`up`.`no_ref_pelayanan` AS `no_ref_pelayanan` from ((`detail_ugd_penanganan` `dup` join `ugd_tindakan` `ut` on(`dup`.`no_ugd_t` = `ut`.`no_ugd_t`)) join `ugd_penanganan` `up` on(`dup`.`no_ugd_p` = `up`.`no_ugd_p`)) order by `dup`.`no_detail_ugd_p` ;

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
-- Struktur untuk view `daftar_penjualan_obat_apotek`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek`  AS  select `poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a`,`poa`.`tanggal_penjualan` AS `tanggal_penjualan`,`poa`.`total_harga` AS `total_harga`,`pe`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pa`.`no_rm` AS `no_rm`,`pa`.`nama` AS `nama_pasien`,`up`.`no_user_pegawai` AS `no_user_pegawai`,`up`.`nama` AS `nama_pegawai` from (((`penjualan_obat_apotik` `poa` join `pelayanan` `pe` on(`poa`.`no_ref_pelayanan` = `pe`.`no_ref_pelayanan`)) join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) join `user_pegawai` `up` on(`pe`.`no_user_pegawai` = `up`.`no_user_pegawai`)) order by `poa`.`no_penjualan_obat_a` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_penjualan_obat_apotek_detail`
--
DROP TABLE IF EXISTS `daftar_penjualan_obat_apotek_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_penjualan_obat_apotek_detail`  AS  select `dpoa`.`no_detail_penjualan_obat_a` AS `no_detail_penjualan_obat_a`,`o`.`nama` AS `nama`,`dpoa`.`qty` AS `qty`,`dpoa`.`harga_jual` AS `harga_jual`,`poa`.`no_penjualan_obat_a` AS `no_penjualan_obat_a`,`poa`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`soa`.`no_stok_obat_a` AS `no_stok_obat_a` from (((`detail_penjualan_obat_apotik` `dpoa` join `stok_obat_apotik` `soa` on(`dpoa`.`no_stok_obat_a` = `soa`.`no_stok_obat_a`)) join `obat` `o` on(`soa`.`kode_obat` = `o`.`kode_obat`)) join `penjualan_obat_apotik` `poa` on(`dpoa`.`no_penjualan_obat_a` = `poa`.`no_penjualan_obat_a`)) order by `dpoa`.`no_detail_penjualan_obat_a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_obat`
--
DROP TABLE IF EXISTS `data_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_obat`  AS  select `o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`min_stok` AS `min_stok`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori`,`o`.`tipe` AS `tipe` from (`obat` `o` join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `o`.`nama` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pelayanan_pasien`
--
DROP TABLE IF EXISTS `data_pelayanan_pasien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pelayanan_pasien`  AS  select `pe`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`pe`.`layanan_tujuan` AS `layanan_tujuan`,`pe`.`tipe_antrian` AS `tipe_antrian`,`pe`.`tgl_pelayanan` AS `tgl_pelayanan`,`pa`.`no_rm` AS `no_rm`,`pa`.`nama` AS `nama`,`pa`.`umur` AS `umur`,`pa`.`alamat` AS `alamat`,`pe`.`status` AS `status` from (`pelayanan` `pe` join `pasien` `pa` on(`pe`.`no_rm` = `pa`.`no_rm`)) where `pe`.`status` = 'belum_finish' order by `pe`.`no_ref_pelayanan` ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_stok_obat_apotek`  AS  select `soa`.`no_stok_obat_a` AS `no_stok_obat_a`,`soa`.`no_penerimaan_o` AS `no_penerimaan_o`,`soa`.`harga_supplier` AS `harga_supplier`,`soa`.`qty` AS `qty`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`o`.`tipe` AS `tipe`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori` from (((`stok_obat_apotik` `soa` join `penerimaan_obat` `po` on(`soa`.`no_penerimaan_o` = `po`.`no_penerimaan_o`)) join `obat` `o` on(`soa`.`kode_obat` = `o`.`kode_obat`)) join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `po`.`tgl_penerimaan_o` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_rawat_jalan`
--
DROP TABLE IF EXISTS `laporan_rawat_jalan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_rawat_jalan`  AS  select `dbp`.`no_bp_p` AS `no_bp_p`,`bt`.`no_bp_t` AS `no_bp_t`,`bt`.`nama` AS `nama_tindakan`,`dbp`.`harga` AS `harga_detail`,`bt`.`harga` AS `harga_tindakan`,`bp`.`no_ref_pelayanan` AS `no_ref_pelayanan`,`ps`.`nama` AS `nama_pasien`,`pl`.`tgl_pelayanan` AS `tgl_pelayanan` from ((((`detail_bp_penanganan` `dbp` join `bp_tindakan` `bt` on(`dbp`.`no_bp_t` = `bt`.`no_bp_t`)) join `bp_penanganan` `bp` on(`dbp`.`no_bp_p` = `bp`.`no_bp_p`)) join `pelayanan` `pl` on(`bp`.`no_ref_pelayanan` = `pl`.`no_ref_pelayanan`)) join `pasien` `ps` on(`pl`.`no_rm` = `ps`.`no_rm`)) order by `dbp`.`no_detail_bp_p` ;

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
  MODIFY `id_detail_obat_keluar_internal` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  MODIFY `no_detail_penjualan_obat_a` int(7) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT untuk tabel `stok_obat_apotik`
--
ALTER TABLE `stok_obat_apotik`
  MODIFY `no_stok_obat_a` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok_obat_rawat_inap`
--
ALTER TABLE `stok_obat_rawat_inap`
  MODIFY `no_stok_obat_rawat_i` int(7) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
