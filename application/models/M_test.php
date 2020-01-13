<?php
class M_test extends CI_Model
{
    function tampil_data($table)
    {
        return $this->db->get($table);
    }

    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

}
