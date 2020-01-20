<?php
class M_laporan extends CI_Model
{
    function laporan_rj_hari_ini()
    {
        $query = $this->db->query("SELECT no_bp_p,nama_pasien,tgl_pelayanan,tipe_pelayanan,
        SUM(IF(nama_tindakan = 'Cek Gula Darah',harga_detail,'-')) AS periksa_gula_darah,
        SUM(IF(nama_tindakan = 'Cek Asam Urat',harga_detail,'-')) AS periksa_asam_urat,
        SUM(IF(nama_tindakan = 'Cek Kolesterol',harga_detail,'-')) AS periksa_kolesterol,
        SUM(IF(nama_tindakan = 'Paket 1', harga_detail, IF(nama_tindakan = 'Paket 2', harga_detail, '-'))) AS
        biaya_periksa,
        SUM(harga_detail) as total_harga
        FROM laporan_rawat_jalan WHERE tipe_pelayanan = 'Rawat Jalan' AND DATE(tgl_pelayanan) = CURDATE()
        GROUP BY no_bp_p ORDER BY tgl_pelayanan DESC")->result();
        return $query;
    }

    function laporan_rj_bulan_ini()
    {
        $query = $this->db->query("SELECT no_bp_p,nama_pasien,tgl_pelayanan,tipe_pelayanan,
        SUM(IF(nama_tindakan = 'Cek Gula Darah',harga_detail,'-')) AS periksa_gula_darah,
        SUM(IF(nama_tindakan = 'Cek Asam Urat',harga_detail,'-')) AS periksa_asam_urat,
        SUM(IF(nama_tindakan = 'Cek Kolesterol',harga_detail,'-')) AS periksa_kolesterol,
        SUM(IF(nama_tindakan = 'Paket 1', harga_detail, IF(nama_tindakan = 'Paket 2', harga_detail, '-'))) AS
        biaya_periksa,
        SUM(harga_detail) as total_harga
        FROM laporan_rawat_jalan WHERE tipe_pelayanan = 'Rawat Jalan' AND MONTH(tgl_pelayanan) = MONTH(CURDATE()) AND YEAR(tgl_pelayanan) = YEAR(CURDATE())
        GROUP BY no_bp_p ORDER BY tgl_pelayanan DESC")->result();
        return $query;
    }
    
}
