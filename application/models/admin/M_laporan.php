<?php
class M_laporan extends CI_Model
{
    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function laporan_rj_hari_ini()
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE DATE(tgl_keluar) = CURDATE() ORDER BY tgl_keluar DESC")->result();
        return $query;
    }

    function laporan_rj_bulan_ini()
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE MONTH(tgl_keluar) = MONTH(CURDATE()) AND YEAR(tgl_keluar) = YEAR(CURDATE()) ORDER BY tgl_keluar DESC")->result();
        return $query;
    }

    function laporan_rj_custom($tgl_mulai,$tgl_akhir)
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE tgl_keluar BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tgl_keluar DESC")->result();
        return $query;
    }

    function laporan_ri_hari_ini()
    {
        // Belum Di Where
        // WHERE DATE(tgl_keluar) = CURDATE()
        $query = $this->db->query("SELECT * FROM laporan_ri ORDER BY tgl_keluar ASC")->result();
        return $query;
    }

    function laporan_ri_bulan_ini(){
        $query = $this->db->query("SELECT * FROM laporan_ri WHERE MONTH(tgl_keluar) = MONTH(CURDATE()) AND YEAR(tgl_keluar) = YEAR(CURDATE()) ORDER BY tgl_keluar ASC")->result();
        return $query;
    }
    function laporan_ri_custom($tgl_mulai,$tgl_akhir){
        $query = $this->db->query("SELECT * FROM laporan_ri WHERE tgl_keluar BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tgl_keluar ASC")->result();
        return $query;
    }

    function total_akomodasi_obat()
    {
        $query = $this->db->query("SELECT SUM(qty * harga) as akomodasi_obat FROM daftar_detail_akomodasi_rawat_inap_obat WHERE tipe ='Obat' AND DATE(tgl_transaksi) = CURDATE()")->result_array();
        return $query;
    }

    function total_akomodasi_alkes()
    {
        $query = $this->db->query("SELECT SUM(qty * harga) as akomodasi_alkes FROM daftar_detail_akomodasi_rawat_inap_obat WHERE tipe ='Alkes' AND DATE(tgl_transaksi) = CURDATE()")->result_array();
        return $query;
    }
    
    function total_akomodasi_lain()
    {
        $query = $this->db->query("SELECT SUM(qty * harga) as akomodasi_lain FROM daftar_detail_akomodasi_rawat_inap_lain WHERE no_lain <> '1' AND DATE(tgl_transaksi) = CURDATE()")->result_array();
        return $query;
    }
}