<?php
class M_pengiriman_obat extends CI_Model
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


    function get_no_transaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        // PO191125-0001
        $field = "no_obat_keluar_i";
        $tabel = "obat_keluar_internal";
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
        return 'OK' . date('ymd') . '-' . $kd; // SELECT SUBSTR('BP191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }
}
