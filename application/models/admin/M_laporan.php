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
        $query = $this->db->query("SELECT * FROM laporan_ri WHERE DATE(tgl_keluar) = CURDATE() ORDER BY tgl_keluar ASC")->result();
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
