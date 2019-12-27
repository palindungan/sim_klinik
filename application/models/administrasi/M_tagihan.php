<?php
class M_tagihan extends CI_Model
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

    function get_select($no_ref,$nama,$kolom)
    {
        $this->db->select('*');
        $this->db->from('data_pelayanan_pasien');
        $this->db->or_like('no_ref_pelayanan', $no_ref);
        $this->db->or_like('nama', $nama);
        return $this->db->get()->result_array();
    }
}
