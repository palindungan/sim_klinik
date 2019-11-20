<?php

class M_login extends CI_Model
{
    public function cek_login()
    {
        $where = array(
            'username' => $this->input->post('username')
        );
        $this->db->select('*'); // Select field
        $this->db->from('user_pegawai'); // from Table1
        $this->db->where($where);
        return $this->db->get();
    }
}
