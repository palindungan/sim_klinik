<?php
class M_obat extends CI_Model
{
    function tampil_data($table)
    {
        return $this->db->get($table);
    }

    function tampil_join()
    {
        $this->db->select('kode_obat,obat.nama AS nama_obat,kategori_obat.nama AS nama_kategori,obat.no_kat_obat AS no_kat,min_stok,harga_jual,tipe,stok_gudang,stok_rawat_inap,stok_rawat_jalan');
        $this->db->from('obat');
        $this->db->join('kategori_obat', 'kategori_obat.no_kat_obat = obat.no_kat_obat', 'left');
        $query = $this->db->get();
        return $query;
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
        $field = "kode_obat";
        $tabel = "obat";
        $digit = "3";
        $kode = "O";
        $q = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS kd_max FROM $tabel");
        $kd = "";
        if ($q->num_rows() > 0) {
        foreach ($q->result() as $k) {
        $tmp = ((int) $k->kd_max) + 1;
        $kd = $kode . sprintf('%0' . $digit . 's', $tmp);
        }
        } else {
        $kd = "O001";
        }
        return $kd;
    }
    
}
