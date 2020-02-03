<?php
class M_antrian extends CI_Model
{
    function tampil_data($table)
    {
        return $this->db->get($table);
    }
    
    function tampil_antrian_bp(){
        $this->db->select('id_antri_bp,kode_antrian_bp,tanggal_antrian,nama');
        $this->db->from('antrian_bp');
        $this->db->join('pelayanan', 'pelayanan.no_ref_pelayanan = antrian_bp.no_ref_pelayanan');
        $this->db->join('pasien','pelayanan.no_rm = pasien.no_rm');
        $this->db->where('status_antrian','0');
        $this->db->where('tanggal_antrian',date('Y-m-d'));
        $this->db->order_by('waktu_antrian','ASC');
        $this->db->order_by('id_antri_bp','ASC');
        return $this->db->get();
    }

    function tampil_antrian_kia(){
        $this->db->select('id_antri_kia,kode_antrian_kia,tanggal_antrian,nama');
        $this->db->from('antrian_kia');
        $this->db->join('pelayanan', 'pelayanan.no_ref_pelayanan = antrian_kia.no_ref_pelayanan');
        $this->db->join('pasien','pelayanan.no_rm = pasien.no_rm');
        $this->db->where('status_antrian','0');
        $this->db->where('tanggal_antrian',date('Y-m-d'));
        return $this->db->get();
    }
    function tampil_antrian_lab(){
        $this->db->select('id_antri_lab,kode_antrian_lab,tanggal_antrian,nama');
        $this->db->from('antrian_lab');
        $this->db->join('pelayanan', 'pelayanan.no_ref_pelayanan = antrian_lab.no_ref_pelayanan');
        $this->db->join('pasien','pelayanan.no_rm = pasien.no_rm');
        $this->db->where('status_antrian','0');
        $this->db->where('tanggal_antrian',date('Y-m-d'));
        return $this->db->get();
    }

    function delete_antrian_kemarin(){
        $day = date("Y-m-d");
        $this->db->query("DELETE FROM antrian_bp WHERE tanggal_antrian<'$day'");
        $this->db->query("DELETE FROM antrian_kia WHERE tanggal_antrian<'$day'");
        $this->db->query("DELETE FROM antrian_lab WHERE tanggal_antrian<'$day'");
        
        
    }

    function input_data($table, $data)
    {
        $this->db->insert($table, $data);
    }

    function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function get_data_antrian_sekarang($table)
    {
        return $this->db->query("SELECT * FROM $table WHERE no_antrian = ( SELECT MIN(no_antrian) FROM $table )");
    }

    function update_data($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    // autogenerate kode / ID
    function get_no()
    {
        $field = "id_pengajar";
        $tabel = "pengajar";
        $digit = "3";
        $kode = "PE";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "PE001";
        }
        return $kd;
    }
}
