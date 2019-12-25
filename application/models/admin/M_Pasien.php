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
    function ambil_no_kia($table,$id)
    {
        return $this->db->get_where($table,array('no_ref_pelayanan' => $id));

    }
    function detail_tindakan_kia($no_kia_p)
    {
        $this->db->select('*');
        $this->db->from('detail_kia_penanganan');
        $this->db->join('kia_tindakan', 'detail_kia_penanganan.no_kia_t = kia_tindakan.no_kia_t');
        $this->db->where('detail_kia_penanganan.no_kia_p', $no_kia_p);
        return $this->db->get();
    }
    
}
