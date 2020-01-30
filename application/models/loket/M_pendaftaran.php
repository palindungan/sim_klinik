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
        $ymd = date('ymd');
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel WHERE SUBSTR($field, 1, 6) = $ymd LIMIT 1");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf('%0' . $digit . 's', $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('ymd') . '-' . $kd; // SELECT SUBSTR('RI191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
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
        $field = "kode_antrian_bp";
        $tabel = "antrian_bp";
        $digit = "3";
        $kode = "AG";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "AG001";
        }
        return $kd;
    }

    function get_no_dewasa_lab()
    {
        $field = "kode_antrian_lab";
        $tabel = "antrian_lab";
        $digit = "3";
        $kode = "C";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "C001";
        }
        return $kd;
    }

    function get_no_anak_anak_lab()
    {
        $field = "kode_antrian_lab";
        $tabel = "antrian_lab";
        $digit = "3";
        $kode = "CG";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "CG001";
        }
        return $kd;
    }

    function get_no_kia()
    {
        $field = "kode_antrian_kia";
        $tabel = "antrian_kia";
        $digit = "3";
        $kode = "B";

        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's',  $tmp);
            }
        } else {
            $kd = "B001";
        }
        return $kd;
    }

    function search_autocomplete($table, $field, $data)
    {
        $this->db->like($field, $data, 'both');
        $this->db->order_by($field, 'ASC');
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }
    function get_no_transaksi_ambulan()
    {
        $field = "no_pelayanan_a";
        $tabel = "pelayanan_ambulan";
        $digit = "3";
        $kode = "T";
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
        foreach ($q->result() as $k) {
        $tmp = ((int) $k->kd_max) + 1;
        $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
        }
        } else {
        $kd = "T001";
        }
        return $kd;
    }

     function get_no_rm()
     {
     $field = "no_rm";
     $tabel = "pasien";
     $digit = "9";
     $kode = "024";

     $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
     $kd = "";
     if ($q->num_rows() > 0) {
     foreach ($q->result() as $k) {
     $tmp = ((int) $k->kd_max) + 1;
     $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
     }
     } else {
     $kd = "024000000001";
     }
     return $kd;
     }
}
