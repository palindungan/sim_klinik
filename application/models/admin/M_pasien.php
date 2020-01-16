<?php
class M_pasien extends CI_Model
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

    function list_kunjung($table,$id)
    {
        return $this->db->order_by('tgl_pelayanan', 'DESC')->get_where($table, array('no_rm' => $id),10);
    }

    function tampil_pasien($table)
    {
        return $this->db->order_by('tgl_pelayanan','DESC')->get_where($table,array('status' => 'finish'));
    }

    function ambil_nama($table,$no_rm)
    {
        return $this->db->get_where($table,array('no_rm' => $no_rm));
    }

    function detail_pasien($table,$id)
    {
        return $this->db->get_where($table,array('no_rm' => $id));
    }
    function detail_pelayanan($table,$id)
    {
        return $this->db->get_where($table,array('no_ref_pelayanan' => $id));
    }
    
}
