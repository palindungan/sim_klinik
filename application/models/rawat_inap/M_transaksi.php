<?php
class M_transaksi extends CI_Model
{
    function tampil_join()
    {
        $this->db->select('*');
        $this->db->from('pelayanan');
        $this->db->join('pasien', 'pasien.no_rm = pelayanan.no_rm');
        $query = $this->db->get();
        return $query;
    }
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

    // autogenerate kode / ID
    function get_no()
    {
        $field = "no_lab_c";
        $tabel = "lab_checkup";
        $digit = "3";
        $kode = "L";
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
            }
        } else {
            $kd = "L001";
        }
        return $kd;
    }

    function get_no_transaksi()
    {
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
        date_default_timezone_set('Asia/Jakarta');
        return 'LB' . date('ymd') . '-' . $kd; // SELECT SUBSTR('LB191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function search_autocomplete($table, $field, $data)
    {
        $this->db->like($field, $data, 'both');
        $this->db->order_by($field, 'ASC');
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }
}