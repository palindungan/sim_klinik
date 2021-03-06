<?php
class Obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('akses') == ""){
            redirect('login');
        }else if($this->session->userdata('akses') != 'Apotek'){ 
            show_404();
        }
        $this->load->model('apotek/M_obat');
    }
    public function index()
    {
        $data['record'] = $this->M_obat->tampil_join()->result();
        $data['kategori'] = $this->M_obat->tampil_data('kategori_obat')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/obat/tampil', $data);
    }
    public function store()
    {
        $id = $this->M_obat->get_no(); // generate
        $harga_jual = str_replace(".", "", $this->input->post('harga_jual'));
        $data = array(
            'kode_obat' => $id,
            'no_kat_obat' => $this->input->post('no_kat_obat'),
            'nama' => $this->input->post('nama'),
            'min_stok' => $this->input->post('min_stok'),
            'harga_jual' => $harga_jual,
            'tipe' => $this->input->post('tipe_logistik'),
            'stok_gudang' => $this->input->post('stok_gudang'),
            'stok_rawat_jalan' => $this->input->post('stok_rawat_jalan'),
            'stok_rawat_inap' => $this->input->post('stok_rawat_inap')
        );
        $this->M_obat->input_data('obat', $data);
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('apotek/obat');
    }
    public function update()
    {
        $where = array(
            'kode_obat' => $this->input->post('kode_obat')
        );
        $harga_jual = str_replace(".", "", $this->input->post('harga_jual'));
        $data = array(
            'no_kat_obat' => $this->input->post('no_kat_obat'),
            'nama' => $this->input->post('nama'),
            'min_stok' => $this->input->post('min_stok'),
            'harga_jual' => $harga_jual,
            'tipe' => $this->input->post('tipe_logistik'),
            'stok_gudang' => $this->input->post('stok_gudang'),
            'stok_rawat_jalan' => $this->input->post('stok_rawat_jalan'),
            'stok_rawat_inap' => $this->input->post('stok_rawat_inap')

        );
        $this->M_obat->update_data($where, 'obat', $data);
        $this->session->set_flashdata('update', 'Diubah');
        redirect('apotek/obat');
    }
    public function delete($id)
    {
        $where = array('kode_obat' => $id);
        $this->M_obat->hapus_data($where, 'obat');
        $this->session->set_flashdata('hapus', 'Dihapus');
        redirect('apotek/obat');
    }
}
