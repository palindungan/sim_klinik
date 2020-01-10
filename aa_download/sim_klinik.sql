-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 10 Jan 2020 pada 14.53
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

--
-- Dumping data untuk tabel `antrian_bp`
--

INSERT INTO `antrian_bp` (`kode_antrian_bp`, `no_ref_pelayanan`, `status`) VALUES
('A001', '191112-005', 'Selesai'),
('A003', '191112-007', 'Diperiksa'),
('A004', '191112-008', 'Antri'),
('A007', '191119-014', 'Antri'),
('A008', '191125-015', 'Antri'),
('A010', '191226-022', 'Antri'),
('AG002', '191112-006', 'Selesai'),
('AG005', '191112-009', 'Selesai'),
('AG006', '191119-013', 'Antri'),
('AG009', '191129-020', 'Selesai'),
('AG011', '200108-001', 'Antri');

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
('BP191226-0002', '191226-022', '2019-12-26 18:41:05', 190000),
('BP200109-0001', '200108-001', '2020-01-09 22:28:12', 0),
('BP200109-0002', '200108-001', '2020-01-09 22:32:24', 100000);

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
('B001', 'pemberian betadine', 90000, 'Terima'),
('B002', 'Transfusi Darah', 100000, 'Terima'),
('L003', 'Khitan', 100000, 'Tidak Terima');

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
,`harga_supplier` int(9)
,`qty` mediumint(5)
,`tgl_penerimaan_o` datetime
,`kode_obat` char(4)
,`nama_obat` varchar(50)
,`harga_jual` int(9)
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

--
-- Dumping data untuk tabel `detail_bp_penanganan`
--

INSERT INTO `detail_bp_penanganan` (`no_detail_bp_p`, `no_bp_p`, `no_bp_t`, `harga`) VALUES
(3, 'BP191226-0002', 'B001', 90000),
(4, 'BP191226-0002', 'B002', 100000),
(5, 'BP200109-0001', 'B001', 90000),
(6, 'BP200109-0001', 'B002', 100000),
(7, 'BP200109-0002', 'B002', 100000),
(8, 'BP200109-0002', 'L003', 0);

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
(5, 'KP191226-0002', 'K001', 1000000),
(6, 'KP191226-0002', 'K002', 70000);

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
(5, 'LB191226-0001', 'L001', 300000),
(6, 'LB191226-0001', 'L002', 1000000);

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

--
-- Dumping data untuk tabel `detail_penjualan_obat_apotik`
--

INSERT INTO `detail_penjualan_obat_apotik` (`no_detail_penjualan_obat_a`, `no_penjualan_obat_a`, `no_stok_obat_a`, `qty`, `harga_jual`, `status_paket`) VALUES
(2, 'PA191226-0002', 4, 1, 20000, 'Ya'),
(3, 'PA191226-0002', 2, 1, 20000, 'Tidak'),
(4, 'PA200109-0001', 3, 2, 0, 'Ya'),
(5, 'PA200109-0002', 3, 2, 0, 'Ya'),
(6, 'PA200109-0003', 3, 2, 0, 'Ya'),
(7, 'PA200109-0004', 3, 2, 0, 'Ya'),
(8, 'PA200109-0004', 2, 2, 0, 'Ya'),
(9, 'PA200109-0005', 4, 1, 0, 'Ya'),
(10, 'PA200109-0005', 1, 1, 0, 'Ya'),
(11, 'PA200110-0001', 4, 1, 0, 'Tidak'),
(12, 'PA200110-0002', 4, 1, 0, 'Ya'),
(13, 'PA200110-0003', 1, 1, 25000, 'Tidak');

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

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_kamar`
--

INSERT INTO `detail_transaksi_rawat_inap_kamar` (`no_detail_transaksi_rawat_inap_k`, `no_transaksi_rawat_i`, `no_kamar_rawat_i`, `harga_harian`, `tanggal_cek_in`, `tanggal_cek_out`, `sub_total_harga`) VALUES
(1, 'RI191121-0001', 'R001', 300000, '2020-01-01 00:00:00', '2020-01-01 00:00:00', 300000);

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

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_obat`
--

INSERT INTO `detail_transaksi_rawat_inap_obat` (`no_detail_transaksi_rawat_inap_o`, `no_transaksi_rawat_i`, `no_stok_obat_rawat_i`, `qty`, `harga_jual`, `sub_total_harga`) VALUES
(1, 'RI191121-0001', 1, 3, 20000, 60000);

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

--
-- Dumping data untuk tabel `detail_transaksi_rawat_inap_tindakan`
--

INSERT INTO `detail_transaksi_rawat_inap_tindakan` (`no_detail_transaksi_rawat_inap_t`, `no_transaksi_rawat_i`, `no_rawat_inap_t`, `harga`) VALUES
(1, 'RI191121-0001', 'I001', 100000);

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
(6, 'UP191226-0002', 'U001', 1000000);

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
('KP191226-0002', '191226-022', '2020-01-05 00:00:00', 1070000);

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
('LB191226-0001', '191226-022', '2020-01-01 00:00:00', 1300000);

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
('O001', 'K002', 'parasetamol', 50, 20000, 'Alkes', 10),
('O002', 'K004', 'panadol', 40, 25000, 'Alkes', 10);

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
  `umur` smallint(3) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nama`, `umur`, `alamat`) VALUES
('01232322', 'asdadssd', 0, '12312asd'),
('098128092', 'hhhh', 0, 'ghjgh'),
('10387212387', 'asdas', 0, 'assa'),
('123123', 'dimas tuda', 0, '123123'),
('12312312ew', 'dwqw', 0, '23wee1'),
('123123222', 'dimas tuda', 0, '12312'),
('123123ed', 'rizal', 0, '123123'),
('12312wd', 'rizkika', 0, '123123'),
('123192838123', 'kika', 0, 'jember'),
('12342gre', 'dimas tuda', 0, '12312'),
('12345', 'rizkika zakka palindungan', 0, 'lumajang'),
('123dq12', 'rizal', 0, '123123'),
('60088879', 'asdassad', 0, '2121'),
('adsmkaskm', 'loooo', 0, 'asdsda'),
('asdasdzxc', 'Afri', 5, 'Lumajang'),
('cadad1212', 'adsq12', 0, '12312'),
('cxcaa132', '123dd', 0, '1212'),
('qwdcqd1221', 'rizkika zakka palindungan', 0, '123123'),
('qweasd123zxc', 'Abda Rasyid', 0, 'Jln Cut Mutiah '),
('qweqwe', 'rizkika', 0, 'adasda'),
('svffd324', 'asdasd', 0, '12312'),
('tyu56756', 'asa', 0, 'qweqw');

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
('191112-001', '12345', 'P001', 'Poli KIA', 'Dewasa', '2019-12-02 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-002', '123123', 'P001', 'Laboratorium', 'Anak-Anak', '2019-12-02 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-003', '123123ed', 'P001', 'Laboratorium', 'Anak-Anak', '2019-12-02 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-004', '12312wd', 'P001', 'Laboratorium', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-005', '123123222', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-006', '123dq12', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-007', 'qwdcqd1221', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-008', 'svffd324', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-009', 'cxcaa132', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-010', 'cadad1212', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191112-011', '12342gre', 'P001', 'Poli KIA', 'Dewasa', '2019-11-12 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191119-012', '123192838123', 'P001', 'Poli KIA', 'Anak-Anak', '2019-11-19 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191119-013', '10387212387', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-19 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191119-014', '12312312ew', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-19 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191125-015', '01232322', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191125-016', 'tyu56756', 'P001', 'Laboratorium', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191125-017', '60088879', 'P001', 'Poli KIA', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191125-018', 'adsmkaskm', 'P001', 'Poli KIA', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191125-019', '098128092', 'P001', 'UGD', 'Dewasa', '2019-11-25 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191129-020', 'qweqwe', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2019-11-29 00:00:00', 'belum_finish', 'Rawat Jalan'),
('191226-021', '098128092', 'P001', 'UGD', 'Dewasa', '2019-12-26 12:10:00', 'belum_finish', 'Rawat Jalan'),
('191226-022', 'qweasd123zxc', 'P001', 'Balai Pengobatan', 'Dewasa', '2019-12-26 18:27:48', 'finish', 'Rawat Inap'),
('200108-001', 'asdasdzxc', 'P001', 'Balai Pengobatan', 'Anak-Anak', '2020-01-08 19:56:02', 'finish', 'Rawat Jalan');

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
('PA191226-0002', '191226-022', '2019-12-26 18:42:43', 40000),
('PA200109-0001', '200108-001', '2020-01-09 22:22:32', 90000),
('PA200109-0002', '200108-001', '2020-01-09 22:22:36', 90000),
('PA200109-0003', '200108-001', '2020-01-09 22:26:17', 90000),
('PA200109-0004', '200108-001', '2020-01-09 22:28:12', 90000),
('PA200109-0005', '200108-001', '2020-01-09 22:32:23', 45000),
('PA200110-0001', '200108-001', '2020-01-10 09:58:27', 20000),
('PA200110-0002', '200108-001', '2020-01-10 09:58:50', 20000),
('PA200110-0003', '200108-001', '2020-01-10 10:00:15', 25000);

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
('I001', 'Kunjungan dokter', 100000);

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
(1, 'PO191201-0001', 'O002', 60000, 0),
(2, 'PO191201-0001', 'O001', 40000, 0),
(3, 'PO191202-0001', 'O002', 8000, 0),
(4, 'PO191202-0001', 'O001', 9000, 0);

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
(1, 'O001', 10),
(2, 'O002', 10);

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
('RI191121-0001', '191226-022', '2020-01-02 00:00:00', 300000);

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
('UP191226-0002', '191226-022', '2020-01-01 00:00:00', 1000000);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_stok_obat_apotek`  AS  select `soa`.`no_stok_obat_a` AS `no_stok_obat_a`,`soa`.`harga_supplier` AS `harga_supplier`,`soa`.`qty` AS `qty`,`po`.`tgl_penerimaan_o` AS `tgl_penerimaan_o`,`o`.`kode_obat` AS `kode_obat`,`o`.`nama` AS `nama_obat`,`o`.`harga_jual` AS `harga_jual`,`ko`.`no_kat_obat` AS `no_kat_obat`,`ko`.`nama` AS `nama_kategori` from (((`stok_obat_apotik` `soa` join `penerimaan_obat` `po` on(`soa`.`no_penerimaan_o` = `po`.`no_penerimaan_o`)) join `obat` `o` on(`soa`.`kode_obat` = `o`.`kode_obat`)) join `kategori_obat` `ko` on(`o`.`no_kat_obat` = `ko`.`no_kat_obat`)) order by `po`.`tgl_penerimaan_o` ;

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
  MODIFY `no_detail_bp_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_kia_penanganan`
--
ALTER TABLE `detail_kia_penanganan`
  MODIFY `no_detail_kia_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_lab_transaksi`
--
ALTER TABLE `detail_lab_transaksi`
  MODIFY `no_detail_lab_t` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_obat_keluar_internal`
--
ALTER TABLE `detail_obat_keluar_internal`
  MODIFY `id_detail_obat_keluar_internal` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan_obat_apotik`
--
ALTER TABLE `detail_penjualan_obat_apotik`
  MODIFY `no_detail_penjualan_obat_a` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_kamar`
--
ALTER TABLE `detail_transaksi_rawat_inap_kamar`
  MODIFY `no_detail_transaksi_rawat_inap_k` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_obat`
--
ALTER TABLE `detail_transaksi_rawat_inap_obat`
  MODIFY `no_detail_transaksi_rawat_inap_o` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_rawat_inap_tindakan`
--
ALTER TABLE `detail_transaksi_rawat_inap_tindakan`
  MODIFY `no_detail_transaksi_rawat_inap_t` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_ugd_penanganan`
--
ALTER TABLE `detail_ugd_penanganan`
  MODIFY `no_detail_ugd_p` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
