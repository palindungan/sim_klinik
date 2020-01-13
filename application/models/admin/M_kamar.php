<?php
class M_kamar extends CI_Model
{
    function tampil_data($table)
    {
        return $this->db->get($table);
    }

    function input_data($table, $data)
    {
        $status = $this->db->insert($table, $data);
        return $status;
    }

    function hapus_data($where, $table)
    {
        $this->db->where($where);
        $status = $this->db->delete($table);
        return $status;
    }

    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $table, $data)
    {
        $this->db->where($where);
        $status = $this->db->update($table, $data);
        return $status;
    }

    // autogenerate kode / ID
    function get_no()
    {
        $field = "no_kamar_rawat_i";
        $tabel = "kamar_rawat_inap";
        $digit = "3";
        $kode = "R";
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
        foreach ($q->result() as $k) {
        $tmp = ((int) $k->kd_max) + 1;
        $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
        }
        } else {
        $kd = "R001";
        }
        return $kd;
    }
    
}
