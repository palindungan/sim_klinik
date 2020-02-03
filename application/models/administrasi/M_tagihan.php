<?php
class M_tagihan extends CI_Model
{
    function tampil_data($table)
    {
        return $this->db->get($table);
    }

    function getRekap()
    {
        $this->db->select("no_ref_pelayanan,pasien.no_rm,pasien.nama,tgl_pelayanan,tipe_pelayanan");
        $this->db->from('pelayanan');
        $this->db->join('pasien', 'pelayanan.no_rm = pasien.no_rm');
        $this->db->order_by('no_ref_pelayanan', 'DESC');
        return $this->db->get();
    }
    function getRekapByNoRM($noRM)
    {
        $this->db->select("no_ref_pelayanan,pasien.no_rm,pasien.nama,tgl_pelayanan,tipe_pelayanan");
        $this->db->from('pelayanan');
        $this->db->join('pasien', 'pelayanan.no_rm = pasien.no_rm');
        $this->db->where('pelayanan.no_rm', $noRM);
        $this->db->order_by('no_ref_pelayanan', 'DESC');
        return $this->db->get();
    }

    function deleteTrashData(){
        $date = date("Y-m-d", strtotime( '-4 days' ) );
        $this->db->query("DELETE FROM pelayanan WHERE tgl_pelayanan<='$date' AND grand_total='0'");
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
        $this->db->select('no_ref_pelayanan,nama');
        $this->db->from('data_pelayanan_pasien_default');
        $this->db->group_start();  //group start
        $this->db->like('no_ref_pelayanan', $no_ref);
        $this->db->or_like('nama', $nama);
        $this->db->group_end();  //group ed
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

    function get_no_bp_p()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_bp_p";
        $tabel = "bp_penanganan";
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
        return 'BP' . date('ymd') . '-' . $kd; // SELECT SUBSTR('BP191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_ugd_p()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_ugd_p";
        $tabel = "ugd_penanganan";
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
        return 'UP' . date('ymd') . '-' . $kd; // SELECT SUBSTR('BP191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_kia_p()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_kia_p";
        $tabel = "kia_penanganan";
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
        return 'KP' . date('ymd') . '-' . $kd; // SELECT SUBSTR('BP191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_pelayanan_a()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_pelayanan_a";
        $tabel = "pelayanan_ambulan";
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
        return 'AB' . date('ymd') . '-' . $kd; // SELECT SUBSTR('AB191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_penjualan_obat_a()
    {
        date_default_timezone_set('Asia/Jakarta');
        // PO191125-0001
        $field = "no_penjualan_obat_a";
        $tabel = "penjualan_obat_apotik";
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

        return 'PA' . date('ymd') . '-' . $kd; // SELECT SUBSTR('BP191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_transaksi_rawat_i()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_transaksi_rawat_i";
        $tabel = "transaksi_rawat_inap";
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
        return 'RI' . date('ymd') . '-' . $kd; // SELECT SUBSTR('RI191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }

    function get_no_transaksi_lain()
    {
        date_default_timezone_set('Asia/Jakarta');
        $field = "no_transaksi_lain";
        $tabel = "transaksi_lain";
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
        return 'LN' . date('ymd') . '-' . $kd; // SELECT SUBSTR('LN191121-0001', 3, 6); dari digit ke 3 sampai 6 digit seanjutnya
    }
}
