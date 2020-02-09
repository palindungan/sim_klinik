<?php

Class M_cek_saldo extends CI_Model{
    private $_table = 'temp_saldo';
    function getLastRecordCekSaldo(){
        $this->db->select('id_temp_saldo,tanggal,saldo_ri');
        $this->db->from($this->_table);
        $this->db->order_by('id_temp_saldo','DESC');
        $this->db->limit(1);
        return $this->db->get()->result();
    }

    function getCekSaldoByDate($tanggal){
        $this->db->select('saldo_ri');
        $this->db->from($this->_table);
        $this->db->where('tanggal',$tanggal);
        $this->db->order_by('id_temp_saldo','DESC');
        $this->db->limit(1);
        $data =  $this->db->get()->result();
        $saldo = 0;
        foreach($data as $i){
            $saldo = $i->saldo_ri;
        }
        return $saldo;
    }
    function input_saldo($data){
        $this->db->insert($this->_table,$data);
    }
}