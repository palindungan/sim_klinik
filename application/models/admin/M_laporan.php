<?php
class M_laporan extends CI_Model
{
    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function laporan_rj_hari_ini()
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE tipe_pelayanan = 'Rawat Jalan' AND DATE(tgl_pelayanan) = CURDATE() ORDER BY tgl_pelayanan DESC")->result();
        return $query;
    }

    function laporan_rj_bulan_ini()
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE tipe_pelayanan = 'Rawat Jalan' AND MONTH(tgl_pelayanan) = MONTH(CURDATE()) AND YEAR(tgl_pelayanan) = YEAR(CURDATE()) ORDER BY tgl_pelayanan DESC")->result();
        return $query;
    }

    function laporan_rj_custom($tgl_mulai,$tgl_akhir)
    {
        $query = $this->db->query("SELECT * FROM laporan_rj WHERE tipe_pelayanan = 'Rawat Jalan' AND tgl_pelayanan BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tgl_pelayanan DESC")->result();
        return $query;
    }
    
}
