<?php
class Checkup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('laboratorium/M_checkup');
    }
    public function index()
    {
        $data['record'] = $this->M_checkup->tampil_data('lab_checkup')->result();
        $this->template->load('sim_klinik/template/laboratorium', 'sim_klinik/konten/laboratorium/checkup/tampil', $data);
    }
    public function store()
    {
        $id = $this->M_checkup->get_no(); // generate
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'no_lab_c' => $id,
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_checkup->input_data('lab_checkup', $data);
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('laboratorium/checkup');
    }
    public function update()
    {
        $where = array(
            'no_lab_c' => $this->input->post('no_lab_c')
        );
        $harga = str_replace(".", "", $this->input->post('harga'));
        $data = array(
            'nama' => $this->input->post('nama'),
            'harga' => $harga
        );
        $this->M_checkup->update_data($where, 'lab_checkup', $data);
        $this->session->set_flashdata('update', 'Diubah');
        redirect('laboratorium/checkup');
    }
    public function delete($id)
    {
        $where = array('no_lab_c' => $id);
        $this->M_checkup->hapus_data($where, 'lab_checkup');
        $this->session->set_flashdata('hapus', 'Dihapus');
        redirect('laboratorium/checkup');
    }
}
