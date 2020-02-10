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

    //Rawat Inap

    function get_laporan_ri_by_date($date){
        $query = $this->db->query("SELECT * FROM laporan_ri WHERE DATE(tgl_keluar) ='$date' ORDER BY tgl_keluar ASC")->result();
        return $query;
        // echo array_sum(array_column($query, 'uang_masuk'));
    }

    function get_rekap_laporan_ri_by_date($date){
        $query = $this->db->query("SELECT tipe_pelayanan,uang_masuk,_pemasukan_bersih,akomodasi_obat FROM laporan_ri WHERE DATE(tgl_keluar) ='$date' ORDER BY tgl_keluar ASC")->result();
        // return $query;
        $data = array(
            'uang_masuk' => array_sum(array_column($query, 'uang_masuk')),

        );
        return $data;
    }

    function laporan_ri_hari_ini()
    {
        // Belum Di Where
        // WHERE DATE(tgl_keluar) = CURDATE()
        $query = $this->db->query("SELECT * FROM laporan_ri  ORDER BY tgl_keluar ASC")->result();
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
}