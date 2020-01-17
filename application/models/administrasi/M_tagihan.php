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

    function jumlah_baris($where, $table)
    {
        return $this->db->where($where)->count_all_results($table);
    }

    function get_select($no_ref, $nama, $kolom)
    {
        $this->db->select('*');
        $this->db->from('data_pelayanan_pasien_default');

        $this->db->like('no_ref_pelayanan', $no_ref);
        $this->db->or_like('nama', $nama);

        $where = array(
            'status' => 'belum_finish'
        );

        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    private $_table = 'ambulance';

    function getAmbulance()
    {
        return $this->db->get($this->_table);
    }

    function get_no_lab_t()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_lab_t";
        $tabel = "lab_transaksi";
        $digit = "4";
        $ymd = date('ymd');

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel WHERE SUBSTR($field, 3, 6) = $ymd LIMIT 1");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'LB' . date('ymd') . '-' . $kd; // SELECT SUBSTR('LB191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }
}
