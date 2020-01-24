<?php
defined("BASEPATH") or die("No Direct Access Allowed");

Class M_setor_uang extends CI_Model{
    private $_table = 'setoran_rawat_inap';

    function inputSetorUang($data){
        $this->db->insert($this->_table,$data);
    }
    function getDataSetorUang(){
        $this->db->order_by('tanggal_setor','DESC');
        return $this->db->get($this->_table)->result();
    }
}