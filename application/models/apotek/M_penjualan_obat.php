<?php
class M_penjualan_obat extends CI_Model
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
        $field = "no_bp_t";
        $tabel = "bp_tindakan";
        $digit = "3";
        $kode = "B";
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
            }
        } else {
            $kd = "B001";
        }
        return $kd;
    }

    function get_no_transaksi()
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
    function get_select($no_ref, $nama, $kolom)
    {
        $this->db->select('no_ref_pelayanan,nama');
        $this->db->from('pelayanan_pasien_default');
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

    function daftar_rekap_penjualan_obat_semua($tgl_mulai,$tgl_akhir)
    {
        $query = $this->db->query("SELECT sum(qty) as qty,kode_obat,nama,tanggal FROM daftar_rekap_penjualan_obat_semua WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir' GROUP BY nama ORDER BY nama ASC");
        return $query;
    }
}
