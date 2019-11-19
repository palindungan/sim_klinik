<?php
class Kamar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_kamar');
    }
    public function index()
    {
        $data['record'] = $this->M_kamar->tampil_data('kamar_rawat_inap')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/admin/kamar/tampil',$data);
    }
    public function store()
    {
        $id = $this->M_kamar->get_no(); // generate
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'no_kamar_rawat_i' => $id,
            'nama' => $this->input->post('nama'),
            'harga_harian' => $harga,
            'tipe' => $this->input->post('tipe')
        );
        $this->M_kamar->input_data('kamar_rawat_inap',$data);
        redirect('admin/kamar');
    }
    public function update()
    {
        $where = array(
            'no_kamar_rawat_i' => $this->input->post('no_kamar_rawat_i')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga_harian' => $harga,
            'tipe' => $this->input->post('tipe')
        );
        $this->M_kamar->update_data($where,'kamar_rawat_inap',$data);
        redirect('admin/kamar');
    }
    public function delete($id)
    {
        $where = array('no_kamar_rawat_i' => $id);
        $this->M_kamar->hapus_data($where, 'kamar_rawat_inap');
        redirect('admin/kamar');
    }
    

}