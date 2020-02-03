<?php
class M_v_rawat_inap extends CI_Model{
    private $table = 'laporan_ri';
    function countRecordWithTglKeluarParam()
    {
        $this->db->select('tipe_saldo');
        $this->db->from($this->table);
        return $this->db->get()->num_rows();
    }
    function getLastRecordWithTglKeluarParam()
    {
        $this->db->select('tipe_saldo,no_ref_pelayanan,no_akomodasi,temp_saldo');
        $this->db->from($this->table);
        $this->db->order_by('tgl_keluar', 'DESC');
        $this->db->limit('1');
        return $this->db->get()->result();
        // $temp_saldo = "";
        // foreach($data as $i){
        //     $temp_saldo = $i->temp_saldo;
        // }
        // return $temp_saldo;
    }
}