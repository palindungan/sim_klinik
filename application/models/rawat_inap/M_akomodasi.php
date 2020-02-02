<?php
class M_akomodasi extends CI_Model
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

    function get_no_akomodasi_rawat_inap()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_akomodasi_rawat_i";
        $tabel = "akomodasi_rawat_inap";
        $digit = "4";
        $ymd = date('ymd');

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel WHERE SUBSTR($field, 3, 6) = $ymd LIMIT 1");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's', $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'AR' . date('ymd') . '-' . $kd; // SELECT SUBSTR('RI191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }
    function countRecordWithTglKeluarParam()
    {
        $this->db->select('no_akomodasi_rawat_i');
        $this->db->from('akomodasi_rawat_inap');
        return $this->db->get()->num_rows();
    }
    function getLastRecordWithTglKeluarParam()
    {
        $this->db->select('temp_saldo');
        $this->db->from('laporan_ri');
        $this->db->order_by('tgl_keluar', 'DESC');
        $this->db->limit('1');
        return  $this->db->get()->result();
        // $temp_saldo = "";
        // foreach($data as $i){
        //     $temp_saldo = $i->temp_saldo;
        // }
        // return $temp_saldo;
    }
}
