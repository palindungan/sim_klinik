<?php
class Kategori_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_kategoriObat');
    }
    public function index()
    {
        $data['record'] = $this->M_kategoriObat->tampil_data('kategori_obat')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/apotek/kategori_obat/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_kategoriObat->get_no(); // generate
        $data = array(
            'no_kat_obat' => $id,
            'nama' => $this->input->post('nama')
        );
        $this->M_kategoriObat->input_data('kategori_obat',$data);
        redirect('apotek/kategori_obat');
    }
    public function update()
    {
        $where = array(
            'no_kat_obat' => $this->input->post('no_kat_obat')
        );
        $data = array(
            'nama' => $this->input->post('nama')
        );
        $this->M_kategoriObat->update_data($where,'kategori_obat',$data);
        redirect('apotek/kategori_obat');
    }
    public function delete($id)
    {
        $where = array('no_kat_obat' => $id);
        $this->M_kategoriObat->hapus_data($where, 'kategori_obat');
        redirect('apotek/kategori_obat');
    }
    

}
