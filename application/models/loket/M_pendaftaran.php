<?php
class M_pendaftaran extends CI_Model
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

    // autogenerate kode / ID
    function get_no()
    {
        $field = "no_ref_pelayanan";
        $tabel = "pelayanan";
        $digit = "3";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('ymd') . '-' . $kd;
    }

    function get_no_dewasa_bp()
    {
        $field = "kode_antrian_bp";
        $tabel = "antrian_bp";
        $digit = "3";
        $kode = "A";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "A001";
        }
        return $kd;
    }

    function get_no_anak_anak_bp()
    {
        $field = "no_ref_pelayanan";
        $tabel = "pelayanan";
        $digit = "3";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('ymd') . '-' . $kd;
    }

    function get_no_dewasa_lab()
    {
        $field = "no_ref_pelayanan";
        $tabel = "pelayanan";
        $digit = "3";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('ymd') . '-' . $kd;
    }

    function get_no_anak_anak_lab()
    {
        $field = "no_ref_pelayanan";
        $tabel = "pelayanan";
        $digit = "3";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('ymd') . '-' . $kd;
    }

    function get_no_kia()
    {
        $field = "no_ref_pelayanan";
        $tabel = "pelayanan";
        $digit = "3";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('ymd') . '-' . $kd;
    }
}
